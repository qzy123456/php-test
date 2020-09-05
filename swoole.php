<?php
/**
 * Created by PhpStorm.
 * User: artist
 * Date: 2019-03-19
 * Time: 11:03
 */
$server = new swoole_websocket_server("127.0.0.1", 5200);
// 设置配置
$server->set(
    array(
        'daemonize' => false,      // 是否是守护进程
        'max_request' => 10000,    // 最大连接数量
        'dispatch_mode' => 2,
        'debug_mode'=> 1,
        // 心跳检测的设置，自动踢掉掉线的fd
        'heartbeat_check_interval' => 5,
        'heartbeat_idle_time' => 600,
        'task_worker_num' => 4
    )
);
$server->on('open', function($server, $req) {
    echo "connection open: {$req->fd}\n";
});

$server->on('message', function($server, $frame) {
    echo "received message: {$frame->data}\n";
    $task['type'] = $frame->data;
    $task['fd']   = $frame->fd;
    $server ->task($task);


});
$server->on('task', function ( $server, $task_id, $from_id, $datas) {

    $update_path = 'img/';
    $data = json_decode($datas['type'], 1);
    if($data['type'] == 3){
        $exe = str_replace('/', '.', strstr(strstr($data['data'], ';', TRUE), '/'));
        $exe = $exe == '.jpeg' ? '.jpg' : $exe;
        $tmp = base64_decode(substr(strstr($data['data'], ','), 1));
        $path = $update_path . md5(rand(1000, 999)) . $exe;
        file_put_contents($path, $tmp);
        echo "image path : {$path}\n";
        $server->push($datas['fd'], $path);
    }
    $server->push($datas['fd'], $data['data']);
    //finish操作是可选的
    //$server->finish("ok");
});
$server->on('finish', function ( $server, $task_id, $data) {
    echo "Finish taskID={$task_id}\n";
});
$server->on('close', function($server, $fd) {
    echo "connection close: {$fd}\n";
});

$server->start();
//
//class Server
//{
//    private $serv;
//    private $conn = null;
//    private static $fd = null;
//
//    public function __construct()
//    {
//        $this->initDb();
//        $this->serv = new swoole_websocket_server("0.0.0.0", 5200);
//        $this->serv->set(array(
//            'worker_num' => 8,
//            'daemonize' => false,
//            'max_request' => 10000,
//            'dispatch_mode' => 2,
//            'debug_mode' => 1
//        ));
//
//        $this->serv->on('Open', array($this, 'onOpen'));
//        $this->serv->on('Message', array($this, 'onMessage'));
//        $this->serv->on('Close', array($this, 'onClose'));
//
//        $this->serv->start();
//
//    }
//   //每次连接的时候 更新一下表
//    function onOpen($server, $req)
//    {
//         $server->push($req->fd, json_encode(33));
//    }
//
//    public function onMessage($server, $frame)
//    {
//        //$server->push($frame->fd, json_encode(["hello", "world"]));
//        $pData = json_decode($frame->data);
//        $data = array();
//        if (isset($pData->content)) {
//            $tfd = $this->getFd($pData->tid); //获取绑定的fd
//            $data = $this->add($pData->fid, $pData->tid, $pData->content); //保存消息
//            $server->push($tfd, json_encode($data)); //推送到接收者
//        } else {
//            $this->unBind(null,$pData->fid); //首次接入，清除绑定数据
//            if ($this->bind($pData->fid, $frame->fd)) {  //绑定fd
//                $data = $this->loadHistory($pData->fid, $pData->tid); //加载历史记录
//            } else {
//                $data = array("content" => "无法绑定fd");
//            }
//        }
//        $server->push($frame->fd, json_encode($data)); //推送到发送者
//
//    }
//
//
//    public function onClose($server, $fd)
//    {
//        $this->unBind($fd);
//        echo "connection close: " . $fd;
//    }
//
//
//    /*******************/
//    function initDb()
//    {
//        $conn = mysqli_connect("127.0.0.1", "root", "root");
//        if (!$conn) {
//            die('Could not connect: ' . mysql_error());
//        } else {
//            mysqli_select_db($conn, "test");
//        }
//        $this->conn = $conn;
//    }
//
//    public function add($fid, $tid, $content)
//    {
//        $sql = "insert into msg (fid,tid,content) values ($fid,$tid,'$content')";
//        if ($this->conn->query($sql)) {
//            $id = $this->conn->insert_id;
//            $data = $this->loadHistory($fid, $tid, $id);
//            return $data;
//        }
//    }
//
//    public function bind($uid, $fd)
//    {
//        $sql = "insert into fd (uid,fd) values ($uid,$fd)";
//        if ($this->conn->query($sql)) {
//            return true;
//        }
//    }
//
//    public function getFd($uid)
//    {
//        $sql = "select * from fd where uid=$uid limit 1";
//        $row = "";
//        if ($query = $this->conn->query($sql)) {
//            $data = mysqli_fetch_assoc($query);
//            $row = $data['fd'];
//        }
//        return $row;
//    }
//
//    public function unBind($fd, $uid = null)
//    {
//        if ($uid) {
//            $sql = "delete from fd where uid=$uid";
//        } else {
//            $sql = "delete from fd where fd=$fd";
//        }
//        if ($this->conn->query($sql)) {
//            return true;
//        }
//    }
//
//    public function loadHistory($fid, $tid, $id = null)
//    {
//        $and = $id ? " and id=$id" : '';
//        $sql = "select * from msg where ((fid=$fid and tid = $tid) or (tid=$fid and fid = $tid))" . $and;
//        $data = [];
//        if ($query = $this->conn->query($sql)) {
//            while ($row = mysqli_fetch_assoc($query)) {
//                $data[] = $row;
//            }
//        }
//        return $data;
//    }
//}
//
//// 启动服务器
//$server = new Server();
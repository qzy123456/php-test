<?php
//确保在连接客户端时不会超时
set_time_limit(0);

$ip = '127.0.0.1';
$port = 1938;

/*
 +-------------------------------
 *    @socket通信整个过程
 +-------------------------------
 *    @socket_create
 *    @socket_bind
 *    @socket_listen
 *    @socket_accept
 *    @socket_read
 *    @socket_write
 *    @socket_close
 +--------------------------------
 */

if(($sock = socket_create(AF_INET,SOCK_STREAM,SOL_TCP)) < 0) {
    echo "socket_create() 失败的原因是:".socket_strerror($sock)."\n";
}

if(($ret = socket_bind($sock,$ip,$port)) < 0) {
    echo "socket_bind() 失败的原因是:".socket_strerror($ret)."\n";
}

if(($ret = socket_listen($sock,4)) < 0) {
    echo "socket_listen() 失败的原因是:".socket_strerror($ret)."\n";
}

$count = 0;

do {
    if (($msgsock = socket_accept($sock)) < 0) {
        echo "socket_accept() failed: reason: " . socket_strerror($msgsock) . "\n";
        break;
    } else {


        $channelName = "testPubSub";
        $channelName2 = "testPubSub2";
        try {
            $redis = new \Redis();
            //建立一个长链接
            $redis->pconnect('127.0.0.1');
            //阻塞获取消息
            while (true){
                //构建命令参数
                $param = array('subscribe', $channelName, $channelName2);
                //使用call_user_func_array回调执行命令
                $ret = call_user_func_array(array($redis, 'rawCommand'), $param);
                //如果结果是消息结构
                if (isset($ret[0]) && $ret[0] == 'message'){
                    //输出消息频道和消息内容
                    echo "channel:".$ret[1].",message:".$ret[2]."\n";


                    socket_write($msgsock, $ret[2], strlen( $ret[2]));
                } else {
                    //没有消息休眠1秒
                    sleep(1);
                }
            }
        } catch (Exception $e){
            echo $e->getMessage();
        }
        //发到客户端
        $msg ="测试成功！\n";
        socket_write($msgsock, $msg, strlen($msg));

        echo "测试成功了啊\n";
        $buf = socket_read($msgsock,8192);


        $talkback = "收到的信息:$buf\n";
        echo $talkback;



    }
    //socket_close($msgsock);

} while (true);

socket_close($sock);
?>
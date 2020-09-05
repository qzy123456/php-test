<?php


$server = new swoole_websocket_server("0.0.0.0", 9501);
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);
$redis->select(0);
$server->on('open', function (swoole_websocket_server $server, $request) {
    echo "server: handshake success with fd{$request->fd}\n";//$request->fd 是客户端id
});
//内容格式类似    {"flag":"init","from":myemail,"to":toemail};
$server->on('message', function (swoole_websocket_server $server, $frame) {
    //客户端发过来的json数据
    $pData = json_decode($frame->data);
    if($GLOBALS['redis']->get($frame->fd) == false){
        $datas = ["user" => $pData->user, "group" => isset($pData->group) ? $pData->group : ""];
        $GLOBALS['redis']->set($frame->fd, json_encode($datas));

    }
    if($pData->type == 'msg'){
        //非初始化的信息发送，一对一聊天，根据每个用户对应的fd发给特定用户
        foreach ($server->connections as $tempfd) {
            $user_info = $GLOBALS['redis']->get($tempfd);
            $user_info = json_decode($user_info);

            var_dump($user_info->user);
            if ($user_info && $user_info->user === $pData->sendTo) {
                $mes = $pData->data;
                $server->push($tempfd, "{\"code\":\"1\",\"mes\":\"{$mes}\"");
                break;
            }
        }
       //群组聊天，根据group的id
    }else if($pData->type == 'group'){
        foreach($server->connections as $fd){
            $result = $GLOBALS['redis']->get($fd);
            $result = json_decode($result);
            var_dump($result->group);
            //自己不再发一遍
            if ($frame === $fd || $result->group !== $pData->group) {
                continue;
            }
            $server->push($fd , $pData->data);
        }

    }


});

$server->on('close', function ($ser, $fd) {
    $GLOBALS['redis']->del($fd);
    echo "client {$fd} closed\n";
});

$server->start();

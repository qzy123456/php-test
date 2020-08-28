<?php
/**
 * Created by PhpStorm.
 * User: artist
 * Date: 2020-07-02
 * Time: 18:06
 */
//创建Server对象，监听 127.0.0.1:9502端口，类型为SWOOLE_SOCK_UDP
$serv = new Swoole\Server("127.0.0.1", 9502, SWOOLE_PROCESS, SWOOLE_SOCK_UDP);

//监听数据接收事件
$serv->on('Packet', function ($serv, $data, $clientInfo) {
    $serv->sendto($clientInfo['address'], $clientInfo['port'], "Server ".$data);
    var_dump($clientInfo);
    //array(4) {
    //  ["server_socket"]=>
    //  int(4)
    //  ["server_port"]=>
    //  int(9502)
    //  ["address"]=>
    //  string(9) "127.0.0.1"
    //  ["port"]=>
    //  int(61097)
    //}
});

//启动服务器
$serv->start();
//netcat -u 127.0.0.1 9502
//hello
//Server: hello



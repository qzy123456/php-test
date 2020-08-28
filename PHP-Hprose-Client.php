<?php

include "hprose-php-master/src/Hprose.php";

try{
    $TcpServerAddr = "tcp://127.0.0.1:8082";
    $client = \Hprose\Socket\Client::create($TcpServerAddr,false);
        //命名空间是Sample，也不知道为啥 即使为空这段反正不能少
    $service = $client->useService('', 'Sample');
    //调用server端Sample注册过的GetUserInfo方法
    $rep = $service->GetUserInfo(16);
    print_r($rep);

    //也不知道为啥 这段反正不能少
    $services = $client->useService('', '');
    //调用server端注册过的hello方法
    $rep1 = $services->hello1("312312ass");
    print_r($rep1);
} catch (Exception $e){
    echo $e->getMessage();
}
<?php
//点对点～～只能接收一次  queue
//try {
//    // 1.建立连接
//    $stomp = new Stomp('tcp://127.0.0.1:61613');
//    // 2.实例化类
//    $obj = new Stdclass();
//    // 3.获取数据
//    for($i=0; $i<3; $i++){
//        $obj->username = 'test';
//        $obj->password = '123456';
//        $queneName   = "/queue/userReg";
//        // 4.发送一个注册消息到队列
//        $stomp->send($queneName, json_encode($obj));
//    }
//} catch (StompException $e) {
//    die('Connection failed: ' . $e->getMessage());
//}
//发布/订阅模型特点：
//多个消费者都可以收到消息  topic
//能重复消费
try {
    // 1.建立连接
    $stomp = new Stomp('tcp://127.0.0.1:61613');
    // 2.实例化类
    $obj = new Stdclass();
    // 3.获取数据
    $obj->username = 'test';
    $obj->password = time();
    $queneName   = "/topic/userReg";
    // 4.发送一个注册消息到队列                          persistent
    $stomp->send($queneName, json_encode($obj),array('persistent' => 'true'));

} catch (StompException $e) {
    die('Connection failed: ' . $e->getMessage());
}


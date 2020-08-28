<?php
/**
 * Created by PhpStorm.
 * User: artist
 * Date: 2019-09-17
 * Time: 14:37
 */
//点对点只能被接收一次，
//$stomp = new Stomp('tcp://localhost:61613');
//$stomp->subscribe('/queue/userReg');
//
//while (true) {
//    //判断是否有读取的信息
//    if ($stomp->hasFrame()) {
//        $frame = $stomp->readFrame();
//        $data = json_decode($frame->body, true);
//        var_dump($data);
//        $stomp->ack($frame);
//    }
//}
//发布/订阅模型特点：
//多个消费者都可以收到消息
//能重复消费（适合广播）

$stomp = new Stomp('tcp://localhost:61613');
$stomp->subscribe('/topic/userReg');
while (true) {
    //判断是否有读取的信息
    if ($stomp->hasFrame()) {
        $frame = $stomp->readFrame();
        $data = json_decode($frame->body, true);

        if ($data['username'] == "test1"){
            var_dump($data);
            $stomp->ack($frame);
        }
    }
}
<?php

//官网例子
//$rk = new RdKafka\Producer();
//$rk->addBrokers("127.0.0.1");
//
//$topic = $rk->newTopic("test");
//
//for ($i = 0; $i < 10; $i++) {
//    $topic->produce(RD_KAFKA_PARTITION_UA, 0, "Message $i");
//    $rk->poll(0);
//}
//
//while ($rk->getOutQLen() > 0) {
//    $rk->poll(50);
//}
$rk = new RdKafka\Producer();
$rk->addBrokers("127.0.0.1:9092");
$topic = $rk->newTopic("sms");
for ($i=0;$i<51;$i++) {
    $content = "第" . $i . "次报警";
    $message = ["mobile" => "18812345678", "content" => $content];
    $payload = json_encode($message);
    //指定向0号partition生产数据
    //$topic->produce(0, 0, $payload);
    //随机选择partition
    $topic->produce(RD_KAFKA_PARTITION_UA, 0, $payload);
    $rk->poll(0);
}
//发消息
while ($rk->getOutQlen() > 0){
    $rk->poll(50);
}


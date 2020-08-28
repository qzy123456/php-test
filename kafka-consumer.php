<?php
//kafka高级消费，类似于发布 订阅，可以同时发给多个订阅者  ，但是订阅者下线  再上线，如果消息被消费之后  就不能再重复消费了
$conf = new RdKafka\Conf();

$conf->setRebalanceCb(function(RdKafka\KafkaConsumer $kafka, $err, array $partitions = null) {
    switch($err) {
        case RD_KAFKA_RESP_ERR__ASSIGN_PARTITIONS:
            $kafka->assign($partitions);
            break;
        case RD_KAFKA_RESP_ERR__REVOKE_PARTITIONS:
            $kafka->assign(NULL);
            break;
        default:
            throw new \Exception($err);
    }
});

$conf->set("group.id", "sms-consumer-group");
$conf->set("metadata.broker.list", "127.0.0.1:9092");
$topicConf = new RdKafka\TopicConf();
$topicConf->set("auto.offset.reset", "smallest");
//$conf->setDefaultTopicConf($topicConf); 加这个老是报错   但是不影响下面的使用   呵呵了
$consumer = new RdKafka\KafkaConsumer($conf);
$consumer->subscribe(["sms"]);
while(true) {
    $message = $consumer->consume(20000);
    switch($message->err) {
        case RD_KAFKA_RESP_ERR_NO_ERROR:
            echo "正确读取到数据\n\r";
            var_dump($message->payload);
            break;
        case RD_KAFKA_RESP_ERR__PARTITION_EOF:
            echo "没有读到数据\n\r";
            break;
        case RD_KAFKA_RESP_ERR__TIMED_OUT:
            echo "读取数据超时\n\r";
            break;
        default:
            throw new \Exception($message->errstr(), $message->err);
            break;
    }
}
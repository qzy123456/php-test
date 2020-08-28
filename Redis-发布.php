<?php
/**
 * Created by PhpStorm.
 * User: artist
 * Date: 2019-08-23
 * Time: 14:05
 */
//生产者发送消息
$channelName = "testPubSub";
$channelName2 = "testPubSub2";
//向指定频道发送消息
try {
    $redis = new \Redis();
    $redis->connect('127.0.0.1');
    for ($i=0;$i<5;$i++){
        $data = array('key' => 'key'.$i, 'data' => 'testdata');
        $param = array('publish', $channelName, json_encode($data));
        $ret = call_user_func_array(array($redis, 'rawCommand'), $param);
        print_r($ret);
    }
} catch (Exception $e){
    echo $e->getMessage();
}
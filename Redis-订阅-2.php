<?php
/**
 * Created by PhpStorm.
 * User: artist
 * Date: 2019-08-23
 * Time: 14:05
 */

//声明测试频道名称

$redis = new Redis();
$res = $redis->pconnect('127.0.0.1', 6379,0);
$redis->subscribe(array('test'), 'callback');

// 回调函数,这里写处理逻辑
function callback($instance, $channelName, $message)
{
    echo $channelName, "==>", $message, PHP_EOL;
}
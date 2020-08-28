<?php
/**
 * Created by PhpStorm.
 * User: artist
 * Date: 2019-08-23
 * Time: 14:05
 */
//生产者发送消息
$redis = new Redis();
// 第一个参数为redis服务器的ip,第二个为端口
$res = $redis->connect('127.0.0.1', 6379);
// test为发布的频道名称,hello,world为发布的消息
$res = $redis->publish('test','hello,world');

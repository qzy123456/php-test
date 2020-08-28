<?php
/**
 * Created by PhpStorm.
 * User: artist
 * Date: 2020-06-03
 * Time: 16:27
 */
$redis = new Redis();

$redis -> connect('127.0.0.1', 6379);

$redis -> hset('zhlinfo', 'name', 'zhl');

$redis -> hset('zhlinfo', 'age', 26);

$redis -> hset('zhlinfo', 'address', 'China Beijing');

var_dump($redis -> hgetall('zhlinfo'));
//
echo $redis -> hget('zhlinfo', 'name');
//
echo $redis -> hget('zhlinfo', 'age');
//
echo $redis -> hget('zhlinfo', 'address');


$arr = array('name' => 'cjq', 'age'=> '23', 'address' => 'China Beijing', 'hobby'=>'travelling');

$redis -> hmset('cjqinfo', $arr);


var_dump($redis->hmget('cjqinfo',['name']));

echo $redis->hget('cjqinfo','hobby');

$redis -> setTimeout('cjqinfo', 5); //设置过期时间
sleep(5);

var_dump($redis->hmget('cjqinfo',['name']));


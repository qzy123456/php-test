<?php
try {
    $redis = new Redis();
    $redis->connect('127.0.0.1', 6379);
    //先设置缓存keyTest为1
    $redis->setex('keyTest', 60, 1);
    //监视keyTest
    $redis->watch(array('keyTest'));
    //假设在开始监视之后，执行事务之前，keyTest被并发操作redis的其他用户修改了
    $redis->setex('keyTest', 60, 10);
    //开启事务
    $redis->multi();
    $redis->incr('keyTest');
    //执行事务
    $ret = $redis->exec();
    var_dump($ret);
    $ret = $redis->get('keyTest');
    var_dump($ret);
    //查看keyTest
} catch (Exception $e){
    echo $e->getMessage();
}

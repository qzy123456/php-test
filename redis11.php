<?php
$data   =   array (

    array ('id'  =>   1 ,   'weight'  =>   5 ) ,
    array ('id'  =>   2 ,    'weight'  =>   110 ) ,
    array ('id' =>   3 ,    'weight'  =>   15 ) ,

);
$weight = 0;
$tempdata = array();
foreach ($data as $one) {

    $weight += $one ['weight'];
    for ($i = 0; $i < $one ['weight']; $i++) {
        $tempdata [] = $one;
    }
}
$use = rand(0, $weight - 1);
$one = $tempdata [$use];
//print_r( $one);die;
$str = "tt_log";
$str = str_replace(array("\r\n", "\r", "\n"), "", trim($str));
//echo $str;
$redis = new Redis();
//var_export($redis);
//Redis::__set_state(array( ))
$redis->connect('127.0.0.1');
$redis->select(1);
//
//
////用户uid
///
$uid = 1;
$dd = "ღⓃ☝☄☆☻☽♫😀🙄😪🤩🤐😢✊👊👱‍♂️🙍‍♂️💕";
$redis->set("符号",$dd,['nx', 'ex'=>90]);
$redis->incr('xsxs');

//$redis->close();
//$redis->hSet("test",11,1);
////print_r($redis->hGetAll('test'));
//
for($i=1;$i<=10;$i++){
    $redis->lPush($str,json_encode($data));
}
//die;
////var_dump($redis->lRange($str,0,-1));
//var_dump($redis->lRem($str,10,0));
$time = time();
// 处理一下消息
$messageData = [
    // 时间戳做消息的id
        "uuid" => 111, // 谁发的消息（系统消息的话，可以为空）
        "message" => 11, // 消息
        "type" => $time // 消息类型(客户端用于处理)

];
$key = "hash22";
$redis->zAdd($key,$time,time());
//$total = $redis->zSize($key);
//echo $total;
//$redis->zRemRangeByScore($key,1572513591,1572513591);
//var_dump($redis->zRangeByScore($key,0,time(),array('withscores' => TRUE)));
//var_dump($redis->zRemRangeByRank($key,5,-1));
//var_dump($redis->zRangeByScore($key,0,time(),array('withscores' => TRUE)));
//var_dump($redis->zRange($key,0,1,TRUE));
//下面是hash操作
//$redis->hSet($key,$time,json_encode($messageData));
//var_dump($redis->hDel($key,1572256083));
//var_dump($redis->hGetAll($key));
//print_r(array_slice($redis->hGetAll($key),-2,null,true));
//print_r(array_keys($redis->hGetAll($key))[0]);

//die;
//
//
//
////开始有签到功能的日期
$startDate = '2017-01-01';

//今天的日期
$todayDate = '2019-05-05';
//记录有uid的key
$cacheKey = "sign-".$todayDate.'-'.$uid;
//计算offset
//$startTime = strtotime($startDate);
//$todayTime = strtotime($todayDate);
//$offset = floor(($todayTime - $startTime) / 86400);
//
//echo "今天是第{$offset}天" ;
//echo "<br>";

//签到
//一年一个用户会占用多少空间呢？大约365/8=45.625个字节，好小，有木有被惊呆？
$redis->setBit($cacheKey, $uid, 1);

//查询签到情况
$bitStatus = $redis->getBit($cacheKey, $uid);
echo  $bitStatus ;
echo "<br>";



//$redis->Bitop('AND', 'monthActivities', $redis->keys('sign-2019-05*'));
echo "连续三天都签到的用户数量：" . $redis->bitCount('twoAnd');
echo PHP_EOL;

/* 设置遍历的特性为不重复查找，该情况下扩展只会scan一次，所以可能会返回空集合 */
$redis->setOption(Redis::OPT_SCAN, Redis::SCAN_NORETRY);
$count = 50;  // 每次遍历50条，注意是遍历50条，遍历出来的50条key还要去匹配你的模式，所以并不等于就能够取出50条key
$iterator = null;
while (true) {
    $keys = $redis->scan($iterator, 'sign-*'.'-'.$uid,$count);
    if ($keys === false) {//迭代结束，未找到匹配pattern的key
        return;
    }
    foreach ($keys as $key) {
        echo $key ;
        echo  PHP_EOL;
    }

}


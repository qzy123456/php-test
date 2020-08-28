<?php
header("content-type:text/html;charset=utf-8");
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);
$redis->watch("mywatchlist");
$len = $redis->hlen("mywatchlist");
$rob_total = 2; //抢购数量
if ($len < $rob_total) {
    $redis->multi();
    $redis->hSet("mywatchlist", "user_id_" . mt_rand(1, 999999), time());
    $rob_result = $redis->exec();
    //file_put_contents("log.txt", $len . PHP_EOL, FILE_APPEND);
    if ($rob_result) {
        $mywatchlist = $redis->hGetAll("mywatchlist");
        echo '抢购成功' . PHP_EOL;
        echo '剩余数量：' . ($rob_total - $len - 1) . PHP_EOL;
        echo '用户列表：' . PHP_EOL;
        print_r($mywatchlist);
        exit;
    } else {
        exit('手气不好，再抢购！');
    }
} else {
    exit('已卖光');
}

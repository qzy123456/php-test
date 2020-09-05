<?php
/**
 * Created by PhpStorm.
 * User: artist
 * Date: 2019-05-06
 * Time: 18:22
 */
date_default_timezone_set('Asia/Shanghai');
$path = "test.json";
    $fileContent = file_get_contents ( $path );
    $fileContent = json_decode($fileContent,true);
    //当前时间（测试时间）
    $time = time();
    //算出当前时间，已经过了多少个周期
    $cycle = ceil(($time - ($fileContent['correction'] + $fileContent['start_time'])) / $fileContent["cycle"]);
    $data = [];
    for ($i = 0;$i<=$cycle;$i++){
        //活动的开启时间，是  起始时间 + 周期时间 * 第n个周期
        $data[$i]["start"] = $fileContent['start_time'] + $i * $fileContent['cycle'];
        //活动的结束时间  是 开启时间+赛季的持续时间  （周期比持续时间长）
        $data[$i]["end"] = $data[$i]["start"] + $fileContent['duration'];
        $data[$i]['name'] = date('Y-m-d',$data[$i]["start"]);
    }
    echo "<pre>";
    print_r($data);
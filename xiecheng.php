<?php
/**
 * Created by PhpStorm.
 * User: artist
 * Date: 2019-05-05
 * Time: 11:50
 */

function task1(){
    for ($i=0;$i<=300;$i++){
        //写入文件,大概要3000微秒
        usleep(3000);
        echo "写入文件{$i}\n";
        Co::sleep(0.001);//挂起当前协程,0.001秒后恢复//相当于切换协程
    }
}
function task2(){
    for ($i=0;$i<=500;$i++){
        //发送邮件给500名会员,大概3000微秒
        usleep(3000);
        echo "发送邮件{$i}\n";
        Co::sleep(0.001);//挂起当前协程,0.001秒后恢复//相当于切换协程
    }
}
function task3(){
    for ($i=0;$i<=100;$i++){
        //模拟插入100条数据,大概3000微秒
        usleep(3000);
        echo "插入数据{$i}\n";
        Co::sleep(0.001);//挂起当前协程,0.001秒后恢复//相当于切换协程
    }
}
$pid1 = go('task1');//go函数是swoole的开启协程函数,用于开启一个协程
$pid2 = go('task2');
$pid3 = go('task3');
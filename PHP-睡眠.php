<?php
/**
 * Created by PhpStorm.
 * User: artist
 * Date: 2020-05-21
 * Time: 16:20
 */
echo date('h:i:s') . "<br />"; //暂停 2 秒
sleep(2);//重新开始
echo date('h:i:s');


echo date('h:i:s') . "<br />";
//延迟 10 秒
usleep(10000000);
//再次开始
echo date('h:i:s');
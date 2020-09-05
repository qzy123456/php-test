<?php

//array_unshift() 函数用于向数组插入新元素。新数组的值将被插入到数组的开头。
$a = array("a" => "red", "b" => "green");
array_unshift($a, "blue");
print_r($a);
//array_filter() 函数用回调函数过滤数组中的元素。
//该函数把输入数组中的每个键值传给回调函数。如果回调函数返回 true，则把输入数组中的当前键值返回给结果数组。数组键名保持不变。
function test_odd($var)
{
    return ($var & 1);
}

$a1 = array("a", "b", 2, 3, 4);
print_r(array_filter($a1, "test_odd"));
//array_map() 函数将用户自定义函数作用到数组中的每个值上，并返回用户自定义函数作用后的带有新的值的数组。
function myfunction($v)
{
    return ($v * $v);
}

$a = array(1, 2, 3, 4, 5);
print_r(array_map("myfunction", $a));
//array_walk_recursive() 函数对数组中的每个元素应用用户自定义函数。在函数中，数组的键名和键值是参数。
//该函数与 array_walk() 函数的不同在于可以操作更深的数组（一个数组中包含另一个数组）。
function myfunction1($value, $key)
{
    echo "The key $key has the value $value<br>";
}

$a1 = array("a" => "red", "b" => "green");
$a2 = array($a1, "1" => "blue", "2" => "yellow");
array_walk_recursive($a2, "myfunction1");

//array_filter( $array, $callback )    // 输出过滤
//array_map( $callback, $array )    // 更改索引项内容
//array_walk_recursive( $array, fn )    // 升级版array_map()，遍历且递归，深入子组数
//array_values( $array )    // 遍历时，返回当前索引项的值，配合filter和map使用
//arrray_change_key_case( $array, CASE_UPPER / CASE_LOWER )    // 切换key为大小写
//array_change_value_case( $array, CASE_UPPER / CASE_LOWER )    // 切换value为大小写
//date_default_timezone_get()    // 获取当前设置的时区
//date_default_timezone_set( 'PRC' )    // 设置时区为中国
//getdate();    // 输出时间数组（将时分秒拆分，好用）
//返回    [seconds] => 38
//    [minutes] => 27
//    [hours] => 8
//    [mday] => 29
//    [wday] => 0
//    [mon] => 9
//    [year] => 2019
//    [yday] => 271
//    [weekday] => Sunday
//    [month] => September
//    [0] => 1569745658
//time()    // 返回秒
//echo microtime();    // 返回微秒
//strtotime("");    // 涵盖时间、时间戳功能
//mt_rand($startNum, $endNum)    // 取范围内随机数


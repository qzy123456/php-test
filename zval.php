<?php
/**
 * Created by PhpStorm.
 * User: artist
 * Date: 2019-08-02
 * Time: 11:32
 */

$mobile = '13912345678';
//1.字符串截取法
$newMobile1 = substr($mobile, 0, 5).'****'.substr($mobile, 9);
echo $newMobile1.'<br/>';
//2.替换字符串的子串
$newMobile2 = substr_replace($mobile, '****', 5, 4);
echo $newMobile2.'<br/>';
//3.用正则
$newMobile3 = preg_replace('/(\d{5})\d{4}(\d{2})/', '$1****$2', $mobile);
echo $newMobile3;
$num = 37788;
$bit = 7;//产生7位数的数字编号
$num_len = strlen($num);
$zero = '';
for($i=$num_len; $i<$bit; $i++){
    $zero .= "0";
}
$real_num = "d".$zero.$num;

echo $real_num;

$a = "fsdfds";

$b = "xiaorui";

$a = array($b, $b = $a)[0];
var_dump(array($b, $b = $a));die;
echo $a."-".$b;
die;
function dummy($array) {}

$array = range(1, 100);

$b = &$array;

dummy($array);

debug_zval_dump( $array);
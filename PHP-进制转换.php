<?php
/**
 * Created by PhpStorm.
 * User: artist
 * Date: 2020-05-06
 * Time: 14:41
 */
//十转2
echo decbin(12); //输出 1100
echo decbin(26); //输出 11010

//十转8
echo decoct(15); //输出 17
echo decoct(264); //输出 410

//3，十进制转十六进制 dechex() 函数
//
echo dechex(10); //输出 a
echo dechex(47); //输出 2f

//二进制转十六制进 bin2hex() 函数

$binary = "11111001";
$hex = dechex(bindec($binary));
echo $hex;//输出f9

//，二进制转十制进 bindec() 函数

echo bindec('110011'); //输出 51
echo bindec('000110011'); //输出 51
echo bindec('111'); //输出 7


//八进制转十进制 octdec() 函数

echo octdec('77'); //输出 63
echo octdec(decoct(45)); //输出 45

//十六进制转十进制 hexdec()函数

var_dump(hexdec("See"));
var_dump(hexdec("ee"));
// both print "int(238)"

var_dump(hexdec("that")); // print "int(10)"
var_dump(hexdec("a0")); // print "int(160)"



//任意进制转换 base_convert() 函数

$hexadecimal = 'A37334';
echo base_convert($hexadecimal, 16, 2);//输出 101000110111001100110100
echo  PHP_EOL;
//ord chr
$string = "不要迷恋哥";
$length = strlen($string);
var_dump($string);//原始中文
var_dump($length);//长度
$result = array();
for($i=0;$i<$length -1;$i++){
    if(ord($string[$i])>127){
        $result[] = $string[$i].' '.$string[++$i];
    }
}
var_dump($result);
echo  PHP_EOL;
$result = array();
for($i=0;$i<$length -1 ;$i++){
    if(ord($string[$i])>127){
        $result[] = ord($string[$i]).' '.ord($string[++$i]);
    }
}
var_dump($result);
echo  PHP_EOL;
$string = "不要迷恋哥";
$length = strlen($string);
var_dump($string);//原始中文
var_dump($length);//长度
$result = array();
for($i=0;$i<$length -1;$i++){
    if(ord($string[$i])>127){
        $result[] = ord($string[$i]).' '.ord($string[++$i]);
    }
}
var_dump($result);
foreach($result as $v){
    $decs = explode(" ",$v);
    echo chr($decs[0]).chr($decs[1]);
}
<?php
/**
 * Created by PhpStorm.
 * User: artist
 * Date: 2019-10-29
 * Time: 14:39
 */
$a = 'runoob';
debug_zval_dump($a);

// 多个参数
$b = 'google';
$c = $b;
debug_zval_dump($a, $b);

$str = "ABCDEFG";


//** 使用strrev()函数 */
function way1($str){
    $result=strrev($str);
    return $result;
}


//** 使用strlen()函数 */
function way2($str){
    $len = strlen($str);
    $new_str = '';
    while( $len ){
        $new_str .= $str[$len-1];
        $len --;
    }
    return $new_str;
}


//** 包含中文的多字节字符串需要用到mb_substr()函数 */
function way3($str, $encoding = 'utf-8'){
    $len = mb_strlen($str);
    $result = '';
    for ($i = $len-1; $i>=0; $i--){
        $result.= mb_substr($str,$i,1,$encoding);
    }
    return $result;
}


//** 算法实现 首尾交换 */
function way4($str){
    $len = strlen($str);
    $times = intval($len/2);

    for($i = 0;$i <= $times; $i++ ){
        $tmp = $str[$i];
        $str[$i] = $str[$len-$i-1];
        $str[$len-$i-1] = $tmp;
    }
    return $str;
}
//** 递归实现反转 */
function way5($str){

    global $strr ;
    if(strlen($str)>0){
        way5(substr($str,1));
    }
    $strr  .= substr($str,0,1);
    if(strlen($str) == 0){
        return $strr;
    }

}
//** 不是用函数情况下 */
function way6($str){
    $o = '';
    $i = 0;
    while(isset($str[$i]) && $str[$i] != null) {
        $o = $str[$i++].$o;
    }
    return $o;
}

echo way1($str);
echo " ";
echo way2($str);
echo " ";
echo way3($str);
echo " ";
echo way4($str);
echo " ";
echo way5($str);
echo " ";
 echo way6($str);
echo '';
//__invoke 当以函数的形式调用一个对象的时候，触发这个函数
class CallableClass
{
    public function __invoke($param1, $param2)
    {
        var_dump($param1,$param2);
    }
}
$obj  = new CallableClass();
$obj(123, 456);

var_dump(is_callable($obj));

class A
{
    public $var1;
    public $var2;
  ///var_export() 导出类时，此静态 方法会被调用。
    public static function __set_state($an_array) // As of PHP 5.1.0
    {
        $obj = new A;
        $obj->var1 = $an_array['var1'];
        $obj->var2 = $an_array['var2'];
        return $obj;
    }
}
$a = new A;
$a->var1 = 5;
$a->var2 = 'foo';

eval('$b = ' . var_export($a, true) . ';'); // $b = A::__set_state(array(
//    'var1' => 5,
//    'var2' => 'foo',
// ));
var_dump($b);
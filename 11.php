<?php
/**
 * Created by PhpStorm.
 * User: artist
 * Date: 2019-03-15
 * Time: 14:20
 */


print_r($_SERVER);die;
//验证邮箱地址是否合法
$email = "doctor@demo.com";
$return=filter_var($email, FILTER_VALIDATE_EMAIL);

//验证url是否合法  需要http://或者https://开头
$url = 'www.baidu.com';
$return=filter_var($url,FILTER_VALIDATE_URL);

//验证IP地址是否合法
$ip = "81111.8.8.8";
$return=filter_var($ip,FILTER_VALIDATE_IP);

die;
function test($a=0,&$result=array()){
    $a++;
    if ($a<10) {
        $result[]=$a;
        test($a,$result);
    }
    echo $a;
    return $result;

}
test();
$A="Hello ";

function print_A()

{

$A = "phpmysql !!";

global $A;       //输出结果关键是这个全局变量，没有这个全局变量输出的就是d项

echo $A;

}



echo $A;

print_A();
function print_A1(){

$A = "phpchina";

echo "A值为: ".$A."<p>";

//return ($A);

}

$B = print_A1();

echo "B值为: ".$B."<P>";
echo 'hello\nworld';
echo "<br>";
$attr = array(1,2,3,4);


echo "<br>";
//uid用户的ID
//bit 表的位数，例如user_0，那么bit就是1，user_00 那么bit就是2，
//我们将uid向右移动20位，这样我们就可以把大约前100万的用户数
//解释一下：($id >> 20)表示将向右移位20位，（向右移动一位标示减少一半），sprintf('%d',$data)标示将数据按照十进制输出。
//即id为1~1048575（2的20次幂-1）时均访问user_0,1048576~2097152时访问user_1,以此类推...
//右移20为也就是
function getTable( $uid , $bit , $seed = 20 ){

    return "user_" . sprintf( "%0{$bit}d" , ($uid >> $seed) );

}
echo getTable(1048576,4);
echo "<br>";
echo "test_".sprintf( "%04d" , (121212>> 18));
echo "<br>";
$a = '1';
$b = &$a;
$b = "2$b";
echo $a,$b;
//21 21
echo "<br>";
///array_merge  必须都是数组
/// 否则报错  Warning: array_merge(): Argument #2 is not an array
$referenceTable = array();
$referenceTable['val1'] = array(1, 2);
$referenceTable['val2'] = array(3);
$referenceTable['val3'] = array(4, 5);

$testArray = array();

$testArray = array_merge($testArray, $referenceTable['val1']);
var_dump($testArray);
$testArray = array_merge($testArray, $referenceTable['val2']);
var_dump($testArray);
$testArray = array_merge($testArray, $referenceTable['val3']);
var_dump($testArray);


echo "<br>";
//因为运算符 = 是会比and 级别高一些
$x = true and false;
var_dump($x); //true

echo "<br>";
//$text[10] = "Doe"给某个字符串具体的某个位置具体字符时候，
//实际只会把D赋给$text. 虽然$text才开始只有5个自负长度，但是php会默认填充空格
$text = 'John ';
$text[10] = 'Doe';
echo $text;
echo strlen($text);
//John D
//11
echo "<br>";

$vv = 1;
$mm = 2;
$ll = 3;
//$l>$m 会转换成1 ，则这个时候再和$m比较。
// no
if( ($ll > $mm) > $vv){
    echo "yes";
}else{
    echo "no";
}
echo "<br>";
//实际的运行结果是$x=0而不是255.
//首先'oxFF' == 255我们好判断，会进行转换将16进制数字转换成10进制数字，0xff -> 255.
//PHP使用is_numeric_string 判断字符串是否包含十六进制数字然后进行转换。
//但是$x = (int)'0xFF';是否也会变成255呢？
//显然不是，将一个字符串进行强制类型转换实际上用的是convert_to_long,
//它实际上是将字符串从左向右进行转换，遇到非数字字符则停止。
//因此0xFF到x就停止了。所以$x=0
$x = NULL;

if ('0xFF' == 255) {
    $x = (int)'0xFF';
}
echo "<br>";
//PHP合并数组+和array_merge()的区别
//同为数组合并，但是还是有差别的:

//键名为数字时，array_merge()不会覆盖掉原来的值，
//但＋合并数组则会把最先出现的值作为最终结果返回，而把后面的数组拥有相同键名的那些值“抛弃”掉（不是覆盖）

$a = array('a','b');
$b = array('c', 'd');
$c = $a + $b;
var_dump($c);
//输出：
// array (size=2)
//  0 => string 'a' (length=1)
//  1 => string 'b' (length=1)
var_dump(array_merge($a, $b));
//输出：
//array (size=4)
// 0 => string 'a' (length=1)
// 1 => string 'b' (length=1)
// 2 => string 'c' (length=1)
// 3 => string 'd' (length=1)
//键名为字符时，＋仍然把最先出现的键名的值作为最终结果返回，
//而把后面的数组拥有相同键名的那些值“抛弃”掉，但array_merge()此时会覆盖掉前面相同键名的值

$a = array('a' => 'a' ,'b' => 'b');
$b = array('a' => 'A', 'b' => 'B');
$c = $a + $b;
var_dump($c);
//输出：
//array (size=2)
//'a' => string 'a' (length=1)
//'b' => string 'b' (length=1)
var_dump(array_merge($a, $b));
//输出：
//array (size=2)
//'a' => string 'A' (length=1)
//'b' => string 'B' (length=1)

//

$employee_detail_array = array(

    "name" => "John Doe",

    "position" => "Software Engineer",

    "address" => "53, nth street, city",

    "status" => "best"

);



// 从数组到对象的类型转换

$employee = (object) $employee_detail_array;



print_r($employee);

var_dump(array_merge(['user' => "212"], ['all' => ['1'=>'2']], ['type' => 'openSuccess']));
echo "<br>";
$str = "Bill & 'Steve'";
echo htmlspecialchars($str, ENT_COMPAT); // 只转换双引号
echo "<br>";
echo htmlspecialchars($str, ENT_QUOTES); // 转换双引号和单引号
echo "<br>";
echo htmlspecialchars($str, ENT_NOQUOTES); // 不转换任何引号

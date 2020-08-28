<?php
//在php7之后,大部分错误可通过异常形式抛出,并可使用catch拦截,例如:
try {
  $a = new stdClass();
   $a->test();//未定义该对象并没有该方法,抛出一个Throwable类
    // Code that may throw an Exception or Error.
} catch (Throwable $t) {
    var_dump($t->getMessage());
    // Executed only in PHP 7, will not match in PHP 5
} catch (Exception $e) {
}
//定义错误等级为最低 也就是全部显示
error_reporting(E_ALL);

//array_unshift() 函数用于向数组插入新元素。新数组的值将被插入到数组的开头。
$a = array("a" => "red","b" => "green");
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
////匿名类
interface Logger {
    public function log(string $msg);
}

class Application {
    private $logger;

    public function getLogger(): Logger {
        return $this->logger;
    }

    public function setLogger(Logger $logger) {
        $this->logger = $logger;
    }
}

$app = new Application;
$app->setLogger(new class implements Logger {
    public function log(string $msg) {
        echo $msg;
    }
});

var_dump($app->getLogger());
//object(class@anonymous)#2 (0) {
//}
//标量类型声明
function sumOfInts(int ...$ints)
{
    return array_sum($ints);
}

var_dump(sumOfInts(2, '3', 4.1));
//int(9)
//返回值类型声明
function arraysSum(array ...$arrays): array
{
    return array_map(function(array $array): int {
        return array_sum($array);
    }, $arrays);
}
print_r(arraysSum([1,2,3], [4,5,6], [7,8,9]));
//Array
//(
//    [0] => 6
//    [1] => 15
//    [2] => 24
//)
//null合并运算符
$username = $_GET['user'] ?? 'nobody';
//太空船操作符（组合比较符）
// 整数
echo 1 <=> 1; // 0
echo 1 <=> 2; // -1
echo 2 <=> 1; // 1

// 浮点数
echo 1.5 <=> 1.5; // 0
echo 1.5 <=> 2.5; // -1
echo 2.5 <=> 1.5; // 1

// 字符串
echo "a" <=> "a"; // 0
echo "a" <=> "b"; // -1
echo "b" <=> "a"; // 1
//通过 define() 定义常量数组
define('ANIMALS', [
    'dog',
    'cat',
    'bird'
]);

echo ANIMALS[1]; // 输出 "cat"
//闭包Closure::call()
class A {private $x = 1;}

// PHP 7 之前版本的代码
$getXCB = function() {return $this->x;};
$getX = $getXCB->bindTo(new A, 'A'); // 中间层闭包
echo $getX();

// PHP 7+ 及更高版本的代码
$getX = function() {return $this->x;};
echo $getX->call(new A);
//为 unserialize（）提供过滤
$foo = "";
// 将所有的对象都转换为 __PHP_Incomplete_Class 对象
$data = unserialize($foo, ["allowed_classes" => false]);
print_r($data);
// 将除 MyClass 和 MyClass2 之外的所有对象都转换为 __PHP_Incomplete_Class 对象
//PS:这个实例官方文档写错了 少个']'
$data = unserialize($foo, ["allowed_classes" => ["MyClass", "MyClass2"]]);
print_r($data);
// 默认情况下所有的类都是可接受的，等同于省略第二个参数
$data = unserialize($foo, ["allowed_classes" => true]);
print_r($data);
echo PHP_EOL;
//生成器可以返回表达式
$gen = (function() {
    yield 1;
    yield 2;

    return 3;
})();

foreach ($gen as $val) {
    echo $val, PHP_EOL;
}

echo $gen->getReturn(), PHP_EOL;

function gen()
{
    yield 1;
    yield 2;

    yield from gen2();
}

function gen2()
{
    yield 3;
    yield 4;
}

foreach (gen() as $val)
{
    echo $val, PHP_EOL;
}
//整数除法函数 intdiv()
var_dump(intdiv(10, 3));
//正则 preg_replace_callback()
 //before (<=php5.6):
$htmlString = '<a href="Sort.php" class="link">PCRE Patterns</a>';
        $htmlString = preg_replace_callback(
            '/(href="?)(\S+)("?)/i',
            function (&$matches) {
                return $matches[1] . urldecode($matches[2]) . $matches[3];
            },
            $htmlString
        );
print_r($htmlString);
echo PHP_EOL;
        $htmlString = preg_replace_callback(
            '/(href="?\S+)(%24)(\S+)?"?/i', // %24 = $
            function (&$matches) {
                return urldecode($matches[1] . '$' . $matches[3]);
            },
            $htmlString
        );
print_r($htmlString);
echo PHP_EOL;
//php7

        $htmlString = preg_replace_callback_array(
            [
                '/(href="?)(\S+)("?)/i' => function (&$matches) {
                    return $matches[1] . urldecode($matches[2]) . $matches[3];
                },
                '/(href="?\S+)(%24)(\S+)?"?/i' => function (&$matches) {
                    return urldecode($matches[1] . '$' . $matches[3]);
                }
            ],
            $htmlString
        );
 print_r($htmlString);
echo PHP_EOL;

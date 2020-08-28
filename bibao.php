<?php
/**
 * Created by PhpStorm.
 * User: artist
 * Date: 2019-05-05
 * Time: 11:31
 */
function tick($callback)
{
    //while (1) {//简单实现的定时器,每秒都去执行一次回调
    call_user_func($callback);
    sleep(1);
    // }
}

class Server
{
    //模拟退出一个服务
    public function exitServer()
    {
        return true;
    }
}

$server = new Server();
$time = time();
tick(function () use ($server) {
    $server->exitServer();
});
////////////////////////////
$fun = function ($name) {
    printf("Hello %s\r\n", $name);
};
echo $fun('Tioncico');
function a($callback)
{
    return $callback();
}

a(function () {
    echo "EasySwoole\n";
    return 1;
});
/**********************************/
function aa($callback)
{
    return $callback();
}

$str1 = "hello,";
$str2 = "Tioncico,";
aa(function () use ($str1, $str2) {
    echo $str1, $str2, "EasySwoole\n";
    return 1;
});

class A
{
    private $value = 111;
}

class B
{
    private $value = 222;
}


$f = function () {
    return $this->value;
};

$objectA = new A();
$functionA = $f->bindTo($objectA, $objectA);
print_r($functionA());
echo "###############################";
$objectB = new B();
$functionB = $f->bindTo($objectB, $objectB);
print_r($functionB());
echo "###############################";

$objectA = new A();
$functionA = Closure::bind($f, $objectA, $objectA);
print_r($functionA());
echo "###############################";
$objectB = new B();
$functionB = Closure::bind($f, $objectB, $objectB);
print_r($functionB());
echo "###############################";
echo memory_get_usage(), '<br>';
$start = memory_get_usage();
$a = Array();
for ($i = 0; $i < 1000; $i++) {
    $a[$i] = $i + $i;
}
$mid = memory_get_usage();
echo memory_get_usage(), '<br>';
for ($i = 1000; $i < 2000; $i++) {
    $a[$i] = $i + $i;
}
$end = memory_get_usage();
echo memory_get_usage(), '<br>';
echo 'argv:', ($mid - $start) / 1000, 'bytes', '<br>';
echo 'argv:', ($end - $mid) / 1000, 'bytes', '<br>';

list($msec, $sec) = explode(' ', microtime());
echo $msectime = (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);
echo "###############################";

$msg = new ArrayObject([1, 2, 3], ArrayObject::ARRAY_AS_PROPS);
$func = function () use ($msg) {
    $msg[0]++;
    print_r($msg);
};

$func();
print_r($msg);


<?php
class Person{
    public $name;
    public function __construct($name) {
        $this->name = $name;
    }
}
$first = new Person("zhangsan");
$second = $first;
$second->name = "lisi";
var_dump($first === $second);   //true
var_dump($second->name);  //lisi
var_dump($first->name);   //lisi

$third = array(
    "hello" => "world",
);  //分配数组的空间0x0001，分配变量$third内存，并指向0x0001
$fourth = $third;  //分配变量$fourth内存，并指向同一地址0x0001，引用计数加1
var_dump($fourth === $third);   //true，内容相同，内容地址也相同
$fourth['hello'] = "fuck";  //变量改变，重新copy一份出来，给$fourth指向，并修改引用计数
var_dump($fourth === $third);   //false，已经是不同的内容，不同的地址

//这就很尴尬了，虽然引用复制较为节省空间，但有时我们希望对象的复制是值copy，各自保留各自的副本。php提供的clone关键字能够解决该问题。
$first = new Person("zhangsan");
$second = clone $first;  //各自有一份Person的副本
var_dump($first === $second);   //false，地址不同
$second->name = "lisi";  //修改的是自己的Person对象内容
var_dump($second->name);  //lisi
var_dump($first->name);  //zhangsan

$ip = gethostbyname('www.baidu.com');
$num_ip =  ip2long($ip);
var_dump($num_ip);
var_dump(long2ip($num_ip));



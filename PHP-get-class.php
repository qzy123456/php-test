<?php
//get_class (): 获取当前调用方法的类名；
//get_called_class():获取静态绑定后的类名；
class Foo{
    public function test(){
        var_dump(get_class());
    }

    public function test2(){
        var_dump(get_called_class());
    }

    public static function test3(){
        var_dump(get_class());
    }

    public static function test4(){
        var_dump(get_called_class());
    }
}

class B extends Foo{

}

$B=new B();
$B->test(); //Foo
$B->test2(); //B
Foo::test3(); //Foo
Foo::test4(); //Foo
B::test3(); //Foo
B::test4(); //B
$timer = Swoole\Timer::after(1000, function () {
    echo "timeout\n";
});

var_dump(Swoole\Timer::clear($timer));
var_dump($timer);
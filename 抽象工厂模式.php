<?php

// 抽象工厂模式
// interface people 人类
interface people{
    public function say();
}

// 第一个man类 继承people
class OneMan implements people{
    // 实现people的say方法
    public function say(){
        echo "man1";
    }
}

// 第二个man类 继承people
class TwoMan implements people{
    public function say(){
        echo "man2";
    }
}

// 第一个woman类 继承people
class OneWoman implements people{
    public function say(){
        echo "woman1";
    }
}

// 第二个woman类 继承people
class TwoWoman implements people{
    public function say(){
        echo "woman2";
    }
}

// 创建对象类
// 将对象的创建抽象成了一个接口
interface createPeople{
    public function createOne();
    public function createtwo();
}

// 用于创建man对象的工厂类 继承createpeople
class FactoryMan implements createPeople{
    // 创建第一个 man
    public function createOne(){
        return new OneMan();
    }
    // 创建第二个man
    public function createTwo(){
        return new TwoMan();
    }
}

// 用于创建woman对象的工厂类 继承createpeople
class FactoryWoman implements createPeople{
    // 创建第一个woman
    public function createOne(){
        return new OneWoman();
    }
    // 创建第二个woman
    public function createTwo(){
        return new TwoWoman();
    }
}

// 执行测试类
class Client{
    // 具体生成对象和执行方法
    public function test(){
        $factory = new FactoryMan();
        $man_one = $factory->createOne();
        $man_one->say();
        $man_two = $factory->createTwo();
        $man_two->say();

        $factory = new FactoryWoman();
        $woman_one = $factory->createOne();
        $woman_one->say();
        $woman_two = $factory->createTwo();
        $woman_two->say();
    }
}

$result = new Client();
$result->test();

$my_array = array("Dog","Cat","Horse");

list($a, $b, $c) = $my_array;
echo "I have several animals, a $a, a $b and a $c.";
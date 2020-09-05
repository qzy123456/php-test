<?php
//private, 自己的,
//protected, 父亲的,
//public 大众的
class Woman{
    public $name = 'lisa'; // 公共的访问权限
    protected $money = 3000.00; // 受保护的权限,子类可以访问，修改，但外部不能调用
    private $age = 35; // 私有的访问权限。子类不能访问，更不能修改

    function printInfo(){
        echo $this->name;
        echo $this->money;
        echo $this->age;
    }

    private function secret(){
        echo "这是个秘密！";
    }

}

 $woman = new Woman();
 echo $woman->name; // 公共属性可以访问
 echo $woman->money; // 受保护属性,报致命错误
 echo $woman->age; // 私有属性，报致命错误

 $woman->printInfo(); // 可以打印三个属性的信息，因为printInfo是公共方法

 $woman->secret(); // 私有方法，访问出错
class Girl extends Woman{
// 可以重新定义父类的public和protected方法，但不能定义private的
     protected $money = 2000.00; // 可以从新定义

    function printInfo(){
        echo $this->name;
        echo $this->money;
        echo $this->age; // 找不到属性
    }

}

 $girl = new Girl();
 echo $girl->name; // 公共属性可以访问
 echo $girl->money; // 受保护属性，报致命错误
 echo $girl->age; // 私有属性，找不到属性
 $girl->printInfo(); // 显示$name,$money,找不到$age属性;

?>
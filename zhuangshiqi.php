<?php

interface Decorater{

    public function display();
}


class XiaoFang implements Decorater{

    private $name;

    public function __construct($name){
        $this->name = $name;
    }

    public function display(){
        echo "我是".$this->name."我出门了!!!".'<br/>';//4
    }
}


class Finery implements Decorater{

    private $component;

    public function __construct(Decorater $component){
        $this->component = $component;
    }

    public function display(){

        $this->component->display();
    }
}


class Shoes extends Finery{

    public function display(){
        echo '穿上鞋子'.'<br/>';//3
        parent::display();
    }
}

class Skirt extends Finery{

    public function display(){
        echo '穿上裙子'.'<br/>'; //2
        parent::display();
    }
}
class Fire extends Finery{

    public function display(){
        echo '出门前先整理头发'.'<br>'; //1
        parent::display();
        echo '出门后再整理一下头发'.'<br>';//5
    }
}

$xiaofang = new XiaoFang('小芳');
$shoes = new Shoes($xiaofang);
$skirt = new Skirt($shoes);

$fire = new Fire($skirt);

$fire->display();
/*
 * 出门前先整理头发
穿上裙子
穿上鞋子
我是小芳我出门了!!!
出门后再整理一下头发
 * */


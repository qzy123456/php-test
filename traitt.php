<?php
/**
 * Created by PhpStorm.
 * User: artist
 * Date: 2019-05-05
 * Time: 17:12
 */
trait Cat{
    public function eat(){
        echo "This is Cat eat";
    }
}

trait Dog{
    use Cat;
    public function drive(){
        echo "This is Dog drive";
    }
    abstract public function getName();

    public function test(){
        static $num=0;
        $num++;
        echo $num;
    }

    public static  function say(){
        echo "This is Dog say";
    }
    private function cc1(){
        echo 'cc';
    }
    protected function dd2(){
        echo 'dd';
    }
}
class animal{
    use Dog;
    public function getName(){
        echo "This is animal name";
    }
    private function cc(){
        echo 'cc';
    }
    protected function dd1(){
        echo 'dd';
    }
}

$animal = new animal();
$animal->getName();
echo "<br/>";
$animal->eat();
echo "<br/>";
$animal->drive();
echo "<br/>";
$animal::say();
echo "<br/>";
$animal->test();
echo "<br/>";
$animal->test();
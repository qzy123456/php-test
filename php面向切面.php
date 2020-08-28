<?php
declare(strict_types=1);
//Object Data
class User
{
    private $name;
    //Join Point 连接点
    function set_name(String $value  )
    {
        $this->name = $value;
    }
    //Join Point 连接点
    function get_name()
    {
        echo "Code......\n";
        return $this->name;
    }
}

//Aspect 方面
class Logged
{
    private $obj;
    //Point Cut 切入点
    function __call( $method, $args )
    {
        //Advice 通知
        $cron =  call_user_func_array(array(&$this->obj,$method),$args);
        return $cron;
    }

    function __construct( $obj )
    {
        $this->obj = $obj;
    }
}

$c1 = new Logged( new User() );
$c1->set_name( "111" );
$name = $c1->get_name();
echo( "name = $name\n" );
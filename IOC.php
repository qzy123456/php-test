<?php
/**
 * Created by PhpStorm.
 * User: artist
 * Date: 2019-03-28
 * Time: 17:34
 */
class DbMysql
{
    public function __construct($host, $name, $pwd)
    {
        // do something
    }

    public function query()
    {
        echo __METHOD__ . PHP_EOL;
    }
}

class DbRedis
{
    public function __construct($host, $name, $pwd)
    {
        // do something
    }

    public function set()
    {
        echo __METHOD__ . PHP_EOL;
    }
}

class controller
{
    public $mysql;
    public $redis;

    public function __construct($mysql, $redis)
    {
        $this->mysql = $mysql;
        $this->redis = $redis;
    }

    public function action()
    {
        $this->mysql->query();
        $this->redis->set();
    }
}

class Container
{

    public $bindings = [];

    public function bind($key, Closure $value)
    {
        $this->bindings[$key] = $value;
    }

    public function make($key)
    {
        $new = $this->bindings[$key];
        return $new();
    }

}

$app = new Container();
$app->bind('mysql', function () {
    return new DbMysql('host', 'name', 'pwd');
});
$app->bind('redis', function () {
    return new DbRedis('host', 'name', 'pwd');
});
$app->bind('controller', function () use ($app) {
    return new Controller($app->make('mysql'), $app->make('redis'));
});
$controller = $app->make('controller');
$controller->action();
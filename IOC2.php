<?php

interface MConfig
{
    public function getConfig();
}

class MysqlConfig implements MConfig
{
    public function getConfig()
    {
// 获取配置
        return ['host', 'name', 'pwd'];
    }
}

interface RConfig
{
    public function getConfig();
}

class RedisConfig implements RConfig
{
    public function getConfig()
    {
// 获取配置
        return ['host', 'name', 'pwd'];
    }
}

interface SMysql
{
    public function query();
}

class DbMysql implements SMysql
{
    public $config;

    public function __construct(MConfig $config)
    {
        $this->config = $config->getConfig();
// do something
    }

    public function query()
    {
        echo __METHOD__ . PHP_EOL;
    }
}

interface SRedis
{
    public function Set();
}

class DbRedis implements SRedis
{
    public function __construct(RConfig $config)
    {
        $this->config = $config->getConfig();
// do something
    }

    public function set()
    {
        echo __METHOD__ . PHP_EOL;
    }
}

class Controller
{
    public $mysql;
    public $redis;

    public function __construct(SMysql $mysql, SRedis $redis)
    {
        $this->mysql = $mysql;
        $this->redis = $redis;
    }

    public function action()
    {
        is_object($this->mysql) && $this->mysql->query();
        is_object($this->redis) && $this->redis->set();
    }
}

class Container
{

    public $bindings = [];

    public function bind($key, $value)
    {
        if (!$value instanceof Closure) {
            $this->bindings[$key] = $this->getClosure($value);
        } else {
            $this->bindings[$key] = $value;
        }
    }

    public function getClosure($value)
    {
        return function () use ($value) {
            return $this->build($value);
        };
    }

    public function make($key)
    {
        if (isset($this->bindings[$key])) {
            return $this->build($this->bindings[$key]);
        }
        return $this->build($key);
    }

    public function build($value)
    {
        if ($value instanceof Closure) {
            return $value();
        }
// 实例化反射类
        $reflection = new ReflectionClass($value);
// isInstantiable() 方法判断类是否可以实例化
        $isInstantiable = $reflection->isInstantiable();
        if ($isInstantiable) {
// getConstructor() 方法获取类的构造函数，为NULL没有构造函数
            $constructor = $reflection->getConstructor();
            if (is_null($constructor)) {
// 没有构造函数直接实例化对象返回
                return new $value;
            } else {
// 有构造函数
                $params = $constructor->getParameters();
                if (empty($params)) {
// 构造函数没有参数，直接实例化对象返回
                    return new $value;
                } else {
                    $dependencies = [];
// 构造函数有参数
                    foreach ($params as $param) {
                        $dependency = $param->getClass();
                        if (is_null($dependency)) {
// 构造函数参数不为class，返回NULL
                            $dependencies[] = NULL;
                        } else {
// 类存在创建类实例
                            $dependencies[] = $this->make($param->getClass()->name);
                        }
                    }
                    return $reflection->newInstanceArgs($dependencies);
                }
            }
        }
        return null;
    }

}

$app = new Container();
$app->bind('MConfig', 'MysqlConfig');
$app->bind('RConfig', 'RedisConfig');
$app->bind('SMysql', 'DbMysql');
$app->bind('SRedis', 'DbRedis');
$app->bind('controller', 'Controller');
$controller = $app->make('controller');
$controller->action();
/**
 * 输出：
 * DbMysql::query
 * DbRedis::set
 */
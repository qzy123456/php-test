<?php
// 框架核心应用层
$application = function($name) {
    echo "this is a {$name} application\n";
};

// 前置校验中间件
$auth = function($handler) {
    return function($name) use ($handler) {
        echo "{$name} need a auth middleware\n";
        return $handler($name);
    };
};

// 前置过滤中间件
$filter = function($handler) {
    return function($name) use ($handler) {
        echo "{$name} need a filter middleware\n";
        return $handler($name);
    };
};

// 后置日志中间件
$log = function($handler) {
    return function($name) use ($handler) {
        //注意这一段～$return = $handler($name);～跟上面的区别很大，调换了位置，
        //虽然同样都是return 但是却是不一样的返回值答案～
        /*Laravel need a filter middleware
          *Laravel need a auth middleware
          *this is a Laravel application
          *Laravel need a log middleware
         * */
        //改变之后
        /*Laravel need a log middleware
         * Laravel need a filter middleware
         *Laravel need a auth middleware
         *this is a Laravel application
        */
        $return = $handler($name);
        echo "{$name} need a log middleware\n";
        return $return;
    };
};

// 中间件栈
$stack = [];

// 打包
function pack_middleware($handler, $stack)
{
    //reverse反转数组
    foreach (array_reverse($stack) as $key => $middleware)
    {
        $handler = $middleware($handler);
    }
    return $handler;
}

// 注册中间件
// 这里用的都是全局中间件，实际应用时还可以为指定路由注册局部中间件
$stack['log'] = $log;
$stack['filter'] = $filter;
$stack['auth'] = $auth;

$run = pack_middleware($application, $stack);

$run('Laravel');

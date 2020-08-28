<?php
interface Milldeware {
    public static function handle(Closure $next);
}

class VerfiyCsrfToekn implements Milldeware {

    public static function handle(Closure $next)
    {
        echo '验证csrf Token'.PHP_EOL;
        $next();
    }
}

class VerfiyAuth implements Milldeware {

    public static function handle(Closure $next)
    {
        echo '验证是否登录 '.PHP_EOL;
        $next();
    }
}

class SetCookie implements Milldeware {
    public static function handle(Closure $next)
    {
        $next();
        echo '设置cookie信息！';
    }
}

$handle = function() {
    echo '当前要执行的程序!';
};

$pipe_arr = [
    'VerfiyCsrfToekn',
    'VerfiyAuth',
    'SetCookie',
];
//array_reduce() 函数向用户自定义函数发送数组中的值，并返回一个字符串。
//注释：如果数组是空的且未传递 initial 参数，该函数返回 NULL。
//array_reduce() 函数用回调函数迭代地将数组简化为单一的值。
//如果指定第三个参数，则该参数将被当成是数组中的第一个值来处理，或者如果数组为空的话就作为最终返回值。
$callback = array_reduce($pipe_arr,function($stack,$pipe) {
      //var_dump($pipe);
    //    string(15) "VerfiyCsrfToekn"
    //string(10) "VerfiyAuth"
    //string(9) "SetCookie"
     echo PHP_EOL;
     //var_dump($stack);  是上面的Milldeware 闭包函数
    return function() use($stack,$pipe){
        return $pipe::handle($stack);
    };
},$handle);
//$stack最后生成的闭包函数
//object(Closure)#5 (1) {
//  ["static"]=>
//  array(2) {
//    ["stack"]=>
//    object(Closure)#4 (1) {
//      ["static"]=>
//      array(2) {
//        ["stack"]=>
//        object(Closure)#3 (1) {
//          ["static"]=>
//          array(2) {
//            ["stack"]=>
//            object(Closure)#1 (0) {
//            }
//            ["pipe"]=>
//            string(15) "VerfiyCsrfToekn"
//          }
//        }
//        ["pipe"]=>
//        string(10) "VerfiyAuth"
//      }
//    }
//    ["pipe"]=>
//    string(9) "SetCookie"
//  }
//}

call_user_func($callback);
//第一步执行call_middware 函数 会执行 SetCookie::handle。
//当执行SetCookie::handle的时候会发现要先执行$next();在echo '设置cookie信息！';
//所以就先执行了VerfiyAuth::handle，这时候会先执行echo '验证是否登录 <br>';然后执行 $next();
//执行 VerfiyCsrfToekn::handle 这时候会先执行echo '验证csrf Token <br>';然后执行 $next();
//执行 $handle();
//最后 在echo '设置cookie信息！'。


//验证是否登录
//验证csrf Token
//当前要执行的程序!设置cookie信息！


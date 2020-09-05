<?php
//php函数method_exists()与is_callable()的区别在于
//一个方法存在并不意味着它就可以被调用。
//对于 private，protected和public类型的方法，method_exits()会返回true，
//但是is_callable()会检查存在其是否可以访问，如果是private，protected类型的，它会返回false。
class Foo {
    public function PublicMethod(){}
    private function PrivateMethod(){}
    public static function PublicStaticMethod(){}
    private static function PrivateStaticMethod(){}
}
$foo = new Foo();
$callbacks = array(
    array($foo, 'PublicMethod'),
    array($foo, 'PrivateMethod'),
    array($foo, 'PublicStaticMethod'),
    array($foo, 'PrivateStaticMethod'),
    array('Foo', 'PublicMethod'),
    array('Foo', 'PrivateMethod'),
    array('Foo', 'PublicStaticMethod'),
    array('Foo', 'PrivateStaticMethod'),
);
foreach ($callbacks as $callback){
    var_dump($callback);
    var_dump(method_exists($callback[0], $callback[1]));
    var_dump(is_callable($callback));
    echo str_repeat('-', 10);
}

//array(2) {
//  [0]=>
//  object(Foo)#1 (0) {
//  }
//  [1]=>
//  string(12) "PublicMethod"
//}
//bool(true)
//bool(true)
//----------
//array(2) {
//  [0]=>
//  object(Foo)#1 (0) {
//  }
//  [1]=>
//  string(13) "PrivateMethod"
//}
//bool(true)
//bool(false)
//----------
//array(2) {
//  [0]=>
//  object(Foo)#1 (0) {
//  }
//  [1]=>
//  string(18) "PublicStaticMethod"
//}
//bool(true)
//bool(true)
//----------
//array(2) {
//  [0]=>
//  object(Foo)#1 (0) {
//  }
//  [1]=>
//  string(19) "PrivateStaticMethod"
//}
//bool(true)
//bool(false)
//----------
//array(2) {
//  [0]=>
//  string(3) "Foo"
//  [1]=>
//  string(12) "PublicMethod"
//}
//bool(true)
//bool(true)
//----------
//array(2) {
//  [0]=>
//  string(3) "Foo"
//  [1]=>
//  string(13) "PrivateMethod"
//}
//bool(true)
//bool(false)
//----------
//array(2) {
//  [0]=>
//  string(3) "Foo"
//  [1]=>
//  string(18) "PublicStaticMethod"
//}
//bool(true)
//bool(true)
//----------
//array(2) {
//  [0]=>
//  string(3) "Foo"
//  [1]=>
//  string(19) "PrivateStaticMethod"
//}
//bool(true)
//bool(false)
//----------
//Process finished with exit code 0
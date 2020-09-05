<?php
class ConstructorParameter
{

}

class ReflectorTest
{
    private $refletorProperty1;

    protected $refletorProperty2;

    public $refletorProperty3;

    private $request;

    public function __construct( $request = 10,  $response, ConstructorParameter $constructorParameter, Closure $closure)
    {

        $this->request = $request;
    }

    private function reflectorMethod1()
    {
    }

    protected function reflectorMethod2()
    {
    }

    public function reflectorMethod3()
    {
    }
}

$reflector_class = new ReflectionClass(ReflectorTest::class);
$methods = $reflector_class->getMethods();//得到所有的方法
$properties = $reflector_class->getProperties();//获取对象属性方法，（比如上面的ReflectorTest::class中的 private $refletorProperty1这种）
$constructor = $reflector_class->getConstructor();//获取类的构造函数，不存在时返回null
$constructor_parameters = $constructor->getParameters();//获取构造函数的值

foreach ($constructor_parameters as $constructor_parameter) {
    $dependency = $constructor_parameter->getClass();
    var_dump($dependency); //返回对象实例 obj 所属类的名字。如果 obj 不是一个对象则返回 FALSE（PHP中false也是null）。

    if ($constructor_parameter->isDefaultValueAvailable()) {
        var_dump($constructor_parameter->getDefaultValue()); //获取构造函数的参数里面传的默认值
    }
}
// NULL       //$request=10 $constructor_parameter->getClass(),返回对象实例 obj 所属类的名字。如果 obj 不是一个对象则返回 FALSE（PHP中false也是null）
// int(10)   //$request=10 $constructor_parameter->getDefaultValue()
// NULL      //$response $constructor_parameter->getClass()  false也是null
// object(ReflectionClass)#15 (1)
// {
// ["name"]=> string(20) "ConstructorParameter"
// }
// object(ReflectionClass)#16 (1) {
// ["name"]=> string(7) "Closure"
// }
echo "<pre>";
print_r($methods); //得到所有的方法
//Array
//(
//    [0] => ReflectionMethod Object
//(
//    [name] => __construct
//[class] => ReflectorTest
//        )
//
//    [1] => ReflectionMethod Object
//(
//    [name] => reflectorMethod1
//[class] => ReflectorTest
//        )
//
//    [2] => ReflectionMethod Object
//(
//    [name] => reflectorMethod2
//[class] => ReflectorTest
//        )
//
//    [3] => ReflectionMethod Object
//(
//    [name] => reflectorMethod3
//[class] => ReflectorTest
//        )
//
//)
echo "<br>";
print_r($properties); //得到所有的变量
//Array
//(
//    [0] => ReflectionProperty Object
//(
//    [name] => refletorProperty1
//[class] => ReflectorTest
//        )
//
//    [1] => ReflectionProperty Object
//(
//    [name] => refletorProperty2
//[class] => ReflectorTest
//        )
//
//    [2] => ReflectionProperty Object
//(
//    [name] => refletorProperty3
//[class] => ReflectorTest
//        )
//
//    [3] => ReflectionProperty Object
//(
//    [name] => request
//[class] => ReflectorTest
//        )
//
//)
echo "<br>";
print_r($constructor);
//ReflectionMethod Object
//(
//    [name] => __construct
//[class] => ReflectorTest
//)
echo "<br>";
print_r($constructor_parameters);
//Array
//(
//    [0] => ReflectionParameter Object
//(
//    [name] => request
//        )
//
//    [1] => ReflectionParameter Object
//(
//    [name] => response
//        )
//
//    [2] => ReflectionParameter Object
//(
//    [name] => constructorParameter
//        )
//
//    [3] => ReflectionParameter Object
//(
//    [name] => closure
//        )
//
//)
$originDatas = [
    'ruleId'=>1
];

$parent = getValue($originDatas,
    function ($list, $id) {  //$list ==>$originDatas,,$id===>1,也就是第三个值
    foreach ($list as $li) {
        if ($li == $id) {
            return $li;
        }
    }
}, 1);

var_dump($parent);
 function getValue($array, $key, $default = null)
{
    if ($key instanceof \Closure) {
        return $key($array, $default);
    }

    if (is_array($key)) {
        $lastKey = array_pop($key);
        foreach ($key as $keyPart) {
            $array = getValue($array, $keyPart);
        }
        $key = $lastKey;
    }

    if (is_array($array) && (isset($array[$key]) || array_key_exists($key, $array))) {
        return $array[$key];
    }

    if (($pos = strrpos($key, '.')) !== false) {
        $array = getValue($array, substr($key, 0, $pos), $default);
        $key = substr($key, $pos + 1);
    }

    if (is_object($array)) {
        // this is expected to fail if the property does not exist, or __get() is not implemented
        // it is not reliably possible to check whether a property is accessible beforehand
        return $array->$key;
    } elseif (is_array($array)) {
        return (isset($array[$key]) || array_key_exists($key, $array)) ? $array[$key] : $default;
    }

    return $default;
}


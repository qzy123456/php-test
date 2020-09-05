<?php
// echo 111;
//class Single{
//    public $hash;
//    static protected $ins=null;
//    final protected function __construct(){
//        $this->hash=rand(1,9999);
//    }
//
//    static public function getInstance(){
//        if (self::$ins instanceof self) {
//            return self::$ins;
//        }
//        self::$ins=new self();
//        return self::$ins;
//    }
//}
//
////工厂模式
//class RandFactory{
//    public static function factory(){
//        return Single::getInstance();
//    }
//}
//
////注册树
//class Register{
//    protected static $objects;
//    public static function set($alias,$object){
//        self::$objects[$alias]=$object;
//    }
//    public static function get($alias){
//        return self::$objects[$alias];
//    }
//    public static function _unset($alias){
//        unset(self::$objects[$alias]);
//    }
//}
//
//Register::set('rand',RandFactory::factory());
//
//$object=Register::get('rand');
//
//print_r($object);
//echo "<hr>";
//$uuid = 212321;
//$uuid1 = "2321321s-2321-sdsad-ewqeqs";
//$number = 5;
//print_r($uuid%$number);
//echo "<hr>";
//print_r(crc32($uuid1)%$number);
//$str = "";
//
//$str = "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";
//$uri = 'https://sandbox.itunes.apple.com/verifyReceipt';
//$post_data = array('receipt-data' => $str);
//$ch = curl_init($uri);
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//curl_setopt($ch, CURLOPT_POST, 1);
//curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
//curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);  //这两行一定要加，不加会报SSL 错误
//curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
//$response = curl_exec($ch);
//$errno = curl_errno($ch);
//$errmsg = curl_error($ch);
//curl_close($ch);
//
//if ($errno != 0) {
//    throw new Exception($errmsg, $errno);
//}
//
//$data = json_decode($response, 1);
//echo "<pre>";
//print_r($data);

/*function myfunction(&$value, $key, $p) {
    //value  red,green
    //key a,b,c,x,y
    //p   green
    if ($value == 'xxx') {
        $value = $p;
    }
}
$a = array("a" => "red", "b" => "green", "c" => "blue", 'd' => ['x' => 'xxx', 'y' => 'yyy']);
array_walk_recursive($a, "myfunction", 'green');
echo "<pre>";
print_r($a);

$a = "Original";
$my_array = array("a" => "Cat","b" => "Dog", "c" => "Horse");
extract($my_array);
echo "\$a = $a; \$b = $b; \$c = $c";
$firstname = "Peter";
$lastname = "Griffin";
$age = "41";
$result = compact("firstname", "lastname", "age");
print_r($result);
$arr2 = [
    [
        'id' => 3,
        'age' => 33,
    ],
    [
        'id' => 2,
        'age' => 44,
    ],
    [
        'id' => 1,
        'age' => 22,
    ],
];
//按age字段升序排序
uasort($arr2, function($a, $b) {
    $field = 'age';
    if ($a[$field] == $b[$field]){
        return 0;
    }
    return ($a[$field] < $b[$field]) ? -1 : 1;
});
print_r($arr2);
function test_odd($var)
{
    return ($var & 1);
}
$a1=array("a","b",2,3,4);
print_r(array_filter($a1,"test_odd"));
//print_r(get_defined_vars()); //打印出所有定义过的变量
highlight_string(' <?php phpinfo(); ?>'); //语法高亮显示

highlight_file("./11.php"); //它能返回指定的PHP文件，并按照语法语义用高亮颜色突出显示文件内容。其中的突出显示的代码都是用HTML标记处理过的。
//echo php_strip_whitespace("./11.php");//这个函数也跟前面的show_source()函数相似，但它会删除文件里的注释和空格符*/
//定义控制器的方法的目录
define('MODULE_DIR', './');
//读取当前的入口文件  一般都是index。php
$APP_PATH= str_replace($_SERVER['DOCUMENT_ROOT'], '', __FILE__);
//var_dump($APP_PATH);die;
$SE_STRING=str_replace($APP_PATH, '', $_SERVER['REQUEST_URI']);
//计算出index.php后面的字段 index.php/controller/methon/id/3
//成 /controller/methon/id/3
//去除多余的 /
$SE_STRING=trim($SE_STRING,'/');
//echo $SE_STRING.'&lt;br>';

//这里需要对$SE_STRING进行过滤处理。
$ary_url=array(
    'controller'=>'index',
    'method'=>'index',
    'pramers'=>array()
);
//var_dump($ary_url);
//将控制器，方法，以及参数进行隔离
$ary_se=explode('/', $SE_STRING);
//var_dump($ary_se);die;
$se_count=count($ary_se);


if($se_count==1 and $ary_se[0]!='' ){
    $ary_url['controller']=$ary_se[0];

}else if($se_count>1){//计算后面的参数，key-value
    $ary_url['controller']=$ary_se[0];
    $ary_url['method']=$ary_se[1];
    if($se_count>2 and $se_count%2!=0){ //没有形成key-value形式
        die('参数错误');
    }else{
        for($i=2;$i < $se_count;$i=$i+2){
            $ary_kv_hash=array(strtolower($ary_se[$i])=>$ary_se[$i+1]);
            $ary_url['pramers']=array_merge($ary_url['pramers'],$ary_kv_hash);
        }
    }
}

//必要的时候  可以全部转成小写，然后首字母再大写
$module_name= ucfirst($ary_url['controller']); //地址的  hello转成Hello
//拼接控制器
$module_file=MODULE_DIR.$module_name.'.class.php';
//方法名
$method_name=$ary_url['method'];
//属否存在改文件
if(file_exists($module_file)){
    include($module_file);
    $obj_module=new $module_name();    //实例化模块m
    //判断是否存在控制器和方法名
    if(!method_exists($obj_module, $method_name)){
        die('方法不存在');
    }else{
        if(is_callable(array($obj_module, $method_name))){    //该方法是否能被调用
            $get_return=$obj_module->$method_name($ary_url['pramers']);    //执行a方法,并把key-value参数的数组传过去
            if(!is_null($get_return)){ //返回值不为空
                var_dump($get_return);
            }
        }else{
            die('该方法不能被调用');
        }

    }
}
else
{
    die('模块文件不存在');
}

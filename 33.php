<?php
header("Content-Type: text/html;charset=utf-8");
/**
 * Created by PhpStorm.
 * User: artist
 * Date: 2019-07-16
 * Time: 16:58
 */
$data = require "./111.php";
//echo "<pre>";
function make_tree2($data = [])
{
    $tree = [];
    if ($data && is_array($data)) {
        foreach ($data as $k=>$v) {
            if ($v["Value"] && is_array($v["Value"])) {
                $tree[] =  make_tree2($v["Value"][0]);
            }else{
                $tree[] = [
                    'id' => $v['Value'],
                ];
            }
        }
    }
    return $tree;
}
//随机字符串（长度值）
$bytes = random_bytes(10);
$value = unpack('H*', $bytes);
var_dump($value);
//array(1) {
//    [1]=>
//  string(20) "e9a61580fb5c53a3624a"
//}
//解码 不然输出的是乱码
var_dump ( bin2hex ( $bytes ));
//string(20) "e9a61580fb5c53a3624a"

echo "<br>";
echo random_int(1,200);
//1-200
const NAME="string";
define("cxc",[122,1212]);
echo constant("NAME1");  //Warning: constant(): Couldn't find constant NAME1 
var_dump( constant("cxc"));
// array(2) {
//     [0]=>
//     int(122)
//     [1]=>
//     int(1212)
//   }
echo cxc[1];
//1212
function func($b, $c) {} ;
function foo($x,$c) {
    $x++;
    var_dump( func_get_args()); //获取所有的参数 是个数组\
    func_num_args(); //获取参数的个数
    echo func_get_arg(0); //获取单个参数，第n个
}
foo(88,1);

$arr = [1,2,3];
foreach ($arr as &$val) {
    echo current($arr);// php7 全返回1 (current传入的是个数组)
}

list($arr[], $arr[]) = [1,2,3];
var_dump($arr);
$array = [1, 2];

list($a, $b) = $array;
echo $a.$b;
//12

$a = array(
    "max_allow_dialogs",
    "livechat_server_ip",
    "livechat_service_time",
    "abort_zh_cn",
    "abort_zh_tw",
    "abort_en_usa",
    "welcome_zh_cn",
    "welcome_zh_tw",
    "welcome_en_usa",
    "timeout_zh_cn",
    "timeout_zh_tw",
    "timeout_en_usa",
    "absence_zh_cn",
    "absence_zh_tw",
    "absence_en_usa"
);
$b = array(
    "max_allow_dialogs",
    "livechat_server_ip",
    "livechat_service_time",
    "abort_zh_cn",
    "abort_zh_tw",
    "abort_en_usa",
    "welcome_zh_cn",
    "welcome_zh_tw",
    "welcome_en_usa",
    "timeout_zh_cn",
    "timeout_zh_tw",
    "timeout_en_usa",
);
$c = array_merge(array_diff($a,$b),array_diff($b,$a));
print_r($c);
<?php
$json = '{ "a": [ { "b": "c" }, "d" ], "x": 1}';
//$arr = [
//    'a'=>[
//        ["b"=>"c"],
//        "d"
//    ],
//    "x"=>1
//];
$arr = json_decode($json,true);
//get(json, "a[0].b") == "c"
//get(json, "a[1]") == "d"
//get(json, "x") == 1
function get($arr,$c){
    //是存在的key 直接取出来
     if(isset($arr[$c])){
         return $arr[$c];
     }
     //转成数组
     $cc = explode('.',$c);
     //不存在小数组
    if(count($cc) < 2){
        $k = strchr($cc[0],'[',true);
        $number = ruler($cc);
        return $arr[$k][$number];
     //存在小数组
    }else{
       $k = strchr($cc[0],'[',true);
        $number = ruler($cc);
        $newArr = $arr[$k][$number];
        $newKey = $cc[1];
        return $newArr[$newKey];
    }
}

echo get($arr,'x');
echo "\n";
echo get($arr,"a[0].b");
echo "\n";
echo get($arr,"a[1]");
//取出【】的数字
function ruler($str)
{
    $result = array();
    preg_match_all("/(?:\[)(.*)(?:\])/i",$str[0], $result);
    return $result[1][0];
}



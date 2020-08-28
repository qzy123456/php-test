<?php

function generateTree($items){
    $tree = array();
    foreach($items as $item){
        if(isset($items[$item['pid']])){
            $items[$item['pid']]['son'][] = &$items[$item['id']];
        }else{
            $tree[] = &$items[$item['id']];
        }
    }
    return $tree;
}
echo "<pre>";
//记住数据格式一定要是这种格式的
//否则要重构数据
//第一步 构造数据
//$items = array();
//foreach($array as $value){
//    $items[$value['id']] = $value;
//}
$items = array(
    1 => array('id' => 1, 'pid' => 0, 'name' => '安徽省'),
    2 => array('id' => 2, 'pid' => 0, 'name' => '浙江省'),
    3 => array('id' => 3, 'pid' => 1, 'name' => '合肥市'),
    4 => array('id' => 4, 'pid' => 3, 'name' => '长丰县'),
    5 => array('id' => 5, 'pid' => 1, 'name' => '安庆市'),
);
print_r(generateTree($items));

function generate2($items){
    $tree = [];
    foreach ($items as $k=>$item){
        if(isset($items[$item['pid']])){
            $items[$item['pid']]['son'][] = &$items[$k];
        }else{
            $tree[] = &$items[$k];
        }
    }
   return $tree;
}
echo "<pre>";
print_r(generate2($items));
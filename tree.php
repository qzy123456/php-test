<?php
/**
 * Created by PhpStorm.
 * User: artist
 * Date: 2019-08-05
 * Time: 15:03
 */
$array = array(
    1=>array('id' => 1, 'pid' => 0, 'name' => '河北省'),
    2=>array('id' => 2, 'pid' => 0, 'name' => '北京市'),
    3=>array('id' => 3, 'pid' => 1, 'name' => '邯郸市'),
    4=>array('id' => 4, 'pid' => 2, 'name' => '朝阳区'),
    5=>array('id' => 5, 'pid' => 2, 'name' => '通州区'),
    6=>array('id' => 6, 'pid' => 4, 'name' => '望京'),
    7=>array('id' => 7, 'pid' => 4, 'name' => '酒仙桥'),
    8=>array('id' => 8, 'pid' => 3, 'name' => '永年区'),
    9=>array('id' => 9, 'pid' => 1, 'name' => '武安市'),
);
function getTree($array, $pid =0, $level = 0){
    static $tree=[];
    if ($array && is_array($array)) {
        foreach ($array as $k=>$v) {
            if ($v['pid'] == $pid) {
                $tree[] = [
                    'id' => $v['id'],
                    'level' => $level,
                    'name' => $v['name'],
                    'pid' => $v['pid'],
                    'children' => getTree($array, $v['id'], $level + 1),
                ];
                unset($array[$k]);
            }
        }
    }
    return $tree;
}
/*
* 获得递归完的数据,遍历生成分类
*/
$array1 = getTree($array);
foreach($array1 as $value){
    echo str_repeat('--', $value['level']), $value['name'].'<br />';
}
function generateTree($array){
    //第一步 构造数据
    $items = array();
    foreach($array as $value){
        $items[$value['id']] = $value;
    }
    //第二 遍历数据 生成树状结构
    $tree = array();
    foreach($items as $key => $value){
        if(isset($items[$value['pid']])){
            $items[$value['pid']]['son'][] = &$items[$key];
        }else{
            $tree[] = &$items[$key];
        }
    }
    return $tree;
}
print_r(generateTree($array));
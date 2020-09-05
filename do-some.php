<?php
/**
 * Created by PhpStorm.
 * User: artist
 * Date: 2019-08-05
 * Time: 15:31
 */
$array = array(
    array('id' => 1, 'pid' => 0, 'name' => '河北省'),
    array('id' => 2, 'pid' => 0, 'name' => '北京市'),
    array('id' => 3, 'pid' => 1, 'name' => '邯郸市'),
    array('id' => 4, 'pid' => 2, 'name' => '朝阳区'),
   array('id' => 5, 'pid' => 2, 'name' => '通州区'),
    array('id' => 6, 'pid' => 4, 'name' => '望京'),
    array('id' => 7, 'pid' => 4, 'name' => '酒仙桥'),
    array('id' => 8, 'pid' => 3, 'name' => '永年区'),
    array('id' => 9, 'pid' => 1, 'name' => '武安市'),
);
function getTree($data,$pid=0,$level=0){
     $tree=[];
    if ($data && is_array($data)) {
        foreach ($data as $k=>$v) {
            if ($v['pid'] == $pid) {
                unset($data[$k]);
                $v['level'] = $v;
                $v['son'] = getTree($data,$v['id'],$level+1);
                $tree[] = $v;

            }
        }
    }
    return $tree;
}
print_r(getTree($array));
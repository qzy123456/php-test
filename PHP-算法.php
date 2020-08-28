<?php
/**
 * Created by PhpStorm.
 * User: artist
 * Date: 2020-07-24
 * Time: 14:23
 */
$arr = [2, 2, 4, 3, 1, 7, 8, 9];
for ($i = 0; $i < count($arr) - 1; $i++) {
    $is = true;
    for ($j = 0; $j < count($arr) - $i - 1; $j++) {
        if ($arr[$j] > $arr[$j + 1]) {
            $tmp = $arr[$j];
            $arr[$j] = $arr[$j + 1];
            $arr[$j + 1] = $tmp;
            $is = false;
        }
    }
    if ($is) {
        break;
    }
}
//var_ dump($arr);
print_r($arr);
<?php
/**
 * 比较规则
 * @param   string    $a
 * @param   string    $b
 * @return  int
 */
function cmp($a, $b) {
    if ($a == $b) {
        return 0;
    }
    return $a . $b > $b . $a ? -1 : 1;
}
/**
 * 寻找非零元素数组中所有元素排列组合后的最大值
 * @param   array     $Arr        待排序数组
 * @param   string    $method     排序方法
 * @return  mixed
 */
function array_form_max_str(array $Arr, $method = 'quick') {
    //参数校验
    if (!is_array($Arr)) return false;
    foreach ($Arr as $value) {
        if ($value < 0) return false;
    }
    //排序算法
    switch ($method) {
        case 'quick' :                   //快速排序
            usort($Arr, "cmp");
            break;
        case 'bubble' :
            $Arr = bubble_sort($Arr);    //冒泡排序
            break;
        default : break;
    }
    //拼接
    return implode('', $Arr);
}

/**
 * 冒泡排序
 * @param   array    $Arr   待排序数组
 * @return  array
 */
function bubble_sort(array $Arr) {
    $length = count($Arr);
    if ($length < 2) {
        return $Arr;
    }

    for ($i = 1, $change = true; $i <= $length && $change; $i++) {
        $change = false;
        for ($j = $length - 1; $j > $i - 1; $j--) {
            if (cmp($Arr[$j - 1], $Arr[$j]) > 0) {
                $temp = $Arr[$j - 1];
                $Arr[$j - 1] = $Arr[$j];
                $Arr[$j] = $temp;
                $change = true;
            }
        }
    }
    return $Arr;
}


$Arr = [20,913,223,91,20,3];
echo '数组为[', implode(',', $Arr), ']', PHP_EOL;
echo '最大排列组合为：', array_form_max_str($Arr), PHP_EOL;

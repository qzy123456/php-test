<?php
//插入排序的基本操作就是将一个数据插入到已经排好序的有序数据中，
//从而得到一个新的、个数加一的有序数据，算法适用于少量数据的排序，时间复杂度为O(n^2)。是稳定的排序方法。
//插入排序
//从第一个元素开始，该元素可以认为已经被排序；
//取出下一个元素，在已经排序的元素序列中从后向前扫描；
//如果该元素（已排序）大于新元素，将该元素移到下一位置；
//重复步骤3，直到找到已排序的元素小于或者等于新元素的位置；
//将新元素插入到该位置后；
//重复步骤2~5。
function InsertSort($arr){
    //数组的长度
    $len = count($arr);
    //数组就一个·～
    if($len <= 1){
        return $arr;
    }
    //定义当前的下标的位置
    for ($i = 0;$i < $len-1; $i++){
        //默认第一位是有序的，所以从第二位开搞
        $current = $arr[$i +1];
        //下标从0开始比较
        $index = $i;
        //下标大于0，并且，后一位，大于前一位，那么后一位，一直往前替换
        while ($index >=0 && $current < $arr[$index]){
            //后面一位跟前面一位交换
            $arr[$index + 1] = $arr[$index];
            $index--;
        }
        $arr[$index + 1] = $current;
    }
   return $arr;
}

//$arr = [1,3,34,-2,0,1,7];
//
//print_r(InsertSort($arr));
//选择排序
//首先在未排序序列中找到最小（大）元素，存放到排序序列的起始位置，
//然后，再从剩余未排序元素中继续寻找最小（大）元素，然后放到已排序序列的末尾。以此类推，直到所有元素均排序完毕。
function Select($arr){
    $len   =count($arr);
    if($len <= 1){
        return $arr;
    }
   //循环判断
    for ($i=0;$i<$len;$i++){
        //当前最小值为0开始
        $index = $i;
        //数组后面的值一直跟（当前位）做比较，如果比当前位小，那么就跟当前位交换位置，也就是最小的排前面～～
        for ($j=$i+1;$j<$len;$j++){
            //判断满足条件，比较小的数的下标进行交换
            if($arr[$j] < $arr[$index]){
                $index = $j;
            }
        }
        //把数组后面的最小值，与当前值做交换～～
        //增加判断的意思是，如果上面的循环没走到，那么就不用交换～～
        if($index != $i){
            $temp = $arr[$index];
            $arr[$index] = $arr[$i];
            $arr[$i] = $temp;
        }
    }
    return $arr;
}
//$arr = [1,3,34,-2,0,1,7];
//
//print_r(Select($arr));
//冒泡
function BubbleSort($arr){
    $len = count($arr);
    if($len <=1){
        return $arr;
    }
    for ($i=0;$i<$len;$i++){
        for ($j=$i+1;$j<$len;$j++){
           if($arr[$j] < $arr[$i]){
               $temp = $arr[$j];
               $arr[$j] = $arr[$i];
               $arr[$i] = $temp;
           }
        }
    }
    return $arr;
}
//$arr = [1,93,34,-20,0,100,7];
//print_r(BubbleSort($arr));

//快速排序
function quick_sort($a)
{
    // 判断是否需要运行，因下面已拿出一个中间值，这里<=1
    if (count($a) <= 1) {
        return $a;
    }
    $middle = $a[0]; // 中间值
    $left = array(); // 接收小于中间值
    $right = array();// 接收大于中间值
    // 循环比较
    for ($i=1; $i < count($a); $i++) {
        if ($middle < $a[$i]) {
            // 大于中间值
            $right[] = $a[$i];
        } else {
            // 小于中间值
            $left[] = $a[$i];
        }
    }
    // 递归排序划分好的2边
    $left = quick_sort($left);
    $right = quick_sort($right);
    // 合并排序后的数据，别忘了合并中间值
    return array_merge($left, array($middle), $right);
    // 倒序
    // return array_merge($right, array($middle), $left);
}
$a = array(2,13,42,34,56,23,67,365,87665,54,68,3);
//print_r(quick_sort($a));
//二分查找
/*
 * $arr 要查询的数组
 * $number 要查询的那个数字
 * $lower 从哪开始 （一般都是从第一位开始也就是下标0）
 * $high 从哪结束（一般都是数组的长度）
 */
function binary_search($arr, $number, $lower, $high) {
    // 以区间的中间点作为参照点比较
    $middle = intval(($lower + $high) / 2);
    // 最低点比最高点大就退出
    if ($lower > $high) {
        return -1;
    }
    if ($number > $arr[$middle]) {
        // 查找数比参照点大，舍去左边继续查找
        return binary_search($arr, $number, $middle + 1, $high);
    } elseif ($number < $arr[$middle]) {
        // 查找数比参照点小，舍去右边继续查找
        return binary_search($arr, $number, $lower, $middle - 1);
    //找到了
    } else {
        return $middle;
    }
}
print_r(binary_search($a,23,0,count($a)));


/**
 * 二分查找算法
 * @param array $arr 待查找区间
 * @param int $number 查找数
 * @return int        返回找到的键
 */
function binary_search_while($arr, $number) {
    // 非数组或者数组为空，直接返回-1
    if (!is_array($arr) || empty($arr)) {
        return -1;
    }
    // 初始变量值
    $len = count($arr);
    $lower = 0;
    $high = $len - 1;
    // 最低点比最高点大就退出
    while ($lower <= $high) {
        // 以中间点作为参照点比较
        $middle = intval(($lower + $high) / 2);
        if ($arr[$middle] > $number) {
            // 查找数比参照点小，舍去右边
            $high = $middle - 1;
        } else if ($arr[$middle] < $number) {
            // 查找数比参照点大，舍去左边
            $lower = $middle + 1;
        } else {
            // 查找数与参照点相等，则找到返回
            return $middle;
        }
    }
    // 未找到，返回-1
    return -1;
}

/**
 * @description 递归遍历文件夹
 * @param $dir
 * @return array
 * @author BinWei
 */
function recursionDir($dir)
{
    $result = [];
    $handle = opendir($dir);
    if ($handle) {
        while (($file = readdir($handle)) !== false) {
            if ($file != '.' && $file != '..') {
                // DIRECTORY_SEPARATOR =>  /
                $current_path = $dir . DIRECTORY_SEPARATOR . $file;
                if (is_dir($current_path)) {
                    $result[$current_path] = recursionDir($current_path);
                } else {
                    $result['file'][] = $current_path;
                }
            }
        }
        closedir($handle);
    }
    return $result;
}


$dir = '/Users/artist/data/www/';

$rs = recursionDir($dir);
echo(json_encode($rs));


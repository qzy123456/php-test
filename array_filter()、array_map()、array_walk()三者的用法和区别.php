<?php
//array_filter()
//  该函数把输入数组中的每个键值传给回调函数。如果回调函数返回 true，则把输入数组中的当前键值返回结果数组中。数组键名保持不变。
$arr = ['a','b',1,2,3];

$new_arr = array_filter($arr,function($val){
    return is_numeric($val);
});

var_dump($new_arr);
//array(3) {
//  [2]=>
//  int(1)
//  [3]=>
//  int(2)
//  [4]=>
//  int(3)
//}

//array_map()
//  该函数将用户自定义函数作用到数组中的每个值上，并返回用户自定义函数作用后的带有新值的数组。
//  可以传递多个数组，回调函数接受的参数数目应该和传递给 array_map() 函数的数组数目一致。
$arr1 = [1,2,3,4,5];
$arr2 = [6,7,8,9,10];

//函数写前面，数组参数写后面
$new_arr = array_map(function($val1,$val2){
    return $val1 + $val2;
},$arr1,$arr2);

var_dump($new_arr);
//array(5) {
//  [0]=>
//  int(7)
//  [1]=>
//  int(9)
//  [2]=>
//  int(11)
//  [3]=>
//  int(13)
//  [4]=>
//  int(15)
//}




//array_walk()
//对数组中的每个元素应用用户自定义函数
//将数组中的元素用于某种操作
	$arr = ['a','b','c'];
	array_walk($arr,function($val,$key){
        echo "{$key} is {$val}".PHP_EOL;
    });
	//返回结果
	//0 is a
	//1 is b
	//2 is c

	//改变数组中的值，传参的时候使用引用
	array_walk($arr,function(&$val){
        $val .= $val;
    });
	var_dump($arr);
//array(3) {
//  [0]=>
//  string(2) "aa"
//  [1]=>
//  string(2) "bb"
//  [2]=>
//  string(2) "cc"
//}
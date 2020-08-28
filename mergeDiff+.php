<?php
//1、当下标为数值时，array＋array合并数组则会把最先出现的值作为最终结果返回，而把后面的数组拥有相同键名的那些值“抛弃”掉（不是覆盖）.，
//但array_merge()不会覆盖掉原来的值

//2、当下标为字符时，array＋array合并数组仍然把最先出现的值作为最终结果返回，而把后面的数组拥有相同键名的那些值“抛弃”掉，
//但array_merge()此时会覆盖掉前面相同键名的值.
$arr1 = ['PHP', 'apache'];

$arr2 = ['PHP', 'MySQl', 'HTML', 'CSS'];

$mergeArr = array_merge($arr1, $arr2);

$plusArr = $arr1 + $arr2;

var_dump($mergeArr);

var_dump($plusArr);

/*
 *
$mergeArr：
array (size=6)
  0 => string 'PHP' (length=3)
  1 => string 'apache' (length=5)
  2 => string 'PHP' (length=3)
  3 => string 'MySQl' (length=5)
  4 => string 'HTML' (length=4)
  5 => string 'CSS' (length=3)
$plusArr：
array (size=4)
  0 => string 'PHP' (length=3)
  1 => string 'apache' (length=5)
  2 => string 'HTML' (length=4)
  3 => string 'CSS' (length=3
*/
$arr1 = ['PHP', 'a'=>'MySQl'];

$arr2 = ['PHP', 'MySQl', 'a'=>'HTML', 'CSS'];

$mergeArr = array_merge($arr1, $arr2);

$plusArr = $arr1 + $arr2;
/*
 * $mergeArr:
array (size=5)
  0 => string 'PHP' (length=3)
  'a' => string 'HTML' (length=4)
  1 => string 'PHP' (length=3)
  2 => string 'MySQl' (length=5)
  3 => string 'CSS' (length=3)
$plusArr:
array (size=4)
  0 => string 'PHP' (length=3)
  'a' => string 'MySQl' (length=5)
  1 => string 'MySQl' (length=5)
  2 => string 'CSS' (length=3)
 * */
$arr1 = ['PHP', 'a'=>'MySQl','6'=>'CSS'];

$arr2 = ['PHP', 'MySQl', 'a'=>'HTML', 'CSS'];

$mergeArr = array_merge($arr1, $arr2);

$plusArr = $arr1 + $arr2;

var_dump($mergeArr);

var_dump($plusArr);
/*
 * $mergeArr:
array (size=6)
  0 => string 'PHP' (length=3)
  'a' => string 'HTML' (length=4)
  1 => string 'CSS' (length=3)
  2 => string 'PHP' (length=3)
  3 => string 'MySQl' (length=5)
  4 => string 'CSS' (length=3)
$plusArr:
array (size=5)
  0 => string 'PHP' (length=3)
  'a' => string 'MySQl' (length=5)
  6 => string 'CSS' (length=3)
  1 => string 'MySQl' (length=5)
  2 => string 'CSS' (length=3)
 * */


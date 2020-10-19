<?php
function printMatrix($matrix)
{
 $row = count($matrix);
 $col = count($matrix[0]);
 if($row == 0 || $col == 0)
  return $matrix;
 $result = array();
 $left = 0;$right = $col-1; $top = 0;$bottom = $row-1;
 while($left<=$right && $top<= $bottom){
  for($i =$left;$i<=$right;++$i){
   array_push($result, $matrix[$top][$i]);
  }
  for($i =$top+1;$i<=$bottom;++$i)
   array_push($result, $matrix[$i][$right]);
  if($top!=$bottom){
   for($i = $right-1;$i>=$left;--$i)
    array_push($result, $matrix[$bottom][$i]);
  }
  if($left!=$right){
   for($i = $bottom-1;$i>$top;--$i)
    array_push($result, $matrix[$i][$left]);
  }
  $left++;$right--;$top++;$bottom--;
 }
 return $result;
}

$arr = [
   [1,3,4,5],
   [6,7,8,9],
   [10,11,12,13]
];
print_r(printMatrix($arr));

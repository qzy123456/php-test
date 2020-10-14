<?php

function NextNumberArray($Number, $NumberRangeArray){
  $w = 0;
  $c = -1;
  $abstand = 0;
  $l = count($NumberRangeArray);    
  for($pos=0; $pos < $l; $pos++){
    $n = $NumberRangeArray[$pos];
    $abstand = ($n < $Number) ? $Number - $n : $n - $Number;
    if ($c == -1){
      $c = $abstand;
      continue;
    } else if ($abstand < $c){
      $c = $abstand;
      $w = $pos;
    }
  }
  return $NumberRangeArray[$w];
}
  
print NextNumberArray(1, array(3, 8, 19, 34, 56, 89)) . "\n";

?>

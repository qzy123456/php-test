<?php

          $light=array_fill(0,100,false);
          for ($i = 0; $i < count($light); $i++) {
              for ($j = 0; $j < count($light); $j++) {
                  if (($i+1)%($j+1)==0) {
                      $light[$i]=!$light[$i];
                 }
             }
}
	print_r($light);


<?php
for($i=0, $j=10; $i<20; $i++) {
    while($j--) {
        if($j==6)
            goto end;
    }
}
echo"这里不会被输出";
end:
echo "i = $i\n";
echo "stop here \n";

$number = 1;
switch($number){
    case 1:
        goto one;                 //使用goto跳到one标记处
        echo "第一名";            //goto已经跳转，这条语句不执行
    case 2:
        goto two;
        echo "第二名";
    case 3:
        goto three;
        echo "第三名";
}

one:
echo " 一! \n";
//exit;
two:
echo " 二! \n";
//exit;
three:
echo " 三! \n";
//exit;
/*
  最终结果是：一! 二! 三!
  注意后面的exit 注释了，为何不是最终输出 一!,大家可以琢磨下。
*/
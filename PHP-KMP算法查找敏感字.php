<?php
/**
 * @desc构建next数组
 * @param string $str 模式字符串
 * @return array
 */
function makeNext($str) {
    $len = strlen($str);

    $next = [0];
    for($pos=1, $k=$next[0]; $pos<$len; $pos++) {
        if($str[$k] == $str[$pos]) {
            $k++;
        } else {
            while($k>0 && $str[$pos]!=$str[$k]) {
                $k = $next[$k-1];
            }
        }

        $next[$pos] = $k;
    }

    return $next;
}

/**
 * @param string $tString  目标字符串
 * @param string $pString  模式字符串
 * @param bool|false $findAll 是否找出模式串出现的全部位置
 */
function kmp($tString, $pString, $findAll=false) {
    $lenT = strlen($tString);
    $lenP = strlen($pString);
    $next = makeNext($pString);
    $found = false;

    for ($pos=0, $k=0; $pos<$lenT; $pos++) {
        if ($pString[$k] == $tString[$pos]) {
            $k++;
        } else {
            while($k>0 && $pString[$k] != $tString[$pos]) {
                $k = $next[$k-1];
            }
        }
        if ($k == $lenP) {
            $found = true;
            echo 'pattern found at '.($pos-$lenP+1) . PHP_EOL;
            if($findAll) {
                //匹配后需要退回到当前模式串出现的位置 下次循环从下一位置重新开始匹配
                $pos = $pos-$lenP+1;
                $k = 0;
            } else {
                break;
            }
        }
    }
    if(! $found) {
        echo 'pattern not found';
    }
}

kmp('abacabcaba', 'aba', true);

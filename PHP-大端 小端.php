<?php
//L表示无符号长整型，按主机字节序。N表示无符号长整型，大端序。
//它们都是32位的，所以如果用L和N对同一个整数进行打包，
//如果结果相等，则本机字节序就是大端序，否则就是小端序。代码如下：
define('BIG_ENDIAN', pack('L', 1) === pack('N', 1));

if (BIG_ENDIAN)
{
    echo "大端序";
}
else
{
    echo "小端序";
}

echo "\n";
echo 0x7FFFFFFF;//2147483647
echo "\n";
echo 0b1111111111111111111111111111111;//2147483647
echo "\n";
echo PHP_INT_MAX;//2147483647
echo "\n";

list($s1, $s2) = explode(' ', microtime());
echo (float)sprintf('%.0f', (floatval($s1) + floatval($s2)) * 1000);


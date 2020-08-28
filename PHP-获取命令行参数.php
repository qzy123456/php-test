<?php
/**
 * Created by PhpStorm.
 * User: artist
 * Date: 2020-07-20
 * Time: 17:18
 */
/**
 * 使用 $argc $argv 接受参数
 */
// php xxx.php a b c d
echo "接收到{$argc}个参数";
print_r($argv);

/**
 * 使用 getopt函数
 */
//其中 a b 相当于url中的参数key
// php xxx.php -a 345 -b 12q3
$param_arr = getopt('a:b:');
print_r($param_arr);


/**
 * 提示用户输入，类似Python
 */
fwrite(STDOUT,'请输入您的博客名：');
echo '您输入的信息是：'.fgets(STDIN);

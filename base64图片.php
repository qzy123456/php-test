<?php
/**
 * Created by PhpStorm.
 * User: artist
 * Date: 2019-10-29
 * Time: 10:51
 */

$str = 'I am Mr.Jing';

// 我去！php中字符串的元素居然是可变的
for ($i=0, $j = strlen($str)-1; $i < $j; $i++, $j--) {
    $tmp = $str[$j];
    $str[$j] = $str[$i];
    $str[$i] = $tmp;
}
// 输出结果
echo $str;
die;
$img = '../../UserFiles/domainname/ali_20181127211537.jpg';
$base64_img = base64EncodeImage($img);
echo  $base64_img;
function base64EncodeImage ($image_file) {
    $base64_image = '';
    $image_info = getimagesize($image_file);
    $image_data = fread(fopen($image_file, 'rb'), filesize($image_file));
    //chunk_split把字符串分割成一段段的了。不影响正常转换成图片,
    //$base64_image = 'data:' . $image_info['mime'] . ';base64,' . chunk_split(base64_encode($image_data));
    //新网可以直接用下面的这种chunk_split把字符串分割成一段段的了。
    //$base64_image = chunk_split(base64_encode($image_data));
    //阿里云只能用下面这种不能有任何分割的字符串POST数据给接口
    $base64_image = base64_encode($image_data);
    return $base64_image;
}
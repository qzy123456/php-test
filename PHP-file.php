<?php
$url = "https://www.baidu.com/s?wd=%E4%BB%8A%E6%97%A5%E6%96%B0%E9%B2%9C%E4%BA%8B&tn=SE_Pclogo_6ysd4c7a&sa=ire_dl_gh_logo&rsv_dl=igh_logo_pc";
//获取远程地址的md5值（需要暂时下载到本地）
echo md5_file($url);
echo "\n ";
//获取远程文件的大小
$file = file_get_contents($url);
echo strlen($file);
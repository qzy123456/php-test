
<?php
//slogin.php文件 完成session的设置
session_start();
header('Content-Type:text/javascript; charset=utf-8');
if(!empty($_GET['code'])){
    require './Des.php';
    $username = Des::decode($_GET['code'],'a');
    if(!empty($username)){
        header('P3P: CP="CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR"');
        $_SESSION['username'] = $username;
    }
}
?>


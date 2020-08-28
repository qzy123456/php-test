<?php
$today = date('Y-m-d H:i:s',time());
//order
$dns_order = new PDO('mysql:host=127.0.0.1;dbname=test', 'root', 'root');
//goods
$dns_goods = new PDO('mysql:host=127.0.0.1;dbname=test', 'root', 'root');
//生成唯一id
$_grid = uniqid("");
$_o = false;
$_g = false;
//1.准备事务
$dns_order->query('XA START \''.$_grid.'\'');
$dns_goods->query('XA START \''.$_grid.'\'');
try {
//2.更新order表
    $sql = "insert into app (create_date,app_code,app_name,publish_date) values('{$today}','111111','111111','{$today}')";
    $resultOrder = $dns_order->query($sql);
    if ($resultOrder === false) {
        echo 'order更新失败';
    } else {
        if ($resultOrder->rowCount() > 0) {
//4.成功通知准备提交
            var_dump($dns_order->query('XA END \''.$_grid.'\''));
            var_dump($dns_order->query('XA PREPARE \''.$_grid.'\''));
            var_dump($resultOrder->rowCount());
            $_o = true;
        }
    }
    if($_o == true) {
        echo ' ';
//3.更新goods表
        $sql = "update lives set room_id = 1 where id = 3";
        $resultGoods = $dns_goods->query($sql);
        if ($resultGoods === false) {
            echo 'goods更新失败';
        } else {
            if ($resultGoods->rowCount() > 0) {
//4.成功通知准备提交
                var_dump($dns_goods->query('XA END \''.$_grid.'\''));
                var_dump($dns_goods->query('XA PREPARE \''.$_grid.'\''));
                var_dump($resultGoods->rowCount());
                $_g = true;
            } else {
                echo 'goods未更新记录';
            }
        }
    }
    echo ''.'-----状态------';
    var_dump($_grid);
    var_dump($_o);
    var_dump($_g);
    echo '-----状态------';
    if ($_o == true && $_g == true) {
//5.提交SQL
        var_dump($dns_order->query('XA COMMIT \''.$_grid.'\''));
        var_dump($dns_goods->query('XA COMMIT \''.$_grid.'\''));
        echo ''.'成功!!!!!!';
    } else {
//4.失败回滚
        echo ''.'失败回滚';
        $dns_order->query('XA ROLLBACK \''.$_grid.'\'');
        $dns_goods->query('XA ROLLBACK \''.$_grid.'\'');
    }
} catch (Exception $e) {
//4.失败回滚
    $dns_order->query('XA ROLLBACK \''.$_grid.'\'');
    $dns_goods->query('XA ROLLBACK \''.$_grid.'\'');
    throw new Exception('执行失败');
}


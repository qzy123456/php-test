<?php
/**
 * Created by PhpStorm.
 * User: artist
 * Date: 2019-10-18
 * Time: 15:26
 */
//这种可以设置命令行调用～·并且传参数,接受参数使用 getopt('d:') 多个参数，例如d，a 就使用 getopt('d:a:')
$js = json_encode(array('name'=>11));
exec("php /Users/artist/data/www/host/swoole-client.php -d {$js}", $output, $return_val);

print_r($output);

    go(function () {

        $data = getopt('d:') != false ? getopt('d:') : "没有数据";
        $data = $data['d'];
        $cli = new Co\http\Client("127.0.0.1", 5200);
        $ret = $cli->upgrade("/");
        if ($ret) {
            $i = 0;
            while ($i < 3) {
                $cli->push($data );
                var_dump($cli->recv());
                co::sleep(1);
                $i++;
            }
            $cli->close();
        }
    });

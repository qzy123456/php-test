<?php
/**
 * Created by PhpStorm.
 * User: artist
 * Date: 2019-03-19
 * Time: 11:06
 */
$s = microtime(true);

for ($c = 100; $c--;) {
    go(function () {
        $mysql = new Swoole\Coroutine\MySQL;
        $mysql->connect([
            'host' => '127.0.0.1',
            'user' => 'root',
            'password' => 'root',
            'database' => 'test'
        ]);
        $statement = $mysql->prepare('SELECT * FROM `app`');
        for ($n = 100; $n--;) {
            $result = $statement->execute();
            assert(count($result) > 0);
        }
    });
}
\Swoole\Event::wait();
echo 'use ' . (microtime(true) - $s) . ' s';



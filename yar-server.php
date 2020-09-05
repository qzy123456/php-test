<?php
/**
 * Created by PhpStorm.
 * User: artist
 * Date: 2019-09-20
 * Time: 15:03
 */
class Service
{
    public function __constrict()
    {
    }

    public function add($a, $b)
    {
        return $a + $b;
    }

    public function sub($a, $b)
    {
        return $a - $b;
    }
}

$rpcServer = new \Yar_Server(new Service());
$rpcServer->handle();
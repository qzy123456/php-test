<?php
/**
 * Created by PhpStorm.
 * User: artist
 * Date: 2019-09-20
 * Time: 15:03
 */
$client = new Yar_Client("http://www.host.com/yar-server.php");
echo $client->add(10, 20);
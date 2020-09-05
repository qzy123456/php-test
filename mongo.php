<?php

$con    = new MongoDB\Driver\Manager('mongodb://127.0.0.1:27017');
$query  = new MongoDB\Driver\Query(["uuid"=>"RC6fa883aa-c922-4a25-bcd1-428541fdede5","title"=>"1212"]);
$cursor = $con->executeQuery('test.mongotest',$query);
echo "<pre>";
foreach ($cursor as $document) {
    print_r($document);
}
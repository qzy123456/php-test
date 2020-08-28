<?php

$person = new \Pb\Student();
$person->setAge(mt_rand(1,1000));
$person->setName('Gary');


$recvPerson = new \Pb\PBClass();
print_r($recvPerson->getStudents());


<?php
class A
{
    public $one = '';
    public $two = '';

    //Constructor
    public function __construct()
    {
        //Constructor
    }

    //print variable one
    public function echoOne()
    {
        echo $this->one."\n";
    }

    //print variable two
    public function echoTwo()
    {
        echo $this->two."\n";
    }
}

//Instantiate the object
$a = new A();

//Instantiate the reflection object
/**
 * @var ReflectionClass
 */
$reflector = new ReflectionClass('A');

//Now get all the properties from class A in to $properties array
//获取所有的参数，
$properties = $reflector->getProperties();
print_r($properties);
$i =1;
//Now go through the $properties array and populate each property
foreach($properties as $property)
{
    echo $property->getName();
    //Populating properties
    $a->{$property->getName()}=$i;
    //Invoking the method to print what was populated
    $a->{"echo".ucfirst($property->getName())}()."\n";

    $i++;
}
<?php
/**
 * Created by PhpStorm.
 * User: artist
 * Date: 2019-08-26
 * Time: 18:15
 */
class Hello {

    private $_name;
     private $_varValue;

     function __construct() {

       }

     function router() {
                 $this->_name = func_get_arg(0);
         $this->_varValue = func_get_arg(1);
       }

     function printResult() {

           echo "<p>";
           echo $this->_name = func_get_arg(0)['id'];
           echo "</p>";
       }
 }
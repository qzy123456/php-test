<?php
/**
 * Created by PhpStorm.
 * User: artist
 * Date: 2020-07-03
 * Time: 16:12
 */
function a($txt) {
    b("b");
}
function b($txt) {
    c("c");
}
function c($txt) {
    var_dump(debug_backtrace());
    //var_dump(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2)); //这句则会只获取 file line function
}
a("a");
//array(3) {
//  [0]=>
//  array(4) {
//    ["file"]=>
//    string(51) "/Users/artist/data/www/host/PHP-debug_backtrace.php"
//    ["line"]=>
//    int(12)
//    ["function"]=>
//    string(1) "c"
//    ["args"]=>
//    array(1) {
//      [0]=>
//      string(9) "c"
//    }
//  }
//  [1]=>
//  array(4) {
//    ["file"]=>
//    string(51) "/Users/artist/data/www/host/PHP-debug_backtrace.php"
//    ["line"]=>
//    int(9)
//    ["function"]=>
//    string(1) "b"
//    ["args"]=>
//    array(1) {
//      [0]=>
//      string(5) "b"
//    }
//  }
//  [2]=>
//  array(4) {
//    ["file"]=>
//    string(51) "/Users/artist/data/www/host/PHP-debug_backtrace.php"
//    ["line"]=>
//    int(17)
//    ["function"]=>
//    string(1) "a"
//    ["args"]=>
//    array(1) {
//      [0]=>
//      string(5) "a"
//    }
//  }
//}


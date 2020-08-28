<?php
//$str = '{
//    ci = bsdkintl;
//    d = 6852972145317856774;
//    o = "14bd371d-d26d-11ea-b54f-0256290297ba";
//    p = "s_diamand_package";
//    s = 0;
//    u = "6927b715-d22c-11ea-b54f-0256290297ba";
//    uid = 6855099671187118854;
//    v = "1.3.9";
//}';
$str = "{\n    ci = bsdkintl;\n    d = 6852972145317856774;\n    o = \"0bd0a28b-d2e7-11ea-b54f-0256290297ba\";\n    p = \"s_diamand_package\";\n    s = 0;\n    u = \"6927b715-d22c-11ea-b54f-0256290297ba\";\n    uid = 6855099671187118854;\n    v = \"1.3.9\";\n}";
$str = rtrim($str, "}");
$str = ltrim($str, "{");
$str = explode(';', $str);
$arr = [];
foreach ((array)$str as $k => $value) {
    foreach ((array)$value as $kk => $vv) {
        $vvv = explode('=', trim($vv));
        if (count($vvv) >= 2) {
            $k = (string)trim($vvv[0]);
            $v = (string)trim($vvv[1],' " ');
            $arr[$k] = $v;
        }
    }
}

print_r($arr);
$arrr = [
  [
    'exp',
    'object'
  ]
];
var_dump($arrr);
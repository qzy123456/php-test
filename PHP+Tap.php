<?php
function serverRequest ($url, $headers = '')
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $sResult = curl_exec($ch);
    if($sError=curl_error($ch)){
        die($sError);
    }
    curl_close($ch);
    return $sResult;
}
function getID( $x )
{
    $characters = array(
        "a" ,
        "b" ,
        "c" ,
        "d" ,
        "e" ,
        "f" ,
        "g" ,
        "h" ,
        "j" ,
        "k" ,
        "l" ,
        "m" ,
        "n" ,
        "p" ,
        "q" ,
        "r" ,
        "s" ,
        "t" ,
        "u" ,
        "v" ,
        "w" ,
        "x" ,
        "y" ,
        "z" ,
        "2" ,
        "3" ,
        "4" ,
        "5" ,
        "6" ,
        "7" ,
        "8" ,
        "9"
    );
    $ReqID = shuffle( $characters );

    for ( ; strlen( $ReqID ) < $x ; ) {
        $ReqID .= $characters[ mt_rand( 0 , count( $characters ) - 1 ) ];
    }

    return $ReqID;
}

$access_token = '1/abjpmb6pdM76y3vyV1IuZIE4xDsZXjqW4eU-rNAkmF5YcKD3zjOxZVwRv1GzAOq58Lm9VE9VYy9Gbg_GlRDR1bNdw-NhR79V_lllBa-9JNpEgz_tGmlu1_MFOEF1Wm80IqQ9ejsBcZg8l5RMCM2IwUA-nXEvIRpyYbybsYkvqc5kiKxI7WFd3cKpeZI5H6W_RNfN5cj2qOKRhZU39V9Yccxzgs7s_2nKQk_pDROqQPA5HGKulB191-aqIP7mqH2SRZWJ1hBvpqRfFmqELSS0krkI1n2Os8qpKp2N0VeubsHAY_dmZg1yjyJ9R0GRFWzNlc-eHiHGFzjO5joI_hzEHA';
$kid = 'BIEZXb7baKJI2ub3oc'; // kid
$mac_key = 'hw1PT3g30vKMbej1oXHWsEjJW59RaQNgkkKSMBj5'; // mac_key
$nonce = getID(6); // 随机字串，建议至少5位，必须每次随机生成
$ts = time(); // 当前时间戳，秒级
$url = 'https://openapi.taptap.com/account/profile/v1?client_id='.$kid;

$signatureBaseArray = [];
$signatureBaseArray[] = $ts; // 当前时间戳，秒级
$signatureBaseArray[] = $nonce; // 随机字符串
$signatureBaseArray[] = 'GET'; // 请求方式, GET 或 POST
$signatureBaseArray[] = "/account/profile/v1?client_id=".$kid; // uri
$signatureBaseArray[] = 'openapi.taptap.com'; // 主机名
$signatureBaseArray[] = 443; // 端口 80 | 443
$signatureBaseArray[] = ""; // ext

$signatureBaseString = implode("\n", $signatureBaseArray) . "\n";
$mac = base64_encode(hash_hmac('sha1', $signatureBaseString, $mac_key, true)); // 生成签名
$header = [
    "Authorization" => sprintf('MAC id="%s",ts="%d",nonce="%s",mac="%s"', $kid, $ts, $nonce, $mac)
];
//$response = serverRequest($url, $header);
$ex = 'curl -s -H Authorization:'.sprintf('MAC id="%s",ts="%d",nonce="%s",mac="%s"', $access_token, $ts, $nonce, $mac).' https://openapi.taptap.com/account/profile/v1?client_id=BIEZXb7baKJI2ub3oc';
echo $ex;
var_dump(exec($ex));



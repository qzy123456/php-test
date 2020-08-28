<?php
 function serverRequest($url, $data, $header = "")
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 跳过证书检查
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);  // 从证书中检查SSL加密算法是否存在
    //设置header头
    if (!empty($header)) {
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    }
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

function accessTokenRequest()
{
    //拼接url
    $url = "xxxxxxxxx";

    $headers = array(
        'Content-Type:multipart/form-data'
    );
    $path = '@'.realpath('cvs.php');
    //data
    $data = [
        "path" =>'cv行啊上线.zip',
        "md5" => md5_file(realpath('cvs.php')),
        "file" => new \CURLFile(realpath('cvs.php'),'application/octet-stream','cvs.php'),
        'bucket_type'=>1
    ];

    $result = serverRequest($url, $data, $headers);
    $result = json_decode($result, true);
var_dump($result);


}
//accessTokenRequest();
$subject = 'qqqq11';
var_dump(preg_match('/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9a-zA-Z]+$/', $subject));




<?php


//$array = array(
//    array('id' => 1, 'pid' => 0, 'name' => '河北省'),
//    array('id' => 2, 'pid' => 0, 'name' => '北京市'),
//    array('id' => 3, 'pid' => 1, 'name' => '邯郸市'),
//    array('id' => 4, 'pid' => 2, 'name' => '朝阳区'),
//   array('id' => 5, 'pid' => 2, 'name' => '通州区'),
//    array('id' => 6, 'pid' => 4, 'name' => '望京'),
//    array('id' => 7, 'pid' => 4, 'name' => '酒仙桥'),
//    array('id' => 8, 'pid' => 3, 'name' => '永年区'),
//    array('id' => 9, 'pid' => 1, 'name' => '武安市'),
//);
//function getTree($data,$pid=0,$level=0){
//     $tree=[];
//    if ($data && is_array($data)) {
//        foreach ($data as $k=>$v) {
//            if ($v['pid'] == $pid) {
//                unset($data[$k]);
//                $v['level'] = $v;
//                $v['son'] = getTree($data,$v['id'],$level+1);
//                $tree[] = $v;
//
//            }
//        }
//    }
//    return $tree;
//}
//print_r(getTree($array));
function serverRequest($url, $data)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 跳过证书检查
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);  // 从证书中检查SSL加密算法是否存在
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

$url = '116.63.100.238:8110/v2';
$arr = [
    '8da822b5-5e3d-11ec-9ac6-fa163e53e5bf',
    'a634d1e4-5e32-11ec-9ac6-fa163e53e5bf',
    'f5296a7c-5e24-11ec-9ac6-fa163e53e5bf',
    '218b45ef-5e1c-11ec-9ac6-fa163e53e5bf',
    'af95eacd-5e1a-11ec-9ac6-fa163e53e5bf',
    'a6eec808-5d90-11ec-9ac6-fa163e53e5bf',
    '285ee21e-5d88-11ec-9ac6-fa163e53e5bf',
    '2e2a8fbc-5d87-11ec-9ac6-fa163e53e5bf',
    '1b88645c-5d85-11ec-9ac6-fa163e53e5bf',
    '7d50ace0-5d7e-11ec-9ac6-fa163e53e5bf',
    '6a82500c-5d76-11ec-9ac6-fa163e53e5bf',
    'e0d181e5-5d72-11ec-9ac6-fa163e53e5bf',
    '3db4ebf7-5d6c-11ec-9ac6-fa163e53e5bf',
    'e090935e-5d61-11ec-9ac6-fa163e53e5bf',
    'dd852fba-5d4c-11ec-9ac6-fa163e53e5bf',
    '0263678f-5cc5-11ec-9ac6-fa163e53e5bf',
    'c913095b-5cb2-11ec-9ac6-fa163e53e5bf',
    '5f3f931c-5ca3-11ec-9ac6-fa163e53e5bf',
    '47717143-5ca3-11ec-9ac6-fa163e53e5bf',
    '8df2745f-5c90-11ec-9ac6-fa163e53e5bf',
    'c5ec5ed4-5c8a-11ec-9ac6-fa163e53e5bf',
    'd2a17739-5c0d-11ec-9ac6-fa163e53e5bf',
    '6bbd9975-5bfe-11ec-9ac6-fa163e53e5bf',
    '955a40b9-5bda-11ec-9ac6-fa163e53e5bf',
    '08eea7a6-599d-11ec-9ac6-fa163e53e5bf',
    '06aa2bce-5987-11ec-9ac6-fa163e53e5bf',
    '7697f98a-5423-11ec-aa35-fa163e53e5bf',
    '4e1fd1cd-527b-11ec-955f-fa163e53e5bf',
    '7ba0464d-4dcb-11ec-89d0-fa163e53e5bf',
    'eeaaf7fa-4c0b-11ec-89d0-fa163e53e5bf',
    'fc5b7193-4b4a-11ec-89d0-fa163e53e5bf',
    '04b0ebf8-490c-11ec-89d0-fa163e53e5bf',
    'f709f204-483e-11ec-89d0-fa163e53e5bf',
    'a8cef0ba-479d-11ec-89d0-fa163e53e5bf',
    '8a0e1760-4790-11ec-89d0-fa163e53e5bf',
    '71d37579-478e-11ec-89d0-fa163e53e5bf',
    '8fc6de64-4789-11ec-89d0-fa163e53e5bf',
    'f3a6a463-4771-11ec-89d0-fa163e53e5bf',
    'f7cdef60-476a-11ec-89d0-fa163e53e5bf',
    '50f51b85-475c-11ec-89d0-fa163e53e5bf',
    '01d81dd5-4754-11ec-89d0-fa163e53e5bf',
    '9cbbec12-4751-11ec-89d0-fa163e53e5bf',
    '1018b92a-46c4-11ec-89d0-fa163e53e5bf',
    '540f33da-46b3-11ec-89d0-fa163e53e5bf',
    'f0eeed24-46ae-11ec-89d0-fa163e53e5bf',
    'd7733971-46ab-11ec-89d0-fa163e53e5bf',
    '3f520b8d-46a8-11ec-89d0-fa163e53e5bf',
    '4de34d73-4694-11ec-89d0-fa163e53e5bf',
    '8523a401-4693-11ec-89d0-fa163e53e5bf',
    '420b6ed2-4690-11ec-89d0-fa163e53e5bf',
    '20e5a522-468b-11ec-89d0-fa163e53e5bf',
    'f965c54d-45f7-11ec-89d0-fa163e53e5bf',
    '3593d633-45f7-11ec-89d0-fa163e53e5bf',
    'e1d22868-45e5-11ec-89d0-fa163e53e5bf',
    '508fbad6-45dd-11ec-89d0-fa163e53e5bf',
    'b9bb6ecc-443f-11ec-89d0-fa163e53e5bf',
    '73325b62-4394-11ec-89d0-fa163e53e5bf',
    '2d3e2d17-4391-11ec-89d0-fa163e53e5bf',
    'b6361b4a-3e04-11ec-89d0-fa163e53e5bf',
    'c9cf9a56-3d32-11ec-89d0-fa163e53e5bf',
    'e94cf95d-3bc4-11ec-89d0-fa163e53e5bf',
    'baa57fd8-3bac-11ec-89d0-fa163e53e5bf',
    '7cfea962-3ba5-11ec-89d0-fa163e53e5bf',
    '7a9cfb57-3b92-11ec-89d0-fa163e53e5bf',
    '9cadcc10-3b09-11ec-89d0-fa163e53e5bf',
    'a01cf750-3af7-11ec-89d0-fa163e53e5bf',
    '89e00ec5-3ae6-11ec-89d0-fa163e53e5bf',
    '0f1d304d-3ae0-11ec-89d0-fa163e53e5bf',
    '667391b8-3895-11ec-89d0-fa163e53e5bf',
    'ff670ced-387f-11ec-89d0-fa163e53e5bf',
    '425d046b-36f7-11ec-89d0-fa163e53e5bf',
    '78de47b1-36ef-11ec-89d0-fa163e53e5bf',
    'c16defff-36db-11ec-89d0-fa163e53e5bf',
    '9d69499e-357c-11ec-89d0-fa163e53e5bf',
    '900c2af4-355c-11ec-89d0-fa163e53e5bf',
    'a45bf780-331e-11ec-89d0-fa163e53e5bf',
    '092f5646-3319-11ec-89d0-fa163e53e5bf',
    'a5f1ced1-30c3-11ec-89d0-fa163e53e5bf',
    'cd6b93d6-30b2-11ec-89d0-fa163e53e5bf',
    '653ffad0-30b2-11ec-89d0-fa163e53e5bf',
    '5c54bbe9-30a7-11ec-89d0-fa163e53e5bf',
    'b1de98a5-30a1-11ec-89d0-fa163e53e5bf',
    '06103fa1-3084-11ec-89d0-fa163e53e5bf',
    'cf064f33-2fd9-11ec-89d0-fa163e53e5bf',
    '891ae13d-2d69-11ec-89d0-fa163e53e5bf',
    '631b5408-2d61-11ec-89d0-fa163e53e5bf',
    '06805ccc-2ca9-11ec-89d0-fa163e53e5bf',
    'c8b8fa4e-2ca1-11ec-89d0-fa163e53e5bf',
    'b769f7c7-1d1c-11ec-89d0-fa163e53e5bf',
    '3e795d55-1d1c-11ec-89d0-fa163e53e5bf',
    '0566799e-1d1a-11ec-89d0-fa163e53e5bf',
    '5a4f886d-1d15-11ec-89d0-fa163e53e5bf',
    'e6f1c3a0-1ce7-11ec-89d0-fa163e53e5bf',
    '04c07255-1ce4-11ec-89d0-fa163e53e5bf',
    'c2e7c96f-1c66-11ec-89d0-fa163e53e5bf',
    '3ab48129-1c63-11ec-89d0-fa163e53e5bf',
    'b7cef21f-1c60-11ec-89d0-fa163e53e5bf',
    '6135af40-1c60-11ec-89d0-fa163e53e5bf',
    '602dbd67-1c5f-11ec-89d0-fa163e53e5bf',
    '2d4256f6-1c5b-11ec-89d0-fa163e53e5bf',
];

foreach ($arr as $uuid) {
    $t = time() * 10000;
    $post = [
        'actions' => [
            $t => ['PassTicket/AddScores', '20211216', 10000, 1]
        ],
        'configVersion' => '2.0.9'
    ];

    $post['uuid'] = $uuid;

    $data = json_encode($post);

    $apiVersion = 'v1';
    $result = serverRequest($url, $data);
    var_dump(json_decode($result, true));
}



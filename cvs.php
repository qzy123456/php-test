<?php
/**
 * Created by PhpStorm.
 * User: artist
 * Date: 2019-06-28
 * Time: 17:37
 */
function excel_export_data($xlsDatas, $xlsTitle, $xlsHeader, $xlsFileName) {

    //定义命名空间
    $str = '<html xmlns:v="urn:schemas-microsoft-com:vml" ';
    $str .= 'xmlns:o="urn:schemas-microsoft-com:office:office" ';
    $str .= 'xmlns:x="urn:schemas-microsoft-com:office:excel" ';
    $str .= 'xmlns="http://www.w3.org/TR/REC-html40">';

    //header设置
    $str .= '<head>';
    $str .= '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" > ';
    $str .= '</head>';

    //数据正文,可以自己设置
    $str .= '<body>';
    $str .= '<table border=1>' . $xlsTitle;
    $str .= '<table border=1>' . $xlsHeader;
    foreach ($xlsDatas as $key => $rt) {
        $str .= "<tr>";
        foreach ($rt as $k => $v) {
            $str .= "<td>{$v}</td>";
        }
        $str .= '</tr>';
    }
    $str .= '</table></body></html>';

    //文件下载
    header('Content-Type: application/vnd.ms-excel; name="excel"');
    header('Content-type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . $xlsFileName);
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: no-cache');
    header('Expires: 0');
    exit($str);
}

$xlsDatas = [
    [
        '1',
        'jack',
        'jack@gmail.com',
        'beijing',
        "13812345678\t",
        '61044119808080X',
        "20170101-00:00:00",
    ],
];
$xlsTitle = "<tr style='border-style:none' ><th  colspan='7'>用户中心-VIP-1-会员信息</th ></tr>";
$xlsHeader = "<tr>
               <th style = 'width:70px;' > ID</th >
               <th style = 'width:70px;' > 用户名</th >
               <th style = 'width:70px;' > 邮箱</th >
               <th style = 'width:70px;' > 地址</th >
               <th style = 'width:70px;' > 电话</th >
               <th style = 'width:70px;' > 身份证</th >
               <th style = 'width:70px;' > 注册时间</th >
           </tr>";
$xlsFileName = '会员信息_' . date('YmdHis') . '.xls';
excel_export_data($xlsDatas, $xlsTitle, $xlsHeader, $xlsFileName);

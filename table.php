<?php
/**
 * Created by PhpStorm.
 * User: artist
 * Date: 2019-03-19
 * Time: 13:37
 */


$data[] =
        array("1552608000" =>array(
            1,
            0.41496598639455784,
            0.3333333333333333,
            0.272108843537415
),
        "1552694400"=>array(
            1,
            0.4489795918367347,
            0.3197278911564626,
            0
        ),
        "1552780800"=>array(
            1,
            0.41353383458646614,
            0,
            0
        ),
        "1552867200"=>array(
            1,
            0,
            0,
            0
        )
        );
foreach ($data as $key=>$v){
    //var_dump($v);
}
//print_r(json_decode($data));
//$contact1 = array(                                             //定义外层数组
//    array(1,'高某','A公司','北京市','(010)987654321','gm@Linux.com'),//子数组1
//    array(2,'洛某','B公司','上海市','(021)123456789','lm@apache.com'),//子数组2
//    array(3,'峰某','C公司','天津市','(022)24680246','fm@mysql.com'),  //子数组3
//    array(4,'书某','D公司','重庆市','(023)13579135','sm@php.com')     //子数组4
//);
//以HTML表格的形式输出二维数组中的每个元素
echo '<table border="1" width="600" align="center">';
echo '<caption><h1>联系人列表</h1></caption>';
echo '<tr bgcolor="#dddddd">';
echo '<th>编号</th><th>姓名</th><th>公司</th><th>地址</th><th>电话</th><th>EMALL</th>';
echo '</tr>';
//使用双层for语句嵌套二维数组$contact1,以HTML表格的形式输出
//使用外层循环遍历数组$contact1中的行
//var_dump(count($data));die;
foreach($data[0] as $key=>$v)
{
    echo '<tr>';
    echo '<td>'.$key.'</td>';
    //使用内层循环遍历数组$contact1 中 子数组的每个元素,使用count()函数控制循环次数
    foreach($v as $key1=>$v1)
    {
        if($v1 !== 0){
            $v1 = round($v1* 100,2);
            switch ($v1){
               case $v1> 60;
               $str =  '<td style="background-color:#330652"><span style="color: aliceblue">'.$v1.'%'.'</span></td>';
               break;
               case  $v1 >50;
                    $str =  '<td style="background-color:#401c44"><span style="color: aliceblue">'.$v1.'%'.'</span></td>';
                    break;
                case $v1> 35;
                    $str =  '<td style="background-color:#401c44;opacity: 0.35"><span style="color: aliceblue">'.$v1.'%'.'</span></td>';
                    break;
                case $v1 > 25;
                    $str =  '<td style="background-color: #401c44"><span style="color: aliceblue">'.$v1.'%'.'</span></td>';
                    break;
                case $v1 > 20;
                    $str =  '<td style="background-color:#8552a1"><span style="color: aliceblue">'.$v1.'%'.'</span></td>';
                    break;
            }
            echo $str;
        }

    }
    echo '</tr>';
}
echo '</table>';
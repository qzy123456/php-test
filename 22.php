<?php
/**
 * Created by PhpStorm.
 * User: artist
 * Date: 2019-03-29
 * Time: 11:40
 */
 class cc {
    public $name;
    function Run(){
        echo 11;
    }
    function __construct()
    {
        echo 111;
    }

    function __toString()
    {
        // TODO: Implement __toString() method.
        return 'dsd';
    }
    function __clone()
    {
        // TODO: Implement __clone() method.
        $this->name = 'eqwe';

    }
    function __destruct()
    {
        // TODO: Implement __destruct() method.
        echo 'destruct';
    }
   public function __set($name, $value)
    {
        // TODO: Implement __set() method.
        $this->$name = $value;
    }
   public function __get($name)
    {
        // TODO: Implement __get() method.
        return $this->$name;
    }
}

//$r = new cc();

//$r->name = "张三";
//$r1 = clone $r;//克隆的语法
//var_dump($r1);
//var_dump($r);
//对某一数组进行加权处理
$numbers = array('nike' => 200, 'jordan' => 500, 'adidas' => 800);

//通常方法，如果是百万级别的访问量，会占用极大内存

//改用yield生成器
function mt_rand_weight($numbers) {
    $total = 0;
    foreach ($numbers as $number => $weight) {
        $total += $weight;
        yield $number => $total;
    }
}

function mt_rand_generator($numbers)
{
    $total = array_sum($numbers);
    $rand = mt_rand(0, $total -1);
    foreach (mt_rand_weight($numbers) as $name => $weight) {
        if ($rand < $weight) echo $name." ";
    }
}
mt_rand_generator($numbers);

$a = '1';
$b = &$a;
$b = "2$b";
echo $a,$b;
//因为指针的问题～～所以b的值直接影响了a的值
//2121
$data = [
    ['id' => 1, 'title' => 'Electronics', 'parent_id' => 0],
    ['id' => 2, 'title' => 'Laptops & PC', 'parent_id' => 1],
    ['id' => 3, 'title' => 'Laptops', 'parent_id' => 2],
    ['id' => 4, 'title' => 'PC', 'parent_id' => 2],
    ['id' => 5, 'title' => 'Cameras & photo', 'parent_id' => 1],
    ['id' => 6, 'title' => 'Camera', 'parent_id' => 5],
    ['id' => 7, 'title' => 'Phones & Accessories', 'parent_id' => 1],
    ['id' => 8, 'title' => 'Smartphones', 'parent_id' => 7],
    ['id' => 9, 'title' => 'Android', 'parent_id' => 8],
    ['id' => 10, 'title' => 'iOS', 'parent_id' => 8],
    ['id' => 11, 'title' => 'Other Smartphones', 'parent_id' => 8],
    ['id' => 12, 'title' => 'Batteries', 'parent_id' => 7],
    ['id' => 13, 'title' => 'Headsets', 'parent_id' => 7],
    ['id' => 14, 'title' => 'Screen Protectors', 'parent_id' => 13],
];
function make_tree2($data = [], $parent_id = 0, $level = 0)
{
    $tree = [];
    if ($data && is_array($data)) {
        foreach ($data as $v) {
            if ($v['parent_id'] == $parent_id) {
                $tree[] = [
                    'id' => $v['id'],
                    'level' => $level,
                    'title' => $v['title'],
                    'parent_id' => $v['parent_id'],
                    'children' => make_tree2($data, $v['id'], $level + 1),
                ];
            }
        }
    }
    return $tree;
}

function make_tree($data)
{
    $refer = array();
    $tree = array();
    foreach($data as $k => $v){
        $refer[$v['id']] =  &$data[$k];  //创建主键的数组引用
    }

    foreach($data as $k => $v){
        $parent_id = $v['parent_id'];   //获取当前分类的父级id
        if($parent_id == 0){
            $tree[] = & $data[$k];   //顶级栏目
        }else{
            if(isset($refer[$parent_id])){
                $refer[$parent_id]['children'][] = & $data[$k];  //如果存在父级栏目，则添加进父级栏目的子栏目数组中
            }
        }
    }

    return $tree;
}
echo "<pre>";
print_r(make_tree2($data));
print_r(make_tree($data));
$cc = getallheaders();
foreach ($cc as $name => $value) {

    echo "$name: $value <br>";

}



<?php
/**
 * 观察者模式
 * @package design pattern
 */

/**
 * 抽象主题角色
 */
interface Subject {

    /**
     * 增加一个新的观察者对象
     * @param Observer $observer
     */
    public function attach(Observer $observer);

    /**
     * 删除一个已注册过的观察者对象
     * @param Observer $observer
     */
    public function detach(Observer $observer);

    /**
     * 通知所有注册过的观察者对象
     */
    public function notifyObservers();
}

/**
 * 具体主题角色
 */
class ConcreteSubject implements Subject {

    private $_observers;

    public function __construct() {
        $this->_observers = array();
    }

    /**
     * 增加一个新的观察者对象
     * @param Observer $observer
     */
    public function attach(Observer $observer) {
        return array_push($this->_observers, $observer);
    }

    /**
     * 删除一个已注册过的观察者对象
     * @param Observer $observer
     */
    public function detach(Observer $observer) {
        $index = array_search($observer, $this->_observers);
        if ($index === FALSE || ! array_key_exists($index, $this->_observers)) {
            return FALSE;
        }

        unset($this->_observers[$index]);
        return TRUE;
    }

    /**
     * 通知所有注册过的观察者对象
     */
    public function notifyObservers() {
        if (!is_array($this->_observers)) {
            return FALSE;
        }

        foreach ($this->_observers as $observer) {
            $observer->update();
        }

        return TRUE;
    }

}

/**
 * 抽象观察者角色
 */
interface Observer {

    /**
     * 更新方法
     */
    public function update();
}

class ConcreteObserver implements Observer {

    /**
     * 观察者的名称
     * @var <type>
     */
    private $_name;

    public function __construct($name) {
        $this->_name = $name;
    }

    /**
     * 更新方法
     */
    public function update() {
        echo 'Observer', $this->_name, ' has notified.<br />';
    }

}
//实例化类：
$subject = new ConcreteSubject();

/* 添加第一个观察者 */
$observer1 = new ConcreteObserver('Martin');
$subject->attach($observer1);

echo '<br /> The First notify:<br />';
$subject->notifyObservers();

/* 添加第二个观察者 */
$observer2 = new ConcreteObserver('phppan');
$subject->attach($observer2);

echo '<br /> The Second notify:<br />';
$subject->notifyObservers();

/* 删除第一个观察者 */
$subject->detach($observer1);

echo '<br /> The Third notify:<br />';
$subject->notifyObservers();

$result = 0;




$three = function() use ($result)
{ var_dump($result); };



$result =2 ;

$three();    // outputs int(1)

////计算一个十进制数转换为二进制数中‘1’的个数
// //例如十进制11 = 二进制1011，则结果是3个1
//
//    //解题思路：利用 n & (n - 1) 可以将最后一个1变0
//   //xxxx1000 & (xxxx1000 - 1) = xxxx1000 & xxxx0111 = xxxx0000
//   // 1011 & (1011 - 1) = 1011 & 1010 = 1010
//   //直到最后一个1被与为0，得出结果
function count1($n) {
    $r = 0;
    while ($n != 0) {
        $r++;
        $n &= ($n - 1);
    }

    return $r;
}
function count2($n) {
    $r = 0;
    while($n !=0)
    {

        if(($n%2) !=0 )
        {
            $r++;
        }
        $n=$n/2;
    }

    return $r;
}

echo count1(13);
//约瑟夫环～猴子选大王
function get_king($n, $m){
    //生成一个有序的数组
    $arr = range(1, $n);
    $i = 0;
    while(count($arr) > 1){
        //开始数
        $i++;
        //当前的
        $curr = array_shift($arr);
        //不满足条件  压入到数组尾部
        if($i%$m !=0){
            array_push($arr, $curr);
        }
    }
    return $arr[0];
}

$res = get_king(5,3); //4
var_dump($res);
//这个也可以处理约瑟夫的问题
//哦，是这样的，每个猴子出列后，剩下的猴子又组成了另一个子问题。
//只是他们的编号变化了。第一个出列的猴子肯定是a[1]=m(mod)n(m/n的余数)，
//他除去后剩下的猴子是a[1]+1,a[1]+2,…,n,1,2,…a[1]-2,a[1]-1，对应的新编号是1,2,3…n-1。
//设此时某个猴子的新编号是i，他原来的编号就是(i+a[1])%n。于是，这便形成了一个递归问题。
//假如知道了这个子问题(n-1个猴子)的解是x，那么原问题(n个猴子)的解便是：(x+m%n)%n=(x+m)%n。
//问题的起始条件：如果n=1,那么结果就是1。
function yuesefu($n, $m)
{
    $r = 0;
    for ($i = 2; $i <= $n; $i++) {
        $r = ($r + $m) % $i;
    }
    return $r + 1;
}
 echo yuesefu(5,3)."是猴王";

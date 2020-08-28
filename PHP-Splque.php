<?php
/**
 * Created by PhpStorm.
 * User: artist
 * Date: 2020-06-17
 * Time: 16:50
 */

class Test {
    public static function foo() {
        echo 'Test::foo() called'.PHP_EOL;
    }
    public static function bar() {
        echo 'Test::bar() called'.PHP_EOL;
    }
    public static function msg($msg) {
        echo "$msg".PHP_EOL;
    }
}

$queue = new SplQueue();
//  * - SplQueue允许使用两种迭代模式
//     *  - SplDoublyLnkedList::IT_MODE_FIFO | SplDoublyLnkedList::IT_MODE_KEEP
//     *  - SplDoublyLnkedList::IT_MODE_FIFO | SplDoublyLnkedList::IT_MODE_DELETE
//     *
//     * 默认的模式是 : SplDoublyLnkedList::IT_MODE_FIFO | SplDoublyLnkedList::IT_MODE_KEEP
//  /**
//     * 取出队列头部的成员
//     * @note dequeue方法等效于父类shift方法
//     * @see splDoublyLinkedList::shift()
//     */
//    /**
//     * 往队列尾部添加成员
//     *
//     * @note enqueue方法等效于父类push方法
//     * @see splDoublyLinkedList::push()

$queue->setIteratorMode(SplQueue::IT_MODE_DELETE);
$queue->enqueue(array("Test", "foo"));
$queue->enqueue(array("Test", "bar"));
$queue->enqueue(array("Test", "msg", "Hi there!"));

foreach ($queue as $task) {
    if (count($task) > 2) {
        list($class, $method, $args) = $task;
        $class::$method($args);
    } else {
        list($class, $method) = $task;
        $class::$method();
    }
}
////////////////////////////////////
$queue = new SplQueue();  //初始化队列

$queue->enqueue(1);       //进队列
$queue->enqueue(2);       //进队列
$queue->enqueue(3);
$queue->enqueue(4);
$queue->enqueue(5);
$queue->enqueue(6);

echo $queue->bottom();    //得到队首元素
echo PHP_EOL;
$queue->dequeue();        //出队列
echo $queue->bottom();    //得到队首元素
echo PHP_EOL;
echo $queue->count();     //队列中元素个数

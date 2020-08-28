<?php
/**
 * 链表元素结点类
 */
class Node
{
    public $pre = NULL; // 前驱
    public $next = NULL; // 后继
    public $data = NULL; // 结点值

    public function __Construct($data)
    {
        $this->data = $data;
    }
}
/**
 * 双向链表类
 */
class DoubleLink
{
    private $head; // 头指针
    private $tail; // 尾指针
    private $len; // 链表长度

    /**
     * 初始化链表
     */
    public function __Construct()
    {
        $newNode = new Node(null);
        $this->tail = $this->head = $newNode;
        $this->len = 0;
    }

    /**
     * 添加结点
     * @param $data 要添加的结点
     * @param $search 添加的位置
     */
    public function addNode($data, $search = null)
    {
        $newNode = new Node($data);
        $tmp = $this->searchNode($search);
        if ($tmp !== null) {
            $newNode->pre = $tmp->pre;
            $newNode->next = $tmp;
            $tmp->pre = $newNode;
            $newNode->pre->next = $newNode;
        } else {
            $newNode->pre = $this->tail;
            $this->tail->next = $newNode;
            $this->tail = $newNode;
        }
        $this->len++;
    }

    /**
     * 删除指定结点
     * @param $search
     */
    public function delNode($search)
    {
        $tmp = $this->searchNode($search);
        if (null !== $tmp) {
            if ($tmp->next !== null) {
                $tmp->pre->next = $tmp->next;
                $tmp->next->pre = $tmp->pre;
            } else {
                $tmp->pre->next = null;
            }
            unset($tmp);
            $this->len--;
        }
    }

    /**
     * 修改指定结点的值
     * @param $search
     * @param $data
     */
    public function setNode($search, $data)
    {
        $tmp = $this->searchNode($search);
        if (null !== $tmp) {
            $tmp->data = $data;
        }
    }

    /**
     * 查找结点
     * @param $search 要查找的结点元素值
     * @return $tmp 查找到的结点元素
     */
    public function searchNode($search)
    {
        $tmp = $this->head;
        while ($tmp->next !== null) {
            $tmp = $tmp->next;
            if ($tmp->data === $search) {
                return $tmp;
            }
        }
        return null;
    }

    /**
     * 读取链表全部结点
     */
    public function show()
    {
        //正序读
        $tmp = $this->head;
        while ($tmp->next !== null) {
            $tmp = $tmp->next;
            echo $tmp->data;
        }
        echo PHP_EOL;
        //逆序读
        $tmp = $this->tail;
        while ($tmp->pre !== null) {
            echo $tmp->data;
            $tmp = $tmp->pre;
        }
    }
}

$myList = new DoubleLink();
$myList->addNode("A");
$myList->addNode("B");
$myList->addNode("C");
$myList->addNode("D");
$myList->addNode("E");
//制定节点后，添加新的节点
$myList->addNode('F', 'C');
//删除
$myList->delNode('F');
//更改指定节点的值
$myList->setNode("B", 'G');
//来吧～～～展示～～心在跳，情在烧🔥～～嗷嗷嗷～～
$myList->show();
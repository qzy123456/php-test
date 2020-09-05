<?php

    class Node
    {
        public $data = '';
        public $next = null;

        function __construct($data)
        {
            $this->data = $data;
        }
    }


    // 链表有几个元素
    function countNode($head)
    {
        $cur = $head;
        $i = 0;
        while (!is_null($cur->next)) {
            ++$i;
            $cur = $cur->next;
        }
        return $i;
    }

    // 增加节点（添加到最后）
    function addNode($head, $data)
    {
        $cur = $head;
        //一直寻找，找到最后一个节点，
        while (!is_null($cur->next)) {
            $cur = $cur->next;
        }
        //把数据插入到最后一个节点里面去
        $new = new Node($data);
        $cur->next = $new;
    }

    // 紧接着插在$no后
    function insertNode($head, $data, $no)
    {
        //如果数据大于整个链表的最大值，那么就出错了
        if ($no > countNode($head)) {
            return false;
        }
        //头节点，
        $cur = $head;
        //要插入的节点
        $new = new Node($data);
        //从头节点开始往后找，
        for ($i = 0; $i < $no; $i++) {
            //找到要插入节点的前一个，比如要插入的位数是5，那么找到4就可以了
            $cur = $cur->next;
        }
        //也就是把以前的下一个，变成现在的下一个， 也就是4的下一个，变成现在要插入数据的下一个，上个一个的下一个变成自己。
        $new->next = $cur->next;
        //上个一个的下一个变成自己。
        $cur->next = $new;

    }

    // 删除第$no个节点
    function delNode($head, $no)
    {
        if ($no > countNode($head)) {
            return false;
        }
        //头节点开始
        $cur = $head;
        //比如要删除第3个节点，那么查到2就可以停止了。也就是要删除的前一个（从0开始的，也就是小于 n-1）
        for ($i = 0; $i < $no - 1; $i++) {
            $cur = $cur->next;
        }
        //删除第一个节点也没关系。因为到时候第二个就是第一个了
        $cur->next = $cur->next->next;

    }

    // 遍历链表
    function showNode($head)
    {
        $cur = $head;
        while (!is_null($cur->next)) {
            $cur = $cur->next;
            echo $cur->data, '<br/>';
        }
    }

    $head = new Node(null);// 定义头节点
    //增加
    addNode($head, 'a');
    addNode($head, 'b');
    addNode($head, 'c');
    //插入
    insertNode($head, 'd', 0);
    //展示
    showNode($head);

    echo '<hr/>';
    //删除链表
    delNode($head, 4);
    //遍历链表
    showNode($head);
<?php

//最大堆
class MaxHeap extends SplHeap
{
    protected function compare($a, $b)
    {
        return $a - $b;
    }
}

//最小堆
class MinHeap extends SplHeap
{
    protected function compare($a, $b)
    {
        return $b - $a;
    }
}

$list = new MaxHeap;
$list->insert(56);
$list->insert(22);
$list->insert(35);
$list->insert(11);
$list->insert(88);
$list->insert(36);
$list->insert(97);
$list->insert(98);
$list->insert(26);
foreach($list as $li)
{
    echo $li."\n";
}
//php的内置队列
$queue = new SplQueue();
//入队
$queue->push($data);
//出队
$data = $queue->shift();
//查询队列中的排队数量
$n = count($queue);
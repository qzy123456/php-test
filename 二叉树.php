<?php

class Node
{
    public $value;
    public $left;
    public $right;
}

//先序遍历
function Firstorder($root)
{
    $stack = [];

    array_push($stack, $root);

    while (!empty($stack)) {
        $center_node = array_pop($stack);

        echo $center_node->value . ' ';

        if ($center_node->right != null) {
            array_push($stack, $center_node->right);
        }

        if ($center_node->left != null) {
            array_push($stack, $center_node->left);
        }
    }
}

//中序遍历
function Middleorder($root)
{
    $stack = [];
    $center_node = $root;

    while (!empty($stack) || $center_node != null) {
        while ($center_node != null) {
            array_push($stack, $center_node);
            $center_node = $center_node->left;
        }

        $center_node = array_pop($stack);
        echo $center_node->value . " ";

        $center_node = $center_node->right;
    }
}

//后序遍历
function Afterlorder($root)
{
    $stack = [];
    $outstack = [];
    array_push($stack, $root);

    while (!empty($stack)) {
        $center_node = array_pop($stack);

        array_push($outstack, $center_node);

        if ($center_node->left != null) {
            array_push($stack, $center_node->left);
        }

        if ($center_node->right != null) {
            array_push($stack, $center_node->right);
        }
    }

    while (!empty($outstack)) {
        $center_node = array_pop($outstack);
        echo $center_node->value . ' ';
    }

}


$a = new Node();
$b = new Node();
$c = new Node();
$d = new Node();
$e = new Node();
$f = new Node();
$a->value = 'A';
$b->value = 'B';
$c->value = 'C';
$d->value = 'D';
$e->value = 'E';
$f->value = 'F';
////////////////A//////////////////////
///////B//////////////C//////////////
///D//////////////E////////F//////
$a->left = $b;
$a->right = $c;
$b->left = $d;
$c->left = $e;
$c->right = $f;

Firstorder($a);

echo PHP_EOL;

Middleorder($a); //中序遍历

echo PHP_EOL;

Afterlorder($a); //后续遍历
//输入分别是
//A B D C E F

//D B A E C F

//D B E F C A
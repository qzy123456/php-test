<?php
class TrieNode {
    public $data;
    public $children = [];
    public $isEndingChar = false;

    public function __construct($data)
    {
        $this->data = $data;
    }
}

class Tire {
    private $root;

    public function __construct() {
        $this->root = new TrieNode('/'); //根节点
    }

    public function getRoot() {
        return $this->root;
    }

    public function insert($text) {
        $p = $this->root;
        for ($i = 0; $i < mb_strlen($text); $i++) {
            $index = $data = $text[$i];

            if (empty($p->children[$index])) {
                $newNode = new TrieNode($data);
                $p->children[$index] = $newNode;
            }
            $p = $p->children[$index];
        }
        $p->isEndingChar = true;
    }

    public function find($pattern) {
        $p = $this->root;
        for ($i = 0; $i < mb_strlen($pattern); $i++) {
            $index = $data = $pattern[$i];

            if (empty($p->children[$index])) {
                return false;
            }
            $p = $p->children[$index];
        }
        if ($p->isEndingChar == false) {
            return false;
        }
        return true;
    }
}

$trie = new Tire();
$strings = ['love','abc','abd','bcd','abcd','efg','hii',"毛泽东"];
foreach ($strings as $str) {
    $trie->insert($str);
}
if ($trie->find('泽东')) {
    print "包含这个字符串\n";
} else {
    print "不包含这个字符串\n";
}
//print_r($trie->getRoot());

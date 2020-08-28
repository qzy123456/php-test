<?php
/**
 * Created by PhpStorm.
 * User: artist
 * Date: 2019-10-22
 * Time: 11:29
 */
$arrWord = array('word1', 'word2', 'word3');
$resTrie = trie_filter_new(); //create an empty trie tree
foreach ($arrWord as $k => $v) {
    trie_filter_store($resTrie, $v);
}
trie_filter_save($resTrie, __DIR__ . '/blackword.tree');

$resTrie = trie_filter_load(__DIR__ . '/blackword.tree');

$strContent = 'hello word2 word1';
$arrRet = trie_filter_search($resTrie, $strContent);
print_r($arrRet); //Array(0 => 6, 1 => 5)
echo substr($strContent, $arrRet[0], $arrRet[1]); //word2
$arrRet = trie_filter_search_all($resTrie, $strContent);
print_r($arrRet); //Array(0 => Array(0 => 6, 1 => 5), 1 => Array(0 => 12, 1 => 5))

$arrRet = trie_filter_search($resTrie, 'hello word');
print_r($arrRet); //Array()

trie_filter_free($resTrie);
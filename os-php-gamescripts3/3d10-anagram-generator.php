<?php

/*
 * 3d10-anagram-generator.php
 * by Duane O'Brien - http://chaoticneutral.net
 * written for IBM DeveloperWorks
 */

if (!empty($_POST)) {

    $words = explode("\n", file_get_contents('words.list.txt'));

    foreach ($words as $word) {
        $key = implode('', sort(str_split($word)));
        if (isset($lookup[$key])) {
            array_push($lookup[$key], $word);
        } else {
            $lookup[$key] = array($word);
        }
    }
}


$search = implode('', sort(str_split($_POST['jumble'])));

if (isset($lookup[$search])) {
    foreach ($lookup[$search] as $word) {
        echo $word;
    }
}



?>
<form method='post'>
<input name='jumble' />
<input type='submit' value='help' />
</form>
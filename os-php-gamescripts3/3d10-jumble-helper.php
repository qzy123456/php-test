<?php

/*
 * 3d10-jumble-helper.php
 * by Duane O'Brien - http://chaoticneutral.net
 * written for IBM DeveloperWorks
 */

if (!empty($_POST)) {

    $words = explode("\n", file_get_contents('words.list.txt'));

    foreach ($words as $word) {
        $arr = str_split($word);
        sort($arr);
        $key = implode('', $arr);
        if (isset($lookup[$key])) {
            array_push($lookup[$key], $word);
        } else {
            $lookup[$key] = array($word);
        }
    }

    $arr = str_split($_POST['jumble']);
    sort($arr);
    $search = implode('', $arr);
    
    if (isset($lookup[$search])) {
        foreach ($lookup[$search] as $word) {
            echo $word . "<br />";
        }
    }
}


?>
<form method='post'>
<input name='jumble' />
<input type='submit' value='help' />
</form>
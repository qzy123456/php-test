<?php

/*
 * 3d10-word-chains.php
 * by Duane O'Brien - http://chaoticneutral.net
 * written for IBM DeveloperWorks
 */

$chain = array();

if (!empty($_POST)) {

    $words = explode("\n", file_get_contents('words.list.txt'));
    $matches = array($_POST['word']);
    
    while (!empty($matches)) {
        shuffle($matches);
        unset($link);
        while (!empty($matches)) {
            $link = array_shift($matches);
            if (!in_array($link, $chain)) {
                $matches = array();
            } else {
                $link = false;
            }
        }
        if ($link == false) {
            break;
        }
        $chain[] = $link;
        $letters = str_split($link);
        foreach ($letters as $key => $letter) {
            foreach ($words as $word) {
                if ($key == 0) {
                    $guess =  '.' . substr($link, 1);
                } else if ($key+1 == count($letters)) {
                    $guess =  substr($link, 0, $key) . '.';
                } else {
                    $guess =  substr($link, 0, $key) . '.' . substr($link, $key+1);
                }
                if (preg_match("/^" . $guess . "$/",$word)) {
                    $matches[] = $word;
                }
            }
        }
    }
}

?>
<form method='post'>
<input name='word' />
<input type='submit' value='make a chain' />
</form>
<?php 

foreach ($chain as $word) {
    echo $word . '<br />';
} 

?>
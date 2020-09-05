<?php

/*
 * 3d10-cryptogram-helper.php
 * by Duane O'Brien - http://chaoticneutral.net
 * written for IBM DeveloperWorks
 */

$result = '';

$letters = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');

$lettercount = array_fill_keys($letters, 0);

$codedlettercount = array_fill_keys($letters, 0);

if (!empty($_POST)) {
    $unencoded = str_split(preg_replace('/[^a-z]/', '', strtolower($_POST['unencoded'])));
    foreach ($unencoded as $letter) {
        $lettercount[$letter]++;
    }
    
    arsort($lettercount);
    
    $encoded = str_split(preg_replace('/[^a-z]/', '', strtolower($_POST['encoded'])));
    foreach ($encoded as $letter) {
        $codedlettercount[$letter]++;
    }
    
    arsort($codedlettercount);
    
    $key = array_combine(array_keys($codedlettercount), array_keys($lettercount));
    
    $decode = str_split($_POST['encoded']);
    $result = '';

    foreach ($decode as $letter) {
        if (isset($key[strtolower($letter)])) {
            $result .= $key[strtolower($letter)];
        } else {
            $result .= $letter;
        }
    }
}

?>
<form method='post'>
Unencoded: <br /><textarea name='unencoded'></textarea>
<br />
Encoded: <br /><textarea name='encoded'></textarea>
<br />
<input type='submit' value='perform analysis' />
</form>
<hr />
<?php echo $result ?>
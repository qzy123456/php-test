<?php

/*
 * 3d10-substitution-cyphers.php
 * by Duane O'Brien - http://chaoticneutral.net
 * written for IBM DeveloperWorks
 */

$letters = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
$code = $letters;
shuffle($code);
$key = array_combine($letters, $code);

if (!empty($_POST)) {
    $messageletters = str_split(strtolower($_POST['message']));
    $show = '';
    foreach ($messageletters as $letter) {
        $show .= $key[$letter];
    }
    $showkey = '';
    foreach ($key as $letter=>$decode) {
        $showkey .= $letter . " = " . $decode . " ";
    }
}

?>
Message : <?php echo $show ?><br />
Key : <?php echo $showkey ?><br />
<form method='post'>
<input name='message' />
<input type='submit' value='encode' />
</form>
<a href='3d10-substitution-cypher.php'>Start Over</a><br />
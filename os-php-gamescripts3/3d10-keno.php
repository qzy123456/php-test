<?php

/*
 * 3d10-keno.php
 * by Duane O'Brien - http://chaoticneutral.net
 * written for IBM DeveloperWorks
 */

$picks = array();
$matches = array();
$picked = array();

if (!empty($_POST)) {
    $balls = array();
    for ($i = 1; $i <= 80; $i++) {
        $balls[] = $i;
    }
    
    shuffle($balls);
    $picks = explode(',', $_POST['picks']);
    sort($picks);
    $matches = array();;
    for ($i = 0; $i < 20; $i++) {
        $picked[] = $balls[$i];
        if (in_array($balls[$i], $picks) && $i < 15) {
            $matches[] = $balls[$i];
        }
    }
    sort($picked);
    sort($matches);    
}

?>
<form method='post'>
<input name='picks' />
<input type='submit' value='play keno' />
</form>
Your Picks: <?php echo implode(',', $picks)?><br />
Balls Picked: <?php echo implode(',', $picked)?><br />
Matches: <?php echo count($matches)?> total : <?php echo implode(',', $matches)?><br />

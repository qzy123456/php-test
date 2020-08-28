<?php

/*
 * 3d10-counting-cards.php
 * by Duane O'Brien - http://chaoticneutral.net
 * written for IBM DeveloperWorks
 */

/* Start by copying in everything we did for the deck generator 
 * In part 2, we'll abstract this out so it's a little easier to use.
 */

if (empty($_POST)) {
    $deck = array (
        'faces' => 16, // 10,J,Q,K * 4 suits
        'aces' => 4, // One per suit
        'other' => 32, // 52 - (16 + 4)
    );
    $deckstr = serialize($deck);
} else {
    $deck = unserialize($_POST['deckstr']);
    switch ($_POST['submit']) {
        case 'face' :
            $deck['faces'] = $deck['faces']-1;
            break;
        case 'ace' :
            $deck['aces']--;
            break;
        case 'other' :
            $deck['other']--;
            break;
    }
    $deckstr = serialize($deck);
}

echo "Odds of pulling a face: " . $deck['faces'] . " out of " . ($deck['faces'] + $deck['aces'] + $deck['other']) . "<br />";
echo "Odds of pulling an ace: " . $deck['aces'] . " out of " . ($deck['faces'] + $deck['aces'] + $deck['other']) . "<br />";
echo "Odds of pulling anything else: " . $deck['other'] . " out of " . ($deck['faces'] + $deck['aces'] + $deck['other']) . "<br />";

?>
<form method="post">
<input type="hidden" name="deckstr" value='<?php echo $deckstr ?>' />
<input type="submit" name="submit" value="face" />
<input type="submit" name="submit" value="ace" />
<input type="submit" name="submit" value="other" />
</form>
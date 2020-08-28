<?php

/*
 * 3d10-bingo-engine.php
 * by Duane O'Brien - http://chaoticneutral.net
 * written for IBM DeveloperWorks
 */

/* Start by copying in everything we did for the deck generator 
 * In part 2, we'll abstract this out so it's a little easier to use.
 */

if (empty($_POST)) {
    for ($i = 1; $i < 16; $i++) {
        $numbers['B'][] = $i;
        $numbers['I'][] = $i+15;
        $numbers['N'][] = $i+30;
        $numbers['G'][] = $i+45;
        $numbers['O'][] = $i+60;
    }
    
    $picks = array();
    
    
    $letters = array ('B','I','N','G','O');
    foreach ($letters as $letter) {
        for ($i = 0;$i < 10;$i++) {
            shuffle($numbers[$letter]);
            $chunks = array_chunk($numbers[$letter], 5);
            $cards[$i][$letter] = $chunks[0];
            if ($letter == 'N') {
                $cards[$i][$letter][2] = '  '; // Free Space
            }
            
        }
        foreach ($numbers[$letter] as $number) {
            $balls[] = $letter.$number;
        }
        shuffle($balls);
    }

    $cardsstr = serialize($cards);
    $ballsstr = serialize($balls);
    $picksstr = serialize($picks);

} else {
    $cards = unserialize($_POST['cardsstr']);
    $balls = unserialize($_POST['ballsstr']);
    $picks = unserialize($_POST['picksstr']);
    array_unshift($picks, array_shift($balls));
    
    echo "<h1>Just Picked: " . $picks[0] . "</h1>";

    $cardsstr = serialize($cards);
    $ballsstr = serialize($balls);
    $picksstr = serialize($picks);
}

?>
Picks : <?php echo implode(',', $picks) ?>
<form method='post'>
<input type='hidden' name='cardsstr' value='<?php echo $cardsstr ?>' />
<input type='hidden' name='ballsstr' value='<?php echo $ballsstr ?>' />
<input type='hidden' name='picksstr' value='<?php echo $picksstr ?>' />
<input type='submit' name='cards' value='next number' />
</form>
<a href="3d10-bingo-engine.php">Start Over</a>
<?php

foreach ($cards as $card) {
    echo "<table border='1'>";
    echo "<tr><td>B</td><td>I</td><td>N</td><td>G</td><td>O</td></tr>";
    for ($i = 0; $i < 5; $i++) {
        echo "<tr><td>" . $card['B'][$i] . "</td><td>" .$card['I'][$i]  . "</td><td>" . $card['N'][$i] . "</td>";
        echo "<td>" . $card['G'][$i] . "</td><td>" . $card['O'][$i] . "</td></tr>";
    }
    echo "</table>";
}

?>
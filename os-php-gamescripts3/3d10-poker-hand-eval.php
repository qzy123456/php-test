<?php

/*
 * 3d10-poker-hand-eval.php
 * by Duane O'Brien - http://chaoticneutral.net
 * written for IBM DeveloperWorks
 */

/* First, we have the suits */

$suits = array (
    "Spades", "Hearts", "Clubs", "Diamonds"
);

/* Next, we declare the faces*/

$faces = array (
    "Two", "Three", "Four", "Five", "Six", "Seven", "Eight",
    "Nine", "Ten", "Jack", "Queen", "King", "Ace"
);

/* Now build the deck by combining the faces and suits. */

$deck = array();

foreach ($suits as $suit) {
    foreach ($faces as $face) {
        $deck[] = array('face'=>$face,'suit'=>$suit);
    }
}

/* Next, you can shuffle up the deck and pull a random card. */

shuffle($deck);

$hand = array();

if (empty($_POST)) {
    
    for ($i = 0; $i < 5; $i++) {
        $hand[] = array_shift($deck);
    }

    $handstr = serialize($hand);
    $deckstr= serialize($deck);
    ?>
<form method='post'>
<input type='hidden' name='handstr' value = '<?php echo $handstr ?>' />
<input type='hidden' name='deckstr' value = '<?php echo $deckstr ?>' />
<?php

foreach ($hand as $index =>$card) {
    echo "<input type='checkbox' name='card[" . $index . "]' /> " . $card['face'] . ' of ' . $card['suit'] . "<br />";
}

?>
<input type='submit' value='draw' />
</form>
<?php

} else {
    $hand = unserialize($_POST['handstr']);
    $deck = unserialize($_POST['deckstr']);
    for ($i = 0; $i < 5; $i++) {
        if (isset($_POST['card'][$i])) {
            $hand[$i] = array_shift($deck);
        }
    }

    foreach ($hand as $index =>$card) {
        echo $card['face'] . ' of ' . $card['suit'] . "<br />";
    }
    
    $results = resolve_hand($hand);
    echo 'Result: ' . $results['result'] . '<br />';
    echo "<a href='3d10-poker-hand-eval.php'>Try Again</a>";

}

function resolve_hand($hand) {
    global $faces;
    $faces_weights = array_flip($faces);
    $return = array(
        'hand' => $hand,
        'suit' => $hand[0]['suit'],
        'highcard' => $hand[0]['face'],
        'flush' => true,
        'straight' => true,
    );
    $first = array_shift($hand);
    $straight = array($faces_weights[$first['face']] => 1);
    $greatest = 1;
    foreach ($hand as $card) {
        if ($return['flush'] == true && $first['suit'] != $card['suit']) {
            $return['flush'] = false; 
        }
        $weight = $faces_weights[$card['face']];
        if ($faces_weights[$return['highcard']] < $weight) {
            $return['highcard'] = $card['face'];
        }
        if (isset($straight[$weight])) {
            $straight[$weight]++;
            if ($straight[$weight] > $greatest) {
                $greatest = $straight[$weight];
            }
            $return['straight'] = false;
        } else {
            $straight[$weight] = 1;
        }
    }
    if ($return['straight'] == true) {
        $these_weights = array_keys($straight);
        sort($these_weights, SORT_NUMERIC);
        // resolve straightness
        $first = current($these_weights);
        $last = end($these_weights);
        if ($last - $first != 4) {
            $return['straight'] = false;
        }
    }
    $return['straight_sort'] = $straight;
    $count = count($straight);
    switch ($count) {
        case 5 :
            // High Card
            if ($return['flush'] == true && $return['straight'] == false) {
                $return['result'] = 'Flush';
            } else if ($return['flush'] == false && $return['straight'] == true) {
                $return['result'] = 'Straight';
            } else if ($return['flush'] == true && $return['straight'] == true) {
                $return['result'] = 'Straight Flush';
            } else {
                $return['result'] = 'High Card';
            }
            break;
        case 4 :
            // Pair
            $return['result'] = 'One Pair';
            break;
        case 3 :
            // Two Pair or Three Of A Kind
            if ($greatest == 3) {
                $return['result'] = 'Three Of A Kind';
            } else {
                $return['result'] = 'Two Pair';
            }
            break;
        case 2 :
            // Full House or Four Of A Kind
            if ($greatest == 4) {
                $return['result'] = 'Four Of A Kind';
            } else {
                $return['result'] = 'Full House';
            }
            break;
        case 1 :
        default :
            // how did you get here?
            $return['error'] = 'Somehow, you had 5 or more of a kind.';
    }
    return $return;
}

?>
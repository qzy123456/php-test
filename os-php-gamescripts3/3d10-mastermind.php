<?php

/*
 * 3d10-mastermind.php
 * by Duane O'Brien - http://chaoticneutral.net
 * written for IBM DeveloperWorks
 */

$pegs = array ('R','O','Y','G','B','V');
$correct = 0;
$colors = 0;
$guess=array();
$code_colors = array_fill_keys($pegs, 0);
$guessed_colors = array_fill_keys($pegs, 0);

if (empty($_POST)) {
    $code = array();
    for ($i = 0; $i < 4; $i++) {
        $code[] = $pegs[rand(0,5)];
    }
} else {
    $guess = str_split($_POST['guess']);
    $code = unserialize($_POST['code']);
    if ($guess == $code) {
        // the code has been guessed.
        echo "You have guessed the code.  Well done!<br />";
    } else {
        foreach ($code as $peg) {
            $code_colors[$peg]++;
        }
        for ($i = 0;$i < 4;$i++) {
            if ($guess[$i] == $code[$i]) {
                // A correct guess
                $correct++;
                // decriment the $code_colors value, as it should not count later
                $code_colors[$guess[$i]]--;
            } else {
                // Keep track of the guessed colors, for output later
                $guessed_colors[$guess[$i]]++;
            }
        }
        $true_colors = array();
        foreach ($pegs as $peg) {
            if ($code_colors[$peg] > 0 && $code_colors[$peg]  == $guessed_colors[$peg] ) {
                $true_colors[$peg] = $code_colors[$peg];
            }
        }
        $colors = count($true_colors);
        
    }
}

?>
POSSIBLE VALUES: <?php echo implode(',', $pegs) ?><br />
Correct Colors: <?php echo $colors ?><br />
Correct Pegs: <?php echo $correct ?><br />
<form method='post'>
Your Guess : <input name='guess' value='<?php echo implode('', $guess) ?>'/>
<input type='hidden' name='code' value='<?php echo serialize($code) ?>' />
<input type='submit' value='guess' />
</form>
<a href='3d10-mastermind.php'>Start Over</a>

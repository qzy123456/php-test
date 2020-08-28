<?php

/*
 * 3d10-npc-generator.php
 * by Duane O'Brien - http://chaoticneutral.net
 * written for IBM DeveloperWorks
 */

function roll($sides) {
    return mt_rand(1,$sides);
}

$rules = array(
    'health' => '36',
    'gore' => 'health/6',
    'clutch' => '1d6',
    'brawn' => '1d6',
    'sense' => '1d6',
    'flail' => '1d6',
    'chuck' => '1d6',
    'lurch' => '1d6',
);

$male = explode("\n", file_get_contents('names.male.txt'));
$female = explode("\n", file_get_contents('names.female.txt'));
$last = explode("\n", file_get_contents('names.last.txt'));

/* Shuffle the name arrays, or you'll get the same results every time */

shuffle($male);
shuffle($female);
shuffle($last);

for ($i = 0; $i <= 10; $i++) {
    echo "<br />Male Name : " . $male[$i] . ' ' . $last[$i] . "<br />\n";
    echo "Female Name : " . $female[$i] . ' ' . $last[$i] . "<br />\n";

    foreach ($rules as $stat=>$rule) {
        if (preg_match("/^[0-9]+$/", $rule)) {
            // This is only a number, and is therefore a static value
            $character[$stat] = $rule;
        } else if (preg_match("/^([0-9]+)d([0-9]+)/", $rule, $matches)) {
            // This is a die roll
            $val = 0;
            for ($n = 0;$n<$matches[1];$n++) {
                $val = $val + roll($matches[2]);
            }
            $character[$stat] = $val;
        } else if (preg_match("/^([a-z]+)\/([0-9]+)$/", $rule, $matches)) {
            // This is a derived value of some kind.
            $character[$stat] = $character[$matches[1]] / $matches[2];
        }
        echo $stat . ' : ' . $character[$stat] . "<br />\n";
    }
}


?>
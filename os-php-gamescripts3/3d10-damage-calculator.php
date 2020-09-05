<?php

/*
 * 3d10-damage-calculator.php
 * by Duane O'Brien - http://chaoticneutral.net
 * written for IBM DeveloperWorks
 */

/* A really basic function to simulate rolling a simple die with N sides */

function roll($sides) {
    return mt_rand(1,$sides);
}

?>

<table border="1">
<tr><td>Weapon Name</td><td>Damage</td><td>Result</td></tr>

<?php

$weapons = array (
    'littlestick' => array (
        'name' => 'Little Stick',
        'roll' => '1d6',
        'bonus' => '0',
    ),
    'bigstick' => array (
        'name' => 'Big Stick',
        'roll' => '1d6',
        'bonus' => '4',
    ),
    'chainsaw' => array (
        'name' => 'Chainsaw',
        'roll' => '2d8',
        'bonus' => '0',
    ),
);

foreach ($weapons as $weapon) {
    list($count, $sides) = explode('d', $weapon['roll']);
    $result = 0;
    for ($i = 0; $i < $count;$i++) {
        $result = $result + roll($sides);
    }
    echo "<tr><td>" . $weapon['name'] . "</td><td>" . $weapon['roll'];
    if ($weapon['bonus'] > 0) {
        echo "+" . $weapon['bonus'];
        $result = $result + $weapon['bonus'];
    }
    echo "</td><td>" . $result . "</td></tr>";
}

?>
</table>
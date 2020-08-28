<?php

/*
 * 3d10-odds-calculator-die-roll.php
 * by Duane O'Brien - http://chaoticneutral.net
 * written for IBM DeveloperWorks
 */

$s = 6;
$n = 2;
$results = array(array());
for ($i = 0; $i < $n; $i ++) {
    $newresults = array();
    foreach ($results as $result) {
        for ($x = 0; $x < $s; $x++) {
            $newresults[] = array_merge($result, array($x+1));           
        }
    }
    $results = $newresults;
}

$sums = array();
$grid = array();
$total = 0;
foreach ($results as $result) {
    $sum = 0;
    $total++;
    $grid[$result[0]][] = $result[1]; // You will need to change this to display more than two dice
    foreach ($result as $num) {
        $sum = $sum + $num;
    }
    $sums[$sum]++;
}

?>
COMBINATIONS : <br />
<table border='1'>
<tr><td>Die 1</td><td colspan='6'>Die 2</td></tr>
<?php
foreach ($grid as $d1 => $row) {
    echo "<tr><td>" . $d1 . "</td><td>" . implode('</td><td>', $row) . "</td></tr>";    
}
?>
</table><br />
SUMS : <br />
<?php

foreach ($sums as $sum=>$odds) {
    echo $sum . " : " . $odds . " in " . $total . "<br />\n";
}

?>
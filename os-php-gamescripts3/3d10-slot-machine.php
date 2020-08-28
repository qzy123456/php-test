<?php

/*
 * 3d10-slot-machine.php
 * by Duane O'Brien - http://chaoticneutral.net
 * written for IBM DeveloperWorks
 */

$faces = array ('Cherry', 'Bar', 'Double Bar', 'Triple Bar', 'Diamond', 'Seven');

$payouts = array (
    'Bar|Bar|Bar' => '5',
    'Double Bar|Double Bar|Double Bar' => '10',
    'Triple Bar|Triple Bar|Triple Bar' => '15',
    'Cherry|Cherry|Cherry' => '20',
    'Seven|Seven|Seven' => '70',
    'Diamond|Diamond|Diamond' => '100',
);


$wheel1 = array();
foreach ($faces as $face) {
    $wheel1[] = $face;
}
$wheel2 = array_reverse($wheel1);
$wheel3 = $wheel1;


if (isset($_POST['payline'])) {
    list($start1, $start2, $start3) = unserialize($_POST['payline']);
} else {
    list($start1, $start2, $start3) = array(0,0,0);
}

$stop1 = rand(count($wheel1)+$start1, 10*count($wheel1)) % count($wheel1);
$stop2 = rand(count($wheel1)+$start2, 10*count($wheel1)) % count($wheel1);
$stop3 = rand(count($wheel1)+$start3, 10*count($wheel1)) % count($wheel1);

$result1 = $wheel1[$stop1];
$result2 = $wheel2[$stop2];
$result3 = $wheel3[$stop3];

echo "Result: " . $result1 . ' ' . $result2 . ' ' . $result3 . "<br />";

if (isset($payouts[$result1.'|'.$result2.'|'.$result3])) {
    // give the payout
    echo "You won : " . $payouts[$result1.'|'.$result2.'|'.$result3];
}

?>
<br />
<form method='post'>
<input type='hidden' name='payline' value='<?php echo serialize(array($stop1, $stop2, $stop3)) ?>' />
<input type='submit' value='spin the wheel' />
</form>
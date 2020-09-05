<?php

/*
 * 3d10-map-generator.php
 * by Duane O'Brien - http://chaoticneutral.net
 * written for IBM DeveloperWorks
 */

$map = array();
$terrain = array ('plains', 'forest', 'swamp', 'hills', 'mountains', 'water');
for ($row = 0; $row < 20; $row++) {
    $map[] = array();
    for ($column = 0; $column < 20; $column++) {
        $pool = $terrain;
        if (isset($map[$row-1])) {
            if (isset($map[$row-1][$column-1])) {
                $pool[] = $map[$row-1][$column-1];
                $pool[] = $map[$row-1][$column-1];
            }
            $pool[] = $map[$row-1][$column];
            $pool[] = $map[$row-1][$column];
            if (isset($map[$row-1][$column+1])) {
                $pool[] = $map[$row-1][$column+1];
                $pool[] = $map[$row-1][$column+1];
            }
        }
        if (isset($map[$row][$column-1])) {
                $pool[] = $map[$row][$column-1];
                $pool[] = $map[$row][$column-1];
        }
        shuffle($pool);
        $map[$row][$column] = $pool[0];
    }
}

?>
<table cellspacing='0' cellpadding='0' border='0'>
<?php foreach ($map as $row) { ?>
<tr>
<?php foreach ($row as $tile) { ?>
<td><img src='tile_<?php echo $tile ?>.png' style='width:50px;height:50px' /></td>
<?php } ?>
</tr>
<?php } ?>
</table>
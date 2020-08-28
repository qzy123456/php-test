<?php

/*
 * 3d10-stat-tracker.php
 * by Duane O'Brien - http://chaoticneutral.net
 * written for IBM DeveloperWorks
 */

if (!empty($_POST)) {
    if ($_POST['submit'] == 'save') {
        $filename = substr(preg_replace("/[^a-z0-9]/", "", strtolower($_POST['name'])), 0, 20);
        $character = array(
            'name' => $_POST['name'],
            'health' => (int) $_POST['health'],
            'gore' => (int) $_POST['gore'],
            'clutch' => (int) $_POST['clutch'],
            'brawn' => (int) $_POST['brawn'],
            'sense' => (int) $_POST['sense'],
            'flail' => (int) $_POST['flail'],
            'chuck' => (int) $_POST['chuck'],
            'lurch' => (int) $_POST['lurch'],
        );
        file_put_contents($filename, serialize($character));
    } else if ($_POST['submit'] == 'load') {
        $filename = substr(preg_replace("/[^a-z0-9]/", "", strtolower($_POST['name'])), 0, 20);
        $data = file_get_contents($filename);
        $character = unserialize($data);
    }
} else {
    $character = array(
        'name' => 'Fred The Zombie',
        'health' => '36',
        'gore' => '1',
        'clutch' => '5',
        'brawn' => '6',
        'sense' => '4',
        'flail' => '2',
        'chuck' => '3',
        'lurch' => '4',
    );
}

?>
<form method='post'>
Name : <input name='name' value='<?php echo $character['name'] ?>' /><input type='submit' name='submit' value='load' /><br />
Health : <input name='health' value='<?php echo $character['health'] ?>' /><br />
Gore : <input name='gore' value='<?php echo $character['gore'] ?>' /><br />
Clutch : <input name='clutch' value='<?php echo $character['clutch'] ?>' /><br />
Brawn : <input name='brawn' value='<?php echo $character['brawn'] ?>' /><br />
Sense : <input name='sense' value='<?php echo $character['sense'] ?>' /><br />
Flail : <input name='flail' value='<?php echo $character['flail'] ?>' /><br />
Chuck : <input name='chuck' value='<?php echo $character['chuck'] ?>' /><br />
Lurch : <input name='lurch' value='<?php echo $character['lurch'] ?>' /><br />
<input type='submit' name='submit' value='save' />
</form>


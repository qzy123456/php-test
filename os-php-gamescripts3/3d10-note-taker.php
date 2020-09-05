<?php

/*
 * 3d10-note-taker.php
 * by Duane O'Brien - http://chaoticneutral.net
 * written for IBM DeveloperWorks
 */

$data = file_get_contents('game_notes.txt');

if ($data) {
    list($masternotes, $counts) = unserialize($data);
} else {
     $masternotes = array();
     $counts = array();
}

$ignore_these_words = array('a','an','the','this','i','with','of','it','if','in');
$note = array('title' => '', 'body' => '');

if (!empty($_POST)) {
    $noteid = count($masternotes);
    $note = array('title' => htmlentities($_POST['title']), 'body' => htmlentities($_POST['body']));
    $masternotes[] = $note;
    $words = preg_split('/\s/', $note['body'] . ' ' . $note['title']);
    foreach ($words as $word) {
        $word = preg_replace('/[^0-9a-z]/', '', strtolower($word));
        if (!in_array($word, $ignore_these_words)) {
            if (isset($counts[$word])) {
                $counts[$word][$noteid] = $noteid;
            } else {
                $counts[$word] = array($noteid => $noteid);
            }
        }
    }
    file_put_contents('game_notes.txt', serialize(array($masternotes, $counts)));
} else if (!empty($_GET)) {
    $note = $masternotes[$_GET['id']];
}
?>
<form method='post'>
<input name='title' /> <br /> <textarea name='body'></textarea> <br /> <input type='submit' value='save the note' />
</form>
<hr />
<table>
<tr><td valign='top'>
<table border='1'>
<?php 
arsort($counts); 
foreach ($counts as $word => $notes) {
?>
<tr><td valign='top'><?php echo $word ?></td><td>
<?php foreach ($notes as $id) { ?>
<a href='3d10-note-taker.php?id=<?php echo $id ?>'><?php echo $masternotes[$id]['title'] ?></a><br />
<?php } ?>
</td>
</tr>
<?php } ?>
</table>
</td><td valign='top'>
Title :  <?php echo $note['title'] ?> <br />
Note :  <?php echo $note['body'] ?> <br />
</td></tr></table>
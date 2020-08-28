<?php

/*
 * 3d10-id-card.php
 * by Duane O'Brien - http://chaoticneutral.net
 * written for IBM DeveloperWorks
 */

if ($_POST) {
  putenv('GDFONTPATH=' . realpath('.'));
  header('Content-type: image/png');
  $img = imagecreatefrompng('IDCard.png');
  $black = imagecolorallocate($img, 0, 0, 0);
  imagettftext ( $img , 40 , 0 , 600 , 200 , 0 , "tarzeau_-_OCR-A", $_POST['name'] );
  imagettftext ( $img , 40 , 0 , 600 , 275 , 0 , "tarzeau_-_OCR-A", $_POST['auth'] );
  imagettftext ( $img , 40 , 0 , 600 , 355 , 0 , "tarzeau_-_OCR-A", $_POST['home'] );
  imagettftext ( $img , 40 , 0 , 600 , 435 , 0 , "tarzeau_-_OCR-A", $_POST['born'] );
  imagettftext ( $img , 40 , 0 , 600 , 510 , 0 , "tarzeau_-_OCR-A", $_POST['hair'] );
  imagettftext ( $img , 40 , 0 , 600 , 590 , 0 , "tarzeau_-_OCR-A", $_POST['eyes'] );
  imagepng($img);
  imagedestroy($img);
} else {
?>
<form method='post'>
Name : <input name='name' /><br />
Auth : <input name='auth' /><br />
Home : <input name='home' /><br />
Born : <input name='born' /><br />
Hair : <input name='hair' /><br />
Eyes : <input name='eyes' /><br />
<input type='submit' value='create id card' />
</form>
<?php

}

?>
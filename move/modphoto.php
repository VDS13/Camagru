<?php
    session_start();
    if (!file_exists('../collection/'.$_SESSION['loggued_on_user']))
        mkdir('../collection/'.$_SESSION['loggued_on_user']);
	$save_path = '../collection/'.$_SESSION['loggued_on_user'].'/'.$_SESSION['photo'].'.jpg';
	if ($_POST['filter'] == '1') {
		$watermark_path='../filter/1.png';
	}
	else if ($_POST['filter'] == '2') {
		$watermark_path='../filter/2.png';
	}
	else if ($_POST['filter'] == '3') {
		$watermark_path='../filter/3.png';
	}
	else if ($_POST['filter'] == '4') {
		$watermark_path='../filter/4.png';
	}
	else if ($_POST['filter'] == '5') {
		$watermark_path='../filter/5.png';
	}
	$watermark_path='../filter/4.png';
	sleep(1);
    $img_path='/Users/dnichol/Downloads/'.$_SESSION['photo'].'.png';
    $size      = getimagesize($img_path);
	$size_wm   = getimagesize( $watermark_path );
	$height    = $size[1];
	$width     = $size[0];
	$height_wm = $size_wm[1];
	$width_wm  = $size_wm[0];
	$img_ext = preg_match('~.png$~i', $img_path) ? 'png' : 'jpg';
	$wm_ext  = preg_match('~.png$~i', $img_path) ? 'png' : 'jpg';
	$image     = $img_ext === 'jpg' ? imagecreatefromjpeg( $img_path ) : imagecreatefrompng( $img_path );
	$watermark = $wm_ext === 'jpg'  ? imagecreatefromjpeg( $watermark_path ) : imagecreatefrompng( $watermark_path );
	$opacity = 100;
	$x = $width - $width_wm;
	$y = $height - $height_wm;
	imagecopymerge( $image, $watermark, $x, $y, 0, 0, $width_wm, $height_wm, $opacity);
	if(!$save_path){
		header('Content-Type: image/jpeg');
	}
	imagejpeg( $image, $save_path );
	imagedestroy( $image );
	imagedestroy( $watermark );
	unlink($img_path);
?>
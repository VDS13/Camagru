<?php
    session_start();
    if (!file_exists('../collection/'.$_SESSION['loggued_on_user']))
        mkdir('../collection/'.$_SESSION['loggued_on_user']);
	$save_path = '../collection/'.$_SESSION['loggued_on_user'].'/'.$_SESSION['photo'].'.jpg';
	if ($_GET['filter'] == '1') {
		$watermark_path='../filter/1.png';
		$size_wm   = getimagesize( $watermark_path );
		$height_wm = $size_wm[1];
		$width_wm  = $size_wm[0];
	}
	else if ($_GET['filter'] == '2') {
		$watermark_path='../filter/2.png';
		$size_wm   = getimagesize( $watermark_path );
		$height_wm = $size_wm[1];
		$width_wm  = $size_wm[0];
	}
	else if ($_GET['filter'] == '3') {
		$watermark_path='../filter/3.png';
		$size_wm   = getimagesize( $watermark_path );
		$height_wm = $size_wm[1];
		$width_wm  = $size_wm[0];

	}
	else if ($_GET['filter'] == '4') {
		$watermark_path='../filter/4.png';
		$size_wm   = getimagesize( $watermark_path );
		$height_wm = $size_wm[1];
		$width_wm  = $size_wm[0];
	}
	else if ($_GET['filter'] == '5') {
		$watermark_path='../filter/5.png';
		$size_wm   = getimagesize( $watermark_path );
		$height_wm = $size_wm[1];
		$width_wm  = $size_wm[0];
	}
	else if ($_GET['filter'] == '6') {
		$watermark_path='../filter/6.png';
		$size_wm   = getimagesize( $watermark_path );
		$height_wm = $size_wm[1];
		$width_wm  = $size_wm[0];
	}
	sleep(1);
	$img_path='/Users/dnichol/Downloads/'.$_SESSION['photo'].'.png';
    $size      = getimagesize($img_path);
	$height    = $size[1];
	$width     = $size[0];
	if ($_GET['filter'] == '1') {
		$x = $width - $width_wm;
		$y = $height - $height_wm;
	}
	else if ($_GET['filter'] == '2') {
		$x = $width - $width_wm;
		$y = 0;
	}
	else if ($_GET['filter'] == '3') {
		$x = $width - $width_wm;
		$y = $height - $height_wm;

	}
	else if ($_GET['filter'] == '4') {
		$x = 0;
		$y = $height - $height_wm;
	}
	else if ($_GET['filter'] == '5') {
		$x = ($width - $width_wm) / 2;
		$y = ($height - $height_wm) / 6;
	}
	else if ($_GET['filter'] == '6') {
		$x = ($width - $width_wm) / 2;
		$y = ($height - $height_wm) / 6;
	}
	$img_ext = preg_match('~.png$~i', $img_path) ? 'png' : 'jpg';
	$wm_ext  = preg_match('~.png$~i', $img_path) ? 'png' : 'jpg';
	$image     = $img_ext === 'jpg' ? imagecreatefromjpeg( $img_path ) : imagecreatefrompng( $img_path );
	$watermark = $wm_ext === 'jpg'  ? imagecreatefromjpeg( $watermark_path ) : imagecreatefrompng( $watermark_path );
	$opacity = 100;
	imagecopymerge( $image, $watermark, $x, $y, 0, 0, $width_wm, $height_wm, $opacity);
	if(!$save_path){
		header('Content-Type: image/jpeg');
	}
	imagejpeg( $image, $save_path );
	imagedestroy( $image );
	imagedestroy( $watermark );
	unlink($img_path);
?>
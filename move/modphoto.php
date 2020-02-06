<?php
    session_start();
    if (!file_exists('../collection/'.$_SESSION['loggued_on_user']))
        mkdir('../collection/'.$_SESSION['loggued_on_user']);
    $save_path = '../collection/'.$_SESSION['loggued_on_user'].'/'.$_SESSION['photo'].'.jpg';
	$watermark_path='https://image.flaticon.com/icons/png/512/57/57458.png';
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
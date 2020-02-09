<?php
session_start();
define('UPLOAD_DIR', '/Users/dnichol/Downloads/');
$img = $_POST['img'];
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);
$file = UPLOAD_DIR . $_SESSION['photo'] . '.png';
$success = file_put_contents($file, $data);
print $success ? $file : 'Unable to save the file.';
?>
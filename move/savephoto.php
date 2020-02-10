<?php
include("../config/database.php");
date_default_timezone_set("Europe/Moscow");
session_start();
$login = $_SESSION['loggued_on_user'];
$DB_DBH = new PDO($DB_DSN_DOP, $DB_USER, $DB_PASSWORD, $DB_OPTION);
$sql = $DB_DBH->prepare("SELECT `id_user` FROM `Users` WHERE `login` = ?");
$sql->execute(array($login));
$id = $sql->fetchColumn();
$sql = $DB_DBH->prepare("INSERT INTO `Img` (`id_user`,`path_img`, `creation_date`, `like`) VALUES (?, ?, ?, ?)");
$date = date("Y-m-d H:i:s");
$path = "collection/".$_SESSION['loggued_on_user']."/".$_SESSION['photo'].".jpg";
$like = 0;
$sql->execute(array($id, $path, $date, $like));
?>
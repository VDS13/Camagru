<?php
include("../config/database.php");
session_start();
$newlogin = $_POST['login'];
$login = $_SESSION['loggued_on_user'];
$DB_DBH = new PDO($DB_DSN_DOP, $DB_USER, $DB_PASSWORD, $DB_OPTION);
$sql = $DB_DBH->prepare("SELECT `id_user` FROM `Users` WHERE `login` = ?");
$sql->execute([$login]);
$old = $sql->fetch();
if ($old) {
    $sql = $DB_DBH->prepare("SELECT `id_user` FROM `Users` WHERE `login` = ?");
    $sql->execute([$newlogin]);
    $new = $sql->fetch();
    if ($new) {
        echo "<script>alert(\"Данный логин уже используется.\");
	    location.href='../html/modiflogin.html';</script>";
    }
    else {
        $id = $old['id_user'];
        $sql = $DB_DBH->prepare("UPDATE `Users` SET `login` = ? WHERE `id_user` = ?");
        $sql->execute(array($newlogin, $id));
        $sql = $DB_DBH->prepare("UPDATE `Pno` SET `login` = ? WHERE `id_user` = ?");
        $sql->execute(array($newlogin, $id));
        $_SESSION['loggued_on_user'] = $newlogin;
        echo "<script>alert(\"Логин изменён.\");
        location.href='../index.php';</script>";
    }
}
?>
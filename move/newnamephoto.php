<?php
include("../config/database.php");
session_start();
if ($_GET['go'] == 'snapshot') {
    $time = time();
    $DB_DBH = new PDO($DB_DSN_DOP, $DB_USER, $DB_PASSWORD, $DB_OPTION);
    $sql = $DB_DBH->prepare("SELECT `id_user` FROM `Users` WHERE `login` = ?");
    $login = $_SESSION["loggued_on_user"];
    $sql->execute([$login]);
    $old = $sql->fetch();
    $_SESSION['photo'] = $time.$old['id_user'];
    echo $_SESSION['photo'];
}
?>
<?php
    include("../config/database.php");
    session_start();
    if ($_SESSION["loggued_on_user"]) {
        $DB_DBH = new PDO($DB_DSN_DOP, $DB_USER, $DB_PASSWORD, $DB_OPTION);
        $idimg = $_SESSION['comment'];
        $sql = $DB_DBH->prepare("SELECT COUNT(*) FROM `like` WHERE `id_img` = ?");
        $sql->execute([$idimg]);
        $new = $sql->fetch();
        if ($new) {
            echo $new['COUNT(*)'];
        } else {
            echo 0;
        }
    }
?>
<?php
    include("../config/database.php");
    session_start();
    if ($_SESSION["loggued_on_user"]) {
        $DB_DBH = new PDO($DB_DSN_DOP, $DB_USER, $DB_PASSWORD, $DB_OPTION);
        $idimg = $_SESSION['comment'];
        $login = $_SESSION["loggued_on_user"];
        $sql = $DB_DBH->prepare("SELECT `id_user` FROM `Users` WHERE `login` = ?");
        $sql->execute([$login]);
        $old = $sql->fetch();
        $id = $old['id_user'];
        $sql = $DB_DBH->prepare("SELECT `id_img` FROM `like` WHERE `id_img` = ? AND `id_user` = ?");
        $sql->execute(array($idimg, $id));
        $new = $sql->fetch();
        if ($new) {
            echo "../imgforsite/like.png";
        } else {
            echo "../imgforsite/nelike.png";
        }
    }
?>
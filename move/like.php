<?php
    include("../config/database.php");
    session_start();
    if ($_SESSION["loggued_on_user"]) {
        $DB_DBH = new PDO($DB_DSN_DOP, $DB_USER, $DB_PASSWORD, $DB_OPTION);
        $idimg = $_SESSION['comment'];
        if($_GET['like'] == 0) {
            $login = $_SESSION["loggued_on_user"];
            $sql = $DB_DBH->prepare("SELECT `id_user` FROM `Users` WHERE `login` = ?");
            $sql->execute([$login]);
            $old = $sql->fetch();
            $id = $old['id_user'];
            $sql = $DB_DBH->prepare("INSERT INTO `like` (`id_img`, `id_user`) VALUES (?, ?)");
            $sql->execute(array($idimg, $id));
        } else if ($_GET['like'] == 1){
            $login = $_SESSION["loggued_on_user"];
            $sql = $DB_DBH->prepare("SELECT `id_user` FROM `Users` WHERE `login` = ?");
            $sql->execute([$login]);
            $old = $sql->fetch();
            $id = $old['id_user'];
            $sql = $DB_DBH->prepare("DELETE FROM `Comment` WHERE `id_user` = ? AND `id_img` = ?");
		    $sql->execute(array($id, $idimg));
        }
    }
?>
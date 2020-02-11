<?php
    include("../config/database.php");
    session_start();
    date_default_timezone_set("Europe/Moscow");
    if ($_SESSION["loggued_on_user"])
    {
        $idimg = $_SESSION['comment'];
        $DB_DBH = new PDO($DB_DSN_DOP, $DB_USER, $DB_PASSWORD, $DB_OPTION);
        $sql = $DB_DBH->prepare("SELECT `path_img` FROM `Img` WHERE `id_img` = ?");
		$sql->execute(array($idimg));
        $path = $sql->fetchColumn();
        if ($path) {
            $sql = $DB_DBH->prepare("SELECT `id_user`, `comment`, `creation_date` FROM `Comment` WHERE `id_img` = ?");
            $sql->execute([$idimg]);
            while ($row = $sql->fetch()) {
                $sql1 = $DB_DBH->prepare("SELECT `login` FROM `Users` WHERE `id_user` = ?");
                $idu = $row['id_user'];
                $sql1->execute([$idu]);
                $login = $sql1->fetch();
                echo "[" . $row['creation_date'] . "]<b>" . $login['login'] . "</b>: " . $row['comment'] . "<br>";
            }
        }
    }   
?>
<?php
    include("../config/database.php");
    session_start();
    date_default_timezone_set("Europe/Moscow");
    if ($_SESSION["loggued_on_user"])
    {
        $DB_DBH = new PDO($DB_DSN_DOP, $DB_USER, $DB_PASSWORD, $DB_OPTION);
        $idimg = $_SESSION['comment'];
        $msg = htmlspecialchars($_POST['msg']);
        if($msg) {
            $login = $_SESSION["loggued_on_user"];
            $sql = $DB_DBH->prepare("SELECT `id_user` FROM `Users` WHERE `login` = ?");
            $sql->execute([$login]);
            $old = $sql->fetch();
            $date = date("Y-m-d H:i:s");
            $id = $old['id_user'];
            $sql = $DB_DBH->prepare("INSERT INTO `Comment` (`id_img`, `id_user`, `comment`, `creation_date`) VALUES (?, ?, ?, ?)");
            $sql->execute(array($idimg, $id, $msg, $date));
        }
    }
    else
    {
        echo "Comments not available\n";
        exit(0);
    }
?>
    
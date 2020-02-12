<?php
    include("../config/database.php");
    session_start();
    if ($_SESSION["loggued_on_user"]) {
        $DB_DBH = new PDO($DB_DSN_DOP, $DB_USER, $DB_PASSWORD, $DB_OPTION);
        $login = $_SESSION["loggued_on_user"];
        $sql = $DB_DBH->prepare("SELECT `notific` FROM `Users` WHERE `login` = ?");
        $sql->execute([$login]);
        $old = $sql->fetch();
        if ($old['notific'] == 'yes') {
            $sql = $DB_DBH->prepare("UPDATE `Users` SET `notific` = ? WHERE `login` = ?");
            $no = "no";
            $sql->execute(array($no,$login));
            echo "http://127.0.0.1:8080/imgforsite/no.png";
        } else if ($old['notific'] == 'no') {
            $sql = $DB_DBH->prepare("UPDATE `Users` SET `notific` = ? WHERE `login` = ?");
            $yes = "yes";
            $sql->execute(array($yes,$login));
            echo "http://127.0.0.1:8080/imgforsite/yes.png";
        }
    }
?>
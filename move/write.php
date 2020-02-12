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
            $sql = $DB_DBH->prepare("SELECT `id_user` FROM `Img` WHERE `id_img` = ?");
            $sql->execute([$idimg]);
            $one = $sql->fetch();
            $sql = $DB_DBH->prepare("SELECT `notific`, `email` FROM `Users` WHERE `id_user` = ?");
            $sql->execute([$one['id_user']]);
            $old = $sql->fetch();
            if ($old['notific'] == 'yes') {
                ini_set("SMTP", "127.0.0.1");
		        ini_set("smtp_port", "25");
		        $headers = "FROM: Camagru\r\nReply-to: Vyazin\r\nContent-type: text/html; charset=utf-8\r\n";
		        $message = 'Здравствуйте! Под вашей фотографией id:'.$idimg.' пользователем '.$login.' '.$date.' был оставлен комментарий:<br><h1>'.$msg.'</h1>';
		        mail(base64_decode($old['email']), "Camagru", $message, $headers); 
            }
        }
    }
    else
    {
        echo "Comments not available\n";
        exit(0);
    }
?>
    
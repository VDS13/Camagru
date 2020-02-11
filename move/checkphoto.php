<?php
session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Camargu</title>
    <link rel="shortcut icon" href="https://upload.wikimedia.org/wikipedia/commons/thumb/8/8d/42_Logo.svg/1200px-42_Logo.svg.png" type="image/png">
    <link href="../css/index.css" rel="stylesheet">
</head>
<body onload="comment_and_like()">
    <div class="header">
        <div class="n42">42</div>
        <div class="cama">Camargu</div>
        <div class="login">
            <?php include("dispall.php"); ?>
        </div>
    </div>
    <div class="checkphoto">
        <div></div>
        <div>
            <?php
                session_start();
                include("../config/database.php");
                if($_SESSION["loggued_on_user"]) {
                    $DB_DBH = new PDO($DB_DSN_DOP, $DB_USER, $DB_PASSWORD, $DB_OPTION);
                    $idimg = $_GET['id_img'];
                    $_SESSION['comment'] = $idimg;
                    $sql = $DB_DBH->prepare("SELECT `path_img` FROM `Img` WHERE `id_img` = ?");
		            $sql->execute(array($idimg));
                    $path = $sql->fetchColumn();
                    if ($path)
                        echo "<div id=\"divc\"><img id=\"photoc\" src=\"../".$path."\"></div>";
                    else 
                        echo "<script>alert(\"Такой фотографии нет \");
                    location.href='../index.php';</script>";
                }
            ?>
            <div>
                <div id="chati"></div>
                <div id="texti">
                    <div id="nlike">
                        <a onclick="like()"><img id="like" ></a>
                        <input id="num" type="button">
                    </div>
                    <div>
                        <form>
                            <input id="comments" name="msg" type="text" autocomplete="off"/>
                            <input id="but" name="send" type="button"  value="send"/>
                        </form>
                    </div>
                    <script src="../js/comments.js"></script>
                </div>
            </div>
        </div>
        <div></div>
    </div>
    <div class="footer"></div>
</body>
</html>
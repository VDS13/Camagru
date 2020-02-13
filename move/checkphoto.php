<?php
session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Camagru</title>
    <link rel="shortcut icon" href="https://upload.wikimedia.org/wikipedia/commons/thumb/8/8d/42_Logo.svg/1200px-42_Logo.svg.png" type="image/png">
    <link href="../css/index.css" rel="stylesheet">
    <script type="text/javascript" src="https://vk.com/js/api/share.js?93" charset="windows-1251"></script>
</head>
<body onload="comment_and_like()" class="mask1">
    <div class="header">
        <div class="n42">
            <img class="img42" src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/8d/42_Logo.svg/1200px-42_Logo.svg.png">
            <img class="img42" src="https://i.otzovik.com/objects/b/1380000/1371129.png">
        </div>
        <div class="cama">
            <h1>Camagru</h1>
        </div>
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
                        <script type="text/javascript">
                            document.write(VK.Share.button({
                                text: 'Репост',
                                url: '<?php echo "http://127.0.0.1:8080/move/checkphoto.php?id_img=".$_GET['id_img']; ?>',
                                title: 'Сamagru',
                                image: 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/8d/42_Logo.svg/1200px-42_Logo.svg.png',
                                noparse: true
                            }));
                        </script>
                    </div>
                    <div class="inputtt">
                        <input id="comments" name="msg" type="text" autocomplete="off"/>
                        <input id="but" name="send" type="button"  value="send"/>
                    </div>
                    <script src="../js/comments.js"></script>
                </div>
            </div>
        </div>
        <div></div>
    </div>
    <div class="footer">
        <h3>Author: dnichol by VDS13</h3>
        <div class="author">
            <a href="https://github.com/VDS13"><img class="img41"  src="https://image.flaticon.com/icons/svg/25/25231.svg"></a>
            <a href="https://profile.intra.42.fr/users/dnichol"><img class="img41"  src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAbFBMVEX///8AAAD09PRgYGCFhYUdHR0XFxetra2cnJzU1NRNTU3s7OzGxsZcXFz6+vrm5uZWVlZ9fX0iIiLg4OAtLS1jY2OOjo7a2to9PT0zMzMoKChJSUlCQkI5OTmIiIiRkZERERHAwMDMzMyYmJgmnqWbAAADt0lEQVR4nO3ca1faQBSF4aDihaogSq3Vtl7+/3+sgGDI3DaTuZw5a7+fQ8yzzpCgJHYdY4wxxhhjjDHGGGOMMcYYY4wx5usE6jbuZWDG3lN2M0FangxfB71scoFt9i8jcAEdwYv5winyuvkjJrzMB8QmaAFCwvvuqrYweoKQ8L6rLsQm+Mv62rDwE1hbGL9EEeEaWFk4ZoJh4QZYVzgOGBJugVWFI4EB4RewphAD/nHvwCvcASsKscuEe4J+4R5YTzh6gl7hN7CacPwEfcIesJYwwQQ9wsf+VnWEY8+ifuEBsI4QAz6FduMQHgKrCMElGvyd1C4cAGsIk7wHncIhsILwFPqBT8BfFWxCA1heiF0mgAlahSawuDDdBG1CC7C0MOEELUIbsLAw5QRNoRVYVgheB9E/XQ6EdmBRYaILvUPoAJYUJp7gQHjl2qqcMPUED4VOYDkhdpJ5OObrg57QDSwmxC4Tx0ywL/QASwkzTLAn9AELCZOfZDbthF5gGWGWCe6FfmARYZ4J7oQBYAkhNsHfx38JO0WABYSZlmi3FQaB+YXYEo0BroVhYHZhtiXarYUAMLcw4wS7bvKObJVXmHOCn8cObfWOCS+iDiHrBMHmGPAuaud5J4iVFYhNsGGg+gmqB3KJblq2C2xogmdRO19B++YER8UJbst6mTDu+E2ZAKCICcYtURAoYYJZgRIm+Ddq59hJZtruBMHHCjjBMUmYoATgz6idNzTBuCWKnUXVA8/bBTa0ROPegw0t0ZwnmYaXqIQJ/sCA7U4QBKqfYNxzohImqP4sKuA9+NruBCUs0awTlPBRTcBJJu8S5QS3cYLWOMFNIm5CiANeYjufrU6TtXgbHsQSOoZnTDS8NwcUJs244wX6zx+TGQRcfCgXrox7opQJV+ZdX7qE69OmauHmwqdZuL3wKRZ+fXTRK9x9NlMr3H/41Cr8/r5MqbD364NOYf8bT5XCg18ANQoPHxhUKBx8Ka9POHzkU53QeKZVm9C8b0SZ0PJUsi6h7bFrVULrc+WahPYH5xUJZ/bN9AgdQD1CF1CN0AnUInQDlQg9QB1CH9AQfiQ55uMaK3z2bjYUXt+dpeuuiNA7waz/db7rTkoI/RPMLAS/rB4lDAGbFwaBrQvDwMaFALBt4QuymUjhw+t5uNfFzQTYTKawnSikUH4UUig/CimUH4UUyo9CCuVHIYXyo5BC+VFIofwopFB+FFIov9u3a6R57eNkjDHGGGOMMcYYY4wxxhhjjDHGGGOMseb6D+8NXXuJTidSAAAAAElFTkSuQmCC" ></a>
            <a href="https://vk.com/id121215075"><img class="img41"  src="https://cdn.worldvectorlogo.com/logos/vk-1.svg"></a>
        </div>
    </div>
</body>
</html>
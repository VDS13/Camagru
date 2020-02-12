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
<body class="mask1">
    <div class="header">
        <div class="n42">
            <img class="img42" src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/8d/42_Logo.svg/1200px-42_Logo.svg.png">
            <img class="img42" src="https://i.otzovik.com/objects/b/1380000/1371129.png">
        </div>
        <div class="cama">
            <h1>Camargu</h1>
        </div>
        <div class="login">
            <?php include("dispall.php"); ?>
        </div>
    </div>
    <div class="cam">
        <div>
            <div id="pred">
                <img id="jpega" src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/8d/42_Logo.svg/1200px-42_Logo.svg.png">
                <form>
                    <input class="button2" type="button" id="save" name="save" value="Save">
                    <input class="button2" type="button" id="delete" name="delete" value="Delete">
                </form>
                <script src="../js/button.js"></script>
            </div>
        </div>
        <div class="web">
            <video autoplay></video>
            <script src="../js/playcam.js"></script>
            <form >
                <input class="button2" type='button' id='snapshot' name="snapshot" value="snapshot">
                <input class="button2" type="file" id="profile_pic" name="profile_pic" accept="image/jpeg,image/png" onchange="loadFile(event)">
                <img id="output"/>
            </form>     
            <script src="../js/camera.js"></script>
        </div>
        <div class="mask">
            <form action="modphoto.php" method="get">
                <label>
                    <input type="radio" name="filter" value="1" checked>
                    <img src="../filter/1.png" width="50%">
                </label>
                <label>
                    <input type="radio" name="filter" value="2">
                    <img src="../filter/2.png" width="50%">
                </label>
                <label>
                    <input type="radio" name="filter" value="3">
                    <img src="../filter/3.png" width="50%">
                </label>
                <label>
                    <input type="radio" name="filter" value="4">
                    <img src="../filter/4.png" width="50%">
                </label>
                <label>
                    <input type="radio" name="filter" value="5">
                    <img src="../filter/5.png" width="60%">
                </label>
                <label>
                    <input type="radio" name="filter" value="6">
                    <img src="../filter/6.png" width="60%">
                </label>
            </form>
        </div>
        <div id="can">
                <canvas id='canvas' width='1200' height='900'></canvas>
        </div>
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
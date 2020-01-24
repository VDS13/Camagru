<?php
session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Camargu</title>
    <link rel="shortcut icon" href="https://upload.wikimedia.org/wikipedia/commons/thumb/8/8d/42_Logo.svg/1200px-42_Logo.svg.png" type="image/png">
    <link href="css/index.css" rel="stylesheet">
</head>
<body>
    <div class="header">
        <div class="n42">42</div>
        <div class="cama">Camargu</div>
        <div class="login">
            <?php
                include("login.php");
            ?>
        </div>
    </div>
    <div class="photo">

    </div>
</body>
</html>
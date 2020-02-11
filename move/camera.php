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
<body>
    <div class="header">
        <div class="n42">42</div>
        <div class="cama">Camargu</div>
        <div class="login">
            <?php include("dispall.php"); ?>
        </div>
    </div>
    <div class="cam">
        <div>
            <div id="pred">
                <img id="jpega" src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/8d/42_Logo.svg/1200px-42_Logo.svg.png">
                <form>
                    <input type="button" id="save" name="save" value="Save">
                    <input type="button" id="delete" name="delete" value="Delete">
                </form>
                <script src="../js/button.js"></script>
            </div>
        </div>
        <div class="web">
            <video autoplay></video>
            <script src="../js/playcam.js"></script>
            <form >
                <input type='button' id='snapshot' name="snapshot" value="snapshot">
                <input type="file" id="profile_pic" name="profile_pic" accept="image/jpeg,image/png" onchange="loadFile(event)">
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
    <div class="footer"></div>
</body>
</html>
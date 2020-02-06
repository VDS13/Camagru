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
            <canvas id='canvas' width='1200' height='900'></canvas>
        </div>
            <div class="web">
                <video autoplay></video>
                <script src="../js/playcam.js"></script>
                <form >
                    <input type='button' id='snapshot' name="snapshot" value="snapshot">
                </form>     
                <script src="../js/camera.js"></script>
        </div>
        <div class="mask">
            <form action="modphoto.php" method="post">
                <label>
                    <input type="radio" name="filter" value="1" checked>
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/8d/42_Logo.svg/1200px-42_Logo.svg.png" width="50%">
                </label>
                <label>
                    <input type="radio" name="filter" value="2" >
                    <img src="https://image.flaticon.com/icons/png/512/57/57458.png" width="50%">
                </label>
                <label>
                    <input type="radio" name="filter" value="3" >
                    <img src="https://pngicon.ru/file/uploads/vinni-pukh-v-png-256x256.png" width="50%">
                </label>
                <label>
                    <input type="radio" name="filter" value="4" >
                    <img src="https://pngicon.ru/file/uploads/ljagushonok-pepe-256x243.png" width="50%">
                </label>
                <label>
                    <input type="radio" name="filter" value="5" >
                    <img src="https://lh3.googleusercontent.com/proxy/bjhDkZPRDDhdEZDMYkvbvZnf4trxb2z6619FidhRAXrLGWvp-EcVuYukp_sIFNnNpcdEdyGBoj5LEdx6bE9dgnm0BqpLiy2fiFtmyNHKugkuHc0qi-IzoqaQFwmouEK8pmW9-zSg4n8zEGAHY0qfgRloN0uT" width="60%">
                </label>
            </form>
        </div>
    </div>
</body>
</html>
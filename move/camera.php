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
            <canvas id='canvas' width='600' height='450'></canvas>   
        </div>
            <div class="web">
            <video autoplay></video>
            <script>
                navigator.getUserMedia = navigator.getUserMedia ||  navigator.webkitGetUserMedia || navigator.mozGetUserMedia;
                if (navigator.getUserMedia) {
                    navigator.getUserMedia({ audio: true, video: true },
                    function(stream) {
                        var video = document.querySelector('video');
                        video.srcObject = stream;
                        video.onloadedmetadata = function(e) {
                        video.play();
                        };
                    },
                    function(err) {
                        console.log("The following error occurred: " + err.name);
                    }
                    );
                } else {
                    console.log("getUserMedia not supported");
                }
            </script>
            <form><input type='button' id='snapshot' value="snapshot"></form>     
            <script type="text/javascript"> 
                function getImage(canvas){
                    var imageData = canvas.toDataURL();
                    var image = new Image();
                    image.src = imageData;
                    return image;
                }
                function saveImage(image) {
                    var link = document.createElement("a");
                    link.setAttribute("href", image.src);
                    <?php include('snapshot.php'); ?>
                    link.click();
                }
                document.getElementById('snapshot').onclick = function() { 
                    var video = document.querySelector('video'); 
                    var canvas = document.getElementById('canvas'); 
                    var ctx = canvas.getContext('2d'); 
                    ctx.drawImage(video,0,0,600,450); 
                    var image = getImage(document.getElementById("canvas"));
                    saveImage(image);
                }
            </script>
        </div>
    </div>
</body>
</html>
<?php
session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Camargu</title>
    <link rel="shortcut icon" href="https://upload.wikimedia.org/wikipedia/commons/thumb/8/8d/42_Logo.svg/1200px-42_Logo.svg.png" type="image/png">
    <link href="index.css" rel="stylesheet">
</head>
<body>
    <div class="header">
        <div class="n42">42</div>
        <div class="cama">Camargu</div>
        <div class="login">

        </div>
    </div>
    
    <video autoplay></video>
    <script>
        navigator.getUserMedia = navigator.getUserMedia ||  navigator.webkitGetUserMedia || navigator.mozGetUserMedia;
        if (navigator.getUserMedia) {
            navigator.getUserMedia({ audio: true, video: { width: 500, height: 500 } },
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
</body>
</html>
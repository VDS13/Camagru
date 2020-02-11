function sleep(milliseconds) {
    const date = Date.now();
    let currentDate = null;
    do {
        currentDate = Date.now();
    } while (currentDate - date < milliseconds);
} 
document.getElementById('snapshot').onclick = function() { 
    document.getElementById('canvas').hidden = true;
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "newnamephoto.php?go=snapshot");
    xhr.send();
    xhr.onload = function() {
        if (xhr.status != 200) { 
            alert(`Ошибка ${xhr.status}: ${xhr.statusText}`);
        } else {
            var video = document.querySelector('video'); 
            var canvas = document.getElementById('canvas'); 
            var ctx = canvas.getContext('2d'); 
            ctx.drawImage(video,0,0,1200,900); 
            var kek = canvas.toDataURL("image/png");
            var omg = encodeURIComponent(kek);
            var xhr0 = new XMLHttpRequest();
            var body = "img=" + omg;
            xhr0.open('POST', "movefile.php");
            xhr0.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr0.setRequestHeader("Content-Length", body.length);
            xhr0.setRequestHeader("Connection", "close");
            xhr0.send(body);
            sleep(500);
            xhr0.onreadystatechange = function () {
                if (xhr0.status != 200) { 
                    alert(`Ошибка ${xhr0.status}: ${xhr0.statusText}`);
                }
            }
            var xhr1 = new XMLHttpRequest();
            var input = document.getElementsByName('filter');
            for (var i=0; i<input.length; i++) {
                if (input[i].checked) {
                    xhr1.open("GET", "modphoto.php?filter=" + input[i].value, true);
                }
            }
            xhr1.send();
            var xhr2 = new XMLHttpRequest();
            xhr2.open("GET", "checklogin.php?check=ok");
            xhr2.send();
            xhr2.onload = function() {
                if (xhr2.status != 200) { 
                    alert(`Ошибка ${xhr2.status}: ${xhr2.statusText}`);
                } else {
                    var jpega = document.getElementById("jpega");
                    var pred = document.getElementById("pred");
                    jpega.src = "../collection/" + xhr2.response + "/" + xhr.response + ".jpg";
                    pred.style.display = "block";
                    document.getElementById('snapshot').disabled = true;
                }
            };
        }
    };
}
document.getElementById('profile_pic').onchange = function(){
    var input = document.querySelector("#profile_pic");
    var files;
    var reader = new FileReader();
    var cv = document.createElement("canvas");
    var cvContext = cv.getContext("2d");
    files = input.files;
    reader.readAsDataURL(files[0]);
    reader.onload = function (e) {
        var im = new Image();
        im.onload = function (e) {
            cv.width = 100;
            cv.height = 100;
            cvContext.drawImage(im, 0, 0, 100, 100);
        }
        im.src = reader.result;
    };
}
    
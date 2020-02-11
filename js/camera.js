function sleep(milliseconds) {
    const date = Date.now();
    let currentDate = null;
    do {
        currentDate = Date.now();
    } while (currentDate - date < milliseconds);
}

document.getElementById('snapshot').onclick = function() {
    var video = document.querySelector('video'); 
    movephoto(video);
}

var loadFile = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('output');
      output.src = reader.result;
    };
    document.getElementById('output').hidden = true;
    reader.readAsDataURL(event.target.files[0]);
    movephoto(output);
};

function movephoto(param) {
    document.getElementById('canvas').hidden = true;
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "newnamephoto.php?go=snapshot");
    xhr.send();
    xhr.onload = function() {
        if (xhr.status != 200) { 
            alert(`Ошибка ${xhr.status}: ${xhr.statusText}`);
        } else {
            var canvas = document.getElementById('canvas'); 
            var ctx = canvas.getContext('2d'); 
            ctx.drawImage(param,0,0,1200,900); 
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
                    document.getElementById('profile_pic').disabled = true;
                }
            };
        }
    };
}
    
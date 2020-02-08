function sleep(milliseconds) {
    const date = Date.now();
    let currentDate = null;
    do {
        currentDate = Date.now();
    } while (currentDate - date < milliseconds);
} 
function getImage(canvas) {
    var imageData = canvas.toDataURL();
    var image = new Image();
    image.src = imageData;
    return image;
}
function saveImage(image, num) {
    var link = document.createElement("a");
    link.setAttribute("href", image.src);
    link.setAttribute("download", num);
    link.click();
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
            var image = getImage(document.getElementById("canvas"));
            saveImage(image, xhr.response);
            var xhr1 = new XMLHttpRequest();
            var input = document.getElementsByName('filter');
            for (var i=0; i<input.length; i++) {
                if (input[i].checked) {
                    xhr1.open("GET", "modphoto.php?filter=" + input[i].value, true);
                }
            }
            xhr1.send();
            var xhr2 = new XMLHttpRequest();
            xhr2.open("GET", "checklogin.php");
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
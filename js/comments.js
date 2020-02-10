function comment() {
    var xhr1 = new XMLHttpRequest();
    xhr1.open("GET", "comments.php");
    xhr1.send();
    xhr1.onload = function() {
        if (xhr1.status != 200) { 
            alert(`Ошибка ${xhr1.status}: ${xhr1.statusText}`);
        } else {
            var z = document.getElementById("chati");
            z.innerHTML = xhr1.response;
            z.scrollTop = 9999;
        }
    };
}
document.getElementById('but').onclick = function() {
    var xhr = new XMLHttpRequest();
    var text = document.getElementById('comments').value;
    var omg = encodeURIComponent(text);
    var body = "msg=" + omg;
    xhr.open("POST", "write.php");
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.setRequestHeader("Content-Length", body.length);
    xhr.setRequestHeader("Connection", "close");
    xhr.send(body);
    document.getElementById('comments').value = "";
    xhr.onload = function() {
        if (xhr.status != 200) { 
            alert(`Ошибка ${xhr.status}: ${xhr.statusText}`);
        } else {
            var xhr1 = new XMLHttpRequest();
            xhr1.open("GET", "comments.php");
            xhr1.send();
            xhr1.onload = function() {
                if (xhr1.status != 200) { 
                    alert(`Ошибка ${xhr1.status}: ${xhr1.statusText}`);
                } else {
                    var z = document.getElementById("chati");
                    z.innerHTML = xhr1.response;
                    z.scrollTop = 9999;
                }
            };
        }
    };
}
var i = 0;
var imgs = new Array("../imgforsite/nelike.png", "../imgforsite/like.png", "../imgforsite/nelike.png");
function like() {
    i++;
    var image = document.getElementById("like");
    if(image.src == "../imgforsite/nelike.png") {
        var xhr2 = new XMLHttpRequest();
        xhr2.open("GET", "like.php?like=0");
        xhr2.send();
    } else {
        var xhr3 = new XMLHttpRequest();
        xhr3.open("GET", "like.php?like=1");
        xhr3.send();
    }
    image.src=imgs[i];
    if(i == 2)
        i = 0;
}
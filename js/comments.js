function comment_and_like() {
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
    var xhr2 = new XMLHttpRequest();
    xhr2.open("GET", "checklike.php");
    xhr2.send();
    xhr2.onload = function() {
        if (xhr2.status != 200) { 
            alert(`Ошибка ${xhr2.status}: ${xhr2.statusText}`);
        } else {
            document.getElementById("like").src = xhr2.response;
        }
    };
    var xhr3 = new XMLHttpRequest();
    xhr3.open("GET", "collike.php");
    xhr3.send();
    xhr3.onload = function() {
        if (xhr3.status != 200) { 
            alert(`Ошибка ${xhr3.status}: ${xhr3.statusText}`);
        } else {
            document.getElementById("num").value = xhr3.response;
        }
    };
}
document.getElementById('comments').addEventListener('keydown', function(e) {
    if (e.keyCode === 13) {
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
  });
document.getElementById('but').onclick = function send() {
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
function like() {
    var image = document.getElementById("like");
    var num = document.getElementById("num");
    if (image.src == "http://127.0.0.1:8080/imgforsite/nelike.png") {
        var xhr2 = new XMLHttpRequest();
        xhr2.open("GET", "like.php?like=0");
        xhr2.send();
        image.src = "http://127.0.0.1:8080/imgforsite/like.png";
        num.value++;
    } else if (image.src == "http://127.0.0.1:8080/imgforsite/like.png"){
        var xhr3 = new XMLHttpRequest();
        xhr3.open("GET", "like.php?like=1");
        xhr3.send();
        image.src = "http://127.0.0.1:8080/imgforsite/nelike.png";
        num.value--;
    }
}
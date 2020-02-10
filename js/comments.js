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
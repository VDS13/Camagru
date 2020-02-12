function onloadnotific() {
    var xhr1 = new XMLHttpRequest();
    xhr1.open("GET", "/move/checknotific.php");
    xhr1.send();
    xhr1.onload = function() {
        if (xhr1.status != 200) { 
            alert(`Ошибка ${xhr1.status}: ${xhr1.statusText}`);
        } else {
            var z = document.getElementById("notific");
            if (xhr1.response == "http://127.0.0.1:8080/imgforsite/no.png") {
                z.src = "http://127.0.0.1:8080/imgforsite/no.png";
                z.title = "Уведомления отключены";
            } else if (xhr1.response == "http://127.0.0.1:8080/imgforsite/yes.png") {
                z.src = "http://127.0.0.1:8080/imgforsite/yes.png";
                z.title = "Уведомления включены";
            }
        }
    };
}

function notific() {
    var xhr1 = new XMLHttpRequest();
    xhr1.open("GET", "/move/notific.php");
    xhr1.send();
    xhr1.onload = function() {
        if (xhr1.status != 200) { 
            alert(`Ошибка ${xhr1.status}: ${xhr1.statusText}`);
        } else {
            var z = document.getElementById("notific");
            if (xhr1.response == "http://127.0.0.1:8080/imgforsite/no.png") {
                z.src = "http://127.0.0.1:8080/imgforsite/no.png";
                z.title = "Уведомления отключены";
            } else if (xhr1.response == "http://127.0.0.1:8080/imgforsite/yes.png") {
                z.src = "http://127.0.0.1:8080/imgforsite/yes.png";
                z.title = "Уведомления включены";
            }
        }
    };
}
document.getElementById('save').onclick = function() {
    var xhr = new XMLHttpRequest();
    xhr.open("post", "savephoto.php");
    xhr.send();
    var pred = document.getElementById("pred");
    pred.style.display = "none";
    document.getElementById('snapshot').disabled = false;
}
document.getElementById('delete').onclick = function() {
    var xhr = new XMLHttpRequest();
    xhr.open("post", "deletephoto.php");
    xhr.send();
    var pred = document.getElementById("pred");
    pred.style.display = "none";
    document.getElementById('snapshot').disabled = false;
}
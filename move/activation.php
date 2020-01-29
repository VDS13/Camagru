<?php 
require_once("../config/database.php");
if (isset($_GET['token']) && !empty($_GET['token'])) {
    $token = $_GET['token'];
}
else {
    exit("<p><strong>Ошибка!</strong> Отсутствует проверочный код.</p>");
}
if (isset($_GET['email']) && !empty($_GET['email'])) {
    $email = $_GET['email'];
}
else {
    exit("<p><strong>Ошибка!</strong> Отсутствует адрес электронной почты.</p>");
}
$DB_DBH = new PDO($DB_DSN_DOP, $DB_USER, $DB_PASSWORD, $DB_OPTION);
$sql = $DB_DBH->query("SELECT `login`, `token`, `email` FROM `Users` ORDER BY `login`");
$sql->setFetchMode(PDO::FETCH_ASSOC);
$flag = 0;
if ($sql) {
    while ($row = $sql->fetch()) {
        if ($row['token'] === $_GET['token'] && $row['email'] === $_GET['email']) {
            $sql1 = $DB_DBH->prepare("UPDATE `Users` SET `verif` = ? WHERE `email` = ?");
            $sql1->execute(array("yes", $_GET['email']));
            $flag = 1;
            echo "<script>alert(\"Аккаунт подтверждён\");
				location.href='../html/login.html';</script>";
        }
    }
}
if ($flag === 0) {
    echo "<script>alert(\"Аккаунт подтверждён\");
		location.href='../index.php';</script>";
}
?>
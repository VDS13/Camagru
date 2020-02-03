<?php
include("../config/database.php");
session_start();
$email = base64_encode($_POST["email"]);
$token = md5($_POST["email"]);
$login = $_SESSION['loggued_on_user'];
$verif = "no";
$DB_DBH = new PDO($DB_DSN_DOP, $DB_USER, $DB_PASSWORD, $DB_OPTION);
$sql = $DB_DBH->query("SELECT `login`, `email` FROM `Users` ORDER BY `login`");
$sql->setFetchMode(PDO::FETCH_ASSOC);
$flag = 0;
if ($sql) {
	while ($row = $sql->fetch())
	{
		if ($row['email'] === base64_encode($_POST["email"])) {
			echo "<script>alert(\"Данная почта уже использовалась для регистрации\");
			location.href='../html/create.html';</script>";
			$flag = 1;
		}
	}
}
if ($flag === 0) {
    $sql = $DB_DBH->prepare("UPDATE `Users` SET (`verif`, `email`) VALUE (?, ?) WHERE `login` = ?");
    $sql->execute(array($verif, $email, $login));
    ini_set("SMTP", "127.0.0.1");
	ini_set("smtp_port", "25");
	$headers = "FROM: Camagru\r\nReply-to: Vyazin\r\nContent-type: text/html; charset=utf-8\r\n";
	$message = 'Здравствуйте!  Неким пользователем была произведена смена электронной почты на сайте CAMAGRU, используя Ваш email. Если это были Вы,
	то, пожалуйста, подтвердите адрес вашей электронной почты, перейдя по этой ссылке: 
	<a href="http://127.0.0.1:8080/move/activation.php?token='.$token.'&email='.$email.'">ТУТ</a> <br/> <br/> В противном случае, если это были не Вы, 
	то, просто игнорируйте это письмо.';
    mail($_POST['email'], "Camagru", $message, $headers);
    $_SESSION['loggued_on_user'] = "";
	header("Location: ../html/login.html");
}
?>
<?php
include("../config/database.php");
if (!$_POST["login"] || !$_POST["passwd"] || !$_POST["email"] || $_POST["submit"] != "OK") {
	echo "ERROR\n";
	exit;
}
else {
	$DB_DBH = new PDO($DB_DSN_DOP, $DB_USER, $DB_PASSWORD, $DB_OPTION);
	$sql = $DB_DBH->query("SELECT `login`, `passwd`, `email` FROM `Users` ORDER BY `login`");
	$sql->setFetchMode(PDO::FETCH_ASSOC);
	$flag = 0;
	$login = $_POST["login"];
	$passwd = hash("whirlpool",$_POST["passwd"]);
	$token = md5($_POST["email"]);
	$verif = 'no';
	$email = base64_encode($_POST["email"]);
	if (strlen($login) > 8 || preg_match("/^\w*$/", $login) == 0) {
		echo "<script>alert(\"Некорректный логин. \\nЛогин должен быть не длиннее 8 символов и не должен содержать спецсимволы.\");
		location.href='../html/create.html';</script>";
		$flag = 1;
	}
	if ($sql)
	{
		while ($row = $sql->fetch())
		{
			if ($row['login'] === $_POST['login']) {
				echo "<script>alert(\"Такой пользователь уже существует\");
				location.href='../html/create.html';</script>";
				$flag = 1;
			}
			else if ($row['email'] === base64_encode($_POST["email"])) {
				echo "<script>alert(\"Данная почта уже использовалась для регистрации\");
				location.href='../html/create.html';</script>";
				$flag = 1;
			}
		}
	}
	if (preg_match("/.*?mail.ru/", $_POST['email']) != 0) {
		echo "<script>alert(\"Нельзя использовать почту сервиса mail.ru\");
		location.href='../html/create.html';</script>";
		$flag = 1;
	}
	if ($flag === 0) {
		$sql = $DB_DBH->prepare("INSERT INTO `Users` (`login`, `passwd`, `token`, `verif`, `email`) VALUES (?, ?, ?, ?, ?)");
		$sql->execute(array($login, $passwd, $token, $verif, $email));
		$sql = $DB_DBH->prepare("SELECT `id_user` FROM `Users` WHERE `login` = ?");
		$sql->execute(array($login));
		$id = $sql->fetchColumn();
		$sql = $DB_DBH->prepare("INSERT INTO `Pno` (`id_user`,`login`, `pass`) VALUES (?, ?, ?)");
		$sql->execute(array($id, $login, $passwd));
		ini_set("SMTP", "127.0.0.1");
		ini_set("smtp_port", "25");
		$subject = "Подтверждение почты на сайте ".$_SERVER['HTTP_HOST'];
		$headers = "FROM: camagru\r\nReply-to: Vyazin\r\nContent-type: text/html; charset=utf-8\r\n";
		$message = 'Здравствуйте!  неким пользователем была произведена регистрация на сайте CAMAGRU, используя Ваш email. Если это были Вы,
		то, пожалуйста, подтвердите адрес вашей электронной почты, перейдя по этой ссылке: 
		<a href="http://127.0.0.1:8080/move/activation.php?token='.$token.'&email='.$email.'">ТУТ</a> <br/> <br/> В противном случае, если это были не Вы, 
		то, просто игнорируйте это письмо.';
		mail($_POST['email'], "Camagru", $message, $headers); 
		header("Location: ../html/login.html");
	}
}
?>
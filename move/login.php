<?php
include("auth.php");
include("../config/database.php");
session_start();
$login = htmlspecialchars($_POST["login"]);
$passwd = $_POST["passwd"];
if ($_SESSION['try'] == 3) {
	$DB_DBH = new PDO($DB_DSN_DOP, $DB_USER, $DB_PASSWORD, $DB_OPTION);
	$sql = $DB_DBH->query("SELECT `login`, `email` FROM `Users` ORDER BY `login`");
    $sql->setFetchMode(PDO::FETCH_ASSOC);
    $flag = 0;
    if ($sql) {
        while ($row = $sql->fetch())
		{
			if ($row['login'] === $_POST['login']) {
                $email = base64_decode($row['email']);
                $flag = 1;
                break ;
			}
		}
    }
    if ($flag === 0) {
        echo "<script>alert(\"Такого пользователя не существует. \");
		location.href='../html/login.html';</script>";
    }
	else {
		ini_set("SMTP", "127.0.0.1");
    	ini_set("smtp_port", "25");
    	$num = rand(10000, 99999);
		$headers = "FROM: camagru\r\nReply-to: Vyazin\r\nContent-type: text/html; charset=utf-8\r\n";
		$message = 'Здравствуйте!  Неким пользователем была произведена попытка зайти на сайт CAMAGRU, используя Ваш email, но был трижды введен неправильный пароль. Если это были Вы,
		то, пожалуйста, подтвердите действие, введя данный код подтверждения:<p>'.$num.'</p>  <br/> <br/> В противном случае, если это были не Вы, 
		то, просто игнорируйте это письмо.';
    	mail($email, "Camagru", $message, $headers);
    	session_start();
    	$_SESSION['num'] = $num;
    	$_SESSION['email'] = base64_encode($email);
		header("Location: ../html/confirm.html");
	}
}
else {
	$_SESSION["loggued_on_user"] = auth($login, $passwd) ? $login : "";
	if ($_SESSION["loggued_on_user"] == "") {
		echo "<script>alert(\"Пользователь не существует, неправильно ввёден пароль или не подтверждён аккаунт\\nПроверьте почту на наличие письма подтверждения аккаунта\");
		location.href='../html/login.html';</script>";
	}
	else {
		header("Location: ../index.php");
	}
}
?>

<?php
include("auth.php");
include("../config/database.php");
session_start();
$login = htmlspecialchars($_POST["login"]);
$passwd = $_POST["passwd"];
$_SESSION["loggued_on_user"] = auth($login, $passwd) ? $login : "";
if ($_SESSION["loggued_on_user"] == "") {
	echo "<script>alert(\"Пользователь не существует или неправильно ввёден пароль\");
	location.href='../html/login.html';</script>";
}
header("Location: ../index.php");
?>

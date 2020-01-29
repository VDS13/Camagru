<?php
include("../config/database.php");
if (!$_POST["login"] || !$_POST["oldpw"] || $_POST["submit"] != "OK" ||
	!$_POST["newpw"] || $_POST["oldpw"] == $_POST["newpw"]) {
	echo "<script>alert(\"Старый и новый пароль совпадают\");
	location.href='../html/modif.html';</script>";
}
$DB_DBH = new PDO($DB_DSN_DOP, $DB_USER, $DB_PASSWORD, $DB_OPTION);
$sql = $DB_DBH->prepare("SELECT `passwd` FROM `Users` WHERE `login` = ?");
$login = $_POST["login"];
$sql->execute([$login]);
$old = $sql->fetch();
if ($old) {
	if ($old['passwd'] === hash("whirlpool",$_POST['oldpw'])) {
		$sql = $DB_DBH->query("SELECT `id_user`, `login`, `pass` FROM `Pno` ORDER BY `login`");
		$sql->setFetchMode(PDO::FETCH_ASSOC);
		if ($sql)
		{
			$flag = 0;
			while ($row = $sql->fetch()) {
				if ($row['login'] === $_POST['login']) {
					$flag = 1;
					$id = $row['id_user'];
					if($row['pass'] === hash("whirlpool",$_POST['newpw'])) {
						$flag = 2;
						break;
					}
				}
			}
			if ($flag === 1) {
				$login = $_POST["login"];
				$passwd = hash("whirlpool",$_POST["newpw"]);
				$sql = $DB_DBH->prepare("INSERT INTO `Pno` (`id_user`,`login`, `pass`) VALUES (?, ?, ?)");
				$sql->execute(array($id, $login, $passwd));
				$sql = $DB_DBH->prepare("UPDATE `Users` SET `passwd` = ? WHERE `id_user` = ?");
				$sql->execute(array($passwd, $id));
				header("Location: ../html/login.html");
			}
			else if ($flag === 2) {
				echo "<script>alert(\"Такой пароль уже был использован ранее\");
				location.href='../html/modif.html';</script>";
			}
		}
	}
	else {
		echo "<script>alert(\"Неверный пароль\");
		location.href='../html/modif.html';</script>";
	}
}
else {
	echo "<script>alert(\"Такого пользователя не существует\");
	location.href='../html/modif.html';</script>";
}
?>
<?php
include("../config/database.php");
if (!$_POST["newpw"] || $_POST["submit"] != "OK") {
	echo "ERROR\n";
	exit;
}
else {
    $DB_DBH = new PDO($DB_DSN_DOP, $DB_USER, $DB_PASSWORD, $DB_OPTION);
    $sql = $DB_DBH->prepare("SELECT `login`, `passwd` FROM `Users` WHERE `email` = ?");
    session_start();
	$email = $_SESSION["email"];
	$sql->execute([$email]);
    $old = $sql->fetch();
    if ($old) {
    	$sql = $DB_DBH->query("SELECT `id_user`, `login`, `pass` FROM `Pno` ORDER BY `login`");
		$sql->setFetchMode(PDO::FETCH_ASSOC);
    	if ($sql)
    	{
    		$flag = 0;
    		while ($row = $sql->fetch()) {
    			if ($row['login'] === $old['login']) {
    				$flag = 1;
    				$id = $row['id_user'];
    				if($row['pass'] === hash("whirlpool",$_POST['newpw'].$secret)) {
    					$flag = 2;
    					break;
    				}
    			}
			}
			if (strlen($_POST['newpw']) < 8 || preg_match("/(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/", $_POST['newpw']) == 0) {
				$flag = 3;
			}
    		if ($flag === 1) {
    			$login = $old["login"];
    			$passwd = hash("whirlpool",$_POST["newpw"].$secret);
    			$sql = $DB_DBH->prepare("INSERT INTO `Pno` (`id_user`,`login`, `pass`) VALUES (?, ?, ?)");
    			$sql->execute(array($id, $login, $passwd));
    			$sql = $DB_DBH->prepare("UPDATE `Users` SET `passwd` = ? WHERE `id_user` = ?");
    			$sql->execute(array($passwd, $id));
    			header("Location: ../html/login.html");
    		}
    		else if ($flag === 2) {
    			echo "<script>alert(\"Такой пароль уже был использован ранее\");
    			location.href='../html/modif2.html';</script>";
			}
			else if ($flag === 3) {
				echo "<script>alert(\"Некорректный пароль. \\nПароль должен быть длиннее 8 символов и должен содержать один спецсимвол.\");
				location.href='../html/modif2.html';</script>";
			}
    	}
    }
    else {
    	echo "<script>alert(\"Такого пользователя не существует\");
    	location.href='../html/modif2.html';</script>";
    }
}
?>
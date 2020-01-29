<?php
function auth($login, $passwd)
{
	include("../config/database.php");
	$DB_DBH = new PDO($DB_DSN_DOP, $DB_USER, $DB_PASSWORD, $DB_OPTION);
	$sql = $DB_DBH->prepare("SELECT `passwd`, `verif` FROM `Users` WHERE `login` = ?");
	$sql->execute([$login]);
	$user = $sql->fetch();
	if ($user) {
		if ($user["passwd"] === hash("whirlpool" , $passwd) && $user['verif'] === 'yes') {
			return TRUE;
		}
	}
	return FALSE;
}
?>
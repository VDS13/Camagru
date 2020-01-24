<?php
if (!$_POST["login"] || !$_POST["oldpw"] || $_POST["submit"] != "OK" ||
	!$_POST["newpw"] || !file_exists("private/passwd") ||
	$_POST["oldpw"] == $_POST["newpw"]) {
	echo "ERROR\n";
	exit;
}
$data = unserialize(file_get_contents("private/passwd"));
if ($data)
{
	foreach ($data as &$val) {
		if ($val["login"] === $_POST["login"] && $val["passwd"] === hash("whirlpool", $_POST["oldpw"]))
		{
			$val["passwd"] = hash("whirlpool", $_POST["newpw"]);
			file_put_contents("private/passwd", serialize($data));
			header("Location: login.html");
			echo "OK\n";
			exit;
		}
	}
	echo "ERROR\n";
}
?>
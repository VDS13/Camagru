<?php
if (!$_POST["login"] || !$_POST["passwd"] || $_POST["submit"] != "OK") {
	echo "ERROR\n";
	exit;
}
else {
	if (!is_dir("private"))
		mkdir("private");
	if (!file_exists("private/passwd"))
		file_put_contents("private/passwd", null);
	else {
		$data = file_get_contents("private/passwd");
		$data = unserialize($data);
		if ($data)
		{
			foreach ($data as $key => $val) {
				if ($val["login"] === $_POST["login"]) {
					echo "ERROR\n";
					exit;
				}
			}
		}
	}
	$account["login"] = $_POST["login"];
	$account["passwd"] = hash("whirlpool", $_POST["passwd"]);
	$account["admin"] = 0;
	$data[] = $account;
	file_put_contents("private/passwd", serialize($data));
	if (!file_exists(("private/" . $account["login"]))) {
		file_put_contents(("private/" . $account["login"]), null);
	}
	header("Location: login.html");
	echo "OK\n";
}
?>
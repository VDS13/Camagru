<?php
function auth($login, $passwd)
{
	if (!file_exists("private"))
	{
		return FALSE;
	}
	if (!file_exists("private/passwd"))
	{
		return FALSE;
	}
	$data = unserialize(file_get_contents("private/passwd"));
	if ($data)
	{
		foreach ($data as $key => $val) {
			if ($val["login"] === $login && $val["passwd"] === hash("whirlpool" , $passwd)) {
				return TRUE;
			}
		}
	}
	return FALSE;
}
?>
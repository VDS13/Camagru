<?php
if ($_SESSION["loggued_on_user"] == "") {
	echo "<a href=\"../html/login.html\"><img class=\"login\" src=\"http://cdn.onlinewebfonts.com/svg/img_568657.png\" title=\"Login\" width=\"50px\" height=\"50px\"></a>";
	return;
}
else {
	echo "<p>" . htmlspecialchars($_SESSION["loggued_on_user"]) . "</p>";
	echo "<a href=\"../move/camera.php\"><img class=\"login\" src=\"https://s1.iconbird.com/ico/2013/9/452/w512h4321380476728camera.png\" title=\"Сделать фото\" width=\"60px\" height=\"50px\"></a>";
	echo "<a href=\"../html/modnew.html\"><img class=\"login\" src=\"https://image.flaticon.com/icons/png/512/57/57458.png\" title=\"Смена данных\" width=\"50px\" height=\"50px\"></a>";
}
?>
<div class="log">
	<form class="button1">
		<button type="submit" name="Logout" formaction="move/logout.php">Logout</button>
	</form>
</div>
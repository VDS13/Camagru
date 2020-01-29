<?php
if ($_SESSION["loggued_on_user"] == "") {
	echo "<a href=\"../html/login.html\"><img class=\"login\" src=\"http://cdn.onlinewebfonts.com/svg/img_568657.png\" title=\"Login\" width=\"50px\" height=\"50px\"></a>";
	return;
}
else {
	echo "<p>" . htmlspecialchars($_SESSION["loggued_on_user"]) . "</p>";
}
?>
<div class="log">
<form class="button1">
	<button type="submit" name="Logout" formaction="move/logout.php">Logout</button>
</form>
</div>
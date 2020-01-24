<?php
if ($_SESSION["loggued_on_user"] == "") {
	echo "<a href=\"login.html\"><img class=\"login\" src=\"http://cdn.onlinewebfonts.com/svg/img_568657.png\" title=\"Login\"></a>";
	return;
}
else {
	echo "<p>" . $_SESSION["loggued_on_user"] . "</p>";
}
?>
<div class="log">
<form class="button1">
    <button type="submit" name="Delete" formaction="delete.php">Delete</button>
	<button type="submit" name="Logout" formaction="logout.php">Logout</button>
</form>
</div>
<?php
	echo "<h2>" . htmlspecialchars($_SESSION["loggued_on_user"]) . "</h2>";
?>
<div class="log">
	<form class="button1">
		<button class="button2" type="submit" name="Logout" formaction="logout.php">Logout</button>
		<button class="button2" type="submit" formaction="goindex.php">На главную</button>
	</form>
</div>
<?php
	echo "<p>" . htmlspecialchars($_SESSION["loggued_on_user"]) . "</p>";
	echo "<p>" . htmlspecialchars($_SESSION["photo"]) . "</p>";
?>
<div class="log">
	<form class="button1">
		<button type="submit" name="Logout" formaction="logout.php">Logout</button>
	</form>
</div>
<?php
session_start();
unlink("/Users/dnichol/myprojects/camagru/collection/".$_SESSION['loggued_on_user']."/".$_SESSION['photo'].".jpg");
?>
<?php
session_start();
unlink("../collection/".$_SESSION['photo'].".jpg");
?>
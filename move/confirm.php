<?php
if (!$_POST["num"] || $_POST["submit"] != "OK") {
	echo "ERROR\n";
	exit;
}
else {
    session_start();
    if ($_SESSION['num'] == $_POST["num"]) {
        header("Location: ../html/modif2.html");
    }
    else {
        echo "<script>alert(\"Ошибка подтверждения.\");
		location.href='../html/confirm.html';</script>";
    }
}
?>
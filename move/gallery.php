<?php
include("config/database.php");
$DB_DBH = new PDO($DB_DSN_DOP, $DB_USER, $DB_PASSWORD, $DB_OPTION);
$sql = $DB_DBH->query("SELECT `path_img` FROM `Img` ORDER BY `creation_date`");
$sql->setFetchMode(PDO::FETCH_ASSOC);
if ($sql) {
    while ($row = $sql->fetch())
	{
        echo "<img id=\"photo\" src=\"".$row['path_img']."\">";
    }
}
?>
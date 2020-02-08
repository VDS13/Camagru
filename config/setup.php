<?php
include("database.php");
try {
    $DB_DBH = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $DB_OPTION);
    $sql = "CREATE DATABASE IF NOT EXISTS camagru";
    $DB_DBH->exec($sql);
} catch (PDOException $e) {
    die('Error creating db: ' . $e->getMessage);
}
try {
    $DB_DBH = new PDO($DB_DSN_DOP, $DB_USER, $DB_PASSWORD,$DB_OPTION);
    $sql = "CREATE TABLE IF NOT EXISTS`Users` (
        `id_user` INT NOT NULL AUTO_INCREMENT,
        `login` VARCHAR(8) NOT NULL,
        `passwd` VARCHAR(256) NOT NULL,
        `token` VARCHAR(256) NOT NULL,
        `verif` ENUM('yes', 'no') NOT NULL,
        `email` VARCHAR(256) NOT NULL,
        PRIMARY KEY(id_user))";
    $DB_DBH->exec($sql);
    $sql = "CREATE TABLE IF NOT EXISTS`Img` (
        `id_img` INT NOT NULL AUTO_INCREMENT,
        `id_user` INT NOT NULL,
        `path_img` VARCHAR(128) NOT NULL,
        `creation_date` DATETIME NOT NULL,
        `like` INT NOT NULL,
        PRIMARY KEY(id_img))";
    $DB_DBH->exec($sql);
    $sql = "CREATE TABLE IF NOT EXISTS`Comment` (
        `id_comment` INT NOT NULL AUTO_INCREMENT,
        `id_img` INT NOT NULL,
        `id_user` VARCHAR(8) NOT NULL,
        `comment` VARCHAR(128) NOT NULL,
        `creation_date` DATETIME NOT NULL,
        PRIMARY KEY(id_comment))";
    $DB_DBH->exec($sql);
    $sql = "CREATE TABLE IF NOT EXISTS`Pno` (
        `id_user` INT NOT NULL,
        `login` VARCHAR(8) NOT NULL,
        `pass` VARCHAR(256) NOT NULL)";
    $DB_DBH->exec($sql);
} catch (PDOException $e) {
    die('Error creating tables: ' . $e->getMessage);
}
?>
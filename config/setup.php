<?php
include("database.php");
try {
    $DB_DBH = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $DB_OPT);
    $sql = "CREATE DATABASE IF NOT EXISTS Camagru";
    $DB_DBH->exec($sql);
} catch (PDOException $e) {
    die('Error creating db: ' . $e->getMessage);
}
try {
    $DB_DBH = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $DB_OPT);
    $sql = "CREATE TABLE `Users` (
        `id_user` INT NOT NULL AUTO_INCREMENT,
        `login` VARCHAR(8) NOT NULL,
        `passwd` VARCHAR(256) NOT NULL,
        `verif` ENUM('yes', 'no') NOT NULL,
        `email` VARCHAR(30) NOT NULL,
        PRIMARY KEY(id_user))";
    $DB_DBH->exec($sql);
    $sql = "CREATE TABLE `Img` (
        `id_img` INT NOT NULL AUTO_INCREMENT,
        `login` VARCHAR(8) NOT NULL,
        `path_img` VARCHAR(128) NOT NULL,
        `creation_date` DATE NOT NULL,
        `like` INT NOT NULL,
        PRIMARY KEY(id_img))";
    $DB_DBH->exec($sql);
    $sql = "CREATE TABLE `Comment` (
        `id_img` INT NOT NULL AUTO_INCREMENT,
        `login` VARCHAR(8) NOT NULL,
        `id_comment` INT NOT NULL AUTO_INCREMENT,
        `comment` VARCHAR(128) NOT NULL,
        `creation_date` DATE NOT NULL,
        PRIMARY KEY(id_img))";
} catch (PDOException $e) {
    die('Error creating tables: ' . $e->getMessage);
}
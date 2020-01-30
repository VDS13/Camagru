<?php
$DB_DSN = 'mysql:host=127.0.0.1;port=3306';
$DB_DSN_DOP = 'mysql:host=127.0.0.1;port=3306;dbname=camagru';
$DB_USER = 'camagru';
$DB_PASSWORD = 'dnichol';
$secret = 'dnichol';
$DB_OPTION = [
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];
?>
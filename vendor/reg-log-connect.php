<?php
$cLife = 3600;

$dbrlhost = "fdb1031.royalwebhosting.net";
$dbrluser = "4405746_relicrkatalog";
$dbrlpas = "R!a8D.CvWU!WXjT0";
$dbrlname = "4405746_relicrkatalog";
$dbrlport = 3306;

if(!isset($mysqlRegLog))
{
    $mysqlRegLog = mysqli_connect($dbrlhost, $dbrluser, $dbrlpas, $dbrlname, $dbrlport);
}

// echo 'Подключение к БД установлено.<br>';

$dbRCheckQuery = "SELECT `id` FROM `user` WHERE `login` = ";
$dbRQuery = "INSERT INTO `user` (`login`, `password`, `shop_cart`) VALUES ";
$dbLQuery = "SELECT * FROM `user` WHERE ";

?>
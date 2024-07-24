<?php
$cLife = 3600;

$dbhost = "fdb1031.royalwebhosting.net";
$dbuser = "4405746_relicrkatalog";
$dbpas = "R!a8D.CvWU!WXjT0";
$dbname = "4405746_relicrkatalog";
$dbport = 3306;

$_SESSION['mysql'] = mysqli_connect($dbhost, $dbuser, $dbpas, $dbname, $dbport);

// echo 'Подключение к БД установлено.<br>';

$_SESSION['it_query'] = 'SELECT * FROM `item`';

?>
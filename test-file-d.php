<?php
session_start();
include_once("db-connect.php");
$_SESSION['up-f-id'] = mysqli_fetch_assoc(mysqli_query($_SESSION['mysql'],'SELECT MAX(`id`) AS `MAX_ID` FROM `item`'))['MAX_ID'] + 1;
$uploaddir = './items/'.$_POST['category'].'/';
$uploadfile = $uploaddir . $_SESSION['up-f-id'] . '.jpg';
$qryI = "";
$qryV = "";
foreach($_POST as $key => $value)
{
    if($key != "MAX_FILE_SIZE")
    {
    $qryI .= isset($key) ? '`'.mysqli_escape_string($_SESSION['mysql'], $key).'`, ' : '';
    $qryV .= isset($value) && $value != '' ? '"'.mysqli_escape_string($_SESSION['mysql'], $value).'", ' : 'NULL, ';
    }
}

$qryI = rtrim($qryI, ",\x20");
$qryV = rtrim($qryV, ",\x20");

if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) 
{
    mysqli_query($_SESSION['mysql'],'INSERT INTO `item` ('.$qryI.') VALUES ('.$qryV.')');
    $_SESSION['db-add-status'] = "Session: Товар добавлен в БД.\n";
    $dbAddStatus = "Товар добавлен в БД.\n";
} 
else 
{
    $_SESSION['db-add-status'] = "Session: Возникла ошибка!\n";
    $dbAddStatus = "Возникла ошибка!\n";
}
exit('<meta http-equiv="refresh" content="0; url=./test.php" />');
?>
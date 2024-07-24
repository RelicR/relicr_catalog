<?php
include_once("db-connect.php");

$items = mysqli_query($_SESSION['mysql'], $_SESSION['it_query']);
$awaititem = array();

while($item = mysqli_fetch_assoc($items))
{
    $awaititem[] = $item;
}

$orderawait = $awaititem;
shuffle($awaititem);

?>
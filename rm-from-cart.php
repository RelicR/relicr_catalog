<?php
include_once("db-connect.php");
if(!isset($_COOKIE['_lu']))
{
    echo "unauth";
}
if(isset($_POST['id']))
{
    if(!preg_match('/\b\d+-('.$_POST['id'].')\b/', $_COOKIE['shop_cart']))
    {
        exit;
    }
    $regexp = '/\b\d+-'.$_POST['id'].'\b/';
    setcookie('shop_cart', preg_replace($regexp, '', $_COOKIE['shop_cart']), time() + $cLife,'/');

    $regexp = '/\b\d+-'.$_POST['id'].'\b/';
    preg_match_all($regexp, $_COOKIE['shop_cart'], $matches);
    //echo $matches[0][0];
    $itemToRm = preg_split('/-/', $matches[0][0])[0];

    echo $itemToRm[0];
}
?>
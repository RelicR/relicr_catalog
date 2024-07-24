<?php
include_once("../db-connect.php");
if(!isset($_COOKIE['_lu']))
{
    echo "unauth";
    exit;
}

mysqli_query($_SESSION['mysql'], 'UPDATE `user` SET `shop_cart` = "'.$_COOKIE['shop_cart'].'" WHERE `login` = "'.openssl_decrypt($_COOKIE['_lu'], "AES-128-ECB", "idktbh").'"');
setcookie('shop_cart', "\x20", time() + $cLife,'/');
setcookie('_li', '', time()-3600, '/');
setcookie('_lu', '', time()-3600, '/');
setcookie('PHPSESSID', '', time()-3600, '/');
//session_abort();

//'UPDATE `users` SET `shop_cart` = '.$_COOKIE['shop_cart'].'WHERE `login` = '.openssl_decrypt($_COOKIE['_lu'], "AES-128-ECB", "idktbh")

?>
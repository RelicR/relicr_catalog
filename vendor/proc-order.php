<?php
include_once("../db-connect.php");
include_once("../get-items.php");
if(!isset($_COOKIE['_lu']))
{
    echo "unauth";
    exit;
}

$tempDesc = "";

include_once("../get-items.php");

$_SESSION['totalWorth'] = 0;
foreach($orderawait as $tempItem)
{
    if(preg_match('/\b\d+-'.$tempItem['id'].'\b/', $_COOKIE['shop_cart'], $matches) == 1)
    {
        $tempAmnt = preg_split('/-/', $matches[0])[0];
        $tempDesc .= $tempItem["name"]."\x20|\x20".$tempAmnt."шт.\x20|\x20".$tempItem["price"]."\x0D\x0A";
        $_SESSION['totalWorth'] += $tempAmnt * $tempItem["price"];
        mysqli_query($_SESSION['mysql'], 'UPDATE `item` SET `amount` = `amount` - '.$tempAmnt.' WHERE `id` = '.$tempItem["id"]);
    }
}

mysqli_query($_SESSION['mysql'], 'INSERT INTO `orders` (`buyer`, `items`, `order_desc`, `price`) VALUES ("'.openssl_decrypt($_COOKIE['_li'],"AES-128-ECB", "idktbhid").'", "'.$_COOKIE['shop_cart'].'", "' .$tempDesc.'", "'.$_SESSION['totalWorth'].'")');
//echo 'INSERT INTO `orders` (`buyer`, `items`, `order_desc`, `price`) VALUES ("'.openssl_decrypt($_COOKIE['_lu'],"AES-128-ECB", "idktbh").'", "'.$_COOKIE['shop_cart'].'", "' .$tempDesc.'", "'.$_SESSION['totalWorth'].'")'; 
setcookie('shop_cart', "\x20", time() + $cLife,'/');
unset($tempDesc, $tempAmnt, $tempItem);
echo "ok";

?>
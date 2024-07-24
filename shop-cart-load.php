<?php
include_once("db-connect.php");
include_once("get-items.php");

if(!isset($_COOKIE['_lu']))
{
    header("Location: ./");
}
$quer = "(";
$regexp = '/\b\d+-\d+\b/';
$totalWorth = 0;
$totalAmount = 0;
$tempCart = $_COOKIE['shop_cart'];
preg_match_all($regexp, $_COOKIE['shop_cart'], $matches);
$_SESSION['sci-amount'] = array();
if(count($matches[0]) == 0)
{
    $_SESSION['isCart'] = false;
    setcookie('shop_cart', "\x20", time()+$cLife,"/");
}
else
{
    //$availitems = mysqli_fetch_object(mysqli_query($_SESSION['mysql'], 'SELECT * FROM `item`'));
    // print_r($awaititem);
    // print_r("\n321 ");
    // print_r($awaititem[5]["amount"]);
    // print_r("\n123 ");
    foreach($matches[0] as $cartItem)
    {
        $tempId = preg_split('/-/', $cartItem)[1];
        $tempAmnt = preg_split('/-/', $cartItem)[0];
        $tempIndex = array_search($tempId, array_column($awaititem, 'id'));
        // print_r($cartItem);
        // print_r($tempId);
        // print_r($awaititem[$tempIndex]['amount']);
        //print_r($tempIndex." ");
        if($awaititem[$tempIndex]['amount'] < $tempAmnt)
        {
            $_SESSION['changeCart'] = true;
            $tempCart = preg_replace('/\b\d+-'.$tempId.'\b/', ' ', $tempCart);
            //print_r($tempCart);
            continue;
        }
        //$_SESSION['shop-cart-items'][] = preg_split('/-/', $cartItem)[1];
        $_SESSION['sci-amount'][$tempId] = $tempAmnt;
        $quer .= $tempId.', ';
        //$totalWorth += $tempId;
    }

    $quer = rtrim($quer,', ').')';
    // foreach($awaititem as $item)
    // {
    //     if($item['id'])
    // }

    // print_r($_SESSION['shop-cart-items']);

    // echo "<br>";
    // print_r($_SESSION['sci-amount']);
    // echo "<br>";
    //print_r($quer);
    //print_r($matches[0]);
    // echo "<br>";

    $awaitItems = mysqli_query($_SESSION['mysql'], 'SELECT * FROM `item` WHERE `id` IN '.$quer);
    unset($tempId, $tempAmnt, $tempIndex);
    if(!isset($_SESSION['changeCart']))
    {
        setcookie('shop_cart', str_replace("\x20\x20", "\x20", $tempCart), time() + $cLife,'/');
        unset($tempCart);
    }
}
// print_r(openssl_decrypt($_COOKIE['_li'],"AES-128-ECB", "idktbhid"));
//print_r($_COOKIE['_li']);
$ordersQuery = mysqli_query($_SESSION['mysql'], 'SELECT * FROM `orders` WHERE `buyer` = '.openssl_decrypt($_COOKIE['_li'],"AES-128-ECB", "idktbhid"));
$_SESSION['isOrder'] = mysqli_num_rows($ordersQuery);
$ordersInfoQuery = mysqli_query($_SESSION['mysql'], 'SELECT SUM(`price`), COUNT(*) FROM `orders` WHERE `buyer` = '.openssl_decrypt($_COOKIE['_li'],"AES-128-ECB", "idktbhid"));
$ordersTotInfo = mysqli_fetch_array($ordersInfoQuery, MYSQLI_NUM);
//print_r($tempCart);
// while($cartItems = mysqli_fetch_assoc($awaitItems))
// {
//     echo "<br>";
//     print_r($cartItems);
// }
//print_r($cartItems);
?>
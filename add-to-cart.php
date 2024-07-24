<?php
include_once("db-connect.php");
if(!isset($_COOKIE['_lu']))
{
    echo "unauth";
    exit;
}
if(isset($_POST['id']))
{
    if(!preg_match('/-('.$_POST['id'].')\b/', $_COOKIE['shop_cart']))
    {
        setcookie('shop_cart', $_COOKIE['shop_cart'].'1-'.$_POST['id'].' ', time() + $cLife,'/');
        echo "ok";
        exit;
    }

    $regexp = '/\b\d+-\d+\b/';
    preg_match_all($regexp, $_COOKIE['shop_cart'], $matches);
    $repeateditems = array();
    $shopcart = "";
    $ans = "ok";
    foreach($matches[0] as $repeateditem)
    {
        $repeateditems[] = preg_split('/-/', $repeateditem);
    }
    foreach($repeateditems as $repeateditem)
    {
        if($repeateditem[1] == $_POST['id'])
        {
            if(isset($_POST['curValue']))
            {
                $ans = $_POST['curValue'] > $_POST['amount'] ? "notok" : $repeateditem[0] - $_POST['curValue'];
                $toAdd = $_POST['curValue'] > $_POST['amount'] ? ''. $repeateditem[0] .'-'. $repeateditem[1] .' ' : ''. $repeateditem[0]-$ans .'-'. $repeateditem[1] .' ';
                $shopcart .= $toAdd;
            }
            else
            {
                $ans = $repeateditem[0] + 1 > $_POST['amount'] ? "notok" : "ok";
                $toAdd = $repeateditem[0] + 1 > $_POST['amount'] ? ''. $repeateditem[0] .'-'. $repeateditem[1] .' ' : ''. $repeateditem[0]+1 .'-'. $repeateditem[1] .' ';
                $shopcart .= $toAdd;
            }
        }
        else
        {
            $shopcart .= ''. $repeateditem[0] .'-'. $repeateditem[1] .' ';
        }
    }

    mysqli_query($_SESSION['mysql'], 'UPDATE `user` SET `shop_cart` = "'.$shopcart.'" WHERE `login` = '.openssl_decrypt($_COOKIE['_lu'],"AES-128-ECB", "idktbh"));
    setcookie('shop_cart', $shopcart, time() + $cLife,'/');
    echo $ans;
}
?>
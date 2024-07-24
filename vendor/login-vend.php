<?php

include("reg-log-connect.php");
//echo($dbLQuery."`login` = \"".$_POST['log-login']."\" AND `password` = \"".hash("sha256", $_POST['log-pass'])."\"");
//print_r("\x0D\x0A");
if (mysqli_num_rows(mysqli_query($mysqlRegLog, $dbLQuery."`login` = \"".$_POST['log-login']."\" AND `password` = \"".hash("sha256", $_POST['log-pass'])."\"")) == 1)
{
    // mysqli_query($mysqlRegLog, $dbLQuery."`login` = \"".$_POST['log-login']."\" AND `password` = \"".hash("sha256", $_POST['log-pass'])."\"");
    $_SESSION['logged-user'] = $_POST['log-login'];
    //$_SESSION['hashed-user-p'] = hash("sha256", $_POST['log-pass']);
    //$_COOKIE['a'] = true;
    
    setcookie('_li', openssl_encrypt(mysqli_fetch_column(mysqli_query($mysqlRegLog, $dbRCheckQuery.'"'.$_POST['log-login'].'"')),"AES-128-ECB", "idktbhid"), time()+$cLife, '/');
    setcookie('_lu', openssl_encrypt($_POST['log-login'],"AES-128-ECB", "idktbh"), time()+$cLife, '/');
    $_SESSION['tempCart'] = mysqli_query($mysqlRegLog, 'SELECT `shop_cart` FROM `user` WHERE `login` = "'.$_POST['log-login'].'"');
    setcookie('shop_cart', mysqli_fetch_assoc($_SESSION['tempCart'])['shop_cart'], time()+$cLife, '/');
    //setcookie('shop_cart', "\x20", time()+$cLife, '/');
    echo "1";
    // echo $_SESSION['logged-user'];
}

else
{
    echo "0";
}

//echo $_POST;

?>
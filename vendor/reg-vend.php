<?php

include("reg-log-connect.php");

if(mysqli_num_rows(mysqli_query($mysqlRegLog, $dbRCheckQuery."\"".$_POST['reg-login']."\"")) == 1)
{
    echo "0";
}

else
{
    mysqli_query($mysqlRegLog, $dbRQuery."('".$_POST['reg-login']."', '".hash("sha256", $_POST['reg-pass'])."', \" \")");
    // $_SESSION['logged-user'] = $_POST['reg-login'];
    // $_SESSION['hashed-user-p'] = hash("sha256", $_POST['reg-pass']);
    // $_SESSION['authentificated'] = true;
    //echo $_POST['log-login']."";
    setcookie('_li', openssl_encrypt(mysqli_fetch_column(mysqli_query($mysqlRegLog, $dbRCheckQuery.'"'.$_POST['reg-login'].'"')),"AES-128-ECB", "idktbhid"), time()+$cLife, '/');
    // echo mysqli_fetch_column(mysqli_query($mysqlRegLog, $dbRCheckQuery.'"'.$_POST['reg-login'].'"'));
    // echo "<br>";
    // echo openssl_encrypt(mysqli_fetch_column(mysqli_query($mysqlRegLog, $dbRCheckQuery.'"'.$_POST['log-login'].'"'))."","AES-128-ECB", "idktbhid");
    // echo "<br>";
    // echo openssl_encrypt(mysqli_fetch_column(mysqli_query($mysqlRegLog, $dbRCheckQuery.'"'.$_POST['log-login'].'"')),"AES-128-ECB", "idktbhid");
    // echo "<br>";
    setcookie('_lu', openssl_encrypt($_POST['reg-login'],"AES-128-ECB", "idktbh"), time()+$cLife, '/');
    setcookie('shop_cart', "\x20", time()+$cLife, '/');
    echo "1";
}

// print_r($_POST);
//echo mysqli_num_rows(mysqli_query($mysqlRegLog, $dbRCheckQuery."\"".$_POST['reg-login']."\""));
//echo ($dbRCheckQuery."\"".$_POST['reg-login']."\"");
?>
<?php
require_once($_SERVER['DOCUMENT_ROOT']."/libs/Smarty.class.php");
$smarty = new Smarty();
$smarty->template_dir = $_SERVER['DOCUMENT_ROOT'].'/libs/templates';
$smarty->compile_dir = $_SERVER['DOCUMENT_ROOT'].'/libs/templates_c';

if(isset($_COOKIE['_lu']))
{
    $smarty->assign('_lu', openssl_decrypt($_COOKIE['_lu'],"AES-128-ECB", "idktbh"));
}
$smarty->assign('page_heads', array(
    'index' => array(
'title' => "Каталог Relic_R", 
'meta' => "Relic_R каталог товары", 
'desc' => "Главная страница электронного каталога Relic_R"),
    'shop-cart' => array(
'title' => "Корзина", 
'meta' => "Relic_R каталог товары корзина", 
'desc' => "Корзина товаров пользователя электронного каталога Relic_R"),
    'test' => array(
'title' => "Добавить товар", 
'meta' => "Relic_R каталог товары", 
'desc' => "Страница добавления товара"),
    'profile' => array(
'title' => "Профиль", 
'meta' => "Relic_R каталог товары профиль заказы", 
'desc' => "Профиль пользователя электронного каталога Relic_R")
));
$smarty->assign('pagename', preg_replace('/(\/relicr-katalog\/)|(.php)|\//', '', $_SERVER['SCRIPT_NAME']));
?>
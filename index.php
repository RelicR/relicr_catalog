<?php
$cLife = 3600;

if(!isset($_COOKIE['PHPSESSID']))
{
    session_set_cookie_params($cLife,"/");
    session_start();
}

if(!isset($_COOKIE['shop_cart']))
{
    setcookie('shop_cart', "\x20", time() + $cLife,'/');
}

include("get-items.php");

include('load-smarty.php');
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/3-korochki.jpg" type="image/jpg">
    <?php $smarty->display('main.tpl');?>
</head>
<body>
    <?php $smarty->display('navbar.tpl');?>
    <div class="container tr-gb">
        <?php foreach($awaititem as $item): ?>
        <div class="shop-item" id="<?php echo $item['id']?>">
            <div class="item-card si-bg">
                <div class="shop-item-cont tr-bg pe-5">
                    <h3 class="shop-item-h3 tr-bg"><?php echo $item['name']?></h3>
                    <img src="items/<?php echo $item['category']."/".$item['id']?>.jpg" class="shop-item-img" loading="lazy">
                </div>
                <div class="shop-item-price tr-bg pe-5">
                    <span class="item-price tr-bg"><?php echo $item['price']?> &#x20bd</span>
                    <button class="item-buy-btn" type="button" value=<?php echo "\"".$item['id']."\""?> onclick="addToCart(this, <?php echo $item['amount']?>);" <?php if($item['amount'] < 1) { echo 'disabled';}?>>Купить</button>
                </div>
                <div class="shop-item-desc tr-bg pe-5">
                    <span class="shop-item-desc-span tr-bg"><?php echo $item['description']?></span>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <script src="./js/getLog.js"></script>
    <script src="./js/reg-log-valid.js" async></script>
    <script src="./js/switch-screens.js" async></script>
    <script src="./js/req-reg.js"></script>
    <script src="./js/shop-cart.js"></script>
    <script src="./js/pfor-exit.js"></script>
</body>
<?php $smarty->display('footer.tpl');?>
</html>


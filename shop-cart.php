<?php
include("get-items.php");
include("shop-cart-load.php");
if(isset($_SESSION['changeCart']))
{
    setcookie('shop_cart', $tempCart, time() + $cLife,'/');
    unset($tempCart, $_SESSION['changeCart']);
    header('Location: '.$_SERVER['REQUEST_URI']);
}

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
    <div class="shop-cart">
        <?php if(isset($_SESSION['isCart'])): ?>
            <h3 style="display:inline">Корзина пуста...</h3>
        <?php ?>
    <?php else:?>
    <div class="shop-cart-container">
        <?php while($cartItems = mysqli_fetch_assoc($awaitItems)): ?>
        <div class="shop-cart-item" id="<?php echo $cartItems['id']?>">
            <div class="shop-cart-item-preview">
                <h4 class="shop-cart-item-h4" id=<?php echo '"'.$cartItems['id'].'-name"'?>><?php echo $cartItems['name']?></h4>
                <img src="items/<?php echo $cartItems['category']."/".$cartItems['id']?>.jpg" class="shop-cart-item-img" loading="lazy">
                <h4 class="shop-cart-item-h4"><?php if(!($cartItems['weight'] == null)){ echo $cartItems['weight']."кг"; }?></h4>
            </div>
            <div class="shop-cart-item-info">
                <h4 class="shop-cart-item-h4"><?php echo $cartItems['description']?></h4>
                <h4 class="shop-cart-item-h4">Производитель: <?php echo $cartItems['firm']?></h4>
            </div>
            <div class="shop-cart-item-control">
                <h4 class="shop-cart-item-h4" id=<?php echo '"'.$cartItems['id'].'-price"' ?>><?php echo $cartItems['price']?>&#x20bd</h4>
                <input type="number" class="shop-cart-item-amount" name="<?php echo $cartItems['id']?>-amount" min="0" max="<?php echo $cartItems['amount']?>" value=<?php echo '"'.$_SESSION['sci-amount'][$cartItems['id']].'"'?> onchange="amountAdd(this, <?php echo $cartItems['amount']?>, <?php echo $cartItems['price']?>)">
            </div>
        </div>
        <?php $totalWorth += $cartItems['price'] * $_SESSION['sci-amount'][$cartItems['id']]; endwhile;?>
    </div>
    <?php endif;?>
    <div class="shop-cart-order-info pe-5">
        <h4 class="shop-cart-item-h4"><bold>Данные заказа:</bold></h4>
        <h4 class="shop-cart-item-h4" id="total-worth">Общая стоимость: <?php echo $totalWorth.'';?>&#x20bd</h4>
        <h4 class="shop-cart-item-h4" id="total-amount">Количество позиций: <?php echo array_sum($_SESSION['sci-amount']).'';?></h4>
        <button type="button" id="shop-cart-order" onclick=setOrder()>Заказать</button>
    </div>
    </div>
    <script src="./js/sci-amount-add.js"></script>
    <script src="./js/pfor-exit.js"></script>
    <script src="./js/cartMobile.js"></script>
    <?php $smarty->display('footer.tpl');?>
</body>
</html>


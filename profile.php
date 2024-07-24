<?php
include("get-items.php");
include("shop-cart-load.php");

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
    <div class="profile-info-container">
        <div class="profile-info-total">
            <center><h4 class="profile-info-h4"><bold>Данные профиля</bold></h4></center>
            <h4 class="profile-info-h4">Пользователь: <?php echo openssl_decrypt($_COOKIE['_lu'],"AES-128-ECB", "idktbh")?></h4>
            <h4 class="profile-info-h4">Всего заказов: <?php if(isset($ordersTotInfo[1])){ echo $ordersTotInfo[1]; } else { echo "0"; }?></h4>
            <h4 class="profile-info-h4">Общая сумма заказов: <?php if(isset($ordersTotInfo[0])){ echo $ordersTotInfo[0]; } else { echo "0"; }?>&#x20bd</h4>
        </div>
        <?php if($_SESSION['isOrder'] > 0):?>
        <?php while($orderItems = mysqli_fetch_assoc($ordersQuery)): ?>
        <div class="order-item pe-5" id="<?php echo $orderItems['id']?>" style="background:white;">
            <h4 class="profile-info-h4" style="display:inline;">Заказ #<?php echo $orderItems['id'];?></h4>
            <h4 class="profile-info-h4" style="display:inline;">от <?php echo $orderItems['date'];?></h4>
            <ul class="order-info">
                <li class="order-info-li"><span class="order-info-span">Товар</span><span class="order-info-span">Кол-во</span><span class="order-info-span">Цена за шт. (&#x20bd)</span></li>
                <?php foreach(preg_split('/\n/', rtrim($orderItems['order_desc'], "\n")) as $orderDetail){?>
                    <li class="order-info-li"><?php foreach(preg_split('/ \| /', $orderDetail) as $orderDI) echo "<span class=\"order-info-span\">".$orderDI."</span>";?></li>
                <?php }?>
            </ul>
        </div>
        <?php endwhile;?>
        <?php else:?>
        <h3 style="display:inline">Пока нет заказов...</h3>
        <?php endif;?>
    </div>
    <script src="./js/sci-amount-add.js"></script>
    <script src="./js/pfor-exit.js"></script>
    <script src="./js/cartMobile.js"></script>
    <br>
    <?php $smarty->display('footer.tpl');?>
</body>
</html>


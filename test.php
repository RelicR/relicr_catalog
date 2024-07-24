<?php
session_start();
include_once("db-connect.php");

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

    <div style="margin: 100px 0px">
        <?php 
        if(isset($_SESSION['db-add-status']))
        {
            echo "<span>";
            echo($_SESSION['db-add-status']);
            unset($_SESSION['db-add-status']);
            echo "</span><br>";
        }
        ?>
        <?php
        $result = mysqli_query($_SESSION['mysql'], 'SHOW COLUMNS FROM `item`');
        $tempFields = array();
        $altFields = [
            'name' => ['elem' => 'input', 'type' => 'text', 'placeholder' => 'Название', 'required' => 'required'],
            'price' => ['elem' => 'input', 'type' => 'number', 'placeholder' => 'Цена', 'required' => 'required'], 
            'firm' => ['elem' => 'input', 'type' => 'text', 'placeholder' => 'Продавец', 'required' => 'required'], 
            'description' => ['elem' => 'textarea', 'type' => 'text', 'placeholder' => 'Описание', 'required' => 'required'], 
            'amount' => ['elem' => 'input', 'type' => 'number', 'placeholder' => 'Количество', 'min' => 1, 'required' => 'required'], 
            'weight' => ['elem' => 'input', 'type' => 'number', 'placeholder' => 'Масса', 'min' => 0, 'step' => 0.01]
        ];
        //$temp = 
        while($tempFill = mysqli_fetch_assoc($result))
        {
            if($tempFill['Field'] != "id" && $tempFill['Field'] != "category")
            {
                $tempFields[] = $tempFill['Field'];
            }  
        }
        print_r("\n");
        $result = mysqli_fetch_all(mysqli_query($_SESSION['mysql'], 'SELECT * FROM `category`'));

        echo "<form enctype=\"multipart/form-data\" action=\"test-file-d.php\" method=\"POST\">";
        echo "<h4 class=\"shop-cart-item-h4\">Категория</h4>";
        echo "<select name=\"category\" required=\"required\">";
        foreach($result as $value)
        {
            echo "<option>".$value[0]."</option>";
        }
        echo "</select>";
        echo "<br>";
        foreach($altFields as $key => $value)
        {
            // print_r($key." ");
            // print_r($value);
            echo "<h4 class=\"shop-cart-item-h4\">".$value['placeholder']."</h4>";
            echo "<".$value['elem']." class=\"db-input\" id=\"".$key."\" name=\"".$key."\" ";
            foreach($value as $vkey => $vval) { echo $vkey."=\"".$vval."\" "; }
            echo "></".$value['elem'].">";
            echo "<br>";
        }
        echo "<br>";
        echo "<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"2000000\" />";
        echo "<input name=\"userfile\" type=\"file\" accept=\".jpg\" required />";
        echo "<input type=\"submit\" value=\"Отправить файл\" />";
        echo "<input type=\"reset\" value=\"Сбросить\" />";
        echo "</form>";
        ?>
    </div>
    <script src="./js/getLog.js"></script>
    <script src="./js/reg-log-valid.js" async></script>
    <script src="./js/switch-screens.js" async></script>
    <script src="./js/req-reg.js"></script>
    <script src="./js/pfor-exit.js"></script>
    <br>
    <?php $smarty->display('footer.tpl');?>
</body>
</html>


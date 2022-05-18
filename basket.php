<?php
    include 'template_start.php';
?>
<div>
	
	<br><a href = "index.php"> <center> <img src = "Emblema1.png" width = "200" height = "200" /> </center> </a><br>
</div>



<?php 
    if ( $_COOKIE['userID'] == 0 )
    {
        //'<p style="text-align: center">'.'</p>';
        echo '<p style="text-align: center">'. "Ваша корзина пуста. Перейдите в каталог, чтобы выбрать товары".'</p>';
        die();
    }
?>
<style>
        table {
border-spacing: 0 10px;

font-family: 'Open Sans', sans-serif;
font-weight: bold;
}

th {
padding: 10px 20px;
background: #80DAEB;
color: #FFFFFF;
border-right: 2px solid; 
font-size: 0.9em;
}
th:first-child {
text-align: left;
}
th:last-child {
border-right: none;
}
td {
vertical-align: middle;
padding: 10px;
font-size: 14px;
text-align: center;
border-top: 2px solid #56433D;
border-bottom: 2px solid #56433D;
border-right: 2px solid #56433D;
}
td:first-child {
border-left: 2px solid #56433D;
border-right:2px solid #56433D;
}
td:nth-child(2){
text-align: left;
}
.posl{
    border-top: none;
border-bottom:none;
border-right:none;
}
</style>
<?php

    if ( $_POST['zakaz'] )
    {
        $req_order = "SELECT * FROM `basket` WHERE `userID`='" . $_COOKIE['userID'] . "'";
        $res_order = mysqli_query($link, $req_order) or die("Ошибка " . mysqli_error($link));

        $basket_Products = "";

        while($result = mysqli_fetch_array($res_order)) {
            $basket_Products = $basket_Products . ' ' . $result["productID"];
        }
        $req_add = "INSERT INTO `orders`(`userID`, `products`, `date`, `phone`, `address`, `comment`) 
        VALUES ('" . $_COOKIE[ 'userID' ] . "', '" . $basket_Products . "', '" . date('m.d.y') . "', '" . $_POST['phone'] ."', '". $_POST['address'] ."', '". $_POST['comment'] ."')";
        $res_add = mysqli_query($link, $req_add) or die("Ошибка " . mysqli_error($link));

        $req_delete = "DELETE FROM `basket` WHERE `userID`='" . $_COOKIE['userID'] . "'";
        $res_delete = mysqli_query($link, $req_delete) or die("Ошибка " . mysqli_error($link));

        echo "<script>alert('Спасибо за заказ!')</script>";

    }       
    
?>

<?php

    if ( $_POST['del'] )
    {
        $req_delete = "DELETE FROM `basket` WHERE `productID`='" . $_COOKIE['productForDelete'] . "'";
        $res_delete = mysqli_query($link, $req_delete) or die("Ошибка " . mysqli_error($link));

        setcookie('productForDelete', '');
        echo "<script>alert('Товар удален!')</script>";

    }       
    
?>


<?php
        $sum_cost = 0;

        $man_array = array();
    
        $req_man = "SELECT * FROM `manufacturers` WHERE 1";
        
        $res_man = mysqli_query($link, $req_man) or die("Ошибка " . mysqli_error($link));
        
        if ( !$res_man )
        {
            echo "Ошибка БД";
            die();
        }
        
        for ( $i = 0; $i < mysqli_num_rows( $res_man ) ; $i++ )
        {
            $man = mysqli_fetch_row($res_man);
            $man_array[ $man[ 0 ] ] = $man[ 1 ];
        }
?>

<?php
        $type_array = array();
        $req_type = "SELECT * FROM `type` WHERE 1";
        
        $res_type = mysqli_query($link, $req_type) or die("Ошибка " . mysqli_error($link));
        
        if ( !$res_type )
        {
            echo "Ошибка БД";
            die();
        }
        
            
        for ( $i = 0; $i < mysqli_num_rows( $res_type ) ; $i++ )
        {
            $man = mysqli_fetch_row($res_type);
            $type_array[ $man[ 0 ] ] = $man[ 1 ];
        }
?>

<?php
    $req_backet = "SELECT * FROM `basket` WHERE `userID`=" . $_COOKIE['userID'];
    $res_backet = mysqli_query($link, $req_backet) or die("Ошибка " . mysqli_error($link));
        
    if ( !$res_backet )
    {
        echo "Ошибка БД";
        die();
    }
    
    $array_backet = array();
    
    for ( $i = 0; $i < mysqli_num_rows($res_backet); $i++ )
    {
        $backet = mysqli_fetch_array($res_backet);
        $array_backet[ $i ] = $backet[ 2 ];
    }
    $req_prod = "SELECT * FROM `products`";
    $res_prod = mysqli_query($link, $req_prod) or die("Ошибка " . mysqli_error($link));
        
    if ( !$res_prod )
    {
        echo "Ошибка БД";
        die();
    }
?>
<form action="" method='post'>
<?php if (mysqli_num_rows($res_backet) != 0) { ?>
<table class="auto-style7" >
        <tr>
            <th>QR код</th> 
            <th>Цена</th>
            <th>Производитель</th>
            <th>Фото</th>
            <th>Название продукта</th>
            <td class="posl"></td>
        </tr>
        
        <?php
            $cnt = mysqli_num_rows( $res_prod );
            for ( $i = 0; $i < $cnt; $i++ )
            {
                $prod = mysqli_fetch_row($res_prod);
                $flag = 0;
                
                for ( $j = 0 ; $j < count($array_backet) ; $j++ )
                {
                    if ( $prod[ 0 ] == $array_backet[ $j ] )
                    {
                        $flag = 1;
                        break;
                    }
                }
                
                if ( $flag )
                {
                    echo "<tr>";
                    echo "<td>" . $prod[ 0 ] . "</td>";
                    echo "<td>" . $prod[ 2 ] . " ₽</td>";
                    echo "<td>" . $man_array[ $prod[ 5 ] ] . "</td>";
                    echo "<td><img width=\"100\" height=\"111\" src=\"images/" . $prod[ 3 ] . "\"></td>";
                    echo "<td>" . $prod[ 1 ] . "</td>";
                    echo "<td class=\"posl\"><input type='submit' value='Удалить' id='{$prod[0]}' name='del' class='button delete-product'></td>";
                    echo "</tr>";
                    
                    $sum_cost += $prod[ 2 ];
                }
            }
    
        ?>
       
    </table>

    <h2><span >Сумма заказа: <?php echo $sum_cost; ?> ₽</span><br /><br />

    <fieldset>
        <legend>Заполните форму для доставки</legend>
        <p>Введите номер телефона:<br /><input name='phone' type='text' placeholder='7ХХХХХХХХХХ'></p>
        <p>Укажите адрес доставки:<br /><textarea name='address'></textarea></p>
        <p>Комментарий:<br /><textarea name='comment'></textarea></p>
    </fieldset>

    <input type="submit" value="Заказать" name="zakaz" class="button">

<?php } else { ?>
    <h3>Корзина пуста... Перейдите в каталог, чтобы выбрать товары.</h3>
<?php } ?>

<?php
    include 'template_end.php';

?>

<script>
    document.addEventListener('click', (e) => {
        if (e.target.classList.contains('delete-product')) {
            document.cookie = "productForDelete=" + e.target.id;
            location.reload();
        }
    });
</script>
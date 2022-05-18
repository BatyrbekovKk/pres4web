<?php
    include 'template_start.php';
?>
<div>
	
	<br><a href = "index.php"> <center> <img src = "Emblema1.png" width = "200" height = "200" /> </center> </a><br>
</div>


<style>
    table {
border-spacing: 0 10px;
font-family: 'Open Sans', sans-serif;
font-weight: bold;
}

th {
padding: 10px 20px;
background: #50C878;
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


</style>
<?php 
    if ( $_COOKIE['userID'] == 0 )
    {
        echo "У вас пока нет заказов. Авторизуйтесь, чтобы сделать заказ.";
        die();
    }
?>

<?php

    if ( $_POST['otmena'] )
    {

        $req_delete = "DELETE FROM `orders` WHERE `userID`='" . $_COOKIE['userID'] . "'";
        $res_delete = mysqli_query($link, $req_delete) or die("Ошибка " . mysqli_error($link));

        echo "<script>alert('Заказ отменен!')</script>";

    }       
    
?>


<?php
    $req_orders = "SELECT * FROM `orders` WHERE `userID`=" . $_COOKIE['userID'];
    $res_orders = mysqli_query($link, $req_orders) or die("Ошибка " . mysqli_error($link));
        
    if ( !$res_orders )
    {
        echo "Ошибка БД";
        die();
    }
?>
<form action="" method='post'>
<table class="auto-style7" border="1">
        <tr>
            <th>Номер заказа</th>
            <th>ID продуктов</th>
            <th>Адрес доставки</th>
            <th>Номер телефона</th>
            <th>Комментарий</th>
            <th>Дата заказа</th>
            <th>Действия с заказом</th>
        </tr>
        
        <?php
            $cnt = mysqli_num_rows( $res_orders );
            for ( $i = 0; $i < $cnt; $i++ )
            {
                $order = mysqli_fetch_array($res_orders);
                if ( $order )
                {
                    echo "<tr>";
                    echo "<td>" . $order[ 0 ] . "</td>";
                    $productsArray = preg_replace('/[\s]+/u','',$order[2]);
                    $productsArray = str_split($productsArray, 1);
                    $products = '';
                    for ($i=0; $i < count($productsArray); $i++) { 
                        $queryStr = "SELECT nameProduct FROM products WHERE productID='{$productsArray[$i]}'";
                        $query = mysqli_query($link, $queryStr);
                        $result = mysqli_fetch_array($query);
                        $products = $products . ' ' . $result[0];
                    }
                    echo "<td>" . trim($products) . "</td>";
                    echo "<td>" . $order[ 5 ] . "</td>";
                    echo "<td>" . $order[ 4 ] . "</td>";
                    echo "<td>" . $order[ 6 ] . "</td>";
                    echo "<td>" . $order[ 3 ] . "</td>";
                    echo "<td><input type='submit' value='Отменить заказ' name='otmena' class='button'></td>";
                    echo "</tr>";
                }
            }
    
        ?>
       
    </table>

    
<?php
    include 'template_end.php';
?>


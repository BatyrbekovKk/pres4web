<?php
    include 'template_start.php';
?>
<div>
	
	<br><a href = "index.php"> <center> <img src = "Emblema1.png" width = "200" height = "200" /> </center> </a><br>
</div>



<?php
    if ( $_POST[ 'filtr' ] )
    {
        $req_prod = "SELECT * FROM `products` WHERE `typeID`=\"" . $_POST['filtr_field'] . "\"";
    } else {
        $req_prod = "SELECT * FROM `products` WHERE 1";
    }
    $res_prod = mysqli_query($link, $req_prod) or die("Ошибка " . mysqli_error($link));
    

    if ( !$res_prod )
    {
        echo "Ошибка БД";
        die();
    }

?>

<?php
    if ( $_POST['zak'] )
    {
        $userID = $_COOKIE[ 'userID' ]; 
        if ( $_COOKIE[ 'userID' ] == 0 )
        {
            echo "Ошибка";
            die();
        }
        
        $array_zak = $_POST[ 'prod' ];
        
        for ( $i = 0; $i < count( $array_zak ); $i++ )
        {
            $req_zak = "INSERT INTO `basket`(`userID`, `productID`, `date`) 
            VALUES ('" . $userID . "', '" . $array_zak[ $i ] . "', '" . date('m.d.y') . "')";
            
            $res_zak = mysqli_query($link, $req_zak) or die("Ошибка " . mysqli_error($link));
        }
    }

?>

<form action="" method="post">
<input type="submit" value="Показать все" name="all" class="button">
<input type="submit" value="Отфильтровать" name="filtr" class="button">

<select size="1"  name="filtr_field">

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
            if ( $_POST['filtr_field'] == $man[0] )
                echo "<option selected value=\"". $man[0] . "\">". $man[ 1 ] . "</option>";
            else 
                echo "<option value=\"". $man[0] . "\">". $man[ 1 ] . "</option>";
            $man_array[ $man[ 0 ] ] = $man[ 1 ];
        }

?>


   </select>
</form>

<?php
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
            $type_array[ $man[ 0 ] ] = $man[ 1 ];
            $man_array[ $man[ 0 ] ] = $man[ 1 ];

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


</style>
<br>
<form action="" method="post">
<table class="auto-style7" text-align= "center" font-size= "20px">
        <?php
         $userID = $_COOKIE[ 'userID' ]; 
        if ( $_COOKIE[ 'userID' ] != 0 )
        {
            echo "<tr>
            <th>QR код</th>
            <th>Цена</th>
            <th>Производитель</th>
            <th>Фото</th>
            <th>Название продукта</th>
            <th>Описание продукта</th>
            <th>Выбор</th>
            </tr>";
        }
        else{
            echo "<tr>
            <th>QR код</th>
            <th>Цена</th>
            <th>Производитель</th>
            <th>Фото</th>
            <th>Название продукта</th>
            <th>Описание продукта</th>
            </tr>";
        }
        
        
        
            $cnt = mysqli_num_rows( $res_prod );
            for ( $i = 0; $i < $cnt; $i++ )
            {
                echo "<tr>";
                $prod = mysqli_fetch_row($res_prod);
                
                echo "<td>" . $prod[ 0 ] . "</td>";
                echo "<td>" . $prod[ 2 ] . " P</td>";
                echo "<td>" . $man_array[ $prod[ 5 ] ] . "</td>";
                echo "<td><img width=\"100\" height=\"111\" src=\"images/" . $prod[ 3 ] . "\"></td>";
                echo "<td>" . $prod[ 1 ] . "</td>";
                
   
 $req_prod2 = "SELECT * FROM `characteristic` WHERE `productID`=\"" . $prod[ 0 ] . "\"";
 $res_prod2 = mysqli_query($link, $req_prod2) or die("Ошибка " . mysqli_error($link));
				
$prod2 = mysqli_fetch_row($res_prod2);
echo "<td>" . $prod2[ 3 ] . "</td>";



                if ( $_COOKIE[ 'userID' ] != 0 ){
                    echo "<td>  <input type=\"checkbox\" name=\"prod[]\" value=\"".$prod[ 0 ]."\"></td>";
                }
                echo "</tr>";
            }
    
        ?>
       

    </table>
    
    <?php
        if ( $_COOKIE[ 'userID' ] != 0 ){
            echo "<input type='submit' value='Добавить в корзину' name='zak' class='button'>";
            echo "<input type=\"reset\" value=\"Сбросить выбор\" class=\"button\">";
        }
    ?>
    
</form>
<?php
    include 'template_end.php';
?>

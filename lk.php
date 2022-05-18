<?php
    include 'template_start.php';
?>
<div>
	
	<br><a href = "index.php"> <center> <img src = "Emblema1.png" width = "200" height = "200" /> </center> </a><br>
</div>


<?php 
    if ( $_COOKIE['userID'] == 0 )
    {
        echo "Вы не авторизованы";
        die();
    }
?>
<style>
    .box{
    width: 260px;
    margin: 0px auto;
    padding: 3px 20px;
    background-color: #77DDE7;
}
.box .title,
.box .meaning{
    text-align: center;
    padding-top: 10px;
    padding-bottom: 10px;
}
.box .title{
    font-size: 25px;
    font-weight: bold;
}
.box .meaning{
    font-size: 22px;
}
</style>
<?php
        $man_array = array();
        $req_user = "SELECT * FROM users WHERE userID = ". $_COOKIE[ 'userID' ];
        $res_user = mysqli_query($link, $req_user ) or die("Ошибка " . mysqli_error($link));
    if ( $res_user ) {
        $user = mysqli_fetch_row($res_user);
        $name_user = $user[ 1 ];
        $last_name_user = $user[ 2 ];
        $pochta_user = $user[ 5 ];
        echo "<div class=\"box\">
  <div class=\"title\"> Ваша персональная информация:</div><div class=\"meaning\">Ваше имя: <i>".$name_user."</i><br>";
        echo "Ваша фамилия: <i>".$last_name_user."</i><br>";
        echo "Ваша почта: <i>".$pochta_user."</i>";
        echo "  <div class=\"title\"> Желаете изменить данные?</div>";
    } else {
        echo "Ошибка БД";
    }
?>

<?php 
    $msg = "";
    if ( $_POST[ 'save_btn' ] )
    {
        if ( $_POST[ 'pass' ] != $_POST[ 'pass2' ] )
        {
            $msg = "Пароли отличаются";
        } else {
        
            $req_upd = "UPDATE `users` SET `name`=\"". $_POST['name'] ."\",`login`=\"". $_POST['login'] ."\",`password`=\"".$_POST['pass']."\",`email`=\"". $_POST['email'] ."\", WHERE `userID`=". $_COOKIE['userID'] ;
        
            $res_upd = mysqli_query($link, $req_upd) or die("Ошибка " . mysqli_error($link));
        
            if ( $res_upd )
            {
                $msg = "Данные успешно изменены";
            } else {
                $msg = "Ошибка БД";
            }
        }
    }
?>


<?php
    $ID_user = $_SESSION[ 'userID' ];
    echo $_SESSION[ 'userID' ];
    $req_user = "SELECT * FROM `users` WHERE `userID`=\"" . $ID_user . "\"";
        
    $res_user = mysqli_query($link, $req_user) or die("Ошибка " . mysqli_error($link));
        
    if ( $res_user )
    {
        $user = mysqli_fetch_row($res_user);
                
        $name_user = $user[ 1 ];
        $login_user = $user[ 2 ];
        $pass_user = $user[ 3 ];
        $email_user = $user[ 4 ];
            
    } else {
        echo "Ошибка БД";
    }

?>

    <form action="" method="post">
    <table class="auto-style7">
        <tr>
            <td>Имя:</td>
            <td>
                <input type="text" size="20" name="name" Value="<?php echo $name_user;?>">
            </td>
        </tr>
        <tr>
            <td>Логин:</td>
            <td>
                <input type="text" size="20" name="login" Value="<?php echo $login_user;?>">
            </td>
        </tr>
        <tr>
            <td>Пароль:</td>
            <td>
                <input type="password" size="20" name="pass" Value="<?php echo $pass_user;?>">
            </td>
        </tr>
        <tr>
            <td>Подтвердите пароль:</td>
            <td>
                <input type="password" size="20" name="pass2" Value="<?php echo $pass_user;?>">
            </td>
        </tr>
        <tr>
            <td>Почта:</td>
            <td>
                <input type="email" size="20" name="pass2" Value="<?php echo $email_user;?>">
            </td>
        </tr>
        <tr>
            <td>
                <span style="color:#be9656">
                <?php echo $msg; ?>
                </span>
            </td>
            <td>
                <input type="submit" value="Изменить" name="save_btn" class="button">
                <input type="reset" value="Сбросить" class="button">
            </td>
        </tr>
    </table>
    </form>

 <form action="" method="GET">

<?php
    include 'template_end.php';
?>


<?php
    include 'template_start.php';
?>


<?php 
    if ( $_COOKIE['userID'] != 0 )
    {
        echo "Вы авторизованы";
        die();
    }
?>

<?php
    $msg = "";
    if ( $_POST['reg_btn'] )
    {
            $new_name = $_POST[ 'new_name' ];
            $new_lastname = $_POST[ 'new_lastname' ];
            $new_log = $_POST[ 'new_log' ];
            $new_pass = $_POST[ 'new_pass' ];
            $new_pass2 = $_POST[ 'new_pass2' ];
            $new_email = $_POST[ 'new_email' ];
            
            if ( $new_pass != $new_pass2 )
            {
                $msg = "пароли отличаются";
            } else {
                $req = "INSERT INTO `productShop`.`users`(`userID`, `name`, `lastname`, `login`, `password`, `email`) 
                VALUES (NULL, '".$new_name."', '".$new_lastname."', '".$new_log."', '".$new_pass."', '".$new_email."')";
                
                $reg = mysqli_query($link, $req) or die("Ошибка " . mysqli_error($link));
        
                if ( $reg )
                {
                    $msg = "Вы успешно зарегистрированы";
                } else {
                    $msg = "Ошибка БД";
                }
            }
    }
?>

    <form action="" method="post">
    <table class="auto-style7">
        <tr>
            <td>Введите имя:</td>
            <td>
                <input type="text" size="20" name="new_name">
            </td>
        </tr>
        <tr>
            <td>Введите фамилию:</td>
            <td>
                <input type="text" size="20" name="new_lastname">
            </td>
        </tr>
        <tr>
            <td>Введите логин:</td>
            <td>
                <input type="text" size="20" name="new_log">
            </td>
        </tr>
        <tr>
            <td>Введите пароль:</td>
            <td>
                <input type="password" size="20" name="new_pass">
            </td>
        </tr>
        <tr>
            <td>Подтвердите пароль:</td>
            <td>
                <input type="password" size="20" name="new_pass2">
            </td>
        </tr>
        <tr>
            <td>Почта:</td>
            <td>
                <input type="email" size="20" name="new_email">
            </td>
        </tr>
        <tr>
            <td>
                <span style="color:#be9656">
                <?php echo $msg; ?>
                </span>
            </td>
            <td>
                <input type="submit" value="Зарегистрироваться" name="reg_btn" class="button">
                <input type="reset" value="Сбросить" class="button">
            </td>
        </tr>
    </table>
    </form>

<?php
    include 'template_end.php';
?>

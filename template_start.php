<?php
        session_start();
        include "DB_param.php";
?>
    <?php
        if ( $_POST['entry'] )      {
            $login = $_POST[ 'login' ];
            $pass = $_POST[ 'pass' ];
            $req_user = "SELECT * FROM `users` WHERE `login`='".$login."'";
            $res_user = mysqli_query($link, $req_user) or die("Ошибка " . mysqli_error($link));
            if ( $res_user )           {
                $user = mysqli_fetch_array($res_user);
                
                if ( $user[ 4 ] == $pass )                {
                    setcookie("userID", $user[0]);
                    setcookie("name", $user[1]);
                    setcookie("login", $user[3]);
                    echo "<script>location.reload();</script>";
                } else {
                    echo "<script>alert('Неверный логин или пароль')</script>";
                }
                
            } else {
                echo "Неверный логин";
            }
        }
        if ( $_POST[ 'exit' ] )       {
            setcookie("userID", 0);
            setcookie("name", "");
            setcookie("login", "");
            session_destroy();
            echo "<script>
            window.location.href = window.location.href;
            </script>";
        }
    ?>

<html>
<head>
    <title>FoodBox</title>
    <link rel="stylesheet" href="slide/css/skin 1/style.css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link href="css/style_font.css" rel="stylesheet" type="text/css" />
    <link href="css/style_input.css" rel="stylesheet" type="text/css" />
    <link href="css/style_button.css" rel="stylesheet" type="text/css" />  
    <link href="https://fonts.googleapis.com/css?family=Kaushan+Script|Montserrat:400,700&amp;subset=cyrillic-ext" rel="stylesheet">

    <style>
        #navbar {
            margin: 1;
            /* font-family: 'Montserrat', sans-serif; */
            font-family: 'Kaushan Script', cursive;


            padding: 0;
            list-style-type: none;
            border: 1px solid #fff;
            border-radius: 20px 5px;
            width: auto;
            text-align: center;
            background-color: #33ADFF;
            font-size: 20px;
        }
        #navbar li {
            display: inline;
        }
        #navbar a {
            color: #fff;
            padding: 5px 10px;
            text-decoration: none;
            font-weight: bold;
            display: inline-block;
            width: 100px;
        }
        /* #navbar a:hover {
            border-radius: 20px 5px;
            background-color: #0066FF;
        } */
        .menu {
            text-align: center
            width: 0px;
            padding: 10px;
            margin: auto;
        }
        /* #header{
            width: 100%;
            height: 9.5%;
            background-image: url(images/Shapka.svg);
            background-attachment:fixed;
        } */

    </style>
</head>
    <header id = "header"  >
        <!-- <div class = "font_header">
            Продукты в Коробочке
        </div>
        <div class="post-detail">
            <span class="post-info">
                <span>
                    Мы лучшие в вашем городе!
                </span>
            </span>
            <span>
                г. Санкт-Петербург, Биржевая линия, д. 16
            </span>
        </div> -->
</header>
    
<body>
    <form action="" method='post'>
    <div class="menu" position: absolute; left: 50%; >   
    <ul id="navbar">
        <li><a href="index.php">Главная страница</a></li>
        <li><a href="cat.php">Каталог продуктов</a></li>
        <li><a href="contacts.php">Контакты / О нас</a></li>
        <li><a href="gallery.php">Галерея магазина</a></li>
        <li>
            <?php 
                if ( $_COOKIE[ "userID" ] != 0 ){
                    echo"<a href=\"basket.php\">Моя корзина</a></li>";
                }
            ?>   
        </li>
        <li>
            <?php 
                if ( $_COOKIE[ "userID" ] != 0 ){
                    echo"<a href=\"myOrders.php\">Мои заказы</a></li>";
                }
            ?>   
        </li>
        <li>
            <?php 
                if ( $_COOKIE[ "userID" ] == 0 ){
                    echo"<a href=\"authorization.php\">Авторизация на сайте</a></li>";
                }
                else{
                    echo"<a href=\"lk.php\">Личный кабинет</a></li>";
                }
            ?>   
        </li>
        <li>
            <?php 
                if ( $_COOKIE[ "userID" ] == 0 ){
                    echo"<a href=\"registration.php\">Регистрация на сайте</a></li>";
                }
                else{
                    // echo "Здравствуйте, ". $_COOKIE["name"];
                }
            ?>                
        </li> 
        <li>
            <?php 
                if ( $_COOKIE[ "userID" ] == 0 ){
                    // echo "Здравствуйте, Гость";
                }
                else{
                     echo "<input type='submit' value='Выход' name='exit' class='button'> </form>";
                }
            ?>
        </li>
    </ul>
</div>

</body> 

<?php
    include 'template_start.php';
?>


<style>
    .wrapper {
        margin: 50px;
        padding: 15px;
        background: #be9656;
        border-radius: 50px;
        color: #ffebcc;
    }
    .about--block {
        display: flex;
        flex-wrap: nowrap;
        justify-content: space-between;
    }

    .about--info {
        flex: 0 0 30%;
        display: flex;
        flex-direction: column;
        text-align: center;
        align-items: center;
    }

    .about--info img {
        width: 60%;
    }

    .about--info p {
        font-size: 16px;
    }
</style>
<div>
    <br><center> <img src = "Emblema1.png" width = "300" height = "300" /> </center> </a><br>
    <div class="about">
    <div class="wrapper">
        <h1 style='text-align:center; margin: 5px 0 50px; line-height: 1.3;'>Сохраняйте время, энергию и деньги<br>для того, что важно именно вам</h1>
        <div class="about--block">
            <div class="about--info">
                <img src="images/about2.svg"
                    alt="">
                <p>Доставим день в день, в удобное для вас время</p>
            </div>
            <div class="about--info">
                <img src="images/about3.svg"
                    alt="">
                <p>Привезем тяжелые сумки прямо до вашей двери</p>
            </div>
            <div class="about--info">
                <img src="images/about1.svg"
                    alt="">
                <p>Выберем лучшие продукты, как для себя</p>
            </div>
        </div>
    </div>
</div>

<div>
    <?php
    $str=substr(basename($_SERVER["PHP_SELF"]),0,-4);
   include "statistics.php";
?>
</div>

<?php
    include 'template_end.php';
?>


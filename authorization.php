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
<form action="" method='post'>
<?php
                        if ( $_COOKIE[ "userID" ] == 0 ){
                           	echo "
                           	<table class=\"auto-style7\" style=\"ertical-align:top\">
                           		<tr>
                           			<td>
                            			Логин:
                        			</td>
                        			<td>
                        				<span class='auth_input'>
                        					<input type='text' size='20' name='login'>
                        				</span>
                        			</td>
                        		</tr>";
                               
                            echo "
                            	<tr>
                            		<td>
                            			Пароль:
                            		</td>
                        			<td>
                        				<span class='auth_input'>
                        					<input type='password' size='20' name='pass'>
                        				</span>
                        			</td>
                        		</tr>
                        		<tr>
                        			<td>
                        				<input type='submit' value='Вход' name='entry' class='button'>
                        			</td>
                        		</tr>
                        	</table>";
                        }
?>


<?php
    include 'template_end.php';
?>
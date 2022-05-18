<html>
<body>
<?php


$data=date("d.m");
// определение ip -посетителя
$ip=$_SERVER["REMOTE_ADDR"];
// файл для сохранения ip
$file1="ip".$str.".txt";
//  файл для подсчета посещений, дата число посетителей за текущии сутки
$file2="count".$str.".txt";
//проверка на наличие файла
if (!file_exists($file2))
{
	$vsego=1;
	$segodny=1;
	$ipkol=1;
	$count=$vsego."\n".$data."\n".$segodny;
	//Создание нового файла для сохранения данных
	$chek=fopen($file2,"w+");
	fwrite($chek,$count);
	fclose($chek);
	$ip2=fopen($file1,"w+");
	fwrite($ip2,$ip."\n");
	fclose($ip2);
}
else
{
	  //формирование массива строк (кол-во посещений, дата,  всего посещений)
	$file=file($file2);
	foreach($file as $stroka)
	{
		$mass[]=$stroka;
	}
	$vsego=(int)$mass[0];
	$data2=(float)$mass[1];
	$segodny=(int)$mass[2];
	$vsego++;
	if($data2!=$data)
	{
	$segodny=1;}
	else
	{$segodny++;  }
//запись новой информации
$count2= $vsego."\n".$data."\n".$segodny;

    $chek=fopen($file2,"w+");
     // запирание файла
    flock($chek,LOCK_EX);
	fwrite($chek,$count2);
	// отпирание файла
	flock($chek,LOCK_UN);
	fclose($chek);
	$ip2=file($file1);
	$ipkol=count($ip2);
	if(in_array($ip."\n",$ip2)==false)
	{
	$ipopen=fopen($file1,"a");
	flock($ipopen,LOCK_EX);
	fwrite($ipopen,$ip."\n");
	 flock($ipopen,LOCK_UN);
	$ipkol++;
	fclose($ipopen);
	}
}
echo"<table align=center border=2 borderColor='white' bgcolor=#33ADFF ><tr>
<td colspan=2 align=center> <font color = #FFFFFF>ПОСЕЩАЕМОСТЬ за $data</font></td></tr>
<tr><th align=center> <font color = #FFFFFF>Всего</font></th><th align=center> <font color = #FFFFFF>Сегодня</font></th></tr>
<tr><td align=center> <font color = #FFFFFF>$vsego</font></td align=center><td><font color = #FFFFFF>$segodny</font></td></tr>
<tr><td colspan=2 align=center><font color = #FFFFFF>Посетителей IP: $ipkol</font></td></tr></table>";
?>

</body>

</html>
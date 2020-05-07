<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");
$start_time=microtime(true);
 ?>
<!DOCTYPE HTML PUBLIC>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Удаление дубликатов</title>
 </head>
 <body>
<br>
Удаление дубликатов + сортировка 
<br>
<form method=post>
  <p><b>Введите Данные:</b></p>
  <p><textarea name="myinf"  cols="70" rows="12" required></textarea></p>
  <p><input type="checkbox" name="htmlclean" value="1"<?php if (isset($_POST["htmlclean"])) {echo(" checked");} ?>>htmlspecialchars</p>
  <p><input type="submit"></p>
</form>
<br>
<?php
if (isset($_POST["myinf"])) //обработка формы
{
$myinfa = $_POST["myinf"];

$numoldstroka = strlen ($myinfa); // длинна строки

if ($numoldstroka < 3) die ("ОШИБКА Мало ДАННЫХ!"); // защита от дурака

$myinfa = str_replace("\r", "", $myinfa); // удалить виндовс символ
$myinfa = explode("\n", $myinfa); // разбить строку в массив
$myinfa = array_diff($myinfa, array('')); // удалить пустые элементы массива
$numlog = count ($myinfa); // число сток-массива

if ($numlog == 0) die ("ОШИБКА НЕТ ДАННЫХ!"); // защита от дурака

asort($myinfa);

$myinfa = array_unique($myinfa);    //уникализация

$numlog2 = count ($myinfa);

print '<pre>';
if (isset($_POST["htmlclean"])) //обработка чекбокса clean
				{	
	foreach ($myinfa as $value) {
         echo "".htmlspecialchars($value, ENT_QUOTES)."\r\n"; //показать
}

				} ELSE {
	foreach ($myinfa as $value) {
         echo "".$value."\r\n"; //показать
}

						}
print '</pre>';

echo "<br><p>Уникальных строк: ".$numlog2." Удалено дубликатов: <b>".($numlog-$numlog2)."</b> <br> Обработано ".$numlog." строк, загружено ".$numoldstroka." символов </p> <br>";

}

$sec=(microtime(true)-$start_time);
$sec=(round($sec*100000)/100);
echo "Выполнено за $sec мс\r\n";
 ?>
 </body>
</html>
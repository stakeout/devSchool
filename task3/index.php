<?php 
error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);
ini_set('display_errors', 1);
//Массив с рандомными датами
$date = array();
for($i=0; $i < 5; $i++) {
	array_push($date, rand(1, time()));
}
echo '<pre>';
print_r($date);
echo '</pre>';
echo '<hr>';
// Наименьший день
$days = array();
for($i=0; $i < 5; $i++){
	array_push($days, date('j', $date[$i]));
}
echo 'Наименьший день: '.min($days);
echo '<hr>';
// Наибольший месяц
$month = array();
for($i=0; $i < 5; $i++){
	array_push($month, date('F', $date[$i]));
}
echo 'Наибольший месяц: '.max($month);
echo '<hr>';
sort($date);
echo 'Сортировка массива по возрастанию дат:';
echo '<br>';
foreach ($date as $key => $value) {
	$key++;
	echo "{$key} значение - {$value}<br>";
}
echo '<hr>';
//вытаскиваем последний элемент массива в переменную $selected
$selected = array_pop($date);
echo 'Извлекаем последний элемент массива $date с помощью функции array_pop и записываем ее в переменную $selected: ==> '.$selected.'';
echo '<hr>';
// Часовой пояс из переменной
echo 'Часовой пояс из $selected: ' .date('d:m:y H:i:s', $selected);
echo '<hr>';
// Мой локальный часовой пояс
echo 'Локальное время: '.date('l d.m.y. h:i:s');
echo '<hr>';
// Часовой пояс NY
date_default_timezone_set('America/New_York');
echo 'Часовой пояс Нью-Йорка: ' .date('l d:m:y H:i:s');
echo '<hr>';
// Ниже идут личные заметки по лекции
//Округлит до ближайшего целого
echo 'ceil: '.ceil(4.76969).'<br>';
//Округлит до целого
echo 'floor: '.floor(4.76969).'<br>';
//Округлит до ближайшего целого, либо плавающее число после точки
echo 'round: '.round(6.76969,1).'<br>'; //результат 6.8
//ищем минимальный и максимальный индекс массива
$arr = Array(54,72,28,8,13);
echo min($arr);
echo '<br>';
echo max($arr);
echo '<br>';
//выводим рандомное число заданного диапазона
echo 'Рандомное число заданного диапазона (1-100): ' .rand(1, 100). '';
echo '<br>';
//рандомное число по кол-ву секунд от 1970 года
mt_srand(time());
echo 'Рандомное число функции mt_rand(10, 100): '.mt_rand(10, 100).'';
echo '<br>';
//работа со строковыми функциями
$str = 'hello my dear friend';
echo 'Длина строки составляет: ' .strlen($str).' символов';
echo '<br>';
//убираем пробелы слева и справа
$str1 = ' ..|  hello mate  ';
ltrim($str1);
rtrim($str1);

echo 'Обрезаем в строке \'..|&nbsp;&nbsp;&nbsp;&nbsp;   hello mate  \' пробелы и не только: ' .trim($str1, '|. ').''; //регуляркой убираем ненужные символы
echo '<br>';
echo 'Переводим строку в верхний регистр: ' .strtoupper($str).'';
echo '<br>';
echo 'Переворачиваем строку справа-налево: ' .strrev($str).'';
echo '<br>';
echo 'функция substr, забираем из строки некоторую подстроку ($str, 0(начальная поизиция), 8(кол-во символов)) можно забрать с конца строки (первый параметр отрицательный) ' .substr($str, 0,8);
echo '<br>';
echo 'функция strstr($str, 5) ' .strstr($str,'my').'';
echo '<br>';
echo ' Возвращает количество секунд, прошедших с начала Эпохи Unix (The Unix Epoch, 1 января 1970, 00:00:00 GMT) до текущего времени. ==> ' .time().' секунд.' ;
echo '<hr>';
$timestamp = strtotime('2017-01-12 19:41:00');//mktime(1,1,1,1,1,2016);
echo $timestamp;
echo '<hr>';
echo date('l d.m.y. h:i:s');
echo '<hr>';
echo date_default_timezone_set('Europe/Minsk');
echo date_default_timezone_get();

?>
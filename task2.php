<?php 
$name = 'Вадим';
$age = 35;
echo 'Меня зовут '.$name.'. Мне '.$age. 'лет.';
echo '<br>';
echo <<<HEREDOC1
Меня зовут $name.<br>Мне $age лет.<br>
HEREDOC1;
unset($name, $age);
//constants
define('MY_TOWN', 'Минск');
$town = MY_TOWN;
if(defined("MY_TOWN")==true) {
	echo "Константа MY_TOWN объявлена.";
}
echo '<br>';
echo 'Живу в городе-герое '.$town.'е.';
echo '<br>';
//MY_TOWN = 'Москва';
//Массив ассоциативный
$book = Array('title'=>'"Князь Серебряный"','author'=>'А.К.Толстой','pages'=>293);
$book2 = Array('title'=>'"Во глубине сибирских руд"','author'=>'А.Гессен','pages'=>320);
echo 'Недавно я прочитал книгу '.$book['title']. ', написанную автором '.$book['author']. ', я осилил все '.$book['pages']. 'страниц, мне она очень понравилась.';
echo '<br>';
//Массив индексный
$books =Array($book, $book2);
echo 'Недавно я прочитал книги ' .$books[0]['title']. ' и ' .$books[1]['title'].
', написанные соответственно авторами ' .$books[0]['author']. ' и ' .$books[1]['author'].
', я осилил в сумме ' .($books[0]['pages']+$books[1]['pages']).
' страниц, не ожидал от себя подобного.';
?>
<?php
session_start();
$select_city = array('100101'=>'Минск',
    '100102'=>'Москва',
    '100103'=>'Берлин',
    '100104'=>'Париж');
$select_category = array('90101'=>'Авто',
    '90102'=>'Цветы',
    '90103'=>'Игры',
    '90104'=>'Книги');

function city_select_parse($arr){
    foreach($arr as $key => $value){
        echo '<option value="' .$key. '">' .$value. '</option>';
    }
}
function category_select_parse($arr){
    foreach($arr as $key => $value){
        echo '<option value="' .$key. '">' .$value. '</option>';
    }
}
$_SESSION['history']=$_POST;
print_r($_SESSION);
?>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <title>6 задание devschool</title>
        <link href="style.css" rel="stylesheet">
    </head>
<body>
    <div class="form-wrapper">
        <form action="" method="post">
            <div class="form-header">
                <label for="privat"><input type="radio" id="privat" name="radio">Частное лицо</label>
                <label for="company"><input type="radio" id="company" name="radio">Компания</label>
            </div>
            <div class="form-body">
                <label for="name">Ваше имя<input type="text" id="name" name="name"></label>
                <label for="email">Электронная почта<input type="email" id="email" name="email"></label>
                <label class="newsletter" for="newsletter"><input type="checkbox" id="newsletter">Я не хочу получать вопросы по объявлению на e-mail</label>
                <label for="phone">Номер телефона<input type="tel" id="phone" name="phone"></label>
                <label for="town">Город
                    <select id="town">
                        <option>Выберите город</option>
                        <?php echo city_select_parse($select_city); ?>
                    </select>

                </label>
                <label for="cathegory">Категория
                    <select id="cathegory">
                        <option>Выберите категорию</option>
                        <?php echo category_select_parse($select_category); ?>
                    </select>
                </label>
                <label for="notification">Название объявления<input type="text" id="notification" name="notification"></label>
                <label for="message">Описание объявления<textarea id="message" name="message"></textarea></label>
                <label for="price">Цена<input type="text" id="price" class="price" name="price" value="0"><span>руб</span></label>
            </div>
            <button type="submit" class="submit" id="submit">Отправить</button>
        </form>
    </div>
</body>
</html>

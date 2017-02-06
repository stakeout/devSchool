<?php
session_start();
require_once('base.php');
require_once('functions.php');

if (array_key_exists('id', $_POST)) {                //существует ли ключ id в массиве post
    $_SESSION['avito'][$_POST['id']] = $_POST;      //если существует то запишем в сессию массив с ключом = название объявления
    unset($_POST);                                      //убьем POST
    header('location: ./');                        //Сделаем редирект на эту же страницу, чтобы избавиться от повторной отправки формы
}
if (array_key_exists('del', $_GET)) {                    //проверим пришел ли у нас  в GET запрос на удаление через параметр del
    unset($_SESSION['avito'][$_GET['del']]);           //если пришел то удалим его в сессии
    header('location: ./');                        //сделаем редирект сюда же для очистки адресной строки и get
}
if (array_key_exists('change', $_GET)) {                //проверим пришел ли из GET параметр change
    $change = true;                                     //включим команду изменения данных
    $ch_name = $_GET['change'];                        //запомним что пришло
    $session = $_SESSION['avito'][$ch_name];
}

echo '<pre>';
print_r($_POST);
// print_r($_SESSION['avito']);
echo '</pre>';
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
            <label for="privat"><input type="radio" id="privat" name="radio" checked>Частное лицо</label>
            <label for="company"><input type="radio" id="company" name="radio" value="company"<?php if ($change && $session['radio'] == 'company') {echo 'checked';} ?>>Компания</label>
        </div>
        <div class="form-body">
            <label for="name">Ваше имя<input type="text" id="name" name="name" value="<?php echo $change ? $session['name'] : ''; ?>"></label>
            <label for="email">Электронная почта<input type="email" id="email" name="email" value="<?php echo $change ? $session['email'] : ''; ?>"></label>
            <label class="newsletter" for="newsletter"><input type="checkbox" id="newsletter" name="newsletter" value="newsletter" <?php if ($change && array_key_exists('newsletter', $session)) {echo 'checked';} ?>>Я не хочу получать вопросы по объявлению на e-mail</label>
            <label for="phone">Номер телефона<input type="tel" id="phone" name="phone" value="<?php echo $change ? $session['phone'] : ''; ?>"></label>
            <label for="town">Город

                <?php echo select_parse($select_city, 'town', 'town', 'Выберите город', $session['town']); ?>


            </label>
            <label for="category">Категория

                <?php echo select_parse($select_category,'category', 'category', 'Выберите категорию', $session['category']); ?>

            </label>
            <label for="notification">Название объявления<input type="text" id="notification" name="notification" value="<?php echo $change ? $session['notification'] : ''; ?>"></label>
            <label for="message">Описание объявления<textarea id="message" name="message"><?php echo $change ? $session['message'] : ''; ?></textarea></label>
            <label for="price">Цена<input type="text" id="price" class="price" name="price" value="<?php echo $change ? $session['price'] : ''; ?>"><span>руб</span></label>
        </div>
        <input type="hidden" name="id" value = "<?php echo $ch_name; ?>">
        <button type="submit" class="submit" id="submit" name="submit"><?php echo $change ? 'Сохранить' : 'Отправить'; ?></button>
    </form>
    <?php
    echo '<table>';
    foreach ($_SESSION as $key => $value) {
        if ($key == 'avito') {
            foreach ($value as $key => $value) {
                echo '<tr>'
                    . '<td>' . '<a href = ?change=' . $key . '> ' . $value['notification'] . '</a></td>'
                    . '<td>' . $value['price'] . ' руб. </td>'
                    . '<td>' . $value['name'] . '</td>'
                    . '<td>' . '<a href = ?del=' . $key . '>Удалить' . '</a></td></tr>'
                ;
            }
        }
    }
    echo '</table>';
    ?>
</div>
</body>
</html>

<?php
require_once ('base.php');
function all_news_parse($arr)
{
    if(isset($arr) && array_filter($arr)){
        echo "<h2> Список всех новостей </h2>"
            . '<ul>';
        foreach($arr as $key => $value){
            echo '<li>' .$value. '</li>';
        }
        echo '</ul>';
    }else{
        return false;
    }
}
function news_by_number($arr, $id)
{
    echo "<h2> Локальная новость </h2>";
    echo '<p>' .$arr[$id]. '</p>';
}
if (isset($_POST['id'])){
    $id = $_POST['id'];
}elseif(isset($_GET['id'])){
    $id = $_GET['id'];
}

if (isset($id) && !empty($id)){
    if ($news[$id]){
        news_by_number($news, $id);
    }else{
        all_news_parse($news);
    }
}elseif(isset($id) && empty($id)){
    header("HTTP/1.0 404 Not Found");
    die('Хакеры');
}else{
    all_news_parse($news);
}
//$post_id = $_POST['id'];
//$get_id = $_GET['id'];
//$id = array();
////унифицируем переменную id для работы и с GET и с POST
//if(empty($post_id)){
//    $id['id'] = $get_id;
//}else{
//    $id['id'] = $post_id;
//}
////проверяем пришедший массив, если пустой выводим все новости
//if(empty($id)){
//    all_news_parse($news);
////если массив не пустой
//}else{
////проверяем, есть ли в нем атрибут id
//    if(array_key_exists('id', $id)){
////если есть, проверяем чтобы полученное значение было в массиве новостей и выводим соответствующую новость.
//      if($id['id'] <= count($news) - 1){
//        news_by_number($news, $id['id']);
////Если атрибут id пустой или не входит в рендж - выводим все новости
//      }else{
//        header("HTTP/1.0 404 Not Found");
//        echo "<h1>Ошибка 404</h1>";
//        echo "<p>Такой новости нет на сайте";
//        all_news_parse($news);
//        }
////если атрибута id в массиве нет, выводим 404 ошибку
//    }else{
//      header("HTTP/1.0 404 Not Found");
//      echo "<h1>Ошибка 404</h1>";
//    }
//}
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Метод POST</title>
</head>
<body>
<form method="post" action="index.php">
    <input type="text" placeholder="Введите цифру" name="id" pattern="[0-9]{1,2}">
    <button type="submit">Перейти к новости</button>
</form>
<?php echo $id['id']; ?>
</body>
</html>

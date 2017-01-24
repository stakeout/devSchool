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
$post_id = $_POST['id'];
$get_id = $_GET['id'];
$id ='';
if(empty($post_id)){
    $id = $get_id;
}else{
    $id = $post_id;
}
if(empty($id)){
    all_news_parse($news);
}else{
    if($id <= count($news) - 1){
        news_by_number($news, $id);
    }else{
        header("HTTP/1.0 404 Not Found");
        echo "<h1>Ошибка 404</h1>";
    }
}
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
<?php echo $id; ?>
</body>
</html>

<?php
require_once ('base.php');
echo '<hr>';
echo '<pre>';
echo $news[$_GET['id']];
print_r($news);
echo $news[4];
echo '</pre>';
function all_news_parse($arr)
{
    if(isset($arr) && array_filter($arr)){
        echo "<li> Список всех новостей </li>";
        foreach($arr as $key => $value){
            echo '<li>' .$value. '</li>';
        }
    }else{
        return false;
    }
}
$id = $_GET['id'];
function news_change_by_number($arr, $number)
{
    if(isset($arr) && array_filter($arr) && $number){
        if($number <= count($arr) - 1){
            echo $arr[$number];
        }
    }else{
        header('HTTP/1.0 404 Not Found', true, 404);
    }
}
?>
<ul>
    <?php all_news_parse($news); ?>
</ul>
<p><?php news_change_by_number($news, $id)?></p>

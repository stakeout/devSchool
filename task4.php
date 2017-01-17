<?php 
error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);
ini_set('display_errors', 1);
//========================
$ini_string='
[игрушка мягкая мишка белый]
цена = '.  mt_rand(1, 10).';
количество заказано = '.  mt_rand(1, 10).';
осталось на складе = '.  mt_rand(0, 10).';
diskont = diskont'.  mt_rand(0, 2).';
    
[одежда детская куртка синяя синтепон]
цена = '.  mt_rand(1, 10).';
количество заказано = '.  mt_rand(1, 10).';
осталось на складе = '.  mt_rand(0, 10).';
diskont = diskont'.  mt_rand(0, 2).';
    
[игрушка детская велосипед]
цена = '.  mt_rand(1, 10).';
количество заказано = '.  mt_rand(1, 10).';
осталось на складе = '.  mt_rand(0, 10).';
diskont = diskont'.  mt_rand(0, 2).';
';
echo '<pre>';
echo print_r($ini_string);
echo '</pre>';
echo '<hr>';
$bd=  parse_ini_string($ini_string, true);
print_r($bd);
echo '<hr>';
//echo count($bd);
$total = array();
function parseBasket($name, $param){
    global $total;
    $priceInStock = $param['цена'] * $param['осталось на складе'];
    echo '<tr><td'.$name.'</td>';
    echo '<td>'.$param['цена'].'</td>';
    echo '<td>'.$param['количество заказано'].'</td>';
    echo '<td>'.$param['осталось на складе'].'</td>';
    echo '<td>'.$priceInStock.'</td>';
    echo '</tr>';
    $total['цена'] += $param['цена'];
    $total['количество заказано'] += $param['количество заказано'];
    $total['осталось на складе'] += $param['осталось на складе'];
    $total['цена с наличием на складе'] += $priceInStock;
}
foreach ($bd as $key => $value){
//    echo $key.'<br>';
//    echo '<pre>';
//    print_r($value);
//    echo '</pre>';
    parseBasket($key, $value);
}
foreach($total as $key => $value){
    echo $key. '<br>';
}
echo '<hr>';
?>
<table>
    <caption>Корзина</caption>
    <tbody>
    <tr>
        <td>Название товара</td>
        <td>Цена</td>
        <td>Количество</td>
        <td>Осталось на складе</td>
        <td>цена с наличием на складе</td>
    </tr>
    <tr>
        <td>Итого: <?=count($bd)?></td>
        <td><?=$total['цена']?></td>
        <td><?=$total['количество заказано']?></td>
        <td><?=$total['осталось на складе']?></td>
        <td><?=$total['цена с наличием на складе']?></td>
    </tr>
    </tbody>
</table>

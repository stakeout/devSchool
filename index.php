<?php 
error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);
ini_set('display_errors', 1);
header('Content-type: text/html; charset=utf-8');
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
//echo '<pre>';
//echo print_r($ini_string);
//echo '</pre>';
//echo '<hr>';
$bd=  parse_ini_string($ini_string, true);

/*
 *
 * - Вам нужно вывести корзину для покупателя, где указать:
 * 1) Перечень заказанных товаров, их цену, кол-во и остаток на складе
 * 2) В секции ИТОГО должно быть указано: сколько всего наименовний было заказано, каково общее количество товара, какова общая сумма заказа
 * - Вам нужно сделать секцию "Уведомления", где необходимо извещать покупателя о том, что нужного количества товара не оказалось на складе
 * - Вам нужно сделать секцию "Скидки", где известить покупателя о том, что если он заказал "игрушка детская велосипед" в количестве >=3 штук, то на эту позицию ему
 * автоматически дается скидка 30% (соответственно цены в корзине пересчитываются тоже автоматически)
 * 3) у каждого товара есть автоматически генерируемый скидочный купон diskont, используйте переменную функцию, чтобы делать скидку на итоговую цену в корзине
 * diskont0 = скидок нет, diskont1 = 10%, diskont2 = 20%
 *
 * В коде должно быть использовано:
 * - не менее одной функции
 * - не менее одного параметра для функции
 * операторы if, else, switch
 * статические и глобальные переменные в теле функции
 *
 */
 
 foreach ($bd as $key => $val){
     $bd[$key]['стоимость'] = $bd[$key]['цена']*$bd[$key]['количество заказано'];
     $bd[$key]['скидка по купону'] = diskont_calc($val['diskont'], true);
     
     if( ($key == 'игрушка детская велосипед') && $val['количество заказано'] >=3){
         $bd[$key]['стоимость со скидкой'] = $bd[$key]['стоимость'] - ($bd[$key]['стоимость'] * 0.3);
     }else{
        $bd[$key]['стоимость со скидкой'] = $bd[$key]['стоимость'] - ($bd[$key]['стоимость'] * diskont_calc($val['diskont'], false));
     }
 }
 
$tableCssStyle = ' border="1px" border-collapse="collapse"';
$theader = '';
$tbody;
parseTable($bd);
function parseTable($tableMarkup){
    global $tableCssStyle;
    global $theader;
    global $tbody;
    $col = 1;
    foreach($tableMarkup[key($tableMarkup)] as $key => $value){
        $theader .= '<th>'.$key.'</th>';
        $col++;
    }
    // for($i=0; $i < count($tableMarkup); $i++){
    //     echo '<tr>';
    //     echo $i.' парамамамамам';
    //     foreach ($tableMarkup as $itemName => $itemProp) {
    //         echo $itemName.'<br>';
    //         foreach ($itemProp as $inner_key => $value) {
    //             echo $value . '<br>';
    //         }

    //     }
    //     echo '</tr>';
    // }
}
?>
<table>
    <caption>Корзина</caption>
    <thead>
            <tr>
                <td>Наименование товара</td>
                <td>Цена</td>
                <td>Колличество</td>
                <td>Стоимость товара</td>
                <td>Скидка по купону</td>
                <td>Стоиммость со скидкой</td>
                <td>Остаток на складе</td>
                <td>Итого</td>
            </tr>
            </thead>
    <tbody>
            <?php 
                foreach($bd as $key => $val){
                    
                    
                    echo '<tr>'
                        . '<td>' .$key . '</td>'
                        . '<td>' .$val['цена'] . '</td>'
                        . '<td>' .$val['количество заказано'] . '</td>'
                        . '<td>' .$val['стоимость'] .'</td>'
                        . '<td>' .$val['скидка по купону'] . '</td>'
                        . '<td>' .$val['стоимость со скидкой'] . '</td>'
                        . '<td>' .$val['осталось на складе'] . '</td>';
                    echo '</tr>';
                    
                }
            ?>
    </tbody>
</table>

<?php

    function diskont_calc($diskont, $human = false){
        switch($diskont){
            case 'diskont0':
                if($human){
                    $result = 'Скидок нет';
                }else{
                    $result = 0;
                }
            break;
            case 'diskont1':
                if($human){
                    $result = '10%';
                }else{
                    $result = 0.1;
                }
            break;
            case 'diskont2':
                if($human){
                    $result = '20%';
                }else{
                    $result = 0.2;
                }
            break;
        }
        
        return $result;
    }

?>
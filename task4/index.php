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
$totalGoods = '';
$totalSum = '';
$message = array();
$total = array();
$totalDiscount = '';
foreach ($bd as $key => $val){
    $bd[$key]['стоимость'] = $bd[$key]['цена']*$bd[$key]['количество заказано'];
    $totalGoods += $bd[$key]['количество заказано'];
    $totalSum += $bd[$key]['стоимость'];
    $bd[$key]['скидка по купону'] = diskont_calc($val['diskont'], true);
    $totalDiscount += ($bd[$key]['стоимость'] - ($bd[$key]['стоимость'] * diskont_calc($val['diskont'], false)));
    $bd[$key]['всего едениц'] = $bd[$key]['осталось на складе'] + $bd[$key]['количество заказано'];
    
    if( ($key == 'игрушка детская велосипед') && $val['количество заказано'] >=3){
        $bd[$key]['стоимость со скидкой'] = $bd[$key]['стоимость'] - ($bd[$key]['стоимость'] * 0.3);
    }else{
        $bd[$key]['стоимость со скидкой'] = $bd[$key]['стоимость'] - ($bd[$key]['стоимость'] * diskont_calc($val['diskont'], false));
    }
    
    if ($val['количество заказано'] > $val['осталось на складе']){
        $message['rest'][] = 'Извините, товара '. $key .' не хватает на складе';
    }
}
?>
    <table>
        <caption>Корзина</caption>
        <thead>
        <tr>
            <td>Наименование товара</td>
            <td>Цена</td>
            <td>Количество</td>
            <td>Стоимость товара</td>
            <td>Скидка по купону</td>
            <td>Стоимость со скидкой</td>
            <td>Остаток на складе</td>
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
    <section>
        <div class="left-col" style="float:left; width:30%;">
            <h3>Итого:</h3>
            <p>были заказаны следующие товары:</p>
            <ul>
                <?php foreach($bd as $key => $value){
                    echo "<li> {$key} </li>";
                }?>
            </ul>
            <p>Всего заказано <?php echo $totalGoods; ?> товаров на сумму <?php echo $totalSum; ?>, сумма с учетом скидки составила <?php echo $totalDiscount;?></p>
        </div>
        <div class="right-col" style="float:right; width:70%;">
            <h3>Скидка</h3>
            <p>При заказе игрушка детская велосипед больше 3 штук, Вы получаете уникальную скидку 30%.</p>
            <h3>Сообщения</h3>
            <?php
            if (isset($message['rest']) && array_filter($message['rest'])){       
                foreach($message['rest'] as $key => $value){
                    echo '<p>' . $value .'</p>';
                }
            }
            
            ?>
        </div>
    </section>
    
    
<?php
function diskont_calc($diskont, $human = false){
    switch($diskont){
        case 'diskont0':
            if($human){
                $result = 'Скидки нет';
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
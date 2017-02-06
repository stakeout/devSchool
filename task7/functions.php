<?php
$change = false;
$ch_name = '';
function select_parse($arr, $name, $id='', $zero='', $select_value=''){
    $selected = '';
    $select_html = '';

    $select_html .= "<select name={$name} id={$id}>";

    if (!empty($zero)){
        $select_html .= "<option>{$zero}</option>";
    }

    foreach($arr as $key => $value){
        if (!empty($select_value)) {
            $selected = ($key == $select_value) ? 'selected=""' : '';
        }
        $select_html .= '<option value="' .$key. '" '.$selected.'>' .$value. '</option>';
    }

    $select_html .= '</select>';

    return $select_html;
}
?>
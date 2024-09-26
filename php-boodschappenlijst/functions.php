<?php


function dd($value) {
    echo "<pre>";
    var_dump($value);
    echo "</pre>";

    die();
}

function urlIs($value){
    return $_SERVER['REQUEST_URI'] === $value;
}

function calcSubTotal($price, $number){     
    return number_format($price * $number, 2);
}

function calcTotal($carry, $item){
    $carry += $item;
    return $carry;
}

function showComma($item) {
    $item = preg_replace('/\./', ',', $item);
    return ($item);
   
}

?>
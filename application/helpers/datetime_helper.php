<?php

function get_year($string){

    return date("Y",strtotime($string));

}
function get_month($string){

    return date("m",strtotime($string));

}
function get_date($string){

    return date("d",strtotime($string));

}

function days_between_dates($date1, $date2)
{
    $date1 = strtotime($date1);
    $date2 = strtotime($date2);
    $days = ceil(abs($date1 - $date2)/86400);
    return $days;
}

function get_hash_image_name(){
    return sprintf('%0.0f',(round(microtime(true))*10000)).'_'.strval(rand(10000,99999)).'_'.strval(rand(10000,99999));
}
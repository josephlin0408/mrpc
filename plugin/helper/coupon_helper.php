<?php

function is_coupon_available($coupon_result){

    //type 0: 無限制
    //type 1: 日期限制 coupon_begin and coupon_expire
    //type 2: 次數上限 coupon_limit > coupon_counter

    $coupon_detail = $coupon_result[0];

    if($coupon_detail['coupon_status']!=0)return false;

    switch ($coupon_detail['coupon_type']) {
        case 1:
            if($coupon_detail['coupon_begin'] > strtotime("now"))return false;
            if($coupon_detail['coupon_expire'] < strtotime("now"))return false;
            break;
        case 2:
            if($coupon_detail['coupon_counter'] >= $coupon_detail['coupon_limit'])return false;
            break;
    }

    return true;
}

function get_coupon_value($coupon_result){

    //discount type 0: 打8折
    //discount type 1: 折10元

    $coupon_detail = $coupon_result[0];

    switch ($coupon_detail['coupon_discount_type']) {
        case 0:
            return floatval($coupon_detail['coupon_discount_double']);
            break;
        case 1:
            return intval($coupon_detail['coupon_discount_int']);
            break;
    }

    return false;
}
<?php

function get_shipping_fee($region, $qty, $order_cart_total)
{
    $shipping_fee = 0;

    switch ($region) {
        case 'TW': //本島
            if($order_cart_total < SHIPPING_FEE_TW_FREE_CONDITION) {
                $shipping_fee = SHIPPING_FEE_TW;
            }
            break;
        case 'IL': //外島
            $shipping_fee = SHIPPING_FEE_IL * $qty;
            break;
        case 'AS': //國外
            $shipping_fee = SHIPPING_FEE_AS * $qty;
            break;
    }
    return $shipping_fee;
}

function get_shipping_fee_each_one($region)
{
    $shipping_fee = 0;

    switch ($region) {
        case 'TW': //本島
            break;
        case 'IL': //外島
            $shipping_fee = SHIPPING_FEE_IL;
            break;
        case 'AS': //國外
            $shipping_fee = 0;
            break;
    }
    return $shipping_fee;
}

function get_service_fee($payment_option, $shipping_option)
{
    $service_fee = 0;

    switch ($payment_option) {
        case 1: //貨到付款
            $service_fee += COD_SERVICE_FEE;
            break;
        case 2: //轉帳
            break;
        case 3: //信用卡
            break;
    }


    switch ($shipping_option) {
        case 2:
        case 4:
        case 6:
            $service_fee += PRIORITY_SERVICE_FEE;
            break;
    }

    return $service_fee;
}

//function get_extra_shipping_fee($payment_option, $cart_total){
//
//    $extra_shipping_fee = 0;
//
//    if($payment_option==1)
//    {
//        if ($cart_total < SHIPPING_FEE_TW_FREE_CONDITION) {
//            $extra_shipping_fee = SHIPPING_FEE_TW;
//        }
//    }
//    return $extra_shipping_fee;
//}
<?php
function get_token($array) {

//    if(isset($array['bag_qty']))$token['bag_qty'] = $array['bag_qty'];
//
//    $token['qty_total'] = $array['pink_qty'] + $array['blue_qty'] + $array['green_qty'] +
//        $array['sound_pink_qty'] + $array['sound_black_qty'] +
//        $array['combo_pink_pink_qty'] + $array['combo_blue_pink_qty'] + $array['combo_green_pink_qty'] +
//        $array['combo_pink_black_qty'] + $array['combo_blue_black_qty'] + $array['combo_green_black_qty'] +
//        $array['bag_qty'];
//
//    $token['pink_subtotal'] = $array['pink_qty'] * $token['stick_price'];
//    $token['blue_subtotal'] = $array['blue_qty'] * $token['stick_price'];
//    $token['green_subtotal'] = $array['green_qty'] * $token['stick_price'];
//
//    $token['sound_pink_subtotal'] = $array['sound_pink_qty'] * $token['sound_price'];
//    $token['sound_black_subtotal'] = $array['sound_black_qty'] * $token['sound_price'];
//
//    $token['combo_pink_pink_subtotal'] = $array['combo_pink_pink_qty'] * $token['combo_price'];
//    $token['combo_blue_pink_subtotal'] = $array['combo_blue_pink_qty'] * $token['combo_price'];
//    $token['combo_green_pink_subtotal'] = $array['combo_green_pink_qty'] * $token['combo_price'];
//
//    $token['combo_pink_black_subtotal'] = $array['combo_pink_black_qty'] * $token['combo_price'];
//    $token['combo_blue_black_subtotal'] = $array['combo_blue_black_qty'] * $token['combo_price'];
//    $token['combo_green_black_subtotal'] = $array['combo_green_black_qty'] * $token['combo_price'];
//
//    $token['bag_subtotal'] = $array['bag_qty'] * $token['bag_price'];
//
//    $token['cart_total'] = $token['pink_subtotal'] + $token['blue_subtotal'] + $token['green_subtotal'] +
//        $token['sound_pink_subtotal'] + $token['sound_black_subtotal'] +
//        $token['combo_pink_pink_subtotal'] + $token['combo_blue_pink_subtotal'] +
//        $token['combo_green_pink_subtotal'] + $token['combo_pink_black_subtotal'] +
//        $token['combo_blue_black_subtotal'] + $token['combo_green_black_subtotal'] + $token['bag_subtotal'];

    if(isset($array['order_id']))$token['order_id'] = $array['order_id'];
    if(isset($array['order_hash_id']))$token['order_hash_id'] = $array['order_hash_id'];
    if(isset($array['full_name']))$token['full_name'] = $array['full_name'];
    if(isset($array['shipping_address']))$token['shipping_address'] = $array['shipping_address'];
    if(isset($array['phone_number']))$token['phone_number'] = $array['phone_number'];
    if(isset($array['email']))$token['email'] = $array['email'];
    if(isset($array['account_last_5']))$token['account_last_5'] = $array['account_last_5'];
    if(isset($array['payment_option']))$token['payment_option'] = $array['payment_option'];
    if(isset($array['virtual_account']))$token['virtual_account'] = $array['virtual_account'];

    $token['cart_total'] = $array['cart_total'];
    $token['qty_total'] = $array['qty_total'];
    $token['region_option'] = $array['region_option'];
    $token['shipping_fee'] = get_shipping_fee($array['region_option'], $token['qty_total'], $array['cart_total']);
    $token['service_fee'] = get_service_fee($array['payment_option'],$array['shipping_option']);
    $token['total'] = $array['order_total'];
    $token['discount'] = $array['order_coupon_discount'];
    return $token;
}

<?php

function verify_login_admin($user_data)
{
    $error = false;
    if(isset($user_data['company_id'])) {
        if($user_data['company_status'] == 0) {
            //OK
        }else $error = true;
    }else $error = true;
    if($error)redirect('/?verify=fail', 'location', 301);
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


<?php

function verify_login($user_data)
{
    $error = false;
    if(isset($user_data['company_id'])) {
        if($user_data['company_status'] == 0) {
            //OK
        }else $error = true;
    }else $error = true;
    if($error)redirect('/?verify=fail', 'location', 301);

}
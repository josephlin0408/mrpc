<?php

function get_device()
{
    //Detect special conditions devices
    $iPod = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
    $iPhone = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
    $iPad = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
    $AndroidTablet = false;
    if(stripos($_SERVER['HTTP_USER_AGENT'],"Android") && stripos($_SERVER['HTTP_USER_AGENT'],"mobile")){
        $Android = true;
    }else if(stripos($_SERVER['HTTP_USER_AGENT'],"Android")){
        $Android = false;
        $AndroidTablet = true;
    }else{
        $Android = false;
        $AndroidTablet = false;
    }
    //$webOS = stripos($_SERVER['HTTP_USER_AGENT'],"webOS");
    $BlackBerry = stripos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
    $RimTablet= stripos($_SERVER['HTTP_USER_AGENT'],"RIM Tablet");
    //$msie6 = strpos($_SERVER["HTTP_USER_AGENT"], 'MSIE 6') ? true : false;
    //$msie7 = (bool)preg_match('/msie 7./i', $_SERVER["HTTP_USER_AGENT"] ) ? true : false;
    //$msie8 = (bool)preg_match('/msie 8./i', $_SERVER["HTTP_USER_AGENT"] ) ? true : false;
    //$msie9 = (bool)preg_match('/msie 9./i', $_SERVER["HTTP_USER_AGENT"] ) ? true : false;
    //$msie10 = preg_match('/(?i)msie [10]/',$_SERVER['HTTP_USER_AGENT']) ? true : false;
    //$msie11 = strpos($_SERVER["HTTP_USER_AGENT"], 'Trident/7.0; rv:11.0') ? true : false;
    //$firefox = strpos($_SERVER["HTTP_USER_AGENT"], 'Firefox') ? true : false;
    //$safari = strpos($_SERVER["HTTP_USER_AGENT"], 'Safari') ? true : false;
    //$chrome = strpos($_SERVER["HTTP_USER_AGENT"], 'Chrome') ? true : false;
    //$opera = preg_match('/Opera/i',$_SERVER["HTTP_USER_AGENT"]) ? true : false;

    //do something with this information
    if( $iPod || $iPhone ){
        //were an iPhone/iPod touch -- do something here
        $device = "iPod_iPhone";
    }else if($iPad){
        $device = "iPad";
        //were an iPad -- do something here
    }else if($Android){
        //we're an Android Phone -- do something here
        $device = "Android";
    }else if($AndroidTablet){
        //we're an Android Phone -- do something here
        $device = "Android_Tablet";
    }else if($BlackBerry){
        $device = "BlackBerry";
    }else if($RimTablet){
        //we're a RIM/BlackBerry Tablet -- do something here
        $device = "RIM/BlackBerry_Tablet";
    }else {
        $device = $_SERVER['HTTP_USER_AGENT'];
    }
    return $device;
}
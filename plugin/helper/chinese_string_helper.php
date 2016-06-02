<?php
function get_chinese_name_split($shipToName){
    if(mb_strlen($shipToName,"utf8") == 4){
        $shipToName = mb_substr($shipToName,0,2,"utf-8")." ".mb_substr($shipToName,1,2,"utf-8");
    }
    if(mb_strlen($shipToName,"utf8") == 3){
        $shipToName = mb_substr($shipToName,0,1,"utf-8")." ".mb_substr($shipToName,1,2,"utf-8");
    }
    if(mb_strlen($shipToName,"utf8") == 2){
        $shipToName = mb_substr($shipToName,0,1,"utf-8")." ".mb_substr($shipToName,1,1,"utf-8");
    }
    return $shipToName;
}
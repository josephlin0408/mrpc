<?php
/**
 * developed by Vincent Ho.
 */
    function front_url_address() {
        $url_address = '';
        if($_SERVER["SERVER_ADDR"]=='127.0.0.1'){
            $url_address = '127.0.0.1/travelbox';
        }else{     
            $url_address = 'jvabox.com';
        }
        return $url_address;
    }

    function back_url_address() {
        $url_address = '';
        if($_SERVER["SERVER_ADDR"]=='127.0.0.1'){
            $url_address = '127.0.0.1/mrpc';
        }else{     
            $url_address = 'jvabox.com/admin';
        }
        return $url_address;
    }

    function get_navigation_url($target=NULL,$url=''){
        $my_href = '';
        if(isset($target)){
            switch($target){
                case('_blank'):
                    $my_href = $url;
                    break;
                case('_self'):
                    $my_href = base_url().$url;
                    break;
            }
        }
        return $my_href;
    }
    function v_array_column(array $input, $columnKey, $indexKey = null) {
        $array = array();
        foreach ($input as $value) {
            if ( ! isset($value[$columnKey])) {
                trigger_error("Key \"$columnKey\" does not exist in array");
                return false;
            }
            if (is_null($indexKey)) {
                $array[] = $value[$columnKey];
            }
            else {
                if ( ! isset($value[$indexKey])) {
                    trigger_error("Key \"$indexKey\" does not exist in array");
                    return false;
                }
                if ( ! is_scalar($value[$indexKey])) {
                    trigger_error("Key \"$indexKey\" does not contain scalar value");
                    return false;
                }
                $array[$value[$indexKey]] = $value[$columnKey];
            }
        }
        return $array;
    }
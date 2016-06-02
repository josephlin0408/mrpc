<?php
    function remove_nbsp($string) {
        $TestStr = trim($string);
        $TestStr = preg_replace('/\s(?=)/','', $TestStr);
        $TestStr = str_replace("　","",$TestStr);
        return $TestStr;
    }

    function get_random_hash_file_name($string) {
        if($string!="")$string = sha1($string.rand());
        return $string;
    }
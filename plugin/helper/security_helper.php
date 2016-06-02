<?php
function anti_sql_injection($array)
{
    array_walk($array, 'trim_value');
    $array = str_ireplace(":","",$array);
    $array = str_ireplace("*","",$array);
    $array = str_ireplace("'","",$array);
    $array = str_ireplace("=","",$array);
    $array = str_ireplace("*","",$array);
    $array = str_ireplace("\"","",$array);
    $array = str_ireplace("#","",$array);
    $array = str_ireplace("_","",$array);
    $array = str_ireplace(")","",$array);
    $array = str_ireplace("(","",$array);
    $array = str_ireplace("PASSWORD","",$array);
    $array = str_ireplace("stop","",$array);
    $array = str_ireplace("SELECT","",$array);
    $array = str_ireplace("DROP","",$array);
    $array = str_ireplace("FROM","",$array);
    $array = str_ireplace("/*","",$array);
    $array = str_ireplace("%23","",$array);
    $array = str_ireplace("union","",$array);
    $array = str_ireplace("substring","",$array);
    $array = str_ireplace("load_file","",$array);
    $array = str_ireplace("exists","",$array);
    $array = str_ireplace("mysql","",$array);
    $array = str_ireplace("limit","",$array);
    $array = str_ireplace("ord","",$array);

    return $array;
}

function trim_value(&$value)
{
    $value = trim($value);
}
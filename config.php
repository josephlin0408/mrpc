<?php
if($_SERVER['HTTP_HOST'] == "127.0.0.1")
{
    define('ENVIRONMENT', 'development');
    define("MYSQL_ADDRESS", "localhost");
    define("MYSQL_USERNAME", "master");
    define("MYSQL_PASSWORD", "master");
    define("DATABASE", "asiapoke_shop");
}else{
    define('ENVIRONMENT', 'production');
    define("MYSQL_ADDRESS", 'localhost');
    define("MYSQL_USERNAME", 'tsmediag_shoper');
    define("MYSQL_PASSWORD", 'cN9}-M(H$O,F');
    define("DATABASE", 'tsmediag_shop');
}
define("SUCCESS", true);              // Successful operation flag
define("FAILURE", false);             // Failed operation flag

date_default_timezone_set("Asia/Taipei");
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
clearstatcache();
<?php

define('ENVIRONMENT', 'production');
define("MYSQL_ADDRESS", 'localhost');
define("MYSQL_USERNAME", 'tsmediag_shoper');
define("MYSQL_PASSWORD", 'cN9}-M(H$O,F');
define("DATABASE", 'tsmediag_shop');
define("SUCCESS", true);              // Successful operation flag
define("FAILURE", false);             // Failed operation flag

date_default_timezone_set("Asia/Taipei");
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
clearstatcache();
/***********************************************************************
 * MySQL Constants (scope = global)
 * ----------------------------------------------------------------------*/


if (strlen(MYSQL_ADDRESS) + strlen(MYSQL_USERNAME) + strlen(MYSQL_PASSWORD) + strlen(MYSQL_ADDRESS) + strlen(DATABASE) == 0)
    echo "WARNING: MySQL not configured.<br>\n";

/***********************************************************************
 * Database connection routine (only used by routines in this library
 * ----------------------------------------------------------------------*/
function connect_to_database()
{
    $link = ($GLOBALS["___mysqli_ston"] = mysqli_connect(MYSQL_ADDRESS, MYSQL_USERNAME, MYSQL_PASSWORD));
    mysqli_query($GLOBALS["___mysqli_ston"], "SET NAMES utf8");
    mysqli_query($link, "SET NAMES utf8");
    mysqli_query($link, "SET CHARACTER_SET_database= utf8");
    mysqli_query($link, "SET CHARACTER_SET_CLIENT= utf8");
    mysqli_query($link, "SET CHARACTER_SET_RESULTS= utf8");
    return ($link);
}

/***********************************************************************
 * insert($database, $table, $data_array)
 * -------------------------------------------------------------
 * DESCRIPTION:
 * Inserts a row into database as defined by a keyed array
 * INPUT:
 * $database     Name of database (where $table is located)
 * $table        Table where row insertion occurs
 * $data_array   A keyed array with defines the data to insert
 * (i.e. $data_array['column_name'] = data)
 * RETURNS
 * SUCCESS or FAILURE
 ***********************************************************************/

function j_insert($table, $data_array)
{
    return insert(DATABASE, $table, $data_array);
}

function insert($database, $table, $data_array)
{
    # Connect to MySQL server and select database
    $mysql_connect = connect_to_database();
    ((bool)mysqli_query($mysql_connect, "USE $database"));

    # Create column and data values for SQL command
    foreach ($data_array as $key => $value) {
        $tmp_col[] = $key;
        $tmp_dat[] = "'$value'";
    }
    $columns = join(",", $tmp_col);
    $data = join(",", $tmp_dat);

    # Create and execute SQL command
    $sql = "INSERT INTO " . $table . "(" . $columns . ")VALUES(" . $data . ")";
    // echo $sql;
    $result = mysqli_query($mysql_connect, $sql);

    # Report SQL error, if one occured, otherwise return result
    if (((is_object($mysql_connect)) ? mysqli_error($mysql_connect) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false))) {
        echo "MySQL Update Error: " . ((is_object($mysql_connect)) ? mysqli_error($mysql_connect) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false));

    } else {
        return mysqli_insert_id($mysql_connect);
    }
}

/***********************************************************************
 * update($database, $table, $data_array, $key_column, $id)
 * -------------------------------------------------------------
 * DESCRIPTION:
 * Inserts a row into database as defined by a keyed array
 * INPUT:
 * $database     Name of database (where $table is located)
 * $table        Table where row insertion occurs
 * $data_array   A keyed array with defines the data to insert
 * (i.e. $data_array['column_name'] = data)
 * RETURNS
 * SUCCESS or FAILURE
 ***********************************************************************/
function j_update($table, $data_array, $key_column, $id)
{
    update(DATABASE, $table, $data_array, $key_column, $id);
}

function update($database, $table, $data_array, $key_column, $id)
{
    # Connect to MySQL server and select database
    $mysql_connect = connect_to_database();
    $bool = ((bool)mysqli_query($mysql_connect, "USE $database"));

    # Create column and data values for SQL command
    $setting_list = "";
    for ($xx = 0; $xx < count($data_array); $xx++) {
        list($key, $value) = each($data_array);
        $setting_list .= $key . "=" . "\"" . $value . "\"";
        if ($xx != count($data_array) - 1)
            $setting_list .= ",";
    }

    # Create SQL command

    $sql = "UPDATE " . $table . " SET " . $setting_list . " WHERE " . $key_column . " = " . "\"" . $id . "\"";
    $result = mysqli_query($mysql_connect, $sql);

    # Report SQL error, if one occured, otherwise return result
    if (((is_object($mysql_connect)) ? mysqli_error($mysql_connect) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false))) {
        echo "MySQL Update Error: " . ((is_object($mysql_connect)) ? mysqli_error($mysql_connect) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false));
        $result = "";
    } else {
        return $result;
    }
}

/***********************************************************************
 * exe_sql($database, $sql)
 * -------------------------------------------------------------
 * DESCRIPTION:
 * Executes a SQL command and returns the result
 * INPUT:
 * $database     Name of database to operate on
 * $sql          sql command applied to $database
 * RETURNS
 * An array containing the results of sql operation
 ***********************************************************************/
function j_exe_sql($sql)
{
    return exe_sql(DATABASE, $sql);
}

function exe_sql($database, $sql)
{
    # Connect to MySQL server and select database
    $mysql_connect = connect_to_database();
    ((bool)mysqli_query($mysql_connect, "USE $database"));

    # Execute SQL command
    $result = mysqli_query($mysql_connect, $sql);

    # Report SQL error, if one occured
    if (((is_object($mysql_connect)) ? mysqli_error($mysql_connect) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false))) {
        echo "MySQL ERROR: " . ((is_object($mysql_connect)) ? mysqli_error($mysql_connect) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false));
        $result_set = "";
    } else {
        # Fetch every row in the result set
        for ($xx = 0; $xx < @mysqli_num_rows($result); $xx++) {
            $result_set[$xx] = mysqli_fetch_array($result);
        }

        # If the result set has only one row, return a single dimension array
        //if(sizeof($result_set)==1)
        //    $result_set=$result_set[0];

        if(isset($result_set))return $result_set;
    }
}

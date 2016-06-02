<?php

/*

task_category_id：

1. 訂單建立
2. 出貨
3. 訂單取消
4. 出貨後三日
5. 轉帳催繳

*/

function set_email_task($task_member_id, $task_order_id, $task_category_id){

	$insert_task_data = array(
        'task_member_id' => $task_member_id,
        'task_order_id' => $task_order_id,
        'task_category_id' => $task_category_id
    );

    return j_insert("pea_email_task",$insert_task_data);
}

function set_email_task_order_created($task_member_id, $task_order_id){
    set_email_task($task_member_id, $task_order_id, 1);
}

function set_email_task_order_shipped($task_member_id, $task_order_id){
    set_email_task($task_member_id, $task_order_id, 2);
}

function set_email_task_order_cancel($task_member_id, $task_order_id){
    set_email_task($task_member_id, $task_order_id, 3);
}

function get_email_task($task_member_id){
	$result = j_exe_sql("SELECT * FROM pea_email_task WHERE task_member_id = ".$task_member_id);
	return $result;
}

function update_email_task($task_id, $task_article_id, $task_status){

	$table = "pea_email_task";
	$id = $task_id;
	$key_column = "task_id";

	$data_array = array(
		"task_article_id" => $task_article_id,
		"task_status" => $task_status
	);

	j_update($table, $data_array, $key_column, $id);
}

function delete_email_task($task_id){
	$table = "pea_email_task";
	$id = $task_id;
	$key_column = "task_id";

	$data_array = array(
		"task_status" => -1
	);

	j_update($table, $data_array, $key_column, $id);
}
<?php
require_once 'helper/mysql_helper.php';
require_once 'helper/email_helper.php';

date_default_timezone_set("Asia/Taipei");

$sql = "SELECT * FROM pea_email_task WHERE task_status = 0";

$task = j_exe_sql($sql);

for($i=0;$i<count($task);$i++)
{
    if($task[$i]['task_category_id']!="")
    {
        $sql = "SELECT * FROM pea_template WHERE template_status = 1 AND template_task_category = ".$task[$i]['task_category_id']." LIMIT 0,1";

        $result = j_exe_sql($sql);

        $subject = $result[0]['template_title'];
        $msg = $result[0]['template_content'];

        echo "task_id: ".$task[$i]['task_id']."\n";
        echo "member_id: ".$task[$i]['task_member_id']."\n";

        //查會員資料
        if($task[$i]['task_target_email']!="")
        {
            $ToEmail = $task[$i]['task_target_email'];

        }else{
            if($task[$i]['task_member_id']!="")
            {
                unset($member);
                $sql = "SELECT * FROM pea_member WHERE member_id = ".$task[$i]['task_member_id']." LIMIT 0,1";
                $member = j_exe_sql($sql);
                $ToEmail = $member[0]['member_account'];
            }else{
                continue;
            }
        }

        echo "member_account: ".$ToEmail."\n";

    }else{
        continue;
    }

    if($task[$i]['task_order_id']!="")
    {
        unset($order);
        unset($cart);
        $sql = "SELECT * FROM pea_order WHERE order_id = ".$task[$i]['task_order_id']." LIMIT 0,1";
        $order = j_exe_sql($sql);

        $sql = "SELECT cart_product_name AS product_name, cart_package_price, cart_package_qty FROM pea_order_cart WHERE cart_order_id = ".$task[$i]['task_order_id'];
        $cart = j_exe_sql($sql);
    }else{
        unset($order);
        unset($cart);
    }


    //MAIL BODY
    $msg = $result[0]['template_content'];

    $msg = str_replace('{name}',$member[0]['member_name'],$msg);
    $msg = str_replace('{address}',$member[0]['member_address'],$msg);
    if($order[0]['order_create_stamp']!="")$msg = str_replace('{order_data}',$order[0]['order_create_stamp'],$msg);
    if($order[0]['order_cart_total']!="")$msg = str_replace('{cart_total}',$order[0]['order_cart_total'],$msg);
    if(count($cart)>0)$msg = str_replace('{order_cart}',build_table($cart),$msg); else $msg = str_replace('{order_cart}',"該訂單無產品",$msg);

    //MAIL SUBJECT
    $subject = $result[0]['template_title'];

    $subject = str_replace('{name}',$member[0]['member_name'],$subject);
    $subject = str_replace('{address}',$member[0]['member_address'],$subject);
    if($order[0]['order_create_stamp']!="")$subject = str_replace('{order_data}',$order[0]['order_create_stamp'],$subject);
    if($order[0]['order_cart_total']!="")$subject = str_replace('{cart_total}',$order[0]['order_cart_total'],$subject);

//    echo "target:".$ToEmail."\n";
//    echo "title:".$subject."\n";
//    echo "content:".$msg."\n";

    if(SendMail($ToEmail, $subject, $msg))
    {
        echo "Email deliver successfully! \n";
        $data_array['task_status'] = 1;
        $data_array['task_article_id'] = $result[0]['template_id'];
        j_update("pea_email_task", $data_array, "task_id", $task[0]['task_id']);
        return true;

    }else{

        echo "Email deliver fail! \n";
        $data_array['task_status'] = 2;
        $data_array['task_article_id'] = $result[0]['template_id'];
        j_update("pea_email_task", $data_array, "task_id", $task[0]['task_id']);
        return false;
    }

sleep(1);

}
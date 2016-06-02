<?php

function set_task($task_member_id, $task_service_id, $task_order_id, $task_category_id)
{
    $data_array['task_member_id'] = $task_member_id;
    $data_array['task_service_id'] = $task_service_id;
    $data_array['task_order_id'] = $task_order_id;
    $data_array['task_category_id'] = $task_category_id;
    return insert(DATABASE, "paw_email_task", $data_array);
}

function sendMail($ToEmail, $MessageSUBJECT, $MessageBODY, $Username, $Password, $FromMailAddress, $FromWho)
{
    mb_internal_encoding('UTF-8');
    require_once("php_emailer/class.phpmailer.php"); // Add the path as appropriate
    $mail = new PHPMailer(); // create a new object
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for GMail
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587;
    $mail->IsHTML(true);
    $mail->Username = $Username;
    $mail->Password = $Password;
    $mail->SetFrom($FromMailAddress,$FromWho);
    $mail->CharSet = "utf-8";
    $mail->Subject = mb_encode_mimeheader($MessageSUBJECT, "UTF-8");
    $mail->Body = $MessageBODY;
    $mail->AddAddress($ToEmail);

    if (!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
        return false;
    } else {
        return true;
    }
}

function send_email_article($task_id, $task_category_id)
{

    if($task_id == null OR $task_id == "")
    {

        if($task_category_id == null OR $task_category_id == 0)
        {

            return false;

        }else{

            $sql = "SELECT * FROM `paw_email_task` WHERE task_category_id = ".$task_category_id." AND task_status = 0 LIMIT 0,1";
        }

    }else{

        $sql = "SELECT * FROM `paw_email_task` WHERE task_id = ".$task_id." AND task_status = 0 LIMIT 0,1";

    }

    $task = exe_sql(DATABASE,$sql);

    echo "task_category_id:".$task[0]['task_category_id'];

    $task_category_id = $task[0]['task_category_id'];

    $sql = "SELECT * FROM `paw_member` WHERE member_id = ".$task[0]['task_member_id']." LIMIT 0,1";

    $member = exe_sql(DATABASE,$sql);

    $sql = "SELECT * FROM `paw_member_service` WHERE service_id = ".$task[0]['task_service_id']." LIMIT 0,1";

    $service = exe_sql(DATABASE,$sql);

    $sql = "SELECT product_name, package_weight, package_price,  cart_package_qty FROM `paw_member_cart`
            LEFT JOIN paw_brand_product ON product_id = cart_product_id
            LEFT JOIN paw_brand_product_package ON package_id = cart_package_id
            WHERE cart_service_id = ".$task[0]['task_service_id']." AND cart_status = 0";

    $service_cart = exe_sql(DATABASE,$sql);

    $sql = "SELECT * FROM `paw_order` WHERE order_id = ".$task[0]['task_order_id']." LIMIT 0,1";

    $order = exe_sql(DATABASE,$sql);

    $sql = "SELECT cart_product_name AS product_name, package_weight, package_price, cart_package_qty FROM `paw_order_cart`
            LEFT JOIN paw_brand_product_package ON package_id = cart_package_id
            WHERE cart_order_id = ".$task[0]['task_order_id'];

    $cart = exe_sql(DATABASE,$sql);

    $sql = "SELECT * FROM `paw_article` WHERE article_status = 1 AND article_task_category = ".$task_category_id." LIMIT 0,1";

    $result = exe_sql(DATABASE,$sql);

    $msg = $result[0]['article_content'];

    $msg = str_replace('{name}',$member[0]['member_name'],$msg);
    $msg = str_replace('{address}',$member[0]['member_address'],$msg);
    if($order[0]['order_create_stamp']!="")$msg = str_replace('{order_data}',$order[0]['order_create_stamp'],$msg);
    if($order[0]['order_paynow_OrderNo']!="")$msg = str_replace('{order_no}',substr($order[0]['order_paynow_OrderNo'],-5),$msg);
    if($order[0]['order_cart_total']!="")$msg = str_replace('{cart_total}',$order[0]['order_cart_total'],$msg);
    if(count($cart)>0)$msg = str_replace('{order_cart}',build_table($cart),$msg); else $msg = str_replace('{order_cart}',"該訂單無產品",$msg);
    if(count($service_cart)>0)$msg = str_replace('{service_cart}',build_table($service_cart),$msg); else $msg = str_replace('{service_cart}',"該服務無產品",$msg);
    $msg = str_replace('{service_next_date}',$service[0]['service_date_next'],$msg);

    $subject = $result[0]['article_title'];

    $subject = str_replace('{name}',$member[0]['member_name'],$subject);
    $subject = str_replace('{address}',$member[0]['member_address'],$subject);
    if($order[0]['order_create_stamp']!="")$subject = str_replace('{order_data}',$order[0]['order_create_stamp'],$subject);
    if($order[0]['order_paynow_OrderNo']!="")$subject = str_replace('{order_no}',substr($order[0]['order_paynow_OrderNo'],-5),$subject);
    if($order[0]['order_cart_total']!="")$subject = str_replace('{cart_total}',$order[0]['order_cart_total'],$subject);
    $subject = str_replace('{service_next_date}',$service[0]['service_date_next'],$subject);

    $to = $member[0]['member_account'];

    if(SendMail($to, $subject, $msg))
    {
        $data_array['task_status'] = 1;
        $data_array['task_article_id'] = $result[0]['article_id'];
        update(DATABASE, "paw_email_task", $data_array, "task_id", $task[0]['task_id']);
        return true;
    }else{

        $data_array['task_status'] = 2;
        $data_array['task_article_id'] = $result[0]['article_id'];
        update(DATABASE, "paw_email_task", $data_array, "task_id", $task[0]['task_id']);
        return false;
    }
}

//棄用
function email_sender($subject, $msg, $to, $from="泡麻吉訊息通知<info@pawmaji.com>", $sCharset="utf-8")
{
    $sMailHeaderFmt = '=?' . $sCharset . '?b?%s?=';
    $headers = "MIME-Version: 1.0\r\n" . "Content-type: text/html; charset=$sCharset\r\n" . "From: $from\r\n"."BCC: endless640c@gmail.com\r\n";
//    $subject = iconv('big5', $sCharset, $subject);
    $subject = sprintf($sMailHeaderFmt, base64_encode($subject));
    if(mail("$to", "$subject", "$msg", "$headers"))
        return true;
    else
        return false;
}

function build_table($array){
    // start table
    $html = '<table style="font-size:12px;">';
    // header row
    $width = array(0 => "40%", 1 =>"20%", 2=>"20%", 3=>"20%");
    $text_align = array(0 => "left", 1 => "center", 2 =>"center", 3=>"center", 4=>"center");
    $html .= '<tr>';
    $i = 0;
    foreach($array[0] as $key=>$value){
        if(!is_numeric($key)){
            $html .= '<th style="  text-shadow: 0 -1px 1px rgba(19, 28, 0, 0.35); border-color: #5a8200;background-color:#7db500;color:#ffffff ;width:'.$width[$i].';
        border:1px solid #cacaca;padding:3px;">' . $key . '</th>';
        $i++;
        }
    }
    $html .= '</tr>';
    // data rows

    foreach( $array as $key=>$value){

            $html .= '<tr>';
            $i = 0;
            foreach($value as $key2=>$value2)
            {
                if(!is_numeric($key2)){
                    $html .= '<td style="border:1px solid #cacaca;padding:3px;text-align:'.$text_align[$i].';">' . $value2 . '</td>';
                    $i++;
                }
            }

            $html .= '</tr>';


    }
    // finish table and return it
    $html .= '</table>';

    $html = str_replace("cart_package_price","單價",$html);
    $html = str_replace("product_name","產品名稱",$html);
    $html = str_replace("cart_package_qty","數量",$html);

    return $html;

}
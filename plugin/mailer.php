<?php
include ('helper/mysql_helper.php');
include ('helper/email_helper.php');

$sql = "SELECT * FROM email_task
        WHERE task_execute_time < '".date("Y-m-d H:i:s", strtotime("now"))."' AND
        task_status = 0 LIMIT 0, 10";

$task = j_exe_sql($sql);

shuffle($task); //取五筆，再洗牌後抽一筆出來

$task_counter = count($task);

if($task_counter > 0){
    echo '共'.$task_counter.'筆'."\n";
}else{
    echo '無資料'."\n";
}

for($i=0;$i < 3;$i++)  //一次只處理x筆
{
    if($task[$i]['task_category_id']!="")
    {
        $sql = "SELECT * FROM email_template
                WHERE template_status = 1
                AND template_task_category = ".$task[$i]['task_category_id']." LIMIT 0,1";

        $result = j_exe_sql($sql);

        $subject = $result[0]['template_title'];
        $msg = $result[0]['template_content'];

        echo "task_id: ".$task[$i]['task_id']."\n";
        echo "task_category_id: ".$task[$i]['task_category_id']."\n";
        echo "task_member_id: ".$task[$i]['task_member_id']."\n";

        //取得會員資料
        if($task[$i]['task_member_id']!="")
        {
            unset($member);
            $sql = "SELECT * FROM member
                WHERE member_id = ".$task[$i]['task_member_id']." LIMIT 0,1";
            $member = j_exe_sql($sql);
            $ToEmail = $member[0]['member_account'];
        }

        echo "member_id: ".$member[0]['member_id']."\n";
        echo "member_account: ".$ToEmail."\n";

        if (!filter_var($ToEmail, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format"."\n";
            echo $emailErr;

            $data_array['task_status'] = 2;
            j_update("email_task", $data_array, "task_id", $task[0]['task_id']);

            $log = array(
                '---',
                '',
                '執行時間: ' . date('Y-m-d H:i:s', time()),
                '模板分類: ' . $task[$i]['task_category_id'],
                '目標地址: ' . $ToEmail,
                '寄送結果: 失敗',
                '發生原因: ' . '電子信箱格式錯誤',
                '',
            );
            $file = 'log/email_log.txt';
            $current = file_get_contents($file);
            file_put_contents($file, $current.implode("\r\n", $log));
            continue;
        }

    }else{
        continue;
    }

    $Username = null;
    $Password = null;
    $FromMailAddress = null;
    $FromWho = null;
    if(!empty($task[$i]['task_company_id'])){
        $sql = "SELECT * FROM `config` WHERE config_company_id = ".$task[$i]['task_company_id'];
        $config = j_exe_sql($sql);
        if(isset($config) AND count($config) > 0 ){
            foreach($config as $item){
                switch($item['config_key']){
                    case 'config_gmail_account':
                        $Username = $item['config_value'];
                        echo "Username: got \n";
                        break;
                    case 'config_gmail_password':
                        $Password = $item['config_value'];
                        echo "Password got \n";
                        break;
                    case 'customer_service_email':
                        $FromMailAddress = $item['config_value'];
                        echo "FromMailAddress: ".$FromMailAddress."\n";
                        break;
                    case 'customer_service_name':
                        $FromWho = $item['config_value'];
                        echo "FromWho: ".$FromWho."\n";
                        break;
                    case 'company_name':
                    case 'company_phone':
                    case 'company_address':
                        $replace_keywords[] = $item;
                        break;
                }
            }
        }else{
            continue;
        }
    }else{

        echo "Company id is NULL"."\n";
        $data_array['task_status'] = 2;
        j_update("email_task", $data_array, "task_id", $task[0]['task_id']);

        $log = array(
            '---',
            '',
            '執行時間: ' . date('Y-m-d H:i:s', time()),
            '模板分類: ' . $task[$i]['task_category_id'],
            '目標地址: ' . $ToEmail,
            '寄送結果: 失敗',
            '發生原因: ' . '商店ID為空值',
            '',
        );
        $file = 'log/email_log.txt';
        $current = file_get_contents($file);
        file_put_contents($file, $current.implode("\r\n", $log));
        continue;
    }

    if($task[$i]['task_order_id']!="")
    {
        unset($order);
        unset($cart);
        $sql = "SELECT * FROM `order_main` WHERE `order_id` = ".$task[$i]['task_order_id']." LIMIT 0,1";
        $order = j_exe_sql($sql);

        $sql = "SELECT cart_product_name AS product_name, cart_package_price, cart_package_qty FROM order_cart WHERE cart_order_id = ".$task[$i]['task_order_id'];
        $cart = j_exe_sql($sql);
    }else{

        unset($order);
        unset($cart);
    }

    //MAIL BODY
    $msg = $result[0]['template_content'];
    $msg = str_replace('{name}',$order[0]['order_member_name'],$msg);
    $msg = str_replace('{address}',$order[0]['order_member_address'],$msg);
    $msg = str_replace('{order_no}',$order[0]['order_id'],$msg);
    $msg = str_replace('{order_total}',$order[0]['order_total'],$msg);
    $msg = str_replace('{order_service_fee}',$order[0]['order_service_fee'],$msg);
    $msg = str_replace('{order_shipping_fee}',$order[0]['order_shipping_fee'],$msg);
    $msg = str_replace('{order_cart_total}',$order[0]['order_cart_total'],$msg);
    if($order[0]['order_create_stamp']!=""){
        $msg = str_replace('{order_date}',$order[0]['order_create_stamp'],$msg);
    }
    if($order[0]['order_cart_total']!="")
        $msg = str_replace('{cart_total}',$order[0]['order_cart_total'],$msg);
    if(count($cart)>0)$msg = str_replace('{order_cart}',build_table($cart),$msg); else $msg = str_replace('{order_cart}',"該訂單無產品",$msg);

    foreach($replace_keywords as $item){
        $msg = str_replace('{'.$item['config_key'].'}',$item['config_value'],$msg);
//        echo '{'.$item['config_key'].'}'.' = '.$item['config_value']."\n";
    }

    //MAIL SUBJECT
    $subject = $result[0]['template_title'];
    $subject = str_replace('{name}',$order[0]['order_member_name'],$subject);
    $subject = str_replace('{address}',$order[0]['order_member_address'],$subject);
    $subject = str_replace('{order_no}',$order[0]['order_id'],$subject);
    $subject = str_replace('{order_total}',$order[0]['order_total'],$subject);
    $subject = str_replace('{order_service_fee}',$order[0]['order_service_fee'],$subject);
    $subject = str_replace('{order_shipping_fee}',$order[0]['order_shipping_fee'],$subject);
    $subject = str_replace('{order_cart_total}',$order[0]['order_cart_total'],$subject);
    if($order[0]['order_create_stamp']!="")$subject = str_replace('{order_date}',$order[0]['order_create_stamp'],$subject);
    if($order[0]['order_cart_total']!="")$subject = str_replace('{cart_total}',$order[0]['order_cart_total'],$subject);
    if(count($cart)>0)$subject = str_replace('{order_cart}',build_table($cart),$subject); else $subject = str_replace('{order_cart}',"該訂單無產品",$subject);

    foreach($replace_keywords as $item){
        $subject = str_replace('{'.$item['config_key'].'}',$item['config_value'],$subject);
//        echo '{'.$item['config_key'].'}'.' = '.$item['config_value']."\n";
    }

    $result = sendMail($ToEmail, $subject, $msg, $Username, $Password, $FromMailAddress, $FromWho);

    if($result)
    {
        echo "Email deliver successfully! \n";
        $data_array['task_status'] = 1;
        $data_array['task_article_id'] = $result[0]['template_id'];
        j_update("email_task", $data_array, "task_id", $task[0]['task_id']);

        $log = array(
            '---',
            '',
            '執行時間: ' . date('Y-m-d H:i:s', time()),
            '模板分類: ' . $task[$i]['task_category_id'],
            '信件抬頭: ' . $subject,
            '目標地址: ' . $ToEmail,
            '來源地址: ' . $FromMailAddress,
            '來源姓名: ' . $FromWho,
            '寄送結果: 成功',
            '',
        );
        $file = 'log/email_log.txt';
        $current = file_get_contents($file);
        file_put_contents($file, $current.implode("\r\n", $log));

    }else{

        echo "Email deliver fail! \n";
        $data_array['task_status'] = 0;
        $data_array['task_article_id'] = $result[0]['template_id'];
        j_update("email_task", $data_array, "task_id", $task[0]['task_id']);

        $log = array(
            '---',
            '',
            '執行時間: ' . date('Y-m-d H:i:s', time()),
            '模板分類: ' . $task[$i]['task_category_id'],
            '信件抬頭: ' . $subject,
            '目標地址: ' . $ToEmail,
            '來源地址: ' . $FromMailAddress,
            '來源姓名: ' . $FromWho,
            '寄送結果: 失敗',
            '發生原因: ' . $result,
            '',
        );
        $file = 'log/email_log.txt';
        $current = file_get_contents($file);
        file_put_contents($file, $current.implode("\r\n", $log));

    }
    sleep(10);
}
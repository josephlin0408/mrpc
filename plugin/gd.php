<?php
include ('helper/mysql_helper.php');

// initializing or creating array
$url = "http://erp.gooddeal.com.tw/_xml_rec.php";

//取得可出貨的訂單
$sql = "SELECT * FROM `order_main` WHERE `order_status` = 1 LIMIT 0,1";
$db_order = j_exe_sql($sql);
$counter = count($db_order);
echo "總共: ".$counter."筆";

for($i=0;$i < $counter;$i++) {
    //取得config 確認是否有 GD api key
    $sql = "SELECT * FROM `config` WHERE config_company_id = ".$db_order[$i]['order_company_id'];
    $config = j_exe_sql($sql);
    $corporation_id = '';
    $api_key = '';
    if(isset($config) AND count($config)>0 ){
        foreach($config as $item){
            switch($item['config_key']){
                case 'good_deal_corporation_id':
                    $corporation_id = $item['config_value'];
                    echo $item['config_key'].'-'.$item['config_value']."\n";
                    break;
                case 'good_deal_api_key':
                    $api_key = $item['config_value'];
                    echo $item['config_key'].'-'.$item['config_value']."\n";
                    break;
            }
        }
    }
    if(empty($corporation_id) OR empty($api_key))continue;

    //寫入 Order id
    $orderno = $db_order[$i]['order_id'];
    $post_id = mb_substr( $db_order[$i]['order_member_address'] , 0 , 3 ,'utf-8'); //郵遞區號
    $address = mb_substr( $db_order[$i]['order_member_address'] , 3 , mb_strlen($db_order[$i]['order_member_address'],'utf-8'),'utf-8' );
    $name = $db_order[$i]['order_member_name'];  //姓名 必填
    $phone_no = $db_order[$i]['order_member_phone'];   //電話
    $mobile_no = $db_order[$i]['order_member_phone'];  //手機
    //如果是貨到付款
    if($db_order[$i]['order_payment_option'] == 1) {
        $agency_fee = $db_order[$i]['order_total'];
    }else{
        $agency_fee = 0;
    }
    $del_type_id = 70; //通路 必填
    /**
     * del_type_id 通路
     * 20 貨運
     * 30 第三方物流
     * 40 全家
     * 50 GD 超商
     * 70 黑貓
     * 71 黑貓上門收款 （退貨用）
     * 72 黑貓來回件
     * 73 黑貓當日配
     * 80 7-11
     * */
    $del_time_id = 4;
    /**
     * 1==>9點到12點
     * 2==>12~17
     * 3==>17之後
     * 4==>不限時間
     */
    //取得購物車
    $sql = "SELECT cart_product_name AS product_name, cart_package_price, cart_package_qty, cart_product_base_id, cart_product_base_count FROM order_cart WHERE cart_order_id = " . $db_order[$i]['order_id'];
    $cart = j_exe_sql($sql);

    for($j=0;$j < $counter;$j++) {

        $temp = $cart[$j]['cart_package_qty'] * $cart[$j]['cart_product_base_count'];

        if($temp == 0) {
            echo "cart_package_qty: ".$cart[$j]['cart_package_qty'].", cart_product_base_count: ".$cart[$j]['cart_product_base_count'];

        }
        $cart_item[] = array( 'product_id' => $cart[$j]['cart_product_base_id'],
            'qty' => $cart[$j]['cart_package_qty'] * $cart[$j]['cart_product_base_count'],
            'price' => $cart[$j]['cart_package_price'] / ($cart[$j]['cart_package_qty'] * $cart[$j]['cart_product_base_count'])
        );
    }

    //$corporation_id = 'WK';  //WK必填 測試寫GD
    //$api_key = '9883c2deb84afdfa90abfee603ea3f37'; //必填
    //$orderno = 3; //訂單編號 檢查是否重複
    //$post_id = 100; //郵遞區號
    //$address = '台北市中正區三元街110號2樓';  //地址 必填
    //$name = "何家維";  //姓名 必填
    //$phone_no = "0960631656"; //電話
    //$mobile_no = "0960631656"; //手機
    //$agency_fee = 0; //代收貨款

    $other_fee = 0; //其他費用
    $auction_ac = " "; //拍賣帳號
    $packstr = " "; //包裝方式
    $inv_no = 0; //發票號碼
    $inv_date = " "; //發票日期
    $inv_chkno = " "; //檢查號碼
    $uniformno = " ";  //統一編號
    $inv_title = " "; //買受人
    $inv_unamt = 0; //未稅總額
    $inv_tax = 0; //總稅額
    $inv_amt = 0; //含稅總金額
    $inv_tax_1 = 0; //稅額小計
    $bank_name = " "; //銀行名稱
    $bank_code = " "; //銀行確認碼

    $order = array (
        'corporation_id' => $corporation_id,
        'api_key' => $api_key,
        'del_type_id' => $del_type_id,
        'post_id' => $post_id,
        'address' => $address,
        'name' => $name,
        'phone_no' => $phone_no,
        'mobile_no' => $mobile_no,
        'auction_ac' => $auction_ac,
        'agency_fee' => $agency_fee,
        'packstr' => $packstr,
        'del_time_id' => $del_time_id,
        'other_fee' => $other_fee,
        'inv_no' => $inv_no,
        'inv_date' => $inv_date,
        'inv_chkno' => $inv_chkno,
        'uniformno' => $uniformno,
        'inv_title' => $inv_title,
        'inv_unamt' => $inv_unamt,
        'inv_tax' => $inv_tax,
        'inv_amt' => $inv_amt,
        'inv_tax_1' => $inv_tax_1,
        'bank_name' => $bank_name,
        'bank_code' => $bank_code,
        'orderno' => $orderno
    );

    foreach ($cart_item as $item) {
        $order['items'][] = $item;
    }

    $xml_obj = new ConnectionGD($url,$order);
    $xml = $xml_obj->get_xml();
    $result = $xml_obj->launch();

    echo $xml;
    echo $result;

    if($result == '000'){
        $data_array['order_status'] = 2;
        j_update("order_main", $data_array, "order_id", $db_order[$i]['order_id']);
        $log = array(
            '---',
            '',
            '執行時間: ' . date('Y-m-d H:i:s', time()),
            '訂單編號: ' . $order['orderno'],
            '客戶名稱: ' . $order['name'],
            '客戶電話: ' . $order['mobile_no'],
            '寄送結果: 成功',
            '訂單內容: ' . $xml,
            '',
        );
    }else{
        $data_array['order_status'] = -4;
        $data_array['order_note'] = $order[$i]['order_note']."; 物流下單失敗代碼：".$result;
        j_update("order_main", $data_array, "order_id", $order[$i]['order_id']);
        $log = array(
            '---',
            '',
            '執行時間: ' . date('Y-m-d H:i:s', time()),
            '訂單編號: ' . $order['orderno'],
            '客戶名稱: ' . $order['name'],
            '客戶電話: ' . $order['mobile_no'],
            '寄送結果: 失敗',
            '發生原因: ' . $result,
            '訂單內容: ' . $xml,
            '',
        );
    }
    $file = 'log/good_deal_log.txt';
    $current = file_get_contents($file);
    file_put_contents($file, $current.implode("\r\n", $log));

    sleep(2);
}

Class ConnectionGD {
    var $url;
    var $xml;

    function __construct($url, $order){
        $this->url = $url;
        $xml_data = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><order></order>');
        $this->array_to_xml($order,$xml_data);
        $this->xml = $xml_data->asXML();
    }

    function get_xml() {
        return $this->xml;
    }

    function launch() {
        $targeturl = $this->url;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $targeturl);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 90);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, array("xml"=>urlencode(trim($this->xml))));
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

    function array_to_xml( $data, &$xml_data ) {
        foreach( $data as $key => $value ) {
            if( is_array($value) ) {
                if( is_numeric($key) ){
                    $key = 'item'; //dealing with <0/>..<n/> issues
                    //$key = 'item'.$key; //dealing with <0/>..<n/> issues
                }
                $subnode = $xml_data->addChild($key);
                $this->array_to_xml($value, $subnode);
            } else {
                $xml_data->addChild("$key",htmlspecialchars("$value"));
            }
        }
    }
}


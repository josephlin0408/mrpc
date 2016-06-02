<?php
define("START_ATUOSHIP", "start");
define("START_CLASS", "btn-success");
define("START_TEXT", "啟動訂購");

define("STOP_ATUOSHIP", "stop");
define("STOP_CLASS", "btn-danger");
define("STOP_TEXT", "停止訂購");

define("NEVER_CHARGE", "0000-00-00");
define("TABLE_NAME","order_main");

class Model_order extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_orders_for_export($order_array)
    {
        $i = 0;
        foreach ($order_array as $value) {
            if($i==0){
                $this->db->where("order_id", $value);
                $i++;
            }
            $this->db->or_where("order_id", $value);
        }
        $this->db->join('order_invoice', 'order_main.order_hash_id = order_invoice.invoice_order_hash_id', 'left');
        $this->db->where('order_company_id', $this->session->all_userdata()['company_id']);
        $query = $this->db->get(TABLE_NAME);

        $data['order'] = $query->result_array();

        //GET CART
        for ($i = 0; $i < count($data['order']); $i++) {
            $query_cart = $this->db->get_where('order_cart', array('cart_order_id' => $data['order'][$i]['order_id']));
            $data['order'][$i]['order_cart'] = $query_cart->result_array();
        }
        return $data['order'];
    }

    public function get_order_payment_option_trans(){

        $this->db->from(TABLE_NAME)->where('order_payment_option', 2);
        $this->db->where('order_company_id', $this->session->all_userdata()['company_id']);
        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_last_order_by_member_id($member_id)
    {
        $this->db->order_by("order_id", "desc");

        $this->db->from(TABLE_NAME)->where('order_member_id', $member_id);
        $this->db->where('order_company_id', $this->session->all_userdata()['company_id']);
        $query = $this->db->get();

        $order = $query->row_array();

        $query_cart = $this->db->get_where('order_cart', array('cart_order_id' => $order['order_id']));

        $order['order_cart'] = $query_cart->result_array();

        return $order;
    }

    public function get_order_search($recorder_per_page = 20 ,
                                     $current_page = 0,
                                     $INVOICE_STATUS,
                                     $LAST_FIVE,
                                     $PAYMENT_STATUS,
                                     $INVOICE,
                                     $PAYMENT_OPTION,
                                     $FULLNAME,
                                     $CELLPHONE,
                                     $ADDRESS,
                                     $MID,
                                     $ID,
                                     $ACCOUNT,
                                     $STATUS,
                                     $startDate,
                                     $endDate,$PHONE)
    {
        $this->db->from(TABLE_NAME);
        $this->db->join('order_invoice', 'order_main.order_hash_id = order_invoice.invoice_order_hash_id', 'left');
        $this->db->where('order_company_id', $this->session->all_userdata()['company_id']);

        $array = array();

        if(!empty($FULLNAME))$array['order_member_name'] = $FULLNAME;
        if(!empty($CELLPHONE))$array['order_member_phone'] = $CELLPHONE;
        if(!empty($ADDRESS))$array['order_member_address'] = $ADDRESS;
        if(!empty($MID))$array['order_member_id'] = $MID;
        if(!empty($ID))$array['order_id'] = $ID;
        if(!empty($ACCOUNT))$array['order_member_account'] = $ACCOUNT;

        if( isset($LAST_FIVE))if($LAST_FIVE != '')$this->db->where("order_account_last_5",$LAST_FIVE);
        if( isset($PAYMENT_OPTION))if($PAYMENT_OPTION != '')$this->db->where("order_payment_option",$PAYMENT_OPTION);
        if( isset($INVOICE))if($INVOICE != '')$this->db->where("invoice_option",$INVOICE);
        if( isset($PAYMENT_STATUS))if($PAYMENT_STATUS != '')$this->db->where("order_payment_status",$PAYMENT_STATUS);
        if( isset($STATUS))if($STATUS != '')$this->db->where("order_status",$STATUS);
        if(!empty($startDate))$this->db->where( "order_create_stamp >= ", $startDate." 00:00:00");
        if(!empty($endDate))$this->db->where( "order_create_stamp < ", $endDate." 23:59:59");
        if(!empty($PHONE))$this->db->like( "order_member_phone", $PHONE);

        if($INVOICE_STATUS == 1)$this->db->where('order_invoice_number = ""');
        if($INVOICE_STATUS == 2)$this->db->where('order_invoice_number != ""');

        if (count($array) > 0){
            $this->db->like($array);
        }

        $count_all_results = $this->db->count_all_results();

        if( isset($LAST_FIVE))if($LAST_FIVE != '')$this->db->where("order_account_last_5",$LAST_FIVE);
        if( isset($PAYMENT_OPTION))if($PAYMENT_OPTION != '')$this->db->where("order_payment_option",$PAYMENT_OPTION);
        if( isset($INVOICE))if($INVOICE != '')$this->db->where("invoice_option",$INVOICE);
        if( isset($PAYMENT_STATUS))if($PAYMENT_STATUS != '')$this->db->where("order_payment_status",$PAYMENT_STATUS);
        if( isset($STATUS))if($STATUS != '')$this->db->where("order_status",$STATUS);
        if(!empty($startDate))$this->db->where( "order_create_stamp >= ", $startDate." 00:00:00");
        if(!empty($endDate))$this->db->where( "order_create_stamp < ", $endDate." 23:59:59");
        if(!empty($PHONE))$this->db->like( "order_member_phone", $PHONE);

        if($INVOICE_STATUS == 1)$this->db->where('order_invoice_number = ""');
        if($INVOICE_STATUS == 2)$this->db->where('order_invoice_number != ""');

        $this->db->from(TABLE_NAME);
        $this->db->join('order_invoice', 'order_main.order_hash_id = order_invoice.invoice_order_hash_id', 'left');

        if (count($array) > 0){
            $this->db->like($array);
        }

        $this->db->order_by("order_create_stamp", "desc");
        $current_recorder = $recorder_per_page * $current_page;
        $this->db->limit($recorder_per_page, $current_recorder);
        $this->db->where('order_company_id', $this->session->all_userdata()['company_id']);
        $query = $this->db->get();

        $data['order'] = $query->result_array();
        $data['count_all_results'] = $count_all_results;
        $data['recorder_per_page'] = $recorder_per_page;
        $data['current_page'] = $current_page;

        for ($i = 0; $i < count($data['order']); $i++) {
            $query_cart = $this->db->get_where('order_cart', array('cart_order_id' => $data['order'][$i]['order_id']));
            $data['order'][$i]['order_cart'] = $query_cart->result_array();
        }
        return $data;
    }

    public function get_order($order_id = FALSE)
    {
        if ($order_id === FALSE) {

            $post = $this->input->post();

            if (count($post) > 0) {
                $array = array();
                if(!empty($post['recorder_per_page']))$recorder_per_page = $post['recorder_per_page'];
                if(!empty($post['current_page']))$current_page = $post['current_page'];
                if (!empty($post['FULLNAME'])) $array['order_member_name'] = $post['FULLNAME'];
                if (!empty($post['CELLPHONE'])) $array['order_member_phone'] = $post['CELLPHONE'];
                if (!empty($post['ADDRESS'])) $array['order_member_address'] = $post['ADDRESS'];
                if (!empty($post['MID'])) $array['order_member_id'] = $post['MID'];
                if (!empty($post['ID'])) $array['order_id'] = $post['ID'];
                if (!empty($post['ACCOUNT'])) $array['order_member_account'] = $post['ACCOUNT'];
                if (isset($post['STATUS'])) if ($post['STATUS'] != '') $array['order_status'] = $post['STATUS'];
                if (!empty($post['startDate'])) $this->db->where("order_create_stamp >= ", $post['startDate'] . " 00:00:00");
                if (!empty($post['endDate'])) $this->db->where("order_create_stamp < ", $post['endDate'] . " 23:59:59");

                if (count($array) > 0) $this->db->like($array);
            }

            if (count($post) == 0) {
                $this->db->where("order_status != 0");

                $this->db->where("order_payment_option = 2");
            }
            $this->db->from(TABLE_NAME);
            $this->db->order_by("order_update_stamp", "desc");
            $this->db->where('order_company_id', $this->session->all_userdata()['company_id']);
            $query = $this->db->get('order_main');
            $data['order'] = $query->result_array();
            //GET CART
            for ($i = 0; $i < count($data['order']); $i++) {
                $query_cart = $this->db->get_where('order_cart', array('cart_order_id' => $data['order'][$i]['order_id']));
                $data['order'][$i]['order_cart'] = $query_cart->result_array();
            }
            return $data;

        } else {

            if (is_numeric($order_id)) {

                $this->db->from(TABLE_NAME)->where('order_id', $order_id);
                $this->db->join('order_invoice', 'order_main.order_hash_id = order_invoice.invoice_order_hash_id', 'left');
                $this->db->where('order_company_id', $this->session->all_userdata()['company_id']);
                $query = $this->db->get();
                $data = $query->row_array();
                $query_cart = $this->db->get_where('order_cart', array('cart_order_id' => $order_id));
                $data['order_cart'] = $query_cart->result_array();
                return $data;
            } else {
                return false;
            }
        }
    }


    //後台dashboard 使用
    public function get_ready_to_ship_orders()
    {
        $this->db->where("order_status", 1);

        $this->db->order_by("order_update_stamp", "desc");

        $query = $this->db->get(TABLE_NAME);

        $data['order'] = $query->result_array();

        return $data['order'];
    }

    public function update_order($data)
    {
        $this->load->helper('url');
        $this->db->where('order_company_id', $this->session->all_userdata()['company_id']);
        $this->db->where('order_id', $this->input->post('order_id'));
        return $this->db->update(TABLE_NAME, $data);
    }

    public function start_auto_refund_order($order_id)
    {
        $data = array(
            'order_status' => 4
        );
        $this->db->where('order_company_id', $this->session->all_userdata()['company_id']);
        $this->db->where('order_id', $order_id);
        return $this->db->update(TABLE_NAME, $data);

    }

    public function set_order_shipped($order_id)
    {
        $data = array(
            'order_status' => 3,
            'order_shipping' => 1
        );
        $this->db->where('order_company_id', $this->session->all_userdata()['company_id']);
        $this->db->where('order_id', $order_id);
        $this->db->update(TABLE_NAME, $data);

    }

    public function get_order_cart_detail($order_id)
    {
        $this->db->select('cart_product_name AS product_name, package_weight, package_price, cart_package_qty');
        $this->db->join('brand_product_package', 'package_id = cart_package_id', 'left');
        $this->db->where('cart_company_id', $this->session->all_userdata()['company_id']);
        $this->db->where("cart_order_id", $order_id);
        $this->db->from('order_cart');
        $query = $this->db->get();
        return $query->result_array();
    }

    //功能說明：今天進多少單
    public function get_order_count_today()
    {
        $this->db->select('order_main.order_create_stamp');
        $this->db->where('order_company_id', $this->session->all_userdata()['company_id']);
        $this->db->where('(order_status > 0 OR (order_status = 0 AND order_payment_option = 2))');

        $today_beginning = date('Y-m-d ' . '00:00:00', time());
        $today_ending = date('Y-m-d ' . '23:59:59', time());

        $this->db->where('order_create_stamp >', $today_beginning);
        $this->db->where('order_create_stamp <', $today_ending);

        $this->db->from('order_main');
        return $this->db->count_all_results();
    }

    //功能說明：昨天進多少單
    public function get_order_count_yesterday()
    {
        $this->db->select('order_main.order_create_stamp');
        $this->db->where('(order_status > 0 OR (order_status = 0 AND order_payment_option = 2))');
        $yesterday_beginning = date('Y-m-d ' . '00:00:00', time() - 86400);
        $yesterday_ending = date('Y-m-d ' . '23:59:59', time() - 86400);
        $this->db->where('order_create_stamp >', $yesterday_beginning);
        $this->db->where('order_create_stamp <', $yesterday_ending);
        $this->db->where('order_company_id', $this->session->all_userdata()['company_id']);
        $this->db->from('order_main');
        return $this->db->count_all_results();
    }

    //功能說明：匯出所有的可出貨訂單
    public function get_orders_ready_to_ship()
    {
        $this->db->where('order_status', 1);
        $query = $this->db->get('order_main');
        return $query->result_array();
    }

    public function get_orders_count_ready_to_ship()
    {
        return count($this->get_orders_ready_to_ship());
    }

    //台灣所有的可出貨訂單
    public function get_orders_ready_to_ship_all()
    {
        $this->db->where('order_status', 1);
        $this->db->where('order_member_region !=', "AS");
        $this->db->where('order_company_id', $this->session->all_userdata()['company_id']);
        $this->db->join('order_invoice', 'order_main.order_hash_id = order_invoice.invoice_order_hash_id', 'left');

        $query = $this->db->get(TABLE_NAME);

        $data['order'] = $query->result_array();

        for ($i = 0; $i < count($data['order']); $i++) {
            $query_cart = $this->db->get_where('order_cart', array('cart_order_id' => $data['order'][$i]['order_id']));
            $data['order'][$i]['order_cart'] = $query_cart->result_array();
        }
        return $data['order'];
    }

    //全世界所有的可出貨訂單
    public function get_orders_ready_to_ship_all_region()
    {
        $this->db->where('order_status', 1);
        $this->db->where('order_company_id', $this->session->all_userdata()['company_id']);
        $query = $this->db->get(TABLE_NAME);
        $data['order'] = $query->result_array();

        //GET CART
        for ($i = 0; $i < count($data['order']); $i++) {
            $query_cart = $this->db->get_where('order_cart', array('cart_order_id' => $data['order'][$i]['order_id']));
            $data['order'][$i]['order_cart'] = $query_cart->result_array();
        }
        return $data['order'];
    }

    //功能說明：列出所有訂單屬於：貨到付款 order_payment_option = 1
    public function get_orders_cod()
    {
        $this->db->where('order_main.order_payment_option', 1); //付款方式 屬於 貨到付款
        $this->db->where('order_company_id', $this->session->all_userdata()['company_id']);
        $query = $this->db->get(TABLE_NAME);
        $data['order'] = $query->result_array();

        //GET CART
        for ($i = 0; $i < count($data['order']); $i++) {
            $query_cart = $this->db->get_where('order_cart', array('cart_order_id' => $data['order'][$i]['order_id']));
            $data['order'][$i]['order_cart'] = $query_cart->result_array();
        }
        return $data['order'];
    }

    //功能說明：列出所有訂單屬於：轉帳付款 order_payment_option = 2
    public function get_orders_transfer()
    {
        $this->db->where('order_main.order_payment_option', 2); //付款方式 屬於 轉帳
        $this->db->where('order_company_id', $this->session->all_userdata()['company_id']);
        $query = $this->db->get(TABLE_NAME);
        $data['order'] = $query->result_array();

        //GET CART
        for ($i = 0; $i < count($data['order']); $i++) {
            $query_cart = $this->db->get_where('order_cart', array('cart_order_id' => $data['order'][$i]['order_id']));
            $data['order'][$i]['order_cart'] = $query_cart->result_array();
        }
        return $data['order'];
    }


    //功能說明：列出所有訂單屬於：信用卡付款 order_payment_option = 3
    public function get_orders_credit_card()
    {
        $this->db->where('order_main.order_payment_option', 3);  //付款方式 屬於 信用卡
        $this->db->where('order_company_id', $this->session->all_userdata()['company_id']);
        $query = $this->db->get(TABLE_NAME);
        $data['order'] = $query->result_array();

        //GET CART
        for ($i = 0; $i < count($data['order']); $i++) {
            $query_cart = $this->db->get_where('order_cart', array('cart_order_id' => $data['order'][$i]['order_id']));
            $data['order'][$i]['order_cart'] = $query_cart->result_array();
        }
        return $data['order'];
    }

    //功能說明：列出所有訂單屬於轉帳付款且已轉帳
    public function get_orders_transfer_and_ready_to_ship()
    {
        $this->db->where('order_main.order_payment_option', 2);   //付款方式 屬於 轉帳
        $this->db->where('order_main.order_status', 1);           //訂單狀態 屬於 成功
        $this->db->where('order_main.order_payment_status', 1);   //付款狀態 屬於 已付款
        $this->db->where('order_company_id', $this->session->all_userdata()['company_id']);
        $query = $this->db->get(TABLE_NAME);
        $data['order'] = $query->result_array();

        //GET CART
        for ($i = 0; $i < count($data['order']); $i++) {
            $query_cart = $this->db->get_where('order_cart', array('cart_order_id' => $data['order'][$i]['order_id']));
            $data['order'][$i]['order_cart'] = $query_cart->result_array();
        }
        return $data['order'];
    }

    //功能說明：列出所有訂單屬於轉帳付款且未轉帳
    public function get_orders_transfer_and_not_ready_to_ship()
    {
        $this->db->where('order_main.order_payment_option', 2);   //付款方式 屬於 轉帳
        $this->db->where('order_main.order_payment_status', 0);   //付款狀態 屬於 未付款
        $this->db->where('order_company_id', $this->session->all_userdata()['company_id']);
        $query = $this->db->get(TABLE_NAME);
        $data['order'] = $query->result_array();

        //GET CART
        for ($i = 0; $i < count($data['order']); $i++) {
            $query_cart = $this->db->get_where('order_cart', array('cart_order_id' => $data['order'][$i]['order_id']));
            $data['order'][$i]['order_cart'] = $query_cart->result_array();
        }
        return $data['order'];
    }

    //列出電子發票
    public function get_orders_electronic_invoice()
    {
        $this->db->join('order_invoice', 'order_main.order_hash_id = order_invoice.invoice_order_hash_id');
        $this->db->where('order_invoice.invoice_option', 2);   //發票選項 電子
        $this->db->where('order_company_id', $this->session->all_userdata()['company_id']);
        $query = $this->db->get(TABLE_NAME);
        $data['order'] = $query->result_array();
        //GET CART
        for ($i = 0; $i < count($data['order']); $i++) {
            $query_cart = $this->db->get_where('order_cart', array('cart_order_id' => $data['order'][$i]['order_id']));
            $data['order'][$i]['order_cart'] = $query_cart->result_array();
        }
        return $data['order'];
    }

    //列出手動發票
    public function get_orders_manual_invoice()
    {
        $this->db->join('order_invoice', 'order_main.order_hash_id = order_invoice.invoice_order_hash_id');
        $this->db->where('order_company_id', $this->session->all_userdata()['company_id']);
        $this->db->where('order_invoice.invoice_option', 3);   //發票選項 電子
        $query = $this->db->get(TABLE_NAME);
        $data['order'] = $query->result_array();

        //GET CART
        for ($i = 0; $i < count($data['order']); $i++) {
            $query_cart = $this->db->get_where('order_cart', array('cart_order_id' => $data['order'][$i]['order_id']));
            $data['order'][$i]['order_cart'] = $query_cart->result_array();
        }
        return $data['order'];
    }

    //列出已出貨訂單
    public function get_orders_shipped()
    {
        $this->db->join('order_invoice', 'order_main.order_hash_id = order_invoice.invoice_order_hash_id');
        $this->db->where('order_company_id', $this->session->all_userdata()['company_id']);
        $this->db->where('order_main.order_status', 2);   //付款狀態 屬於 已出貨
        $query = $this->db->get(TABLE_NAME);

        $data['order'] = $query->result_array();

        //GET CART
        for ($i = 0; $i < count($data['order']); $i++) {
            $query_cart = $this->db->get_where('order_cart', array('cart_order_id' => $data['order'][$i]['order_id']));
            $data['order'][$i]['order_cart'] = $query_cart->result_array();
        }
        return $data['order'];
    }


    //功能說明：更新一筆訂單，切換轉帳狀態
    public function update_order_payment_status($order_id, $order_payment_status)
    {
        if ($order_payment_status == 'true') {
            $order_status = 1;
        } else {
            $order_status = 0;
        }
        $data = array(
            'order_status' => $order_status,
            'order_payment_status' => $order_status
        );
        $this->db->where('order_company_id', $this->session->all_userdata()['company_id']);
        $this->db->where('order_main.order_id', $order_id);
        $this->db->update(TABLE_NAME, $data);

        return $order_status;
    }

    //功能說明：更新一筆訂單，增加黑貓宅配追蹤碼
    public function update_order_tracking_number($order_id, $order_tracking_number)
    {
        if (empty($order_id) OR empty($order_tracking_number)) return false;
        $data = array(
            'order_status' => 2, //已出貨
            'order_tracking_number' => $order_tracking_number
        );
        $this->db->where('order_company_id', $this->session->all_userdata()['company_id']);
        $this->db->where('order_main.order_id', $order_id);
        $this->db->update(TABLE_NAME, $data);
        return true;
    }

    //功能說明：更新一筆訂單，增加發票號碼
    public function update_order_invoice_number($order_id, $order_invoice_number)
    {
        if (empty($order_id) OR empty($order_invoice_number)) return false;
        $data = array(
            'order_invoice_number' => $order_invoice_number
        );
        $this->db->where('order_company_id', $this->session->all_userdata()['company_id']);
        $this->db->where('order_main.order_id', $order_id);
        $this->db->update(TABLE_NAME, $data);
        return true;
    }

    public function update_order_status($order_tracking_number, $order_status)
    {
        if (empty($order_status) OR empty($order_tracking_number)) return false;
        $data = array(
            'order_status' => $order_status
        );
        $this->db->where('order_company_id', $this->session->all_userdata()['company_id']);
        $this->db->where('order_main.order_tracking_number', $order_tracking_number);
        $this->db->update(TABLE_NAME, $data);

        return true;
    }

    public function change_status($order_status, $status_change_id)
    {
        $this->db->where('order_company_id', $this->session->all_userdata()['company_id']);
        $this->db->where('order_id', $status_change_id);
        $data = array(
            'order_status' => $order_status
        );
        $this->db->update(TABLE_NAME, $data);
    }

    public function change_status_to_cancel($status_change_id)
    {
        $this->change_status(-2, $status_change_id);
    }

    public function change_status_to_shipped($status_change_id)
    {
        $this->change_status(2, $status_change_id);
    }

    public function get_order_member_id($order_id)
    {
        $this->db->where('order_company_id', $this->session->all_userdata()['company_id']);
        $this->db->where('order_id', $order_id);
        $data = $this->db->get(TABLE_NAME)->row_array();
        return $data['order_member_id'];
    }
}

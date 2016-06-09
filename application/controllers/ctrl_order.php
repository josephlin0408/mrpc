<?php
class Ctrl_order extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_order');
        $this->load->model('model_member');
        $this->load->model('model_task');

        $this->load->library('form_validation');
        $this->load->library('session');

        $this->load->helper('date');
        $this->load->helper('html');
        $this->load->helper('form');
        $this->load->helper('email');

        $this->load->helper('verify_login');

        verify_login_admin($this->session->all_userdata());
    }

    public function index()
    {
        header( "Location:".base_url()."order/page/20/1");
        exit;
    }

    public function paging($recorder_per_page,$current_page){

        $loginData = $this->session->all_userdata();

        if(
            $this->input->post('INVOICE_STATUS')!="" OR
            $this->input->post('LAST_FIVE')!="" OR
            $this->input->post('PAYMENT_STATUS')!="" OR
            $this->input->post('INVOICE')!="" OR
            $this->input->post('PAYMENT_OPTION')!="" OR
            $this->input->post('FULLNAME')!="" OR
            $this->input->post('CELLPHONE')!="" OR
            $this->input->post('ADDRESS')!="" OR
            $this->input->post('ACCOUNT')!="" OR
            $this->input->post('MID')!="" OR
            $this->input->post('ID')!="" OR
            $this->input->post('STATUS')!="" OR
            $this->input->post('startDate')!="" OR
            $this->input->post('endDate')!="" OR
            $this->input->post('PHONE')!="" OR
            $this->input->post('RESET') == 1 OR
            !isset($loginData['order_search'])
        )
        {

            $loginData['order_search']['INVOICE_STATUS'] = $this->input->post('INVOICE_STATUS');
            $loginData['order_search']['LAST_FIVE']      = $this->input->post('LAST_FIVE');
            $loginData['order_search']['PAYMENT_STATUS'] = $this->input->post('PAYMENT_STATUS');
            $loginData['order_search']['INVOICE']        = $this->input->post('INVOICE');
            $loginData['order_search']['PAYMENT_OPTION'] = $this->input->post('PAYMENT_OPTION');
            $loginData['order_search']['FULLNAME']       = $this->input->post('FULLNAME');
            $loginData['order_search']['CELLPHONE']      = $this->input->post('CELLPHONE');
            $loginData['order_search']['ADDRESS']        = $this->input->post('ADDRESS');
            $loginData['order_search']['ACCOUNT']        = $this->input->post('ACCOUNT');
            $loginData['order_search']['MID']            = $this->input->post('MID');
            $loginData['order_search']['ID']             = $this->input->post('ID');
            $loginData['order_search']['STATUS']         = $this->input->post('STATUS');
            $loginData['order_search']['startDate']      = $this->input->post('startDate');
            $loginData['order_search']['endDate']        = $this->input->post('endDate');
            $loginData['order_search']['PHONE']          = $this->input->post('PHONE');
            $this->session->set_userdata($loginData);
        }

        $current_page = $current_page - 1;

        $data = $this->model_order->get_order_search(
            $recorder_per_page,
            $current_page,
            $loginData['order_search']['INVOICE_STATUS'],
            $loginData['order_search']['LAST_FIVE'],
            $loginData['order_search']['PAYMENT_STATUS'],
            $loginData['order_search']['INVOICE'],
            $loginData['order_search']['PAYMENT_OPTION'],
            $loginData['order_search']['FULLNAME'],
            $loginData['order_search']['CELLPHONE'],
            $loginData['order_search']['ADDRESS'],
            $loginData['order_search']['MID'],
            $loginData['order_search']['ID'],
            $loginData['order_search']['ACCOUNT'],
            $loginData['order_search']['STATUS'],
            $loginData['order_search']['startDate'],
            $loginData['order_search']['endDate'],
            $loginData['order_search']['PHONE']
        );
        $data['order'] = $this->orderTableFormat($data['order']);

        $data['order_search']['INVOICE_STATUS']   = $this->input->post('INVOICE_STATUS');
        $data['order_search']['LAST_FIVE']        = $this->input->post('LAST_FIVE');
        $data['order_search']['PAYMENT_STATUS']   = $this->input->post('PAYMENT_STATUS');
        $data['order_search']['INVOICE']          = $this->input->post('INVOICE');
        $data['order_search']['PAYMENT_OPTION']   = $this->input->post('PAYMENT_OPTION');
        $data['order_search']['FULLNAME']         = $this->input->post('FULLNAME');
        $data['order_search']['CELLPHONE']        = $this->input->post('CELLPHONE');
        $data['order_search']['ADDRESS']          = $this->input->post('ADDRESS');
        $data['order_search']['ACCOUNT']          = $this->input->post('ACCOUNT');
        $data['order_search']['MID']              = $this->input->post('MID');
        $data['order_search']['ID']               = $this->input->post('ID');
        $data['order_search']['STATUS']           = $this->input->post('STATUS');
        $data['order_search']['startDate']        = $this->input->post('startDate');
        $data['order_search']['endDate']          = $this->input->post('endDate');
        $data['order_search']['PHONE']            = $this->input->post('PHONE');

        $data['recorder_per_page'] = $recorder_per_page;
        $data['current_page'] = $current_page;


        $loginData =  $this->session->all_userdata();
        $company_id = $loginData['company_id'];
        $lang_id    = $loginData['lang_id'];
        $this->load->model('model_language');
        $data['select_bar_language']  = $this->model_language->get_all_language($company_id);
        $data['language_id_selected'] = $lang_id;
        $this->load->view('templates/header_color',$data);

        $this->load->view('order/index', $data);
    }

    public function payment($order_id, $order_payment_status, $member_id)
    {
        if (empty($order_id) OR empty($order_payment_status)) {
            show_404();
        }
        //寄信
        $this->model_task->set_task_order_paid($member_id, $order_id);

        echo $this->model_order->update_order_payment_status($order_id, $order_payment_status);

    }

    public function get_orders_transfer_and_ready_to_ship()
    {
        $data = $this->model_order->get_orders_transfer_and_ready_to_ship();
        $data['order'] = $this->orderTableFormat($data['order']);


        $loginData =  $this->session->all_userdata();
        $company_id = $loginData['company_id'];
        $lang_id    = $loginData['lang_id'];
        $this->load->model('model_language');
        $data['select_bar_language']  = $this->model_language->get_all_language($company_id);
        $data['language_id_selected'] = $lang_id;
        $this->load->view('templates/header_color',$data);

        $this->load->view('order/index', $data);
        $this->load->view('templates/footer');
    }

    public function get_orders_transfer_and_not_ready_to_ship()
    {
        $data = $this->model_order->get_orders_transfer_and_not_ready_to_ship();
        $data['order'] = $this->orderTableFormat($data['order']);

        $loginData =  $this->session->all_userdata();
        $company_id = $loginData['company_id'];
        $lang_id    = $loginData['lang_id'];
        $this->load->model('model_language');
        $data['select_bar_language']  = $this->model_language->get_all_language($company_id);
        $data['language_id_selected'] = $lang_id;
        $this->load->view('templates/header_color',$data);

        $this->load->view('order/index', $data);
        $this->load->view('templates/footer');
    }

    public function get_orders_ready_to_ship()
    {
        $data = $this->model_order->get_orders_ready_to_ship_all_region();
        $data['order'] = $this->orderTableFormat($data['order']);

        $loginData =  $this->session->all_userdata();
        $company_id = $loginData['company_id'];
        $lang_id    = $loginData['lang_id'];
        $this->load->model('model_language');
        $data['select_bar_language']  = $this->model_language->get_all_language($company_id);
        $data['language_id_selected'] = $lang_id;
        $this->load->view('templates/header_color',$data);

        $this->load->view('order/index', $data);
        $this->load->view('templates/footer');
    }

    public function get_orders_cod()
    {
        $data = $this->model_order->get_orders_cod();
        $data['order'] = $this->orderTableFormat($data['order']);

        $loginData =  $this->session->all_userdata();
        $company_id = $loginData['company_id'];
        $lang_id    = $loginData['lang_id'];
        $this->load->model('model_language');
        $data['select_bar_language']  = $this->model_language->get_all_language($company_id);
        $data['language_id_selected'] = $lang_id;
        $this->load->view('templates/header_color',$data);

        $this->load->view('order/index', $data);
        $this->load->view('templates/footer');
    }

    public function get_orders_transfer()
    {
        $data = $this->model_order->get_orders_transfer();
        $data['order'] = $this->orderTableFormat($data['order']);

        $loginData =  $this->session->all_userdata();
        $company_id = $loginData['company_id'];
        $lang_id    = $loginData['lang_id'];
        $this->load->model('model_language');
        $data['select_bar_language']  = $this->model_language->get_all_language($company_id);
        $data['language_id_selected'] = $lang_id;
        $this->load->view('templates/header_color',$data);

        $this->load->view('order/index', $data);
        $this->load->view('templates/footer');
    }

    public function get_orders_credit_card()
    {
        $data = $this->model_order->get_orders_credit_card();
        $data['order'] = $this->orderTableFormat($data['order']);

        $loginData =  $this->session->all_userdata();
        $company_id = $loginData['company_id'];
        $lang_id    = $loginData['lang_id'];
        $this->load->model('model_language');
        $data['select_bar_language']  = $this->model_language->get_all_language($company_id);
        $data['language_id_selected'] = $lang_id;
        $this->load->view('templates/header_color',$data);

        $this->load->view('order/index', $data);
        $this->load->view('templates/footer');
    }

    public function get_orders_electronic_invoice()
    {
        $data = $this->model_order->get_orders_electronic_invoice();
        $data['order'] = $this->orderTableFormat($data['order']);

        $loginData =  $this->session->all_userdata();
        $company_id = $loginData['company_id'];
        $lang_id    = $loginData['lang_id'];
        $this->load->model('model_language');
        $data['select_bar_language']  = $this->model_language->get_all_language($company_id);
        $data['language_id_selected'] = $lang_id;
        $this->load->view('templates/header_color',$data);

        $this->load->view('order/index', $data);
        $this->load->view('templates/footer');
    }

    public function get_orders_manual_invoice()
    {
        $data = $this->model_order->get_orders_manual_invoice();
        $data['order'] = $this->orderTableFormat($data['order']);

        $loginData =  $this->session->all_userdata();
        $company_id = $loginData['company_id'];
        $lang_id    = $loginData['lang_id'];
        $this->load->model('model_language');
        $data['select_bar_language']  = $this->model_language->get_all_language($company_id);
        $data['language_id_selected'] = $lang_id;
        $this->load->view('templates/header_color',$data);

        $this->load->view('order/index', $data);
        $this->load->view('templates/footer');
    }

    public function get_orders_shipped()
    {
        $data = $this->model_order->get_orders_shipped();
        $data['order'] = $this->orderTableFormat($data['order']);

        $loginData =  $this->session->all_userdata();
        $company_id = $loginData['company_id'];
        $lang_id    = $loginData['lang_id'];
        $this->load->model('model_language');
        $data['select_bar_language']  = $this->model_language->get_all_language($company_id);
        $data['language_id_selected'] = $lang_id;
        $this->load->view('templates/header_color',$data);

        $this->load->view('order/index', $data);
        $this->load->view('templates/footer');
    }



    public function view($order_id)
    {

        $data['order_item'] = $this->model_order->get_order($order_id);

        if (empty($data['order_item'])) {
            show_404();
        }

        $options = array(
            '0' => '已下單',
            '1' => '可出貨',
            '2' => '已出貨',
            '-1' => '已退款',
            '-2' => '已取消',
            '-3' => '刷卡失敗'
        );
        $attr = "id ='order_status' class='form-control' ";

        $this->form_validation->set_rules('order_member_name', '姓名', 'required');
        $this->form_validation->set_rules('order_member_phone', '手機號碼', 'required');

        $selected = $data['order_item']['order_status'];
        $data['order_item']['order_status_select'] = form_dropdown('order_status', $options, $selected, $attr);

        if ($this->form_validation->run() === FALSE) {
            $data['msg'] = "<span></span>";

            $loginData =  $this->session->all_userdata();
            $company_id = $loginData['company_id'];
            $lang_id    = $loginData['lang_id'];
            $this->load->model('model_language');
            $data['select_bar_language']  = $this->model_language->get_all_language($company_id);
            $data['language_id_selected'] = $lang_id;
            $this->load->view('templates/header_color',$data);

            $this->load->view('order/view', $data);
        } else {
            //更新訂單狀態
            $data = array(
                'order_member_name'        => $this->input->post('order_member_name'),
                'order_member_phone'       => $this->input->post('order_member_phone'),
                'order_member_address'     => $this->input->post('order_member_address'),
                'order_status'             => $this->input->post('order_status'),
                'order_tracking_number'    => $this->input->post('order_tracking_number'),
                'order_invoice_number'     => $this->input->post('order_invoice_number'),
                'order_notes'              => $this->input->post('order_notes'),
                'order_note'               => $this->input->post('order_note'),
                'order_account_last_5'     => $this->input->post('order_account_last_5')
            );

            $this->model_order->update_order($data);
            $data['order_item'] = $this->model_order->get_order($order_id);
            $selected = $data['order_item']['order_status'];
            $data['order_item']['order_status_select'] = form_dropdown('order_status', $options, $selected, $attr);
            $data['msg'] = "<span>Edited!</span>";
            $this->index();
        }
    }


    public function orderTableFormat($order)
    {
        for ($i = 0; $i < count($order); $i++) {

            $order[$i]['order_create_stamp'] = mdate("%m-%d %H:%i", strtotime($order[$i]['order_create_stamp']));

            switch ($order[$i]['order_status']) {

                case -3:
                    $order[$i]['STATUS_IMAGE'] = "<div class='j_alert alert-danger'>刷卡失敗</div>";
                    break;
                case -2:
                    $order[$i]['STATUS_IMAGE'] = "<div class='j_alert alert-danger'>已取消</div>";
                    break;
                case -1:
                    $order[$i]['STATUS_IMAGE'] = "<div class='j_alert alert-warning'>已退款</div>";
                    break;
                case 0:
                    $order[$i]['STATUS_IMAGE'] = "<div class='j_alert alert-default'>未完成</div>";
                    break;
                case 1:
                    $order[$i]['STATUS_IMAGE'] = "<div class='j_alert alert-success'>可出貨</div>";
                    break;
                case 2:
                    $order[$i]['STATUS_IMAGE'] = "<div class='j_alert alert-info'>已出貨</div>";
                    break;
                default:
                    $order[$i]['STATUS_IMAGE'] = "<div class='j_alert alert-info'>已下單</div>";
                    break;
            }

        }
        return $order;
    }

    public function change_status()
    {
        $order_status   = $this->input->post('order_status');

        $order_id       = $this->input->post('order_id');

        //變更訂單狀態

        switch($order_status){
            case('INVENTORY_SHIPPED'):
                $this->model_order->change_status_to_shipped($order_id);
                break;
            case('ORDER_CANCEL'):
                $this->model_order->change_status_to_cancel($order_id);
                break;
        }

        //送出通知信

        $email_status   = $this->input->post('email_status');

        $member_id = $this->model_order->get_order_member_id($order_id);

        switch($email_status){
            case('INVENTORY_SHIPPED'):
                $this->model_task->set_task_order_shipped($member_id,$order_id);
                break;;
            case('ORDER_CANCEL'):
                $this->model_task->set_task_order_cancel($member_id,$order_id);
                break;
        }
        $this->index();
    }
}

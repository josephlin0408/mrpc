<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ctrl_payment_method extends CI_Controller
{
    public $company_id;
    public $lang_id;
    public $user_data;
    public $switch;

    public function __construct()
    {
        parent::__construct();
        $helpers   = array('url', 'form','array');
        $libraries = array('form_validation', 'session');
        $this->load->helper($helpers);
        $this->load->library($libraries);

        $post               = $this->input->post();
        $this->user_data    = $this->session->all_userdata();
        $this->company_id   = $this->user_data['company_id'];
        $this->lang_id      = $this->user_data['lang_id'];

        $this->session->set_userdata($this->user_data);
    }

    public function get_payment()
    {
        $loginData =  $this->session->all_userdata();
        $company_id = $loginData['company_id'];
        $lang_id    = $loginData['lang_id'];
        $this->load->model('model_payment_method');
        $data['payment_method_list'] = $this->model_payment_method->func_get($company_id,$lang_id);
        if(empty($data['payment_method_list'])){
            $data[0] = array(
                'pm_company_id' => $company_id,
                'pm_lang_id'    => $lang_id,
                'pm_name'       => '信用卡支付',
                'pm_fee'        => 0,
                'pm_status'     => 1,
            );
            $data[1] = array(
                'pm_company_id' => $company_id,
                'pm_lang_id'    => $lang_id,
                'pm_name'       => '轉帳',
                'pm_fee'        => 0,
                'pm_status'     => 1,
            );
            $data[2] = array(
                'pm_company_id' => $company_id,
                'pm_lang_id'    => $lang_id,
                'pm_name'       => '貨到付款',
                'pm_fee'        => 0,
                'pm_status'     => 0,
            );
            for($i=0;$i<3;$i++){
                $this->model_payment_method->func_add($data[$i]);
            }
            $data['payment_method_list'] = $this->model_payment_method->func_get($company_id,$lang_id);
        }
        $this->load->model('model_language');
        $data['select_bar_language']  = $this->model_language->get_all_language($company_id);
        $data['language_id_selected'] = $lang_id;
        $this->load->view('templates/header_color',$data);
        $this->load->view('method/payment',$data);
    }

    public function update_fee()
    {
        $pm_id  = $this->input->post('pm_id');
        $pm_fee = $this->input->post('pm_fee');
        $this->load->model('model_payment_method');
        $this->model_payment_method->func_update_fee($pm_id,$pm_fee);
    }

    public function update_status()
    {
        $pm_id      = $this->input->post('pm_id');
        $pm_status  = $this->input->post('pm_status');
        $this->load->model('model_payment_method');
        switch((string)$pm_status){
            case('0'):
                $new_status = '2';
                break;
            case('1'):
                $new_status = '0';
                break;
            case('2'):
                $new_status = '0';
                break;
            default:
                $new_status = '4';
        }
        $this->model_payment_method->func_update_status($pm_id,$new_status);
        echo $new_status;
    }
}
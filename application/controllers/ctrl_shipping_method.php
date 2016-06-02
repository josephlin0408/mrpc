<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ctrl_shipping_method extends CI_Controller
{
    public $company_id;
    public $lang_id;
    public $user_data;
    public $switch;

    public function __construct() {
        parent::__construct();
        $helpers   = array('url', 'form','array');
        $libraries = array('form_validation', 'session');
        $this->load->helper($helpers);
        $this->load->library($libraries);
        $this->load->model('model_shipping_method');
        $post               = $this->input->post();
        $this->user_data    = $this->session->all_userdata();
        $this->company_id   = $this->user_data['company_id'];
        $this->lang_id      = $this->user_data['lang_id'];

        $this->session->set_userdata($this->user_data);
    }

    public function get_shipping() {
        $loginData =  $this->session->all_userdata();
        $company_id = $loginData['company_id'];
        $lang_id    = $loginData['lang_id'];
        $data['shipping_method_list'] = $this->model_shipping_method->func_get($company_id,$lang_id);
        if(empty($data['shipping_method_list'])){
            $data[0] = array(
                'sm_company_id' => $company_id,
                'sm_lang_id'    => $lang_id,
                'sm_name'       => '優先',
                'sm_freight'    => 0,
                'sm_status'     => 1,
            );
            $data[1] = array(
                'sm_company_id' => $company_id,
                'sm_lang_id'    => $lang_id,
                'sm_name'       => '普通',
                'sm_freight'    => 0,
                'sm_status'     => 1,
            );
            $data[2] = array(
                'sm_company_id' => $company_id,
                'sm_lang_id'    => $lang_id,
                'sm_name'       => '免運',
                'sm_freight'    => 0,
                'sm_status'     => 0,
            );
            for($i=0;$i<3;$i++){
                $this->model_shipping_method->func_add($data[$i]);
            }
            $data['shipping_method_list'] = $this->model_shipping_method->func_get($company_id,$lang_id);
        }

        $this->load->model('model_language');
        $data['select_bar_language']  = $this->model_language->get_all_language($company_id);
        $data['language_id_selected'] = $lang_id;
        $this->load->view('templates/header_color',$data);
        $this->load->view('method/shipping',$data);
    }

    public function func_update()
    {
        $source['sm_id']      = $this->input->post('sm_id');
        $source['sm_name']    = $this->input->post('sm_name');
        $source['sm_freight'] = $this->input->post('sm_freight');
        $source['sm_status']  = $this->input->post('sm_status');
        $this->model_shipping_method->func_update($source);
        $this->get_shipping();
    }

    public function func_add()
    {
        $source['sm_company_id']    = '999';
        $source['sm_lang_id']       = '999';
        $source['sm_name']          = $this->input->post('sm_name');
        $source['sm_freight']       = $this->input->post('sm_freight');
        $source['sm_status']        = '1';
        $this->model_shipping_method->func_add($source);
        $this->get_shipping();
    }
}
<?php

class Ctrl_coupon extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->library('session');
        $this->load->library('form_validation');

        $this->load->model('model_coupon');

        $this->load->helper('date');
        $this->load->helper('form');
        $this->load->helper('verify_login');

        verify_login_admin($this->session->all_userdata());
    }

    public function index()
    {
        $data['coupon'] = $this->model_coupon->get_coupon();

        $loginData =  $this->session->all_userdata();
        $company_id = $loginData['company_id'];
        $lang_id    = $loginData['lang_id'];
        $this->load->model('model_language');
        $data['select_bar_language']  = $this->model_language->get_all_language($company_id);
        $data['language_id_selected'] = $lang_id;
        
        $this->load->view('templates/header_color',$data);
        $this->load->view('coupon/index',$data);
    }

    public function create()
    {
        $post = $this->input->post();
        $data = $this->model_coupon->set_coupon($post);
        if (isset($data)) echo json_encode($data);
    }

    public function update()
    {
        $post = $this->input->post();
        $data = $this->model_coupon->update_coupon($post);
        if (isset($data)) echo json_encode($data);
    }

    public function view($id)
    {
        $data['coupon_item'] = $this->model_coupon->view_coupon($id);
//        echo'<pre>';print_r($data);echo'<br></pre><hr>';
        if (empty($data['coupon_item'])) {
            show_404();
        }

        $this->form_validation->set_rules('fullname', '姓名', 'required');
        $this->form_validation->set_rules('cellphone', '手機號碼', 'required');


        if ($this->form_validation->run() === FALSE) {
            $data['msg'] = "";
            $this->load->view('templates/header_color');
            $this->load->view('coupon/view', $data);
        } else {
            $this->model_coupon->update_coupon();
            $data['coupon_item'] = $this->model_coupon->view_coupon($id);
            $data['msg'] = "<div class='alert alert-success'>會員更新成功！<a class='btn btn-default' href='" . base_url() . "coupon'>回列表</a></div>";

            $loginData =  $this->session->all_userdata();
            $company_id = $loginData['company_id'];
            $lang_id    = $loginData['lang_id'];
            $this->load->model('model_language');
            $data['select_bar_language']  = $this->model_language->get_all_language($company_id);
            $data['language_id_selected'] = $lang_id;
            $this->load->view('templates/header_color',$data);
            $this->load->view('coupon/view', $data);
        }
    }

    public function update_coupon_status()
    {
        $this->load->model('model_order');

        $order = $this->model_order->get_order_payment_option_trans();

        for($i=0;$i<count($order);$i++){

            $this->model_coupon->update_prospect_to_coupon($order[$i]['order_coupon_id']);
            echo $order[$i]['order_coupon_id'].",";
        }
    }

    public function delete($coupon_id)
    {
        $this->model_coupon->delete_coupon($coupon_id);
        redirect(base_url()."coupon");
    }
}

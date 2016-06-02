<?php

class Ctrl_member extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('session');
        $this->load->library('form_validation');

        $this->load->model('model_member');

        $this->load->helper('date');
        $this->load->helper('form');
        $this->load->helper('verify_login');

        verify_login_admin($this->session->all_userdata());
    }

    public function index()
    {
        $data['member'] = $this->model_member->get_members();

        $data['member_search']['fullname']  = $this->input->post('fullname');
        $data['member_search']['cellphone'] = $this->input->post('cellphone');
        $data['member_search']['address']   = $this->input->post('address');
        $data['member_search']['id']        = $this->input->post('id');
        $data['member_search']['account']   = $this->input->post('account');

        $data['operation_member_id'] = "";

        $loginData =  $this->session->all_userdata();
        $company_id = $loginData['company_id'];
        $lang_id    = $loginData['lang_id'];
        $this->load->model('model_language');
        $data['select_bar_language']  = $this->model_language->get_all_language($company_id);
        $data['language_id_selected'] = $lang_id;
        $this->load->view('templates/header_color',$data);

        $this->load->view('member/index',$data);
    }



    public function view($id)
    {
        $data['member_item'] = $this->model_member->view_member($id);
        if (empty($data['member_item'])) {
            show_404();
        }

        $this->form_validation->set_rules('fullname', '姓名', 'required');
        $this->form_validation->set_rules('cellphone', '手機號碼', 'required');


        if ($this->form_validation->run() === FALSE) {
            $data['msg'] = "";

            $loginData =  $this->session->all_userdata();
            $company_id = $loginData['company_id'];
            $lang_id    = $loginData['lang_id'];
            $this->load->model('model_language');
            $data['select_bar_language']  = $this->model_language->get_all_language($company_id);
            $data['language_id_selected'] = $lang_id;
            $this->load->view('templates/header_color',$data);

            $this->load->view('member/view', $data);
        } else {
            $this->model_member->update_member();
            $data['member_item'] = $this->model_member->view_member($id);
            $data['msg'] = "<div class='alert alert-success'>會員更新成功！<a class='btn btn-default' href='" . base_url() . "member'>回列表</a></div>";

            $loginData =  $this->session->all_userdata();
            $company_id = $loginData['company_id'];
            $lang_id    = $loginData['lang_id'];
            $this->load->model('model_language');
            $data['select_bar_language']  = $this->model_language->get_all_language($company_id);
            $data['language_id_selected'] = $lang_id;
            $this->load->view('templates/header_color',$data);

            $this->load->view('member/view', $data);
        }
    }

    public function update_member_status()
    {
        $this->load->model('model_order');

        $order = $this->model_order->get_order_payment_option_trans();

        for($i=0;$i<count($order);$i++){

            $this->model_member->update_prospect_to_member($order[$i]['order_member_id']);
            echo $order[$i]['order_member_id'].",";
        }
    }

    public function paging($recorder_per_page,$current_page)
    {
        $loginData['member_search']['fullname']  = $this->input->post('fullname');
        $loginData['member_search']['cellphone'] = $this->input->post('cellphone');
        $loginData['member_search']['address']   = $this->input->post('address');
        $loginData['member_search']['account']   = $this->input->post('account');
        $loginData['member_search']['member_level'] = $this->input->post('member_level');

        $current_page = $current_page - 1;

        $data = $this->model_member->get_member_search(
            $recorder_per_page,
            $current_page,
            $loginData['member_search']['fullname'],
            $loginData['member_search']['cellphone'],
            $loginData['member_search']['address'],
            $loginData['member_search']['account'],
            $loginData['member_search']['member_level']
        );
        $data['member_search']['fullname']  = $this->input->post('fullname');
        $data['member_search']['cellphone'] = $this->input->post('cellphone');
        $data['member_search']['address']   = $this->input->post('address');
        $data['member_search']['account']   = $this->input->post('account');
        $data['member_search']['member_level']   = $this->input->post('member_level');


        $loginData =  $this->session->all_userdata();
        $company_id = $loginData['company_id'];
        $lang_id    = $loginData['lang_id'];
        $this->load->model('model_language');
        $data['select_bar_language']  = $this->model_language->get_all_language($company_id);
        $data['language_id_selected'] = $lang_id;

        $this->load->view('templates/header_color',$data);
        $this->load->view('member/index', $data);
    }
}

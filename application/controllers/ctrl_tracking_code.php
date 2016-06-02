<?php

class Ctrl_tracking_code extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('model_code');
        $this->load->model('model_code_category');
        $this->load->helper('form');
        $this->load->library('session');
        $this->load->helper('verify_login');
        verify_login_admin($this->session->all_userdata());
    }

    public function index() {
        //取得資料
        $data = $this->model_code->get_active_code();
        $data['status'] = array( 0=>'隱藏', 1=>'顯示', 2=>'刪除');
        //顯示表單
//        print_r($data);
        $this->code_viewer("update", $data);
    }

    public function create() {
        $data['category'] = $this->model_code_category->get_task_category();

        //取得POST DATA
        $source = $this->code_adapter();

        //判斷是否有新建
        if(!empty($source['code_content']))
        {
            //存檔
            $this->model_code->add_code_array($source);

            //送到編輯頁面
            redirect('code/update/'.$source['code_hash_id'],'location',301);
        }else
        {
            $data['msg'] = "";
        }

        //顯示表單

        $this->code_viewer("create", $data);
    }

    public function update($code_hash_id)
    {
        if($code_hash_id===false OR strlen($code_hash_id)<40)show_404();
        //取得POST DATA
        $source = $this->code_adapter();
        if(!empty($source['code_hash_id']))
        {
            $this->model_code->update_code_array($source);
            redirect('code/','location',301);
        }

        //取得資料
        $data = $this->model_code->get_code($code_hash_id);
        $data['msg'] = "";

        //顯示表單
        $this->code_viewer("update", $data);

    }


    public function code_viewer($page,$data = array()) {

        $this->load->view('templates/header_color');
        $this->load->view('tracking_code/'.$page,$data);
        $this->load->view('templates/footer_color');

    }

    public function code_adapter(){

        $source = array();
        $source['code_fb_id'] = $this->input->post('code_fb_id');
        $source['code_mf_id'] = $this->input->post('code_mf_id');
        $source['code_ga_id'] = $this->input->post('code_ga_id');
        $source['code_vwo_id'] = $this->input->post('code_vwo_id');
        $source['code_mc_id'] = $this->input->post('code_mc_id');
        $source['code_mc_token_prospect'] = $this->input->post('code_mc_token_prospect');
        $source['code_mc_token_member'] = $this->input->post('code_mc_token_member');
        $source['code_hash_id'] = $this->input->post('code_hash_id');
        $source['code_content'] = $this->input->post('code_content');
        $source['code_status'] = $this->input->post('code_status');

        return $source;
    }

}

<?php

class Ctrl_template extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('form_validation');
        $this->load->helper('date');
        $this->load->helper('html');
        $this->load->helper('form');
        $this->load->model('model_template');
        $this->load->model('model_task_category');

        $this->load->library('session');

        $this->load->helper('verify_login');

        verify_login_admin($this->session->all_userdata());
    }

    /**
     *  文章首頁
     */
    public function index()
    {
        if ($this->input->post('target_email') != "") {

            $this->load->model('model_task');

            $source['task_target_email'] = $this->input->post('target_email');
            $source['task_category_id'] = $this->input->post('template_task_category');

            $this->model_task->set_task_array($source);

            $data['target_email'] = $this->input->post('target_email');
        }

        //取得資料
        $data['article'] = $this->model_template->get_template();
        $data['category'] = $this->model_task_category->get_task_category();
        $data['status'] = array(0=>'隱藏', 1=>'顯示', 2=>'刪除');

        //顯示表單
        $this->template_viewer("index", $data);
    }

    public function create()
    {
        $data['category'] = $this->model_task_category->get_task_category();

        //取得POST DATA
        $source = $this->template_adapter();

        //判斷是否有新建
        if (!empty($source['template_title'])) {
            //存檔
            $this->model_template->add_template_array($source);

            //送到編輯頁面
            redirect('email/update/' . $source['template_hash_id'], 'location', 301);
        } else {
            $data['msg'] = "";
        }

        //顯示表單
        $this->template_viewer("create", $data);
    }

    public function update($template_hash_id)
    {
        if ($template_hash_id === false OR strlen($template_hash_id) < 40) show_404();

        //取得POST DATA
        $source = $this->template_adapter();

        if (!empty($source['template_title'])) {

            $this->model_template->update_template_array($source);

            redirect('email/update/' . $source['template_hash_id'], 'location', 301);
        }

        //取得資料
        $data = $this->model_template->get_template($template_hash_id);

        $data['category'] = $this->model_task_category->get_task_category();

        $data['msg'] = "";

        $this->template_viewer("update", $data);

    }

    public function test()
    {
        $this->load->helper('email');

        $subject = "email function test";

        $msg = "for test";

        $to = "endless640c@gmail.com";

        echo email_sender($subject, $msg, $to);

    }

    public function template_viewer($page, $data = array())
    {
        $loginData =  $this->session->all_userdata();
        $company_id = $loginData['company_id'];
        $lang_id    = $loginData['lang_id'];
        $this->load->model('model_language');
        $data['select_bar_language']  = $this->model_language->get_all_language($company_id);
        $data['language_id_selected'] = $lang_id;
        $this->load->view('templates/header_color',$data);
        $this->load->view('template/' . $page, $data);
    }

    public function template_adapter()
    {

        $source = array();

        $source['template_title'] = $this->input->post('template_title');
        $source['template_task_category'] = $this->input->post('template_task_category');
        $source['template_hash_id'] = $this->input->post('template_hash_id');
        $source['template_content'] = $this->input->post('template_content');
        $source['template_status'] = $this->input->post('template_status');

        return $source;
    }
}

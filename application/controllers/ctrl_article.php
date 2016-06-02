<?php

class Ctrl_article extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('date');
        $this->load->helper('html');
        $this->load->helper('form');
        $this->load->model('model_article');
        $this->load->model('model_article_category');
        verify_login_admin($this->session->all_userdata());
    }

    public function index()
    {
        //取得資料
        $data['article'] = $this->model_article->get_article();
        $data['category'] = $this->model_article_category->get_task_category();
        $data['status'] = array( 0=>'隱藏', 1=>'顯示', 2=>'刪除');

        //顯示表單
        $this->article_viewer("index", $data);
    }

    public function create()
    {
        $data['category'] = $this->model_article_category->get_task_category();

        //取得POST DATA
        $source = $this->article_adapter();

        //判斷是否有新建
        if(!empty($source['article_title']))
        {
            //存檔
            $this->model_article->add_article_array($source);

            //送到編輯頁面
            redirect('article/update/'.$source['article_hash_id'],'location',301);
        }else
        {
            $data['msg'] = "";
        }
        //顯示表單
        $this->article_viewer("create", $data);
    }

    public function update($article_hash_id)
    {
        if($article_hash_id===false OR strlen($article_hash_id)<40)show_404();

        //取得POST DATA
        $source = $this->article_adapter();
        if(!empty($source['article_title']))
        {
            $this->model_article->update_article_array($source);
            redirect('article/','location',301);
        }

        //取得資料
        $data = $this->model_article->get_article($article_hash_id);
        $data['category'] = $this->model_article_category->get_task_category();
        $data['msg'] = "";
        //顯示表單
        $this->article_viewer("update", $data);

    }


    public function article_viewer($page,$data = array()){

        $this->load->view('templates/header');
        $this->load->view('article/'.$page,$data);
        $this->load->view('templates/footer');

    }

    public function article_adapter(){

        $source = array();

        $source['article_title'] = $this->input->post('article_title');
        $source['article_task_category'] = $this->input->post('article_task_category');
        $source['article_hash_id'] = $this->input->post('article_hash_id');
        $source['article_content'] = $this->input->post('article_content');
        $source['article_status'] = $this->input->post('article_status');

        return $source;
    }



}

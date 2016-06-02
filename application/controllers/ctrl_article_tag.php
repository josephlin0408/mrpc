<?php
class ctrl_article_tag extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $helpers 	= array('date','html','form','verify_login');
        $libraries 	= array('form_validation','session');
        $models 	= array('model_article_tag','model_language');

        $this->load->helper($helpers);
        $this->load->library($libraries);
        $this->load->model($models);
        verify_login_admin($this->session->all_userdata());
        date_default_timezone_set('Asia/Taipei');
    }

    public function func_list()
    {
        $loginData = $this->session->all_userdata();
        $data['select_bar_language']  = $this->model_language->get_all_language($loginData['company_id']);
        $data['language_id_selected'] = $loginData['lang_id'];
        $data['article_tag'] = $this->model_article_tag->func_get($loginData['company_id'],$loginData['lang_id'],$article_tag_id=NULL);
        $this->load->view('templates/header_color',$data);
        $this->load->view('article_tag/index.php',$data);
    }

    public function func_add()
    {
        $source = $this->input->post();
        $loginData = $this->session->all_userdata();
        $source['article_tag_company_id'] = $loginData['company_id'];
        $source['article_tag_lang_id'] = $loginData['lang_id'];

        $this->model_article_tag->func_add($source);
        $this->func_list();
    }

    public function func_update()
    {
        $source = $this->input->post();
        $loginData = $this->session->all_userdata();
        $source['article_tag_company_id']   = $loginData['company_id'];
        $source['article_tag_lang_id']      = $loginData['lang_id'];
        $this->model_article_tag->func_update($source);
        if((string)$source['article_tag_status']=='1'){
            $this->model_article_tag->disable_all_link_selected($source['article_tag_id'],$source['article_tag_company_id']);
        }
        $this->func_list();
    }

    public function func_remove()
    {
        $tag_id = $this->input->post('tag_id');
        $this->load->model('model_article_tag');
        $this->model_article_tag->delete_all_link_with_tag_id($tag_id,$arl_article_tag_company_id = 1);
        $this->model_article_tag->delete_tag($tag_id,$arl_article_tag_company_id = 1,$lang_id = 1);
        echo 'success';
    }

    public function func_change_tag_nav_status()
    {
        $tag_id = $this->input->post('tag_id');
        $tag_nav_status = $this->input->post('status');
        $this->load->model('model_article_tag');
        $this->model_article_tag->set_tag_nav_status($tag_id,$tag_nav_status);
        echo 'success';
    }


}
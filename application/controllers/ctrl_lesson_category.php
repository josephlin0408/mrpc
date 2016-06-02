<?php
class ctrl_lesson_category extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $helpers 	= array('date','html','form','verify_login');
        $libraries 	= array('form_validation','session');
        $models 	= array('model_lesson_category_main','model_language');
        $this->load->helper($helpers);
        $this->load->library($libraries);
        $this->load->model($models);
        verify_login_admin($this->session->all_userdata());
        date_default_timezone_set('Asia/Taipei');
    }

    public function func_get_category_main()
    {
        $loginData  =  $this->session->all_userdata();
        $data['select_bar_language']  = $this->model_language->get_all_language($loginData['company_id']);
        $data['language_id_selected'] = $loginData['lang_id'];

        $data['category_main'] = $this->model_lesson_category_main->func_get($loginData['company_id'],$loginData['lang_id'],$lesson_category_id=NULL);
        $this->load->view('templates/header_color',$data);
        $this->load->view('lesson_category/main',$data);
    }

    public function func_category_main_add()
    {
        $loginData                  = $this->session->all_userdata();
        $source                     = $this->input->post();
        $source['lesson_company_id']   = $loginData['company_id'];
        $source['lesson_lang_id']      = $loginData['lang_id'];
        $this->model_lesson_category_main->func_add($source);
        $this->func_get_category_main();
    }
    public function func_main_update()
    {
        $loginData                  = $this->session->all_userdata();
        $source                     = $this->input->post();
        $source['lesson_company_id']   = $loginData['company_id'];
        $source['lesson_lang_id']      = $loginData['lang_id'];
        $this->model_lesson_category_main->func_update($source);
        $this->func_get_category_main();
    }

    public function func_get_category_branch($acb_acm_id)
    {
        $loginData  =  $this->session->all_userdata();
        $company_id = $loginData['company_id'];
        $lang_id    = $loginData['lang_id'];
        $data['select_bar_language']  = $this->model_language->get_all_language($company_id);
        $data['language_id_selected'] = $lang_id;

        $data['acb_acm_id']         = $acb_acm_id;//主類別ID，以便於功能正確執行
        $data['main_data']          = $this->model_article_category_main->func_get($company_id,$lang_id,$acb_acm_id);//給次分類列表一個主分類名稱提示
        $data['category_branch']    = $this->model_article_category_branch->func_get($company_id,$lang_id,$acb_acm_id,$acb_id=NULL);
        $this->load->view('templates/header_color',$data);
        $this->load->view('article_category/branch',$data);
    }

    public function func_category_branch_add_form($acb_acm_id)
    {
        $loginData  =  $this->session->all_userdata();
        $company_id = $loginData['company_id'];
        $lang_id    = $loginData['lang_id'];
        $data['select_bar_language']  = $this->model_language->get_all_language($company_id);
        $data['language_id_selected'] = $lang_id;

        $data['acb_acm_id'] = $acb_acm_id;//主類別ID，以便於功能正確執行

        $this->load->view('templates/header_color',$data);
        $this->load->view('article_category/branch_add',$data);
    }

    public function func_category_branch_add()
    {
        $loginData                  = $this->session->all_userdata();
        $source                     = $this->input->post();
        $source['acb_company_id']   = $loginData['company_id'];
        $source['acb_lang_id']      = $loginData['lang_id'];
        $this->model_article_category_branch->func_add($source);
        $this->func_get_category_branch($source['acb_acm_id']);
    }

    public function func_category_branch_update_form($acb_acm_id,$acb_id)
    {
        $loginData  =  $this->session->all_userdata();
        $data['select_bar_language']  = $this->model_language->get_all_language($loginData['company_id']);
        $data['language_id_selected'] = $loginData['lang_id'];

        $data['acb_acm_id']         = $acb_acm_id;//主類別ID，以便於功能正確執行
        $data['acb_id']             = $acb_id;//次類別ID，以便於功能正確執行
        $data['category_branch']    = $this->model_article_category_branch->func_get($loginData['company_id'],$loginData['lang_id'],$acb_acm_id,$acb_id);

        $this->load->view('templates/header_color',$data);
        $this->load->view('article_category/branch_update',$data);
    }

    public function func_category_branch_update()
    {
        $source = $this->input->post();
        $this->model_article_category_branch->func_update($source);
        $this->func_get_category_branch($source['acb_acm_id']);

    }

    public function func_query(){
        $name = ($this->input->get('term')) ? $this->input->get('term') : NULL;
        if($name!="") {
            $result = $this->model_article_category_branch->func_query($name);
            foreach($result as &$value){
                $data[] = $value['acb_name'];
            }
            echo json_encode($data);
        }else{
            $array['data'] = '查無資料';
            echo json_encode($array);
        }
    }

    //新增文章到次類別中的頁面
    public function func_category_branch_insert_article($acb_acm_id, $acb_id)
    {
        $data['name'] = $this->input->post('name');
        $data['acb_acm_id'] = $acb_acm_id;
        $data['acb_id'] = $acb_id;

        if($data['name']!="") {
            $this->model_article_category_branch_link->func_add($data);
            redirect('article/category/branch/insert/article/'.$acb_acm_id.'/'.$acb_id);
        }
        $data['article_list'] = $this->model_article_category_branch_link->func_get($acb_id);

        $this->load->view('templates/header_color');
        $this->load->view('article_category/insert',$data);
    }

    public function func_category_branch_disable_article($acb_acm_id, $acb_id, $acbl_id){
        $this->model_article_category_branch_link->func_disable($acbl_id);
        redirect('article/category/branch/insert/article/'.$acb_acm_id.'/'.$acb_id);
    }
}
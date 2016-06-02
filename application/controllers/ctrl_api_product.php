<?php
class ctrl_api_product extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $helpers 	= array('date','html','form','verify_login');
        $libraries 	= array('form_validation','session');
        $models 	= array('model_article_category_main','model_article_category_branch','model_product_accounting','model_article_category_branch_link');
        $this->load->helper($helpers);
        $this->load->library($libraries);
        $this->load->model($models);
    }
    public function func_get_product_category_list() {
        $array = $this->model_product_accounting->func_get();
        if(!isset($_GET['json'])){
            echo json_encode($array);
        }else{
            echo "<pre>";
            print_r($array);
        }
    }
    public function func_get_product_list()
    {
        $array = $this->model_product_accounting->func_get_model();
        if(!isset($_GET['json'])){
            echo json_encode($array);
        }else{
            echo "<pre>";
            print_r($array);
        }
    }
}
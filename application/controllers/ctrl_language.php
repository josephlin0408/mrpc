<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ctrl_language extends CI_Controller
{
    /*建構子載入CI所需之class以及model以便其他func使用其功能*/
    public function __construct()
    {

        parent::__construct();
        $helpers    = array('url', 'form','date','html');
        $libraries  = array('form_validation', 'session');
        $this->load->helper('verify_login');
        $this->load->helper($helpers);
        $this->load->library($libraries);
        $this->load->model('model_language');
        verify_login_admin($this->session->all_userdata());
        date_default_timezone_set('Asia/Taipei');
    }

    public function get_language_list()
    {
        /*SESSION DOWNLOAD*/
        $loginData =  $this->session->all_userdata();
        /*SESSION DOWNLOAD END*/
//        echo'<pre>';print_r($loginData);echo'</pre><hr>';
        /*必要資料預設*/
        $company_id = $loginData['company_id'];
        $lang_id    = $loginData['lang_id'];

        /*必要資料預設END*/

        $data['error_hint'] = '';
        $data['error_status'] = false;

        /*最後瀏覽客戶顯示*/
        if(isset($loginData['lastClientId'])){
            $data['lastClientId'] = $loginData['lastClientId'];
        }else{
            $data['lastClientId'] = '.';
        }
        /*最後瀏覽客戶顯示END*/

        $SWITCH = $this->input->post('SWITCH');
        switch($SWITCH){
            /*快速新增客戶*/
            case('create_new_language'):
                $source['add_language_name']            = $this->input->post('add_language_name');
                $source['add_language_abbreviation']    = $this->input->post('add_language_abbreviation');
                $source['add_language_sort']            = $this->input->post('add_language_sort');
                $source['add_language_status']          = $this->input->post('add_language_status');
                $source['add_company_id']               = $company_id;
                /*各種驗證*/
                if($source['add_language_sort']>100){
                    $data['error_hint'] = '自訂編號大於100，新增失敗';
                    $data['error_status'] = true;
                }
                if($source['add_language_sort']<0){
                    $data['error_hint'] = '自訂編號小於0，新增失敗';
                    $data['error_status'] = true;
                }
//                $data_exist = $this->model_language->check_exist_sort($company_id,$source['add_language_sort']);
//                if(!empty($data_exist)){
//                    $data['error_hint'] = '自訂編號重複，新增失敗';
//                    $data['error_status'] = true;
//                }
                /*各種驗證END*/
                if(!$data['error_status']){
                    $this->model_language->quick_add($source);
                }
                break;
            /*快速新增客戶END*/
            case('delete_this_language'):
                $delete_language_id = $this->input->post('delete_language_id');
                $this->model_language->quick_delete($company_id,$delete_language_id);
                break;
            case('visible_this_language'):
                $this_language_id = $this->input->post('this_language_id');
                $this->model_language->quick_set_status($company_id,0,$this_language_id);
                break;
            case('hidden_this_language'):
                $this_language_id = $this->input->post('this_language_id');
                $this->model_language->quick_set_status($company_id,1,$this_language_id);
                break;
        }
        $data['all_language'] = $this->model_language->get_all_language($company_id);
        if(empty($data['all_language'])){
            $this->set_default_language($company_id);
            $data['all_language'] = $this->model_language->get_all_language($company_id);
        }

        $data['num_list']   = count($data['all_language']);

        $data['select_bar_language']  = $this->model_language->get_all_language($company_id);
        $data['language_id_selected'] = $lang_id;
        $this->load->view('templates/header_color',$data);
        $this->load->view('language/index.php',$data);
    }

    public function set_default_language($company_id)
    {
        /*台灣*/
        $source['add_language_name']            = '繁體中文';
        $source['add_language_abbreviation']    = 'TW';
        $source['add_language_sort']            = '0';
        $source['add_language_status']          = '0';
        $source['add_company_id']               = $company_id;
        $this->model_language->quick_add($source);
        unset($source);
        /*美國*/
        $source['add_language_name']            = 'English';
        $source['add_language_abbreviation']    = 'US';
        $source['add_language_sort']            = '1';
        $source['add_language_status']          = '1';
        $source['add_company_id']               = $company_id;
        $this->model_language->quick_add($source);
        unset($source);
        /*日本*/
        $source['add_language_name']            = '日本語';
        $source['add_language_abbreviation']    = 'JP';
        $source['add_language_sort']            = '2';
        $source['add_language_status']          = '1';
        $source['add_company_id']               = $company_id;
        $this->model_language->quick_add($source);
        unset($source);
        /*中國*/
        $source['add_language_name']            = '简体中文';
        $source['add_language_abbreviation']    = 'CN';
        $source['add_language_sort']            = '3';
        $source['add_language_status']          = '1';
        $source['add_company_id']               = $company_id;
        $this->model_language->quick_add($source);
    }

    public function session_change()
    {
        $language_selected = $this->input->post('language_selected');
        /*SESSION DOWNLOAD*/
        $loginData =  $this->session->all_userdata();
        $loginData['lang_id'] = $language_selected;
        $this->session->set_userdata($loginData);
        unset($loginData);
        $loginData =  $this->session->all_userdata();
        /*SESSION DOWNLOAD END*/
        echo $loginData['lang_id'];
    }
}
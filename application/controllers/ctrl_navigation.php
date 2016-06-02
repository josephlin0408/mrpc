<?php
class ctrl_navigation extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->helper('date');
        $this->load->helper('html');
        $this->load->helper('form');
        $this->load->helper('verify_login');

        $this->load->library('form_validation');
        $this->load->library('session');

        $this->load->model('model_navigation');
        $this->load->model('model_navigation_content');

        verify_login_admin($this->session->all_userdata());
    }

    public function navigation_admin()
    {
        /*必要資料預設*/
        $company_id = $this->session->userdata('company_id');
        $lang_id    = $this->session->userdata('lang_id');
        /*必要資料預設END*/

        /*view所需資料*/
        $data['navigation'] = $this->model_navigation->func_get($company_id,$lang_id);
        for($i=0;$i<count($data['navigation']);$i++){
            $navigation_type_id = $data['navigation'][$i]['nt_id'];
            $data['navigation_content'][$navigation_type_id] = $this->model_navigation_content->func_get($navigation_type_id,$company_id,$lang_id);
        }
        /*view所需資料END*/
        $this->load->model('model_language');
        $data['select_bar_language']  = $this->model_language->get_all_language($company_id);
        $data['language_id_selected'] = $lang_id;
        $this->load->view('templates/header_color',$data);
        $this->load->view('navigation/index.php',$data);
    }

    public function navigation_add()
    {
        $loginData =  $this->session->all_userdata();
        $data   = $this->input->post();
        $source = array(
            'nt_company_id' => $loginData['company_id'],
            'nt_lang_id'    => $loginData['lang_id'],
        );
        $combined_source = $data+$source;
        $this->model_navigation->func_add($combined_source);
        $this->navigation_admin();

    }

    public function navigation_update()
    {
        $loginData =  $this->session->all_userdata();
        $source = array(
            'nt_company_id' => $loginData['company_id'],
            'nt_lang_id'    => $loginData['lang_id'],
        );
        $data = $this->input->post();
        if(empty($data))$data=array();
        $combined_source = $data+$source;
        $this->model_navigation->func_update($combined_source);
        $this->navigation_admin();
    }

    public function navigation_content_add()
    {
        $loginData =  $this->session->all_userdata();
        $data = $this->input->post();
        if(empty($data))$data=array();
        $source = array(
            'nc_company_id' => $loginData['company_id'],
            'nc_lang_id'    => $loginData['lang_id'],
        );
        $combined_source = $data + $source;
        $this->model_navigation_content->func_add($combined_source);
        $this->navigation_admin();
    }

    public function navigation_content_update()
    {
        $loginData =  $this->session->all_userdata();
        $data = $this->input->post();
        if(empty($data))$data=array();
        $source = array(
            'nc_company_id' => $loginData['company_id'],
            'nc_lang_id'    => $loginData['lang_id'],
        );
        $combined_source = $data + $source;
        $this->model_navigation_content->func_update($combined_source);
        $this->navigation_admin();
    }
}
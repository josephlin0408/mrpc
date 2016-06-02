<?php
class ctrl_config_admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $helpers 	= array('date','html','form','verify_login');
        $libraries 	= array('form_validation','session');
        $models 	= array('model_language','model_config');
        $this->load->helper($helpers);
        $this->load->library($libraries);
        $this->load->model($models);
        verify_login_admin($this->session->all_userdata());
        date_default_timezone_set('Asia/Taipei');
    }
    public function index()
    {
        $loginData  =  $this->session->all_userdata();
        $data['config'] = $this->model_config->get_config($loginData['company_id'],$config_id=NULL);
        $this->load->model('model_language');
        $data['select_bar_language']  = $this->model_language->get_all_language($loginData['company_id']);
        $data['language_id_selected'] = $loginData['lang_id'];
        $this->load->view('templates/header_color',$data);
        $this->load->view('config_admin/main',$data);
    }

    public function create()
    {
        $loginData = $this->session->all_userdata();
        $source['config_key'] = $this->input->post('config_key');
        $source['config_val'] = $this->input->post('config_val');
        $source['config_company_id'] = $loginData['company_id'];
        $this->model_config->add_config($source);
        redirect('config/admin');
    }

    public function update()
    {
        $source = array();
        for($i=0;$i<count($this->input->post('config_id'));$i++){
            $source[$i] = array(
                'config_id' => $this->input->post('config_id')[$i],
                'config_key' => $this->input->post('config_key')[$i],
                'config_value' => $this->input->post('config_value')[$i],
                'config_status' => $this->input->post('config_status')[$i],
            );
        }
        $loginData = $this->session->all_userdata();
        if(!empty($source)){
            $this->model_config->update_config($source,$loginData['company_id']);
        }
        redirect('config/admin');
    }

    public function delete($config_id)
    {
        $this->model_config->delete_config($this->session->all_userdata()['company_id'],$config_id);
        redirect('config/admin');
    }
}
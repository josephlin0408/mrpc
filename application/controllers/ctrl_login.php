<?php

class Ctrl_login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_company_user');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index()
    {
        $this->session->sess_destroy();
        $this->load->view('login/index');
    }

    public function verify()
    {
        $data = $this->model_company_user->get_user_by_email($this->input->post('email'));
        if (!empty($data['user_account']))
        {
            if ($data['user_password'] == sha1($this->input->post('password'))) {
                $loginData = array(
                    'company_id'     => $data['user_company_id'],
                    'company_name'   => $data['company_name'],
                    'lang_id'        => $data['user_lang_id'],
                    'company_status' => $data['company_status'],
                    'user_status'    => $data['user_status'],
                    'user_name'      => $data['user_name'],
                    'user_account'   => $data['user_account'],
                    'user_role'      => $data['user_role']
                );
                $this->session->set_userdata($loginData);
                redirect(base_url() . 'navigation', 'location', 301);
            }
        }
        redirect('/login?get=error' , 'location', 301);
    }

}

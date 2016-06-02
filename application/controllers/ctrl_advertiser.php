<?php

class ctrl_advertiser extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('session');
        $this->load->library('form_validation');

        $this->load->model('model_member');
        $this->load->model('model_language');

        $this->load->helper('date');
        $this->load->helper('form');
        $this->load->helper('verify_login');

        verify_login_admin($this->session->all_userdata());
    }

    public function paging($recorder_per_page,$current_page)
    {
        /*查出資料*/
        $this->load->model('model_advertiser');
        $data = $this->model_advertiser->get_advertiser_search($recorder_per_page, $current_page);
//        echo'<div class="hidden"><pre>';print_r($data);echo'</pre></div>';;
        for($i=0;$i<count($data['company_user']);$i++){
            if($data['company_user'][$i]['user_status']== 0 ){
                $data['company_user'][$i]['user_status'] = '正常';
            }else{
                $data['company_user'][$i]['user_status'] = '停權';
            }
        }
        /*查出資料END*/
        $current_page = $current_page - 1;
        $loginData =  $this->session->all_userdata();
        $data['select_bar_language']  = $this->model_language->get_all_language($loginData['company_id']);
        $data['language_id_selected'] = $loginData['lang_id'];
        $this->load->view('templates/header_color',$data);
        $this->load->view('advertiser/index', $data);
    }

    public function add($recorder_per_page,$current_page)
    {
        $source['user_company_id']  = 1;
        $source['user_lang_id']     = 1;
        $source['user_account']     = $this->input->post('user_account');
        $source['user_password']    = '39dfa55283318d31afe5a3ff4a0e3253e2045e43';//0000
        $source['user_role']        = 1;//表示廣告商
        $source['user_phone']       = $this->input->post('user_phone');
        $source['user_name']        = $this->input->post('user_name');
        $source['user_status']      = $this->input->post('user_status');
        $this->load->model('model_advertiser');
        /*偵測是否帳號重複，不重複才可新增*/
        $item = $this->model_advertiser->get_id_via_account($source['user_account']);
        if(empty($item)){
            $this->model_advertiser->add_advertiser($source);
        }
        /*偵測是否帳號重複，不重複才可新增END*/
        redirect('advertiser/page/'.$recorder_per_page.'/'.$current_page);
    }
}

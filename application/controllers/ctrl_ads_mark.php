<?php

class ctrl_ads_mark extends CI_Controller
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
        $this->load->model('model_ads_mark');
        $data = $this->model_ads_mark->get_ads_mark($recorder_per_page, $current_page);
        $data['ads_mark_type_name'] = array('首頁橫幅','主標籤附屬','置頂次分類','延伸閱讀');//注意這邊順序如果動到，前台廣告位置會錯置
        $data['ads_mark_status_name'] = array('啟用','停用');
        /*查出資料END*/

        /*新增編輯表單所需資料*/
        $data['add_btn_switch'] = TRUE;
            $this->load->model('model_advertiser');
        $data['advertiser'] = $this->model_advertiser->get_advertiser_search()['company_user'];
        if(empty($data['advertiser'])){
            $data['add_btn_switch'] = FALSE;
        }
        for($i=0;$i<count($data['advertiser']);$i++){
            $data['advertiser_name'][$data['advertiser'][$i]['user_id']] = $data['advertiser'][$i]['user_name'].'('.$data['advertiser'][$i]['user_account'].')';
        }
        $this->load->model('model_article');
        $data['article'] = $this->model_article->get_article_for_select($company_id=1,$lang_id=1);
        if(empty($data['article'])){
            $data['add_btn_switch'] = FALSE;
        }
        for($i=0;$i<count($data['article']);$i++){
            $data['article_name'][$data['article'][$i]['article_id']] = $data['article'][$i]['article_title'];
        }
        /*新增編輯表單所需資料END*/

        $current_page = $current_page - 1;
        $data['recorder_per_page'] = $recorder_per_page;
        $data['current_page'] = $current_page;

        $loginData =  $this->session->all_userdata();
        $data['select_bar_language']  = $this->model_language->get_all_language($loginData['company_id']);
        $data['language_id_selected'] = $loginData['lang_id'];

        $this->load->view('templates/header_color',$data);
        $this->load->view('ads_mark/index', $data);
    }

    public function add($recorder_per_page,$current_page)
    {
        $this->load->model('model_article');
        $this->load->model('model_advertiser');
        $source['ads_mark_type']            = $this->input->post('ads_mark_type');
        $source['ads_mark_buyer']           = $this->model_advertiser->get_id_via_account($this->input->post('ads_mark_buyer'));
        $source['ads_mark_article_id']      = $this->model_article->get_article($this->input->post('ads_mark_article_id'))['article_id'];
        $source['ads_mark_period_start']    = $this->input->post('ads_mark_period_start');
        $source['ads_mark_period_end']      = $this->input->post('ads_mark_period_end');
        if(strtotime($source['ads_mark_period_start'])>strtotime($source['ads_mark_period_end']))redirect('ads-mark/home/'.$recorder_per_page.'/'.$current_page);;
        $source['ads_mark_status']          = $this->input->post('ads_mark_status');
        $source['ads_mark_company_id']      = 1;
        $source['ads_mark_lang_id']         = 1;
        $this->load->model('model_ads_mark');
        $this->model_ads_mark->add_ads_mark($source);
        redirect('ads-mark/home/'.$recorder_per_page.'/'.$current_page);
    }

    public function delete($ads_mark_id)
    {
        $this->load->model('model_ads_mark');
        $this->model_ads_mark->delete_ads_mark($ads_mark_id);
        redirect('ads-mark/home/20/1');
    }
}

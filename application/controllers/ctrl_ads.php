<?php
define("INDEX", 1);
class ctrl_ads extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('form_validation');
        $this->load->helper('date');
        $this->load->helper('html');
        $this->load->helper('form');

        $this->load->library('session');
        $this->load->helper('verify_login');

        verify_login_admin($this->session->all_userdata());
    }

    public function ads_admin()
    {
        /*SESSION DOWNLOAD*/
        $loginData =  $this->session->all_userdata();
        /*SESSION DOWNLOAD END*/

        /*必要資料預設*/
        $company_id = $loginData['company_id'];
        $lang_id    = $loginData['lang_id'];
        $category = '1'; //尚未做廣告類別 AD category

        $this->load->model('model_language');
        $data['select_bar_language']  = $this->model_language->get_all_language($company_id);
        $data['language_id_selected'] = $lang_id;

        /*必要資料預設END*/

        /*model載入*/
        $this->load->model('model_ads');
        /*model載入END*/

        /*負責廣告更新*/
        switch ($this->input->post('category'))
        {
            case "ads":
                /*非更新對象*/
                $target['ad_id']         = $this->input->post('id');
                $target['ad_company_id'] = $company_id;
                $target['ad_lang_id']    = $lang_id;
                /*非更新對象END*/
                /*更新對象*/
                $target['ad_link']       = $this->input->post('link');//連結網址
                $target['ad_path']       = $this->input->post('path');//圖檔連結
                $target['ad_files']      = $this->input->post('files');//圖片名稱
                $target['ad_text']      = $this->input->post('ad_text');//短文字
                for($i=0;$i<count($target['ad_id']);$i++){
                    if(!empty($_FILES['files']['name'][$i])){
                        $target['ad_source'][$i] = $_FILES['files']['name'][$i];
                    }else{
                        $target['ad_source'][$i] = $target['ad_path'][$i];
                    }
                }
                /*更新對象END*/
                $this->model_ads->update_ads($target);
                /*圖檔處理*/
                for($i=0;$i<count($_FILES['files']['tmp_name']);$i++){
                    if(!empty($_FILES['files']['tmp_name'][$i])){
                        $_FILES['files']['name'][$i] = iconv("UTF-8","BIG5", $_FILES['files']['name'][$i]);
                        move_uploaded_file($_FILES['files']['tmp_name'][$i],"uploads/".$_FILES['files']['name'][$i]);
                    }
                }
                /*圖檔處理END*/
                break;
        }
        /*負責廣告更新END*/

        /*view所需資料*/
        $data['ad']             = array();
        $data['location']       = '';
        $data['ad']         = $this->model_ads->get_ads($category,$company_id,$lang_id);
        if(empty($data['ad'])){
            $this->model_ads->set_default_ads($category,$company_id,$lang_id);
            $data['ad'] = $this->model_ads->get_ads($category,$company_id,$lang_id);
        }
        /*若沒有廣告可以顯示時，隱藏該顯示方塊，精簡畫面*/
        $ad_num = count($data['ad']);
        $ad_status_count = 0;
        for($i=0;$i<$ad_num;$i++){
            if($data['ad'][$i]['ad_status']==1)$ad_status_count++;
        }
        if($ad_status_count==$ad_num){
            $data['ad_status_exam'] = TRUE;
        }else{
            $data['ad_status_exam'] = FALSE;
        }
        /*若沒有廣告可以顯示時，隱藏該顯示方塊，精簡畫面END */

        /*view所需資料END*/



        /*DIY lesson*/
//        $data['STB'] = $this->model_ads->getWhereTest();

        $this->load->view('templates/header_color',$data);
        $this->load->view('ads/index.php',$data);
    }

    public function ads_status_switch()
    {
        $this->load->model('model_ads');
        $ad_id          = $this->input->post('adId');
        $ori_ad_status  = $this->model_ads->func_get_ads_status($ad_id);
        $new_ad_status  = $this->model_ads->func_switch_ads_status($ad_id,$ori_ad_status);
        switch($new_ad_status){
            case('0'):
                echo '顯示中';
                break;
            case('1'):
                echo '隱藏中';
                break;
        }
    }

}
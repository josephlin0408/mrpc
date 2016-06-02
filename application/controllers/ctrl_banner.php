<?php
define("INDEX", 1);
class ctrl_banner extends CI_Controller
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

    public function banner_admin_form()
    {
        /*必要資料預設*/
        $company_id = $this->session->userdata('company_id');
        $lang_id    = $this->session->userdata('lang_id');
        $category   = '1';
        /*必要資料預設END*/

        /*model載入*/
        $this->load->model('model_banner');
        /*model載入END*/

        /*負責橫幅更新*/
        switch ($this->input->post('category'))
        {
            case "banner":
                /*更新對象*/
                $target['banner_link']          = $this->input->post('link');//連結網址
                $target['youtube']              = $this->input->post('youtube');//影片網址
                $target['path']                 = $this->input->post('path');//	圖檔連結
                for($i=0;$i<count($target['youtube']);$i++){
                    if(!empty($target['youtube'][$i])){
                        $target['banner_source'][$i] = $target['youtube'][$i];
                    }else{
                        //如果圖片正常
                        if(!empty($_FILES['files']['name'][$i])){
                            $fn_array = explode(".", $_FILES['files']['name'][$i]);//分割檔名
                            $subName = $fn_array[1];//副檔名
                            $target['banner_source'][$i] = sha1($_FILES['files']['name'][$i].rand()).".".$subName;//若有上傳圖片，則使用新的圖檔名更新至資料庫
                        }else{
                            $target['banner_source'][$i] = $target['path'][$i];//若沒有上傳圖片，則使用原路徑更新至資料庫
                        }
                    }
                }
                $target['files']                = $this->input->post('files');//上傳圖片
                /*更新對象END*/

                /*非更新對象*/
                $target['banner_id']            = $this->input->post('id');
                $target['banner_company_id']    = $company_id;
                $target['banner_lang_id']       = $lang_id;
                /*非更新對象END*/
                $this->model_banner->update_banners($target);

                /*圖檔處理*/
                for($i=0;$i<count($_FILES['files']['tmp_name']);$i++){
                    if(!empty($_FILES['files']['tmp_name'][$i])){
//                        $_FILES['files']['name'][$i] = iconv("UTF-8","BIG5", $_FILES['files']['name'][$i]);
                        move_uploaded_file($_FILES['files']['tmp_name'][$i],"uploads/".$target['banner_source'][$i]);
                    }
                }
                /*圖檔處理END*/
                break;
        }
        /*負責橫幅更新END*/

        /*view所需資料*/
        $data['banner']         = array();
        $data['banner']         = $this->model_banner->get_banners($category,$company_id,$lang_id);
        /*當沒有所屬該公司的橫幅資料時自動創建五筆*/
        if(empty($data['banner'])){
            $this->model_banner->set_default_banners($category,$company_id,$lang_id);
            $data['banner'] = $this->model_banner->get_banners($category,$company_id,$lang_id);
        }
        /*當沒有所屬該公司的橫幅資料時自動創建五筆END*/
        /*若沒有橫幅可以顯示時，隱藏該顯示方塊，精簡畫面*/
        $banner_num = count($data['banner']);
        $banner_status_count = 0;
        for($i=0;$i<$banner_num;$i++){
            if($data['banner'][$i]['banner_status']==1)$banner_status_count++;
        }
        if($banner_status_count==$banner_num){
            $data['banner_status_exam'] = TRUE;
        }else{
            $data['banner_status_exam'] = FALSE;
        }
        /*若沒有橫幅可以顯示時，隱藏該顯示方塊，精簡畫面END*/
        /*view所需資料END*/

        $this->load->model('model_language');
        $data['select_bar_language']  = $this->model_language->get_all_language($company_id);
        $data['language_id_selected'] = $lang_id;
        $this->load->view('templates/header_color',$data);
        $this->load->view('banner/index.php',$data);
    }

    public function banner_status_switch()
    {
        $this->load->model('model_banner');
        $banner_id          = $this->input->post('bannerId');
        $ori_banner_status  = $this->model_banner->func_get_banner_status($banner_id);
        $new_banner_status  = $this->model_banner->func_switch_banner_status($banner_id,$ori_banner_status);
        switch($new_banner_status){
            case('0'):
                echo '顯示中';
                break;
            case('1'):
                echo '隱藏中';
                break;
        }
    }

}
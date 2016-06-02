<?php
class ctrl_offline_store extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $helpers 	= array('date','html','form','verify_login');
        $libraries 	= array('form_validation','session');
        $models 	= array('model_offline_store');
        
        $this->load->helper($helpers);
        $this->load->library($libraries);
        $this->load->model($models);
        verify_login_admin($this->session->all_userdata());
        date_default_timezone_set('Asia/Taipei');
    }

    public function get_list()
    {
        $loginData =  $this->session->all_userdata();
        $data['login_data'] = $loginData;
        $company_id = $loginData['company_id'];
        $lang_id    = $loginData['lang_id'];

        $data['ofs_store'] = $this->model_offline_store->func_get($company_id,$lang_id,$status='all');

        $loginData =  $this->session->all_userdata();
        $company_id = $loginData['company_id'];
        $lang_id    = $loginData['lang_id'];
        $this->load->model('model_language');
        $data['select_bar_language']  = $this->model_language->get_all_language($company_id);
        $data['language_id_selected'] = $lang_id;

        $this->load->view('templates/header_color',$data);
        $this->load->view('offline_store/index',$data);
    }

    public function add_list()
    {
        $loginData =  $this->session->all_userdata();
        $company_id = $loginData['company_id'];
        $lang_id    = $loginData['lang_id'];
        $this->load->model('model_language');
        $data['select_bar_language']  = $this->model_language->get_all_language($company_id);
        $data['language_id_selected'] = $lang_id;
        $this->load->view('templates/header_color',$data);
        $this->load->view('offline_store/add',$data);
    }



    public function update_list($ofs_id)
    {
        $loginData =  $this->session->all_userdata();
        $company_id = $loginData['company_id'];
        $lang_id    = $loginData['lang_id'];
        $this->load->model('model_language');
        $data['select_bar_language']  = $this->model_language->get_all_language($company_id);
        $data['language_id_selected'] = $lang_id;

        $data['ofs_store'] = $this->model_offline_store->func_get($company_id,$lang_id,$status='all',$ofs_id);
        if(empty($data['ofs_store']))redirect('offline/store/admin');
        $this->load->view('templates/header_color',$data);
        $this->load->view('offline_store/update',$data);
    }
    public function func_add()
    {
        $loginData =  $this->session->all_userdata();
        $source['ofs_company_id']  = $loginData['company_id'];
        $source['ofs_language_id']    = $loginData['lang_id'];

        $source['ofs_name']     = $this->input->post('ofs_name');
        $source['ofs_addr']     = $this->input->post('ofs_addr');
        $source['ofs_desc']     = $this->input->post('ofs_desc');
        $this->load->helper('remove_nbsp');
        $source['ofs_source']   = get_random_hash_file_name($_FILES['ofs_source']['name']).".".substr($_FILES['ofs_source']['name'], strrpos($_FILES['ofs_source']['name'] , ".")+1);//將檔案名稱轉成隨機雜湊英數
        $source['ofs_status']   = $this->input->post('ofs_status');

        /*針對檔案上傳做預防性回導*/
        if($_FILES['ofs_source']['size']>1992000)redirect('offline/store/admin');//圖片檔案大小大於2MB時停止上傳並導回瀏覽介面
        /*針對檔案上傳做預防性回導END*/
        if(!empty($_FILES['ofs_source']['tmp_name'])){
            $ofs_source = iconv("UTF-8","BIG5", $_FILES['ofs_source']['name']);
            move_uploaded_file($_FILES["ofs_source"]["tmp_name"],"uploads/".$ofs_source);
        }
        $this->model_offline_store->func_add($source);
        $this->get_list();
    }


    public function func_update()
    {
        $source['ofs_id']       = $this->input->post('ofs_id');
        $source['ofs_name']     = $this->input->post('ofs_name');
        $source['ofs_addr']     = $this->input->post('ofs_addr');
        $source['ofs_desc']     = $this->input->post('ofs_desc');
        $this->load->helper('remove_nbsp');
        $source['ofs_source']   = get_random_hash_file_name($_FILES['ofs_source']['name']).".".substr($_FILES['ofs_source']['name'], strrpos($_FILES['ofs_source']['name'] , ".")+1);//將檔案名稱轉成隨機雜湊英數
        $source['ofs_status']   = $this->input->post('ofs_status');
        if(empty($source['ofs_source']))$source['ofs_source']   = $this->input->post('ofs_source_origin');
        /*針對檔案上傳做預防性回導*/
        if($_FILES['ofs_source']['size']>1992000)redirect('offline/store/admin');//圖片檔案大小大於2MB時停止上傳並導回瀏覽介面
        /*針對檔案上傳做預防性回導END*/
        if(!empty($_FILES['ofs_source']['tmp_name'])){
            $ofs_source = iconv("UTF-8","BIG5", $source['ofs_source']);
            move_uploaded_file($_FILES["ofs_source"]["tmp_name"],"uploads/".$ofs_source);
        }
        $this->model_offline_store->func_update($source);
        $this->get_list();
    }

    public function delete_list($ofs_id)
    {
        $this->model_offline_store->func_delete($ofs_id);
        $this->get_list();
    }

}

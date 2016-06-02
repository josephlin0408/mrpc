<?php
class ctrl_online_store extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $helpers 	= array('date','html','form','verify_login');
        $libraries 	= array('form_validation','session');
        $models 	= array('model_online_store');

        $this->load->helper($helpers);
        $this->load->library($libraries);
        $this->load->model($models);
        verify_login_admin($this->session->all_userdata());
        date_default_timezone_set('Asia/Taipei');
    }

    public function func_get()
    {
        $loginData          =  $this->session->all_userdata();
        $data['login_data'] = $loginData;
        $company_id         = $loginData['company_id'];
        $lang_id            = $loginData['lang_id'];
        $data['os_store']  = $this->model_online_store->func_get($company_id,$lang_id,$status='all');

        $loginData =  $this->session->all_userdata();
        $company_id = $loginData['company_id'];
        $lang_id    = $loginData['lang_id'];
        $this->load->model('model_language');
        $data['select_bar_language']  = $this->model_language->get_all_language($company_id);
        $data['language_id_selected'] = $lang_id;

        $this->load->view('templates/header_color',$data);
        $this->load->view('online_store/index',$data);
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
        $this->load->view('online_store/add',$data);
    }



    public function update_list($os_id)
    {
        $loginData =  $this->session->all_userdata();
        $company_id = $loginData['company_id'];
        $lang_id    = $loginData['lang_id'];
        $this->load->model('model_language');
        $data['select_bar_language']  = $this->model_language->get_all_language($company_id);
        $data['language_id_selected'] = $lang_id;

        $data['os_store'] = $this->model_online_store->func_get($company_id,$lang_id,$status='all',$os_id);
        if(empty($data['os_store']))redirect('online/store/admin');
        $this->load->view('templates/header_color',$data);
        $this->load->view('online_store/update',$data);
    }
    public function func_add()
    {
        $loginData =  $this->session->all_userdata();
        $source['os_company_id']  = $loginData['company_id'];
        $source['os_language_id']    = $loginData['lang_id'];

        $source['os_name']     = $this->input->post('os_name');
        $source['os_link']     = $this->input->post('os_link');
        $this->load->helper('remove_nbsp');

        if(empty($source['os_source'])){
            $source['os_source']  = $this->input->post('os_source_origin');
        }else{
            $source['os_source']   = get_random_hash_file_name($_FILES['os_source']['name']).".".substr($_FILES['ofs_source']['name'], strrpos($_FILES['ofs_source']['name'] , ".")+1);//將檔案名稱去掉空白
        }
        $source['os_status']   = $this->input->post('os_status');

        /*針對檔案上傳做預防性回導*/
        if($_FILES['os_source']['size']>1992000)redirect('online/store/admin');//圖片檔案大小大於2MB時停止上傳並導回瀏覽介面
        /*針對檔案上傳做預防性回導END*/
        if(!empty($_FILES['os_source']['tmp_name'])){
            $os_source = iconv("UTF-8","BIG5", $_FILES['os_source']['name']);
            move_uploaded_file($_FILES["os_source"]["tmp_name"],"uploads/".$os_source);
        }

        $this->model_online_store->func_add($source);
        $this->func_get();
    }

    public function func_update()
    {
        $source['os_id']       = $this->input->post('os_id');
        $source['os_name']     = $this->input->post('os_name');
        $source['os_link']     = $this->input->post('os_link');
        $this->load->helper('remove_nbsp');
        $source['os_source']   = remove_nbsp($_FILES['os_source']['name']);//將檔案名稱去掉空白
        $source['os_status']   = $this->input->post('os_status');
        if(empty($source['os_source']))$source['os_source']   = $this->input->post('os_source_origin');
        /*針對檔案上傳做預防性回導*/
        if($_FILES['os_source']['size']>1992000)redirect('online/store/admin');//圖片檔案大小大於2MB時停止上傳並導回瀏覽介面
        /*針對檔案上傳做預防性回導END*/
        if(!empty($_FILES['os_source']['tmp_name'])){
            $os_source = iconv("UTF-8","BIG5", $source['os_source']);
            move_uploaded_file($_FILES["os_source"]["tmp_name"],"uploads/".$os_source);
        }

        $this->model_online_store->func_update($source);
        $this->func_get();
    }

    public function delete_list($os_id)
    {
        $this->model_online_store->func_delete($os_id);
        $this->func_get();
    }
}

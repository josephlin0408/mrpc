<?php
class ctrl_lesson extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $helpers 	= array('date','html','form','verify_login');
        $libraries 	= array('form_validation','session');
        $models 	= array('model_language','model_lesson','model_lesson_category_main');
        $this->load->helper($helpers);
        $this->load->library($libraries);
        $this->load->model($models);
        verify_login_admin($this->session->all_userdata());
        date_default_timezone_set('Asia/Taipei');
    }
    public function index()
    {
        $loginData  =  $this->session->all_userdata();
        $data['lesson'] = $this->model_lesson->get_lesson($loginData['company_id'],$loginData['lang_id'],$lesson_id=NULL);
        $data['lesson_category'] = $this->model_lesson_category_main->func_get($loginData['company_id'],$loginData['lang_id'],$lesson_category_id=NULL);
        for($i=0;$i<count($data['lesson_category']);$i++){
            $data['lesson_category'][$i]['category_content'] = $this->model_lesson->get_lesson_via_category_id($loginData['company_id'],$loginData['lang_id'],$data['lesson_category'][$i]['lesson_category_id']);
        }
        $this->load->view('templates/header_color',$data);
        $this->load->view('lesson/main',$data);
    }

    public function create()
    {
        //取得POST DATA
        $source = $this->lesson_adapter();
        //判斷是否有新建
        if (!empty($source['lesson_title'])) {
            /*針對檔案上傳做預防性回導*/
            $this->load->helper('remove_nbsp');
            if(empty($_FILES['lesson_source']['name'])){
                $source['lesson_source'] = '';
            }else{
                $source['lesson_source'] = get_random_hash_file_name($_FILES['lesson_source']['name']).".".substr($_FILES['lesson_source']['name'], strrpos($_FILES['lesson_source']['name'],".")+1);//將檔案名稱轉成隨機雜湊英數
            }
            /*針對檔案上傳做預防性回導*/
            if($_FILES['lesson_source']['size']>1992000)redirect('lesson');//圖片檔案大小大於2MB時停止上傳並導回瀏覽介面
            /*針對檔案上傳做預防性回導END*/
            if(!empty($_FILES['lesson_source']['tmp_name'])){
                $lesson_image = iconv("UTF-8","BIG5", $source['lesson_source']);
                move_uploaded_file($_FILES["lesson_source"]["tmp_name"],"uploads/".$lesson_image);
            }
                $this->model_lesson->add_model($source);
            redirect('lesson', 'location', 301);
        }
        $loginData                  =  $this->session->all_userdata();
        $data['lesson_category']    = $this->model_lesson_category_main->func_get_available($loginData['company_id'],$loginData['lang_id']);
        //顯示表單
        $this->load->view('templates/header_color',$data);
        $this->load->view('lesson/create',$data);
    }

    public function lesson_adapter()
    {
        $source = array();

        $source['lesson_category_id']           = $this->input->post('lesson_category_id');
        $source['lesson_title']                 = $this->input->post('lesson_title');
        $source['lesson_booking_start_time']    = $this->input->post('lesson_booking_start_time');
        $source['lesson_booking_end_time']      = $this->input->post('lesson_booking_end_time');
        $source['lesson_booking_number_limit']  = $this->input->post('lesson_booking_number_limit');
        $source['lesson_tag_price']             = $this->input->post('lesson_tag_price');
        $source['lesson_sell_status']           = $this->input->post('lesson_sell_status');
        $source['lesson_link']                  = $this->input->post('lesson_link');
        $source['lesson_meta']                  = $this->input->post('lesson_meta');

        $source['lesson_source']        = $this->input->post('lesson_source');
        $source['lesson_open_status']   = $this->input->post('lesson_open_status');
        $source['lesson_status']        = $this->input->post('lesson_status');
        $source['lesson_lecturer']      = $this->input->post('lesson_lecturer');
        $source['lesson_address']       = $this->input->post('lesson_address');
        $source['lesson_latitude']      = $this->input->post('lesson_latitude');
        $source['lesson_longitude']     = $this->input->post('lesson_longitude');
        $source['lesson_content']       = $this->input->post('lesson_content');

        return $source;
    }

    public function update($lesson_id)
    {
        $loginData         = $this->session->all_userdata();
        $data['lesson']    = $this->model_lesson->get_lesson($loginData['company_id'],$loginData['lang_id'],$lesson_id);
        $data['lesson_category']    = $this->model_lesson_category_main->func_get_available($loginData['company_id'],$loginData['lang_id']);

        $source = $this->lesson_adapter();
        $source['switch'] = $this->input->post('switch');
        $source['ori_img_source'] = $this->input->post('ori_img_source');
        $source['lesson_id'] = $lesson_id;

        $source['lesson_company_id'] = $loginData['company_id'];
        $source['lesson_lang_id'] = $loginData['lang_id'];

        if($source['switch']=='update_this_lesson'){
            /*針對檔案上傳做預防性回導*/
            $this->load->helper('remove_nbsp');
            if(empty($_FILES['lesson_source']['name'])){
                $source['lesson_source'] = $source['ori_img_source'];
            }else{
                $source['lesson_source'] = get_random_hash_file_name($_FILES['lesson_source']['name']).".".substr($_FILES['lesson_source']['name'], strrpos($_FILES['lesson_source']['name'],".")+1);//將檔案名稱轉成隨機雜湊英數
            }
            /*針對檔案上傳做預防性回導*/
            if($_FILES['lesson_source']['size']>1992000)redirect('lesson');//圖片檔案大小大於2MB時停止上傳並導回瀏覽介面
            /*針對檔案上傳做預防性回導END*/
            if(!empty($_FILES['lesson_source']['tmp_name'])){
                $lesson_image = iconv("UTF-8","BIG5", $source['lesson_source']);
                move_uploaded_file($_FILES["lesson_source"]["tmp_name"],"uploads/".$lesson_image);
            }
            $this->model_lesson->update_model($source);
            redirect('lesson', 'location', 301);
        }

        $this->load->view('templates/header_color',$data);
        $this->load->view('lesson/update',$data);
    }
}
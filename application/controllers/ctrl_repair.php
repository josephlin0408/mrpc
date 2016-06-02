<?php
class ctrl_repair extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $helpers 	= array('date','html','form','verify_login');
        $libraries 	= array('form_validation','session');
        $models 	= array('model_language','model_lesson','model_lesson_category_main','model_repair');
        $this->load->helper($helpers);
        $this->load->library($libraries);
        $this->load->model($models);
        verify_login_admin($this->session->all_userdata());
        date_default_timezone_set('Asia/Taipei');
    }
    public function index()
    {
        $loginData  =  $this->session->all_userdata();
        $data['repair'] = $this->model_repair->get_repair($loginData['company_id'],$repair_id=NULL);
        $this->load->model('model_language');
        $data['select_bar_language']  = $this->model_language->get_all_language($loginData['company_id']);
        $data['language_id_selected'] = $loginData['lang_id'];
        $this->load->view('templates/header_color',$data);
        $this->load->view('repair/main',$data);
    }

    public function create()
    {
        //取得POST DATA
        $source = $this->repair_adapter();
        $loginData                  =  $this->session->all_userdata();
        $source['repair_company_id'] = $loginData['company_id'];
        $source['repair_status']     = '0';//0表示剛立單的狀態
        //判斷是否有新建
        if (!empty($source['repair_product_name'])) {
            $this->model_repair->add_model($source);
            redirect('repair', 'location', 301);
        }

        /*必要資料預設*/
        $this->load->model('model_language');
        $data['select_bar_language']  = $this->model_language->get_all_language($loginData['company_id']);
        $data['language_id_selected'] = $loginData['lang_id'];
        $this->load->view('templates/header_color',$data);
        $this->load->view('repair/create',$data);
    }

    public function repair_adapter()
    {
        $source = array();

        $source['repair_product_name']                  = $this->input->post('repair_product_name');
        $source['repair_product_owner']                 = $this->input->post('repair_product_owner');
        $source['repair_product_owner_phone_number']    = $this->input->post('repair_product_owner_phone_number');
        $source['repair_date']                          = $this->input->post('repair_date');
        $source['repair_store_data']                    = $this->input->post('repair_store_data');
        $source['repair_store_staff_data']              = $this->input->post('repair_store_staff_data');
        $source['repair_content']                       = $this->input->post('repair_content');

        return $source;
    }

    public function update($repair_id)
    {
        $loginData         = $this->session->all_userdata();
        $data['repair'] = $this->model_repair->get_repair($loginData['company_id'],$repair_id);

        $source = $this->repair_adapter();
        $source['repair_company_id']    = $loginData['company_id'];
        $source['repair_status']        = $this->input->post('repair_status');
        $source['repair_id']            = $repair_id;

        if(!empty($source['repair_content'])){

            $this->model_repair->update_model($source);
            redirect('repair', 'location', 301);
        }
        $this->load->model('model_language');
        $data['select_bar_language']  = $this->model_language->get_all_language($loginData['company_id']);
        $data['language_id_selected'] = $loginData['lang_id'];
        $this->load->view('templates/header_color',$data);
        $this->load->view('repair/update',$data);
    }

    public function update_via_ajax()
    {
        $update_name  = $this->input->post('update_name');
        $update_value = $this->input->post('update_value');
        $update_id    = $this->input->post('update_id');
        $this->model_repair->set_field($update_id,$update_name,$update_value,$this->session->all_userdata()['company_id']);
        echo $update_name.$update_value.'//'.$update_id;
    }

    public function delete($repair_id)
    {
        $this->model_repair->delete_repair($this->session->all_userdata()['company_id'],$repair_id);
        $this->index();
    }
}
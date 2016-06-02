<?php
define("INDEX", 1);
class ctrl_message extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session','form_validation'));
        $this->load->helper(array('date','html','form','verify_login'));
        $this->load->model('model_message');
        verify_login_admin($this->session->all_userdata());
    }

    public function get_message()
    {
        $loginData      = $this->session->all_userdata();
        $data['msg']    = $this->model_message->get_message($loginData['company_id'],$loginData['lang_id'],$article_id=NULL);

        /*將留言對應的文章號轉為文章主題*/
        $this->load->model('model_article');
        for($i=0;$i<count($data['msg']);$i++){
            $data['msg'][$i]['msg_article_title'] = $this->model_article->func_get_article_title_via_id($data['msg'][$i]['msg_article_id']);
        }
        /*將留言對應的文章號轉為文章主題END*/

        $this->load->view('templates/header_color',$data);
        $this->load->view('message/index',$data);
    }

    public function delete_message($msg_id)
    {
        $this->model_message->func_delete($msg_id);
        redirect('message');
    }

}
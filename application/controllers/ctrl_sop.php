<?php

/**
 * Class Ctrl_sop
 */
class Ctrl_sop extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('date');
        $this->load->helper('html');
        $this->load->helper('form');
        $this->load->helper('myurl');
        $this->load->helper('datetime');
        $this->load->helper('verify_login');
        $this->load->model('model_article');
        $this->load->model('model_article_banner');
        $this->load->model('model_article_recommend_link');

        verify_login_admin($this->session->all_userdata());
    }

    public function index()
    {
        if ($this->input->post('target_email') != "") {

            $this->load->model('model_task');

            $source['task_target_email'] = $this->input->post('target_email');
            $source['task_category_id'] = $this->input->post('article_task_category');

            $this->model_task->set_task_array($source);

            $data['target_email'] = $this->input->post('target_email');
        }

        //取得資料
        $data['article'] = $this->model_article->get_article();
        $data['status'] = array(0=>'隱藏', 1=>'顯示', 2=>'刪除');

        //顯示表單
        $this->article_viewer("index", $data);
    }

    public function more($article_hash_id) {
        $data['article_category'] = $this->model_article_recommend_link->func_get($article_hash_id);
        $data['article_hash_id'] = $article_hash_id;
        $this->load->view('templates/header_color',$data);
        $this->load->view('article/more',$data);
    }

    public function add_article_category($article_hash_id) {
        $data['name'] = $this->input->post('name');
        $data['article_hash_id'] = $article_hash_id;
        $this->model_article_recommend_link->func_add($data);
        redirect('article/more/'.$article_hash_id);
    }

    public function disable_article_category($article_hash_id, $arl_id) {
        $data['arl_id'] = $arl_id;
        $this->model_article_recommend_link->func_disable($data);
        redirect('article/more/'.$article_hash_id);
    }

    public function create()
    {
        //取得POST DATA
        $source = $this->article_adapter();

        //判斷是否有新建
        if (!empty($source['article_hash_id'])) {
            //存檔
            /*針對檔案上傳做預防性回導*/
            $this->load->helper('remove_nbsp');
            $source['article_image'] = get_hash_image_name().".".substr($_FILES['article_image']['name'],strrpos($_FILES['article_image']['name'],".")+1);
            /*針對檔案上傳做預防性回導*/
            if($_FILES['article_image']['size']>1992000)redirect('article/update/' . $source['article_hash_id']);//圖片檔案大小大於2MB時停止上傳並導回瀏覽介面
            /*針對檔案上傳做預防性回導END*/
            if(!empty($_FILES['article_image']['tmp_name'])){
                $ofs_source = iconv("UTF-8","BIG5", $source['article_image']);
                move_uploaded_file($_FILES["article_image"]["tmp_name"],"uploads/".$ofs_source);
            }

            $this->model_article->add_article_array($source);
            //送到編輯頁面
            redirect('article/update/' . $source['article_hash_id'], 'location', 301);
        } else {
            $data['msg'] = "";
        }

        //顯示表單
        $this->article_viewer("create", $data);
    }

    /**
     * @param $article_hash_id
     */
    public function update($article_hash_id)
    {
        if ($article_hash_id === false OR strlen($article_hash_id) < 40) show_404();
        $loginData =  $this->session->all_userdata();
        $this->load->model('model_article_tag');
        $this->load->model('Model_article');
        $article = $this->Model_article->get_article($article_hash_id,NULL);//Get Article Id
        //取得POST DATA
        $source = $this->article_adapter();
        if (!empty($source['article_title'])) {
            /*刪除該文章所有標籤連結*/
            $this->model_article_tag->delete_all_article_tag_link($article['article_id'],$loginData['company_id']);
            /*刪除該文章所有標籤連結END*/
            /*標籤處理：檢查標籤是否存在，若存在則以原存在之標籤新增文章標籤連結，若不存在則新增標籤並同時新增文章標籤連結*/

            $my_tag_array = $this->input->post('my_tag');
            if(empty($my_tag_array))$my_tag_array = array('無');
            for($i=0;$i<count($my_tag_array);$i++){
                $if_tag_exist = $this->model_article_tag->func_if_exist($my_tag_array[$i],$loginData['company_id']);
                if($if_tag_exist){
                    //存在時，僅新增連結
                    $source_add_link = array(
                        'arl_article_id'                => $article['article_id'],
                        'arl_article_tag_id'            => $if_tag_exist,
                        'arl_article_tag_status'        => 0,
                        'arl_article_tag_company_id'    => $loginData['company_id'],
                    );
                    $this->model_article_tag->func_add_link($source_add_link);
                }else{
                    //不存在時，新增標籤，且同時新增連結
                    $source_add_tag = array(
                        'article_tag_string'        => $my_tag_array[$i],
                        'article_tag_status'        => 0,
                        'article_tag_company_id'    => $loginData['company_id'],
                        'article_tag_lang_id'       => $loginData['lang_id'],
                    );
                    $insert_id = $this->model_article_tag->func_add($source_add_tag,TRUE);
                    $source_add_link = array(
                        'arl_article_id'                => $article['article_id'],
                        'arl_article_tag_id'            => $insert_id,
                        'arl_article_tag_status'        => 0,
                        'arl_article_tag_company_id'    => $loginData['company_id'],
                    );
                    $this->model_article_tag->func_add_link($source_add_link);
                }
            }
            /*標籤處理：檢查標籤是否存在，若存在則以原存在之標籤新增文章標籤連結，若不存在則新增標籤並同時新增文章標籤連結END*/

            /* ====== 針對檔案上傳做預防性回導 START ====== */

            $this->load->helper('remove_nbsp');
            if(!empty($_FILES['article_image']['tmp_name']))$source['article_image'] = get_hash_image_name().".".substr($_FILES['article_image']['name'], strrpos($_FILES['article_image']['name'],".")+1);//將檔案名稱轉成隨機雜湊英數
            if(empty($source['article_image']))$source['article_image'] = $this->input->post('article_image_ori');
            if($_FILES['article_image']['size']>1992000)redirect('article/update/' . $source['article_hash_id']);//圖片檔案大小大於2MB時停止上傳並導回瀏覽介面

            /* ====== 針對檔案上傳做預防性回導 END ======== */

            if(!empty($_FILES['article_image']['tmp_name'])){
                list($width, $height, $type, $attr) = getimagesize($_FILES['article_image']['tmp_name']);
                $source['article_image_width'] = $width;
                $source['article_image_height'] = $height;
                $ofs_source = iconv("UTF-8","BIG5", $source['article_image']);
                move_uploaded_file($_FILES["article_image"]["tmp_name"],"uploads/".$ofs_source);
            }

            $this->model_article->update_article_array($source);
            redirect('article', 'location', 301);
            exit;
        }

        //取得資料
        $data = $this->model_article->get_article($article_hash_id);
        /*取得標籤內容*/
        $tag_data = $this->model_article_tag->func_get_link_via_article_id($article['article_id'],$loginData['company_id']);
        for($i=0;$i<count($tag_data);$i++){
            $tag_data[$i]['tag_name'] = $this->model_article_tag->func_get($loginData['company_id'],$lang_id=1,$tag_data[$i]['arl_article_tag_id'])['article_tag_string'];
        }
        $data['tag_data'] = $tag_data;
        /*取得標籤內容END*/

        $data['msg'] = "";

        $this->article_viewer("update", $data);
    }

    public function test()
    {
        $this->load->helper('email');
        $subject = "email function test";
        $msg = "for test";
        $to = "endless640c@gmail.com";
        echo email_sender($subject, $msg, $to);
    }

    public function article_viewer($page, $data = array())
    {
        $loginData =  $this->session->all_userdata();
        $company_id = $loginData['company_id'];
        $lang_id    = $loginData['lang_id'];
        $this->load->model('model_language');
        $data['select_bar_language']  = $this->model_language->get_all_language($company_id);
        $data['language_id_selected'] = $lang_id;
        $data['default_script_link'] = TRUE;
        $this->load->view('templates/header_color',$data);
        $this->load->view('article/'. $page, $data);
        $this->load->view('templates/footer');
    }

    public function article_adapter()
    {
        $source = array();
        $source['article_company_id'] = $this->session->userdata('company_id');
        $source['article_lang_id'] = $this->session->userdata('lang_id');
        $source['article_title'] = $this->input->post('article_title');
        $source['article_alias'] = $this->input->post('article_alias');
        $source['article_digest'] = $this->input->post('article_digest');
        $source['article_hash_id'] = $this->input->post('article_hash_id');
        $source['article_address'] = $this->input->post('article_address');
        $source['article_content'] = $this->input->post('article_content');
        $source['article_status'] = $this->input->post('article_status');
        $source['article_lat'] = $this->input->post('article_lat');
        $source['article_lon'] = $this->input->post('article_lon');

        return $source;
    }

    public function banner_image_edit($article_hash_id)
    {
        $data['article_hash_id'] =  $article_hash_id;
        $data['image_list'] = $this->model_article_banner->func_get_image($article_hash_id);

        $loginData =  $this->session->all_userdata();
        $company_id = $loginData['company_id'];
        $lang_id    = $loginData['lang_id'];
        $this->load->model('model_language');
        $data['select_bar_language']  = $this->model_language->get_all_language($company_id);
        $data['language_id_selected'] = $lang_id;
        $this->load->view('templates/header_color',$data);
        $this->load->view('banner_image/image_edit',$data);
    }

    public function banner_image_upload($article_hash_id) {

        $data['article_hash_id'] =  $article_hash_id;

        $loginData =  $this->session->all_userdata();
        $company_id = $loginData['company_id'];
        $lang_id    = $loginData['lang_id'];
        $this->load->model('model_language');
        $data['select_bar_language']  = $this->model_language->get_all_language($company_id);
        $data['language_id_selected'] = $lang_id;
        $this->load->view('templates/header_color',$data);

        $this->load->view('banner_image/image_upload',$data);
    }

    /**
     * @param $article_hash_id
     * @param $image_id
     */
    public function banner_image_switch($article_hash_id, $image_id)
    {
        $this->model_article_banner->func_switch_image($image_id);
        redirect('article/banner/'.$article_hash_id);
    }
    public function banner_image_disable($article_hash_id, $image_id)
    {
        $this->model_article_banner->func_disable_image($image_id);
        redirect('article/banner/'.$article_hash_id);
    }

    public function func_query(){
        $name = ($this->input->get('term')) ? $this->input->get('term') : NULL;
        if($name!="") {
            $result = $this->model_article->get_article_via_title($name);
            if(count($result)==0){
                $result = $this->model_article->get_article_via_content($name);
            }
            foreach($result as &$value){
                $data[] = $value['article_title'];
            }
            echo json_encode($data);
        }else{
            $array['data'] = '查無資料';
            echo json_encode($array);
        }
    }

    public function get_tag_for_auto_complete()
    {
        $this->load->model('model_article_tag');
        if (isset($_GET['term']) && $_GET['term'] != '') {
            $tag_data   = array();
            $loginData  =  $this->session->all_userdata();
            $tag_data   = $this->model_article_tag->func_get_via_part_of_name($_GET['term'],$loginData['company_id'],$lang_id=1);
            for($i=0;$i<count($tag_data);$i++){
                $tag_array[] = $tag_data[$i]['article_tag_string'];
            }
            echo json_encode($tag_array);
        }
    }
}

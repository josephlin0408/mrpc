<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ctrl_inventory extends CI_Controller
{
    public $company_id;
    public $lang_id;
    public $user_data;
    public $switch;

    public function __construct()
    {
        parent::__construct();
        $helpers   = array('url', 'form','array','myurl');
        $libraries = array('form_validation', 'session');
        $this->load->helper($helpers);
        $this->load->library($libraries);
        $this->load->model('model_product_accounting');
        $this->user_data = $this->session->all_userdata();
        $this->company_id = $this->user_data['company_id'];
        $this->lang_id = $this->user_data['lang_id'];
        $this->session->set_userdata($this->user_data);
        $this->load->helper('verify_login');
        verify_login_admin($this->session->all_userdata());
    }

    /**
     * 產品類別管理
     */
    public function product_category_admin()
    {
        /*商品類別管理*/
        switch($this->input->post('SWITCH')) {
            case('add_category'):
                $data['category_company_id']    = $this->session->userdata('company_id');
                $data['category_lang_id']       = $this->session->userdata('lang_id');
                $data['category_name']          = $this->input->post('category_name');
                $this->model_product_accounting->func_add($data);
                redirect(base_url()."inventory/product/category/admin");
                exit;
                break;
            case('update_category_name'):
                $data['update_category_id']      = $this->input->post('update_category_id');
                $data['update_category_name']    = $this->input->post('update_category_name');
                $this->model_product_accounting->func_update($data);
                redirect(base_url()."inventory/product/category/admin");
                exit;
                break;
            case('search_bar_action'):
                $data['search_name'] = $this->input->post('search_name');
                $this->user_data['search_name'] = $this->input->post('search_name');
                break;
            case('switch_category_status'):
                $data['status_category_id']     = $this->input->post('status_category_id');
                $status_category_status = $this->input->post('status_category_status');
                if($status_category_status==0){
                    $new_category_status = 1;//若啟用中則轉暫停使用
                }else{
                    $new_category_status = 0;//若暫停使用中則轉啟用
                }
                $this->model_product_accounting->change_category_status($data['status_category_id'],$new_category_status);
                break;
        }
        /*商品類別管理END*/
        /*商品類別顯示*/
        if(isset($data['search_name'])){
            $data['doc'] = $this->model_product_accounting->func_get($this->company_id,$this->lang_id,$data['search_name']);
        }else{
            $data['search_name'] = '';
            $data['doc'] = $this->model_product_accounting->func_get($this->company_id,$this->lang_id,'');
        }
        /*擁有模組數*/
        if(count($data['doc'])<>0){
            for($i=0;$i<count($data['doc']);$i++){
                $category_id = $data['doc'][$i]['category_id'];
                $data['own_num'][$category_id] = $this->model_product_accounting->func_get_num_of_own_model_by_category($category_id);
            }
        }
        /*擁有模組數END*/
        /*商品類別顯示END*/
        $loginData =  $this->session->all_userdata();
        $company_id = $loginData['company_id'];
        $lang_id    = $loginData['lang_id'];
        $this->load->model('model_language');
        $data['select_bar_language']  = $this->model_language->get_all_language($company_id);
        $data['language_id_selected'] = $lang_id;
        $this->load->view('templates/header_color',$data);

        $this->load->view('inventory_admin/product/category_admin',$data);
    }
    /**
     * 產品模組管理
     */
    public function product_model_admin()
    {
        /* 初始化 開始 */
        $company_id = $this->session->userdata('company_id');
        $lang_id    = $this->session->userdata('lang_id');
        $data['search_model_category'] = $this->session->userdata('search_model_category');
        $data['search_model_name'] = $this->session->userdata('search_model_name');
        /* 初始化 結束 */

        /*若該客戶無任何模組類別，則導回類別管理頁面*/
        $all_model_category = $this->model_product_accounting->func_get($company_id,$lang_id,'');
        if(empty($all_model_category)){
            redirect('inventory/product/category/admin');
        }
        /*若該客戶無任何模組類別，則導回類別管理頁面END*/

        /* 商品類別管理 開始 */
        switch($this->input->post('SWITCH')){
            case('add_model'):
                $data['model_company_id']   = $this->session->userdata('company_id');
                $data['model_lang_id']      = $this->session->userdata('lang_id');
                $data['model_category_id']  = $this->input->post('add_model_category');
                $data['model_name']         = $this->input->post('model_name');
                $data['model_unit_name']    = $this->input->post('add_model_unit_name');
                $data['model_default_unit_price']       = $this->input->post('model_default_unit_price');
                $data['model_default_unit_cost']        = $this->input->post('add_model_default_unit_cost');
                $data['model_default_ori_qty']          = $this->input->post('add_model_default_ori_qty');
                $data['model_default_ori_unit_cost']    = $this->input->post('add_model_default_ori_unit_cost');
                $data['search_model_category'] = $this->input->post('add_model_category');
                $new_model_id = $this->model_product_accounting->func_add_model($data);

                /* 首次新增模組時，新增一筆模組屬性與屬性值 開始 */
                $source['attr_type_product_model_id']   = $new_model_id;
                $source['attr_type_name']               = "顏色";
                $source['attr_type_company_id']         = $company_id;
                $source['attr_type_lang_id']            = $lang_id;
                $new_attr_type_id                       = $this->model_product_accounting->func_add_model_attr_type($source);
                $cons['attr_company_id']        = $company_id;
                $cons['attr_lang_id']           = $lang_id;
                $cons['attr_model_id']          = $new_model_id;
                $cons['attr_type_id']           = $new_attr_type_id;
                $cons['add_attr_value_name']    = '單一';
                $this->model_product_accounting->func_add_attr_val($cons);
                /* 首次新增模組時，新增一筆模組屬性與屬性值 結束 */
                redirect(base_url()."inventory/product/model/admin");
                exit;
                break;

            case('update_model'):
                $data['model_category_id']              = $this->input->post('update_model_category_id');
                $data['model_name']                     = $this->input->post('model_name');
                $data['model_unit_name']                = $this->input->post('update_model_unit_name');
                $data['model_default_unit_price']       = $this->input->post('model_default_unit_price');
                $data['model_default_unit_cost']        = $this->input->post('update_model_default_unit_cost');
                $data['model_default_ori_qty']          = $this->input->post('update_model_default_ori_qty');
                $data['model_default_ori_unit_cost']    = $this->input->post('update_model_default_ori_unit_cost');
                $data['model_id']                       = $this->input->post('update_model_id');
                $data['model_init_product_id']          = $this->input->post('update_model_init_product_id');
                $this->model_product_accounting->func_update_model($data);
                $data['search_model_category'] = $this->input->post('update_model_category_id');
                redirect(base_url()."inventory/product/model/admin");
                exit;
                break;

            case('search_bar_action'):
                $user_data = $this->session->all_userdata();
                $user_data['search_model_category'] = $this->input->post('search_model_category');
                $user_data['search_model_name'] = $this->input->post('search_model_name');
                $this->session->set_userdata($user_data);

                $data['search_model_name']        = $this->input->post('search_model_name');
                $data['search_model_category']    = $this->input->post('search_model_category');
                break;
            case('switch_model_status'):
                $status_model_id = $this->input->post('status_model_id');
                $new_model_status = $this->input->post('model_status');
                if($new_model_status==0){
                    $new_model_status = 2;//若啟用中則轉暫停使用
                }elseif($new_model_status==2){
                    $new_model_status = 0;//若暫停使用中則轉啟用
                }else{
                    $new_model_status = 2;//若都不是則轉暫停使用
                }
                $this->model_product_accounting->func_change_model_status($status_model_id,$new_model_status);
                redirect(base_url()."inventory/product/model/admin");
                exit;
                break;
        }
        /* 商品類別管理 結束*/

        /* 商品模組列表查詢 開始 */
        $data['doc'] = $this->model_product_accounting->func_get_model($this->company_id,$this->lang_id, $data['search_model_name'], $data['search_model_category']);
        /* 商品模組列表查詢 結束 */

        /* 為新增功能建立下拉式選單所需資料 開始 */
        $data['category_doc'] = $this->model_product_accounting->func_get($this->company_id,$this->lang_id,'');
        $data['category_name_id'] = i_array_column($data['category_doc'], 'category_name', 'category_id');
        /* 為新增功能建立下拉式選單所需資料 結束 */

        /* 畫面顯示商品數所需資料 開始 */
        for($i=0;$i<count($data['doc']);$i++){
            $data['doc'][$i]['model_product_num'] = count($this->model_product_accounting->func_get_model_content($this->company_id,$this->lang_id,$data['doc'][$i]['model_id']));
        }
        /* 畫面顯示商品數所需資料 結束 */

        /* 為編輯功能建立下拉式選單所需資料 開始 */
        for($i=0;$i<count($data['doc']);$i++){
            $search_con['model_id'] = $data['doc'][$i]['model_id'];
            $data['model_product_list'][$search_con['model_id']] = $this->model_product_accounting->func_get_product($this->company_id,$this->lang_id,$search_con);
        }
        /* 為編輯功能建立下拉式選單所需資料 結束 */

        /* 預設產品ID號顯示內容 開始 */
        $doc_str = array();
        for($i=0;$i<count($data['doc']);$i++){
            $product_id = $data['doc'][$i]['model_init_product_id'];
            $temp_doc = $this->model_product_accounting->func_get_attr_link($product_id);
            for($j=0;$j<count($temp_doc);$j++){
                $attr_type_name = $this->model_product_accounting->func_get_attr_type_name_via_id($temp_doc[$j]['main_attr_link_product_attr_type_id']);
                $attr_name      = $this->model_product_accounting->func_get_attr_name_via_id($temp_doc[$j]['main_attr_link_product_attr_id']);
                $doc_str[$product_id][$j] = '{'.$attr_type_name.':'.$attr_name.'}';
            }
        }
        $data['attr_str'] = $doc_str;

        /* 預設產品ID號顯示內容 開始 */

        $this->load->model('model_language');
        $data['select_bar_language']  = $this->model_language->get_all_language($company_id);
        $data['language_id_selected'] = $lang_id;
        $this->load->view('templates/header_color',$data);
        $this->load->view('inventory_admin/product/model_admin',$data);
    }

    /**
     * 產品標籤管理
     */
    public function product_attribute_admin()
    {
        /* 初始化 開始 */
        $company_id = $this->session->userdata('company_id');
        $lang_id    = $this->session->userdata('lang_id');
        $con_model_id = $this->input->post('con_model_id');

        if($con_model_id!="") {
            $user_data = $this->session->all_userdata();//取得當前session
            $user_data['con_model_id'] = $con_model_id;//將類別模組的ID放到session
            $this->session->set_userdata($user_data);
            $data['con_model_id'] = $con_model_id;//放到前台以便於作業
            redirect(base_url()."inventory/product/attribute/admin");
            exit;
        } else {
            $data['con_model_id'] = $this->session->userdata('con_model_id');

        }
        /* 初始化 結束 */

        /* 偵測模組內部是否已經有產品 開始 */
        $temp_doc = $this->model_product_accounting->func_get_model_content($company_id,$lang_id,$data['con_model_id']);
        if(!empty($temp_doc)){
            $data['model_content_exist'] = true;
        }else{
            $data['model_content_exist'] = false;
        }
        /* 偵測模組內部是否已經有產品 結束 */
        $data['doc'] =  $this->model_product_accounting->func_get_model_attr_type($company_id,$lang_id,$data);
        $data['model_attr_type_doc'] = $this->model_product_accounting->func_get_model($company_id,$lang_id);
        //$data['model_name_array'] = j_array_column($data['model_attr_type_doc'], 'model_name', 'model_id');

        /* 顯示擁有值數量 */
        for($i=0;$i<count($data['doc']);$i++){
            $data['num'][$data['doc'][$i]['attr_type_id']] = $this->model_product_accounting->func_get_attr_val_num($data['doc'][$i]['attr_type_id']);
            $data['doc'][$i]['attr_type_val'] = $this->model_product_accounting->func_get_attr_val_via_type_id($data['doc'][$i]['attr_type_id']);
        }
        /*顯示擁有值數量END*/
        $this->load->model('model_language');
        $data['select_bar_language']  = $this->model_language->get_all_language($company_id);
        $data['language_id_selected'] = $lang_id;
        $this->load->view('templates/header_color',$data);
        $this->load->view('inventory_admin/product/attribute_admin',$data);
    }

    public function add_attribute_type()
    {
        /*設置擁有屬性上限*/
        $attr_type_limit = 3;
        $this->load->model('model_product_accounting');
        $cons['con_model_id'] = $this->input->post('con_model_id');
        $result = $this->model_product_accounting->func_get_model_attr_type(1,1,$cons);
        if(count($result)>=$attr_type_limit){
            redirect('inventory/product/attribute/admin');
        }
        /*設置擁有屬性上限END*/

        $source['attr_type_company_id']         = $this->session->userdata('company_id');
        $source['attr_type_lang_id']            = $this->session->userdata('lang_id');
        $source['attr_type_product_model_id']   = $this->input->post('con_model_id');;
        $source['attr_type_name']               = $this->input->post('add_attr_type_name');
        $new_attr_type_id                       = $this->model_product_accounting->func_add_model_attr_type($source);
        /* 新增模組屬性時新增一筆屬性值 開始 */
        $cons['attr_company_id']        = $this->session->userdata('company_id');
        $cons['attr_lang_id']           = $this->session->userdata('lang_id');
        $cons['attr_model_id']          = $this->input->post('con_model_id');;
        $cons['attr_type_id']           = $new_attr_type_id;
        $cons['add_attr_value_name']    = '第一筆屬性值';
        $this->model_product_accounting->func_add_attr_val($cons);
        /* 新增模組屬性時新增一筆屬性值 結束 */
        $this->product_attribute_admin();
    }

    public function update_attribute_type()
    {
        $source['attr_type_id']         = $this->input->post('update_attr_type_id');
        $source['attr_type_name']       = $this->input->post('update_attr_type_name');
        $this->model_product_accounting->func_update_model_attr_type($source);
        $this->product_attribute_admin();
    }

    public function product_attribute_value_admin()
    {
        /*資訊接收*/
        $data['attr_type_id']  = $this->input->post('attr_type_id');
        $data['attr_model_id'] = $this->input->post('attr_model_id');

        /*資訊接收END*/
        /*功能列*/
        switch($this->input->post('SWITCH')){
            case('add_attr_val'):
                $data['attr_company_id'] = $this->company_id;
                $data['attr_lang_id']    = $this->lang_id;
                $data['add_attr_value_name'] = $this->input->post('add_attr_value_name');
                $temp_id = $this->model_product_accounting->func_add_attr_val($data);
                /*偵測模組內部是否已經有產品*/
                $temp_doc = $this->model_product_accounting->func_get_model_content($this->company_id,$this->lang_id,$data['attr_model_id']);
                if(!empty($temp_doc)){//若已有產品在資料庫內，表示非首創產品
                    $addSWITCH = 'add_model_attr_val_causing_add_product';
                    $addData['add_model_id']        = $data['attr_model_id'];
                    $addData['add_attr_type_id']    = $data['attr_type_id'];
                    $addData['add_attr_id']         = $temp_id;
                    $this->product_model_content_add($addSWITCH,$addData);
                }
                /*偵測模組內部是否已經有產品END*/
                break;
            case('update_attr_val'):
                $data['attr_id']        = $this->input->post('update_attr_id');
                $data['attr_val_name']  = $this->input->post('update_attr_val_name');
                $this->model_product_accounting->func_update_attr_val($data);
                break;

        }
        /*功能列END*/
        /*顯示ID VS 中文*/
        $cons['con_model_id'] = $data['attr_model_id'];
        $data['attr_type_doc'] = $this->model_product_accounting->func_get_model_attr_type($this->company_id,$this->lang_id,$cons);
        $data['attr_type_name_id'] = i_array_column($data['attr_type_doc'], 'attr_type_name', 'attr_type_id');
//        echo'<pre>';print_r($data['attr_type_name_id']);echo'</pre><hr>';
        /*顯示ID VS 中文END*/
        /*畫面顯示*/
        $data['doc'] = $this->model_product_accounting->func_get_attr_val($this->company_id,$this->lang_id,$data);
        /*畫面顯示END*/

        $loginData =  $this->session->all_userdata();
        $company_id = $loginData['company_id'];
        $lang_id    = $loginData['lang_id'];
        $this->load->model('model_language');
        $data['select_bar_language']  = $this->model_language->get_all_language($company_id);
        $data['language_id_selected'] = $lang_id;
        $this->load->view('templates/header_color',$data);

        $this->load->view('inventory_admin/product/attribute_value_admin',$data);
    }
    public function product_model_content_admin($model_id=NULL)
    {
        $this->company_id = $this->company_id;
        $this->lang_id    = $this->lang_id;
        /*預設搜尋內容*/
        $search_con['product_status']   = '';
        if($model_id){
            $search_con['model_id'] = $model_id;
        }else{
            $search_con['model_id']         = $this->input->post('con_model_id');//必要條件
        }
        if(empty($search_con['model_id'])){
            redirect('inventory/product/model/admin');
        }
        /*預設搜尋內容END*/

        /*商品產品管理*/
        switch($this->input->post('SWITCH')){
            case('update_product'):
                $data['product_id']              = $this->input->post('update_product_id');
                $data['product_unit_price']      = $this->input->post('update_product_unit_price');
                $data['product_unit_cost']       = $this->input->post('update_product_unit_cost');
                $data['product_ori_qty']         = $this->input->post('update_product_ori_qty');
                $data['product_ori_unit_cost']   = $this->input->post('update_product_ori_unit_cost');
                $data['product_status']          = $this->input->post('update_product_status');
                $data['product_list_price']      = $this->input->post('update_product_list_price');
                $data['product_base_id']         = $this->input->post('update_product_base_id');
                $data['product_base_count']      = $this->input->post('update_product_base_count');
                $this->model_product_accounting->func_update_product($data);
                break;
            case('search_bar_action'):
                break;
        }
        /*模組產品管理END*/
        /*模組產品顯示*/
        $data['doc_product'] = $this->model_product_accounting->func_get_product($this->company_id,$this->lang_id,$search_con);
//        echo'<pre>';print_r($data['doc_product']);echo'</pre><hr>';
        $data['doc_model'] = $this->model_product_accounting->func_get_model_selected($this->company_id,$this->lang_id,$search_con);
        /*產品屬性顯示*/
        for($i=0;$i<count($data['doc_product']);$i++){
            $data['doc_attr_link'][] = $this->model_product_accounting->func_get_attr_link($data['doc_product'][$i]['product_id']);
        }
        for($i=0;$i<count($data['doc_attr_link']);$i++){
            for($j=0;$j<count($data['doc_attr_link'][$i]);$j++){
                $attr_type_name = $this->model_product_accounting->func_get_attr_type_name_via_id($data['doc_attr_link'][$i][$j]['main_attr_link_product_attr_type_id']);
                $attr_name      = $this->model_product_accounting->func_get_attr_name_via_id($data['doc_attr_link'][$i][$j]['main_attr_link_product_attr_id']);
                $data['echo_attr_link'][$data['doc_attr_link'][$i][$j]['main_attr_link_product_id']][] = $attr_type_name.':'.$attr_name;
            }
        }
        /*產品屬性顯示END*/
        /*模組產品顯示END*/
        /*主圖檢查與顯示*/
        for($i=0;$i<count($data['doc_product']);$i++){
            if(empty($data['doc_product'][$i]['product_image'])){
                $all_img = $this->model_product_accounting->func_get_image($data['doc_product'][$i]['product_id']);
                if(!empty($all_img)){
                    $data['doc_product'][$i]['product_image']       = base_url().$all_img[0]['image_url'];
                    $data['doc_product'][$i]['product_image_id']    = $all_img[0]['image_id'];
                    $this->model_product_accounting->func_add_image_data_of_product($all_img[0]['image_product_id'],$data['doc_product'][$i]['product_image'],$data['doc_product'][$i]['product_image_id']);
//                    echo'<pre>';print_r($all_img);echo'</pre><hr>';
                }
            }
        }
        /*主圖檢查與顯示END*/

        $loginData =  $this->session->all_userdata();
        $company_id = $loginData['company_id'];
        $lang_id    = $loginData['lang_id'];
        $this->load->model('model_language');
        $data['select_bar_language']  = $this->model_language->get_all_language($company_id);
        $data['language_id_selected'] = $lang_id;
        $this->load->view('templates/header_color',$data);

        $this->load->view('inventory_admin/product/model_content_admin',$data);
    }

    public function product_model_content_add($SWITCH=NULL,$addData=NULL)
    {
        $this->load->library('ProductAdd');
        //if($SWITCH===NULL)$SWITCH = $this->input->post('SWITCH');
        $data['con_model_id']   = $this->input->post('con_model_id');
        switch($this->input->post('SWITCH')){
            case('first_add_product'):
                /*偵測模組內部是否已經有產品*/
                $temp_doc = $this->model_product_accounting->func_get_model_content($this->company_id,$this->lang_id,$data['con_model_id']);
                if(!empty($temp_doc))redirect('inventory/product/model/admin');//如果已經有產品，則無再次新增之效果，防止重新整理頁面
                /*偵測模組內部是否已經有產品END*/
                /*整理屬性資料*/
                $data['model_doc']      = $this->model_product_accounting->func_get_model_via_id($this->company_id,$this->lang_id,$data['con_model_id']);
                $data['attr_type']      = $this->model_product_accounting->func_get_model_attr_type($this->company_id,$this->lang_id,$data);
                $data['attr_model_id']  = $data['con_model_id'];
                $result_num = 1;
                for($i=0;$i<count($data['attr_type']);$i++){
                    $data['attr_type_id']       = $data['attr_type'][$i]['attr_type_id'];
                    $data['attr_type_val'][$i]  = $this->model_product_accounting->func_get_attr_val($this->company_id,$this->lang_id,$data);
                    $result_num                 *= count($data['attr_type_val'][$i]);
                }
                /*整理屬性資料END*/
                /*整理產品資料*/
                $source['product_company_id']           = $this->company_id;
                $source['product_lang_id']              = $this->lang_id;
                $source['product_model_id']             = $data['con_model_id'];
                $source['product_unit_price']           = $data['model_doc']['model_default_unit_price'];
                $source['product_unit_cost']            = $data['model_doc']['model_default_unit_cost'];
                $source['product_ori_qty']              = $data['model_doc']['model_default_ori_qty'];
                $source['product_ori_unit_cost']        = $data['model_doc']['model_default_ori_unit_cost'];
                $source['product_status']               = 0;
                /*整理產品資料END*/
                /*新增產品並留下新增產品ID號*/
                for($i=0;$i<$result_num;$i++){
                    $product_id =  $this->model_product_accounting->func_add_product($source);
                    for($j=0;$j<count($data['attr_type_val']);$j++){
                        $new_product_id[] = $product_id;
                    }
                }
                /*新增產品並留下新增產品ID號END*/
                /*為該產品新增屬性標籤*/
                /* count($data['attr_type_val']) 表示有幾種屬性 */
                /* $result_num 表示將會產生幾種產品 */
                /* count($data['attr_type_val'][$i] 表示該屬性有幾種值 */
                /* 標籤數 = 商品數 * 屬性數 */
                /* $link_num 表示標籤數 */
                $ProductAdd = new ProductAdd;
                /*array("attr_type_id,attr_id","attr_type_id,attr_id"))*/
                for($i=0;$i<count($data['attr_type_val']);$i++){
                    for($j=0;$j<count($data['attr_type_val'][$i]);$j++){
                        $array_var[$i][$j] = $data['attr_type_val'][$i][$j]['attr_type_id'].','.$data['attr_type_val'][$i][$j]['attr_id'];
                    }
                }
                for($i=0;$i<count($array_var);$i++){
                    $ProductAdd->add_dimension($array_var[$i]);
                }
                $source['product_main_attr_link'] = $ProductAdd->start();
                for($i=0;$i<count($source['product_main_attr_link']);$i++){
                    $source['product_main_attr_link'][$i]['product_id'] = $new_product_id[$i];
                    $source['product_main_attr_link'][$i]['model_id']   = $data['con_model_id'];
                    $this->model_product_accounting->func_add_product_main_attr_link($source['product_main_attr_link'][$i]);
                }
                /*為該產品新增屬性標籤END*/
                /*新增產品後，改變模組狀態*/
                $this->model_product_accounting->func_change_model_status($data['con_model_id'],'0');//0表示啟用、1表示停用
                /*新增產品後，改變模組狀態END*/
                /*新增產品後，改變模組預設的產品ID號*/
                $this->model_product_accounting->func_change_model_init_product_id($data['con_model_id'],array_shift($new_product_id));
                /*新增產品後，改變模組預設的產品ID號END*/
                $this->product_model_content_admin($data['con_model_id']);
                break;
            case('add_model_attr_val_causing_add_product'):
                $data['model_doc'] = $this->model_product_accounting->func_get_model_via_id($this->company_id,$this->lang_id,$addData['add_model_id']);

                /*整理產品資料*/
                $source['product_company_id']    = $this->company_id;
                $source['product_lang_id']       = $this->lang_id;
                $source['product_model_id']      = $addData['add_model_id'];
                $source['product_unit_price']    = $data['model_doc']['model_default_unit_price'];
                $source['product_unit_cost']     = $data['model_doc']['model_default_unit_cost'];
                $source['product_ori_qty']       = $data['model_doc']['model_default_ori_qty'];
                $source['product_ori_unit_cost'] = $data['model_doc']['model_default_ori_unit_cost'];
                $source['product_status']        = 0;
                /*整理產品資料END*/

                /*決定要新增幾個產品*/
                $cons['con_model_id'] = $addData['add_model_id'];
                $temp_model_attr_doc = $this->model_product_accounting->func_get_model_attr_type($this->company_id,$this->lang_id,$cons);
                $temp_result = $this->model_product_accounting->func_get_other_attr_type($this->company_id,$this->lang_id,$addData['add_model_id'],$addData['add_attr_type_id']);
                $result_num = 1;
                for($i=0;$i<count($temp_result);$i++){//count($temp_result)為有幾種屬性
                    $attr[$i] = $this->model_product_accounting->func_get_attr_val_same($this->company_id,$this->lang_id,$addData['add_model_id'],$temp_result[$i]['attr_type_id']);
                    $result_num *= count($attr[$i]);//取得之結果為要新增的產品數
                }

                /*決定新增幾個產品END*/
                /*新增產品並留下新增產品ID號*/
                $new_product_id = array();
                for($i=0;$i<$result_num;$i++){
                    $product_id =  $this->model_product_accounting->func_add_product($source);
                    for($j=0;$j<count($temp_model_attr_doc);$j++){
                        $new_product_id[] = $product_id;
                    }
                }
                /*新增產品並留下新增產品ID號END*/

                /*為該產品新增屬性標籤*/
                $ProductAdd = new ProductAdd;
                /*整理class所需資料*/
                $attr[][0] = $this->model_product_accounting->get_attr_via_id($addData['add_attr_id']);
                for($i=0;$i<count($attr);$i++){
                    for($j=0;$j<count($attr[$i]);$j++){
                        $array_var[$i][$j] = $attr[$i][$j]['attr_type_id'].','.$attr[$i][$j]['attr_id'];
                    }
                }
                /*整理class所需資料END*/

                for($i=0;$i<count($array_var);$i++){
                    $ProductAdd->add_dimension($array_var[$i]);
                }
                $source['product_main_attr_link'] = $ProductAdd->start();

                /*修正產品ID號*/
                for($i=0;$i<count($source['product_main_attr_link']);$i++){
                    $source['product_main_attr_link'][$i]['product_id'] = $new_product_id[$i];
                    $source['product_main_attr_link'][$i]['model_id'] = $addData['add_model_id'];
                    $this->model_product_accounting->func_add_product_main_attr_link($source['product_main_attr_link'][$i]);
                }
                /*修正產品ID號END*/
                /*為該產品新增屬性標籤END*/
                break;
        }
    }

    public function product_model_content_image_upload()
    {
        $data['image_product_id']   =  $this->input->post('image_product_id');
        $data['con_model_id']       = $this->input->post('con_model_id');
//        echo'<pre>';print_r($data);echo'</pre><hr>';

        //用SESSION儲存搜尋條件
        $this->user_data = $this->session->all_userdata();
        if(isset($post['image_product_id'])){
            $data['image_product_id'] = $post['image_product_id'];
            $this->user_data['image_product_id'] = $post['image_product_id'];
        }else{
            if(isset($this->user_data['image_product_id']))$data['image_product_id'] = $this->user_data['image_product_id'];
        }
        if(isset($post['con_model_id'])){
            $data['con_model_id'] = $post['con_model_id'];
            $this->user_data['con_model_id'] = $post['con_model_id'];
        }else{
            if(isset($this->user_data['con_model_id']))$data['con_model_id'] = $this->user_data['con_model_id'];
        }
        $this->session->set_userdata($this->user_data);
        //用SESSION儲存搜尋條件


        $loginData =  $this->session->all_userdata();
        $company_id = $loginData['company_id'];
        $lang_id    = $loginData['lang_id'];
        $this->load->model('model_language');
        $data['select_bar_language']  = $this->model_language->get_all_language($company_id);
        $data['language_id_selected'] = $lang_id;
        $this->load->view('templates/header_color',$data);

        $this->load->view('inventory_admin/product/model_content_image_upload',$data);
    }

    public function product_model_content_image_admin()
    {
        $data['con_model_id'] = $this->input->post('con_model_id');

        switch($this->input->post('SWITCH')){
            case('change_image_status_selected'):
                $image_id       = $this->input->post('image_id');
                $image_status   = $this->input->post('image_status');
                switch($image_status){
                    case(0):
                        $new_image_status = 1;
                        break;
                    case(1):
                        $new_image_status = 0;
                        break;
                    default:
                        $new_image_status = 0;
                }
                $this->model_product_accounting->func_change_image_status($image_id,$new_image_status);
                break;
            case('main_this_image'):
                $image_id           = $this->input->post('image_id');
                $image_url_full     = $this->input->post('image_url_full');
                $image_product_id   = $this->input->post('image_product_id');
                $this->model_product_accounting->func_add_image_data_of_product($image_product_id,$image_url_full,$image_id);
                break;
        }

        $data['image_product_id']   =  $this->input->post('image_product_id');//必要
        $data['image_product_list'] = $this->model_product_accounting->func_get_image($data['image_product_id']);
        $data['main_img_id']        = $this->model_product_accounting->func_get_main_img_id_via_product_id($data['image_product_id']);

        $loginData =  $this->session->all_userdata();
        $company_id = $loginData['company_id'];
        $lang_id    = $loginData['lang_id'];
        $this->load->model('model_language');
        $data['select_bar_language']  = $this->model_language->get_all_language($company_id);
        $data['language_id_selected'] = $lang_id;
        $this->load->view('templates/header_color',$data);

        $this->load->view('inventory_admin/product/model_content_image_admin',$data);
    }

    public function func_get_model_meta_description()
    {
        $model_id = $this->input->post('model_id');
        $description = $this->model_product_accounting->get_meta_description($model_id);
        echo $description;
    }

    public function func_update_model_meta_description()
    {
        $source['model_meta_description']   = $this->input->post('model_meta_description');
        $source['model_id']                 = $this->input->post('model_id');
        $this->model_product_accounting->func_update_model_meta_description($source);
        $this->product_model_admin();
    }

    public function model_description_update_form($model_id)
    {
        $description = $this->model_product_accounting->get_model_description($model_id);
        $data = array(
            'description'   => $description,
            'model_id'      => $model_id,
        );

        $loginData =  $this->session->all_userdata();
        $company_id = $loginData['company_id'];
        $lang_id    = $loginData['lang_id'];
        $this->load->model('model_language');
        $data['select_bar_language']  = $this->model_language->get_all_language($company_id);
        $data['language_id_selected'] = $lang_id;
        $this->load->view('templates/header_color',$data);

        $this->load->view('inventory_admin/product/model_description_update_form',$data);
    }

    public function model_description_update()
    {
        $source['model_id']             = $this->input->post('model_id');
        $source['model_description']    = $this->input->post('model_description');
        $this->model_product_accounting->func_update_model_description($source);
        $this->product_model_admin();
    }
}
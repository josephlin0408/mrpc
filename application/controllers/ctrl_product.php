<?php
class Ctrl_product extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('model_product_color');
        $this->load->model('model_product_size');
        $this->load->model('model_product');
        $this->load->model('model_product_type');
        $this->load->library('session');
        $this->load->helper('verify_login');

        verify_login_admin($this->session->all_userdata());
    }

    public function index($recorder_per_page = 10, $current_page = 1)
    {
        $post = $this->input->post();

        if(empty($recorder_per_page))$post['recorder_per_page'] = 20; else $post['recorder_per_page'] = $recorder_per_page;
        if(empty($current_page))$post['current_page'] = 1; else $post['current_page'] = $current_page;
        $post['enable'] = 1;

        $data = $this->model_product->read($post);

        if($data['result']!="true")redirect(base_url()."product/item/list/20/1?s=null");

        $data['product_type_fk'] = $this->model_product_type->get_product_type_fk(1);

        $data['list_url'] = "product/item/list";
        $data['create_url'] = "product/item/create";
        $data['update_url'] = "product/item/update";
        $data['delete_url'] = "product/item/delete";

        $data['recorder_per_page'] = $post['recorder_per_page'];
        $data['current_page'] = $post['current_page'];
        if(!isset($post['keyword']))$post['keyword'] = "";
        $data['keyword'] = $post['keyword'];

        foreach ($post as $key => $value) {
            if($value != "")
            {
                $data[$key] = $value;
            }
        }

        $this->load->view('templates/header_color');
        $this->load->view('product/list_color',$data);

    }

    public function create()
    {

        if ($_POST) {

            $_product_type = ($this->input->post('_product_type')) ? $this->input->post('_product_type') : NULL;
            $name = ($this->input->post('name')) ? $this->input->post('name') : NULL;
            $token = ($this->input->post('token')) ? $this->input->post('token') : NULL;
            $instock = ($this->input->post('instock')) ? $this->input->post('instock') : 0;
            $priority = ($this->input->post('priority')) ? $this->input->post('priority') : 0;
            $price_ntd = ($this->input->post('price_ntd')) ? $this->input->post('price_ntd') : 0;
            $price_rmb = ($this->input->post('price_rmb')) ? $this->input->post('price_rmb') : 0;
            $sale_price_ntd = ($this->input->post('sale_price_ntd')) ? $this->input->post('sale_price_ntd') : 0;
            $sale_price_rmb = ($this->input->post('sale_price_rmb')) ? $this->input->post('sale_price_rmb') : 0;
            $content = ($this->input->post('content')) ? $this->input->post('content') : NULL;
            $shipping_fee_tw = ($this->input->post('shipping_fee_tw')) ? $this->input->post('shipping_fee_tw') : 0;
            $shipping_fee_tw_free_condition = ($this->input->post('shipping_fee_tw_free_condition')) ? $this->input->post('shipping_fee_tw_free_condition') : 0;
            $shipping_fee_il = ($this->input->post('shipping_fee_tw')) ? $this->input->post('shipping_fee_tw') : 0;
            $shipping_fee_il_free_condition = ($this->input->post('shipping_fee_tw')) ? $this->input->post('shipping_fee_tw') : 0;
            $shipping_fee_as = ($this->input->post('shipping_fee_tw')) ? $this->input->post('shipping_fee_tw') : 0;
            $shipping_fee_as_free_condition = ($this->input->post('shipping_fee_tw')) ? $this->input->post('shipping_fee_tw') : 0;

            $data = array(
                '_product_type' => $_product_type,
                'name' => $name,
                'token' => $token,
                'instock' => $instock,
                'priority' => $priority,
                'price_ntd' => $price_ntd,
                'price_rmb' => $price_rmb,
                'sale_price_ntd' => $sale_price_ntd,
                'sale_price_rmb' => $sale_price_rmb,
                'content' => $content,
                'shipping_fee_tw' => $shipping_fee_tw,
                'shipping_fee_tw_free_condition' => $shipping_fee_tw_free_condition,
                'shipping_fee_il' => $shipping_fee_il,
                'shipping_fee_il_free_condition' => $shipping_fee_il_free_condition,
                'shipping_fee_as' => $shipping_fee_as,
                'shipping_fee_as_free_condition' => $shipping_fee_as_free_condition,

            );

//            if($_FILES['userfile']['name']!="") {
//
//                $data['image'] = $this->do_upload();
//
//            }

            $data = $this->model_product->set_product($data);

            $data['list_url'] = "product/item/list";

            redirect(base_url().'product/item/update/'.$data['id']);

        }else{

            $data['product_type_fk'] = $this->model_product_type->get_product_type_fk();

            $data['list_url'] = "product/item/list/20/1";

            $this->load->view('templates/header_color.php');

            $this->load->view('product/create.php', $data);

        }
    }

    function check_and_generate_product_item($product_idx){

        //取出 size
        $size_list = $this->model_product_size->get_product_size(1, $product_idx);
        //取出 color
        $color_list = $this->model_product_color->get_product_color(1, $product_idx);

        $size_amount = count($size_list);
        $color_amount = count($color_list);
        for($size_index = 0 ; $size_index < $size_amount; $size_index++){

            for($color_index = 0 ; $color_index < $color_amount; $color_index++){

                //檢查每一個尺寸對應顏色，如果沒有就新增該筆庫存
                $temp = $this->model_product_item->get_product_item_by_color_and_size($size_list[$size_index]['idx'], $color_list[$color_index]['idx']);

                if(count($temp) < 1){
                    $data['token'] = sha1(time().rand());
                    $data['_product'] = $product_idx;
                    $data['_color'] = $color_list[$color_index]['idx'];
                    $data['_size'] = $size_list[$size_index]['idx'];
                    $data['enable'] = 1;
                    $this->model_product_item->set_product_item($data);

                }
            }

        }

    }

    public function update($idx)
    {
        if ($_POST) {

            $idx = ($this->input->post('idx')) ? $this->input->post('idx') : NULL;
            $_product_type = ($this->input->post('_product_type')) ? $this->input->post('_product_type') : NULL;
            $name = ($this->input->post('name')) ? $this->input->post('name') : NULL;
            $priority = ($this->input->post('priority')) ? $this->input->post('priority') : NULL;
            $price_ntd = ($this->input->post('price_ntd')) ? $this->input->post('price_ntd') : NULL;
            $price_rmb = ($this->input->post('price_rmb')) ? $this->input->post('price_rmb') : NULL;
            $sale_price_ntd = ($this->input->post('sale_price_ntd')) ? $this->input->post('sale_price_ntd') : NULL;
            $sale_price_rmb = ($this->input->post('sale_price_rmb')) ? $this->input->post('sale_price_rmb') : NULL;
            $content = ($this->input->post('content')) ? $this->input->post('content') : NULL;
            $shipping_fee_tw = ($this->input->post('shipping_fee_tw')) ? $this->input->post('shipping_fee_tw') : 0;
            $shipping_fee_tw_free_condition = ($this->input->post('shipping_fee_tw_free_condition')) ? $this->input->post('shipping_fee_tw_free_condition') : 0;
            $shipping_fee_il = ($this->input->post('shipping_fee_il')) ? $this->input->post('shipping_fee_il') : 0;
            $shipping_fee_il_free_condition = ($this->input->post('shipping_fee_il_free_condition')) ? $this->input->post('shipping_fee_il_free_condition') : 0;
            $shipping_fee_as = ($this->input->post('shipping_fee_as')) ? $this->input->post('shipping_fee_as') : 0;
            $shipping_fee_as_free_condition = ($this->input->post('shipping_fee_as_free_condition')) ? $this->input->post('shipping_fee_as_free_condition') : 0;

            $data = array(

                'idx' => $idx,
                '_product_type' => $_product_type,
                'name' => $name,
                'priority' => $priority,
                'price_ntd' => $price_ntd,
                'price_rmb' => $price_rmb,
                'sale_price_ntd' => $sale_price_ntd,
                'sale_price_rmb' => $sale_price_rmb,
                'content' => $content,
                'shipping_fee_tw' => $shipping_fee_tw,
                'shipping_fee_tw_free_condition' => $shipping_fee_tw_free_condition,
                'shipping_fee_il' => $shipping_fee_il,
                'shipping_fee_il_free_condition' => $shipping_fee_il_free_condition,
                'shipping_fee_as' => $shipping_fee_as,
                'shipping_fee_as_free_condition' => $shipping_fee_as_free_condition,

            );

            $this->model_product->update_product($data);

            redirect(base_url().'product/item/list/20/1');

        }else{

            $result = $this->model_product->get_product_detail($idx);

            $data['data'] = $result[0];
            $data['stock_list_url'] = "product/stock/list/".$idx;
            $data['color_list_url'] = "product/color/list/".$idx;
            $data['size_list_url'] = "product/size/list/".$idx;
            $data['upsell_list_url'] = "product/upsell/list/".$idx;
            $data['list_url'] = "product/item/list/20/1";
            $data['product_type_fk'] = $this->model_product_type->get_product_type_fk();

            $this->load->view('templates/header_color.php');
            $this->load->view('product/update.php', $data);

        }
    }

    public function delete($idx)
    {
        $data = array(
            'idx' => $idx,
            'enable' => 0
        );

        $this->model_product->delete_product($data);

        redirect(base_url().'product/item/list/20/1');
    }

    public function get_product_detail($idx){

        $result = $this->model_product->get_product_detail($idx);

        $data['data'] = $result[0];
        $data['list_url'] = "product/item/list/20/1";
        $data['product_type_fk'] = $this->model_product_type->get_product_type_fk();

        $this->load->view('templates/header.php');
        $this->load->view('product/update.php', $data);


    }

    public function create_product_image($idx)
    {
        if ($_POST) {

            $_product = ($this->input->post('_product')) ? $this->input->post('_product') : NULL;
            $image =  $this->do_upload();
            $order = ($this->input->post('order')) ? $this->input->post('order') : 0;
            $enable = ($this->input->post('enable')) ? $this->input->post('enable') : 0;

            $data = array(

                '_product' => $_product,
                'image' => $image,
                'order' => $order,
                'enable' => $enable,

            );

            $data = $this->model_product->set_product_image($data);

//            redirect(base_url().'product/item/edit/'.$data['id']);

        }else{

            $data['id'] = $idx;

            $this->load->view('product_image/create.php', $data);

        }
    }

    public function get_product_image($idx){

        $result = $this->model_product->get_product_image($idx);

        if(!empty($result)){
            echo "<pre>";
            print_r($result);
            echo "</pre>";
        }


    }

    public function update_product_image($idx)
    {
        if ($_POST) {

            $idx = ($this->input->post('idx')) ? $this->input->post('idx') : NULL;
            $order = ($this->input->post('order')) ? $this->input->post('order') : NULL;

            $data = array(
                'idx' => $idx,
                'order' => $order,

            );

            $data = $this->model_product->update_product_image($data);

            echo "<pre>";
            print_r($data);
            echo "</pre>";

        }else{

            $result = $this->model_product->get_product_image($idx);

            $data['data'] = $result[0];

            $this->load->view('product_image/update.php', $data);

        }
    }

    public function delete_product_image($idx)
    {

        $this->model_product->delete_product_image($idx);

    }

    function do_upload($image_width = 1335, $upload_path = "uploads/")
    {
        $this->load->library('upload');

        $files = $_FILES;

        $filename = $this->get_hash_name($files['userfile']['name']);

        $_FILES['userfile']['name']= $filename;
        $_FILES['userfile']['type'] = $files['userfile']['type'];
        $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'];
        $_FILES['userfile']['error'] = $files['userfile']['error'];
        $_FILES['userfile']['size'] = $files['userfile']['size'];

        $config = $this->set_upload_options($upload_path);
        $this->upload->initialize($config);

        if (!$this->upload->do_upload())
        {
            echo $this->upload->display_errors();
        }
        else
        {
            //上傳成功：建立小圖
            $config = $this->set_resize_options($this->upload->data(), $image_width, $filename);

            $this->load->library('image_lib',$config);

            if ( ! $this->image_lib->resize())
            {
                echo $this->image_lib->display_errors();
            }
            else
            {
                return $config['new_image'];
            }
        }
    }

    private function get_hash_name($ori_name){

        $ext = explode('.',$ori_name);

        $hash_name = sha1(current($ext).rand());

        return $hash_name.'.'.end($ext);
    }

    private function set_upload_options($upload_path){
        $config = array();
        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']      = '7000';
        $config['overwrite']     = FALSE;

        return $config;
    }

    private function set_resize_options($data, $image_width, $filename){
        $config = array();
        $config['image_library'] = 'gd2';
        $config['source_image']	= $data['full_path'];
        $config['maintain_ratio'] = TRUE;
        $config['new_image'] = $filename;
        $config['width'] = $image_width;
        $config['height'] = $image_width;

        return $config;
    }

}

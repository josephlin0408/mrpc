<?php
class Ctrl_product_color extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('model_product_color');
        $this->load->model('model_product_image');
        $this->load->library('session');
        $this->load->helper('verify_login');

        verify_login_admin($this->session->all_userdata());
    }

    public function index($product_id)
    {
        $enable = 1;
        $data['id'] = $product_id;
        $data['data'] = $this->model_product_color->get_product_color($enable, $product_id);
        $counter = count($data['data']);
        for($i=0;$i<$counter;$i++){
            $data['data'][$i]['images'] = $this->model_product_image->get_product_color_image($data['data'][$i]['idx']);
        }

        $this->load->view('templates/header_color.php');
        $this->load->view('product_color/index.php', $data);
    }

    public function create($product_idx)
    {
        if ($_POST) {

            $name = ($this->input->post('name')) ? $this->input->post('name') : NULL;
            $code = ($this->input->post('code')) ? $this->input->post('code') : NULL;
            $token = ($this->input->post('token')) ? $this->input->post('token') : NULL;
            $instock = ($this->input->post('instock')) ? $this->input->post('instock') : 0;
            $_product = ($this->input->post('_product')) ? $this->input->post('_product') : NULL;
            $priority = ($this->input->post('priority')) ? $this->input->post('priority') : 0;

            $data = array(
                'priority' => $priority,
                'name' => $name,
                'code' => strtoupper($code),
                'token' => $token,
                'instock' => $instock,
                '_product' => $_product,
                'enable' => "1",
            );

            $color_idx = $this->model_product_color->set_product_color($data);

            if($_FILES['userfile']['name']!="" AND $color_idx !="") {

                $image =  $this->do_upload();
                $data_image = array(

                    '_product' => $product_idx,
                    '_color' => $color_idx,
                    'image' => $image,
                    'order' => 1,
                    'enable' => 1,

                );

                $this->model_product_image->set_product_image($data_image);
            }

            redirect(base_url().'product/color/list/'.$product_idx);

        }else{

            $data['product_idx'] = $product_idx;

            $this->load->view('templates/header_color');
            $this->load->view('product_color/create.php',$data);

        }
    }

    public function update($product_idx,$color_idx)
    {
        if ($_POST) {

            $code = ($this->input->post('code')) ? $this->input->post('code') : NULL;
            $name = ($this->input->post('name')) ? $this->input->post('name') : NULL;
            $instock = ($this->input->post('instock')) ? $this->input->post('instock') : 0;
            $priority = ($this->input->post('priority')) ? $this->input->post('priority') : 0;

            if($_FILES['userfile']['name']!="") {

                $image =  $this->do_upload();
                $data_image = array(

                    '_product' => $product_idx,
                    '_color' => $color_idx,
                    'image' => $image,

                );

                $this->model_product_image->set_product_image($data_image);
            }

            $data_color = array(
                'priority' => $priority,
                'code' => strtoupper($code),
                'name' => $name,
                'instock' => $instock,
                'idx' => $color_idx,
            );

            $this->model_product_color->update_product_color($data_color);

            redirect(base_url().'product/color/list/'.$product_idx);

        }else{

            $result = $this->model_product_color->get_one_product_color($color_idx);

            $data['data'] = $result[0];

            $data['images'] = $this->model_product_image->get_product_color_image($color_idx);

            $data['color_idx'] = $color_idx;
            $data['product_idx'] = $product_idx;

            $this->load->view('templates/header_color.php');
            $this->load->view('product_color/update.php', $data);

        }
    }

    public function delete_product_color($product_idx,$color_idx)
    {
        $this->model_product_color->delete_product_color($color_idx);;

        redirect(base_url().'product/color/list/'.$product_idx);
    }

    function do_upload($image_width = 450, $upload_path = "uploads/")
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

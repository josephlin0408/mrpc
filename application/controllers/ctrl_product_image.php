<?php
class Ctrl_product_image extends CI_Controller
{
    public function __construct() {
        parent::__construct();

        $this->load->model('model_product_image');

        $this->load->library('session');
        $this->load->helper('verify_login');
        verify_login_admin($this->session->all_userdata());
    }

    public function delete_product_image($product_idx, $color_idx, $image_idx)
    {
        $this->model_product_image->delete_product_image($image_idx);

        redirect(base_url().'product/color/update/'.$product_idx.'/'.$color_idx);
    }

    function do_upload($image_width = 1335, $upload_path = "uploads/post/")
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

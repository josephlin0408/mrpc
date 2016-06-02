<?php
class Ctrl_product_size extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('model_product_size');
        $this->load->library('session');
        $this->load->helper('verify_login');

        verify_login_admin($this->session->all_userdata());
    }

    public function index($product_idx)
    {
        $enable = 1;

        $data['data'] = $this->model_product_size->get_product_size($enable, $product_idx);

        $data['product_idx'] = $product_idx;

        $this->load->view('templates/header.php');
        $this->load->view('product_size/index.php', $data);
        $this->load->view('templates/footer.php');

    }

    public function create($product_idx)
    {
        if ($_POST) {

            $name = ($this->input->post('name')) ? $this->input->post('name') : NULL;
            $_product = ($this->input->post('_product')) ? $this->input->post('_product') : NULL;

            $data = array(

                'name' => $name,
                '_product' => $_product,
                'enable' => "1",

            );

            $data = $this->model_product_size->set_product_size($data);



            redirect(base_url()."product/size/list/".$product_idx);

        }else{

            $data['product_idx'] = $product_idx;

            $this->load->view('templates/header.php');
            $this->load->view('product_size/create.php',$data);

        }
    }

    public function update($product_idx,$size_idx)
    {
        if ($_POST) {

            $name = ($this->input->post('name')) ? $this->input->post('name') : NULL;

            $data = array(
                'name' => $name,
                'idx' => $size_idx,
            );

            $this->model_product_size->update_product_size($data);

            redirect(base_url().'product/size/list/'.$product_idx);

        }else{

            $result = $this->model_product_size->get_one_product_size($size_idx);

            $data['data'] = $result[0];

            $data['size_idx'] = $size_idx;

            $this->load->view('templates/header.php');
            $this->load->view('product_size/update.php', $data);

        }
    }

    public function delete_product_size($product_idx,$size_idx)
    {
        $this->model_product_size->delete_product_size($size_idx);;

        redirect(base_url().'product/size/list/'.$product_idx);
    }

}

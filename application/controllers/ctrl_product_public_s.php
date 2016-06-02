<?php
class Ctrl_product_public extends CI_Controller
{
    public function __construct() {

        parent::__construct();

        $this->load->model('model_product');

        $this->load->model('model_product_type');

        $this->load->model('model_product_item');

        $this->load->model('model_product_upsell');

        $this->load->model('model_product_image');

        $this->load->model('model_product_color');

        $this->load->model('model_product_size');
    }

    public function get_data(){

        $data = $this->model_product->get_product_item_for_item_list();

        return $data;
    }

    public function index()
    {
        $data = $this->get_data();

        echo "<pre>";
        print_r($data);
    }

    public function json()
    {
        $data = $this->get_data();

        echo json_encode($data);
    }
}

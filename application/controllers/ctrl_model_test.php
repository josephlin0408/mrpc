<?php

class Ctrl_model_test extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('session');
        $this->load->library('form_validation');

        $this->load->model('model_member');

        $this->load->helper('date');
        $this->load->helper('form');
        $this->load->helper('verify_login');

    }

    public function model_test()
    {
        $this->load->model('Model_order');
        $data =  $this->Model_order->update_order_payment_status(2,1);
        echo'<pre>';print_r($data);echo'<br></pre><hr>';
    }
}

<?php
class Ctrl_dashboard extends CI_Controller
{

    public function __construct()
	{
		parent::__construct();

        $this->load->library('session');
        $this->load->library('form_validation');

        $this->load->model('model_order');

        $this->load->helper('date');
        $this->load->helper('form');
        $this->load->helper('verify_login');

        verify_login_admin($this->session->all_userdata());
	}

	public function index()
	{
        $data['order_count_today']          = $this->model_order->get_order_count_today();
        $data['order_count_yesterday']      = $this->model_order->get_order_count_yesterday();
        $data['order_count_ready_to_ship']  = $this->model_order->get_orders_count_ready_to_ship();

		$this->load->view('templates/header_color');
		$this->load->view('dashboard/index',$data);
	}
}

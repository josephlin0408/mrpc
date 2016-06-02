<?php
class Ctrl_system extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('model_system');
        $this->load->library('session');
        $this->load->helper('verify_login');
        verify_login_admin($this->session->all_userdata());
    }

    public function update()
    {
        if ($_POST) {

            $cod_service_fee = ($this->input->post('cod_service_fee')) ? $this->input->post('cod_service_fee') : NULL;
            $priority_service_fee = ($this->input->post('priority_service_fee')) ? $this->input->post('priority_service_fee') : NULL;
            $shipping_fee_tw = ($this->input->post('shipping_fee_tw')) ? $this->input->post('shipping_fee_tw') : 0;
            $shipping_fee_tw_free_condition = ($this->input->post('shipping_fee_tw_free_condition')) ? $this->input->post('shipping_fee_tw_free_condition') : 0;
            $shipping_fee_il = ($this->input->post('shipping_fee_il')) ? $this->input->post('shipping_fee_il') : 0;
            $shipping_fee_as = ($this->input->post('shipping_fee_as')) ? $this->input->post('shipping_fee_as') : 0;

            $data = array(
                'idx' => 1,
                'priority_service_fee' => $priority_service_fee,
                'cod_service_fee' => $cod_service_fee,
                'shipping_fee_tw' => $shipping_fee_tw,
                'shipping_fee_tw_free_condition' => $shipping_fee_tw_free_condition,
                'shipping_fee_il' => $shipping_fee_il,
                'shipping_fee_as' => $shipping_fee_as,
            );

            $this->model_system->update_system($data);

            redirect(base_url().'product/item/list/20/1');

        }else{

            $data['data'] = $this->model_system->get_system_config();

            $this->load->view('templates/header.php');
            $this->load->view('system/update.php', $data);

        }
    }

}

<?php
class Ctrl_product_type extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('model_product_type');
        $this->load->library('session');
        $this->load->helper('verify_login');

        verify_login_admin($this->session->all_userdata());
    }

    public function get_url($data = array()){
        $data['list_url'] = "product/type/list";
        $data['create_url'] = "product/type/create";
        $data['update_url'] = "product/type/update";
        $data['delete_url'] = "product/type/delete";

        return $data;
    }

    public function index()
    {
        $enable = null;

        $enable = (isset($_POST['enable']) AND $_POST['enable'] != "") ? $this->input->post('enable') : NULL;

        $data['data'] = $this->model_product_type->get_product_type_fk(1);

        $data = $this->get_url($data);

        $this->load->view('templates/header_color.php');
        $this->load->view('product_type/index.php', $data);

    }

    public function create()
    {
        if ($_POST) {

            $name = ($this->input->post('name')) ? $this->input->post('name') : NULL;
            $order = ($this->input->post('order')) ? $this->input->post('order') : NULL;
            $data = array(

                'name' => $name,
                'order' => $order
            );

            $data = $this->model_product_type->set_product_type_fk($data);

            redirect(base_url().'product/type/list');

        }else{

            $data = $this->get_url();

            $this->load->view('templates/header_color.php');
            $this->load->view('product_type/create.php',$data);

        }
    }

    public function update($idx)
    {
        if ($_POST) {

            $name = ($this->input->post('name')) ? $this->input->post('name') : NULL;
            $order = ($this->input->post('order')) ? $this->input->post('order') : NULL;
            $idx = ($this->input->post('idx')) ? $this->input->post('idx') : NULL;

            $data = array(
                'name' => $name,
                'order' => $order,
                'idx' => $idx,
            );

            $data = $this->model_product_type->update_product_type_fk($data);

            redirect(base_url().'product/type/list');

        }else{

            $result = $this->model_product_type->get_one_product_type_fk($idx);

            $data['data'] = $result[0];

            $data = $this->get_url($data);

            $this->load->view('templates/header_color.php');
            $this->load->view('product_type/update.php', $data);

        }
    }

    public function delete_product_type_fk($id)
    {
        $this->model_product_type->delete_product_type_fk($id);;

        redirect(base_url().'product/type/list');
    }

}

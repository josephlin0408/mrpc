<?php
class Ctrl_product_item extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('model_product_item');
        $this->load->model('model_product_size');
        $this->load->model('model_product_color');
        $this->load->library('session');
        $this->load->helper('verify_login');

        verify_login_admin($this->session->all_userdata());
    }

    public function index()
    {
        $post = $this->input->post();
        if(count($post['idx'])>0){
            $this->model_product_color->update_product_color_all($post);
            redirect(base_url().'product/item/list/20/1');
        }

        $data['data'] = $this->model_product_color->get_product_color_all();

        $this->load->view('templates/header.php');
        $this->load->view('product_item/index.php', $data);

    }

    public function create()
    {
        if ($_POST) {

            $_product = ($this->input->post('_product')) ? $this->input->post('_product') : NULL;
            $_color = ($this->input->post('_color')) ? $this->input->post('_color') : NULL;
            $_size = ($this->input->post('_size')) ? $this->input->post('_size') : NULL;
            $in_store = ($this->input->post('in_store')) ? $this->input->post('in_store') : NULL;
            $enable = (isset($_POST['enable']) AND $_POST['enable'] !="") ? $this->input->post('enable') : NULL;


            $data = array(

                '_product' => $_product,
                '_color' => $_color,
                '_size' => $_size,
                'in_store' => $in_store,
                'enable' => $enable,

            );

            $data = $this->model_product_item->set_product_item($data);

//            redirect(base_url().'product/item/list');

        }else{

            $this->load->view('product_item/create.php');

        }
    }

    public function update($product_idx,$stock_idx)
    {
        if ($_POST) {

            $remain_count = ($this->input->post('remain_count')) ? $this->input->post('remain_count') : NULL;

            $data = array(
                'remain_count' => $remain_count,
                'idx' => $stock_idx,
            );


            $data = $this->model_product_item->update_product_item($data);

            redirect(base_url().'product/stock/list/'.$product_idx);

        }else{

            $result = $this->model_product_item->get_one_product_item($stock_idx);

            $data['data'] = $result[0];

            $this->load->view('templates/header.php');
            $this->load->view('product_item/update.php', $data);

        }
    }

    public function delete_product_item($id)
    {
        $this->model_product_item->delete_product_item($id);;

        redirect(base_url().'product/item/list');
    }

}

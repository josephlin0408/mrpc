<?php
class Ctrl_product_upsell extends CI_Controller
{
    public function __construct() {
        parent::__construct();

        $this->load->model('model_product_upsell');
        $this->load->library('session');
        $this->load->helper('verify_login','url', 'login');
        $this->load->helper('form');
        verify_login_admin($this->session->all_userdata());
    }

    public function index($product_idx){

        $source['add_product'] = $this->input->post('add_product');
        $source['product_target_name'] = $this->input->post('product_target_name');
        if(!empty($source['add_product'])){
            $product_target_name_id = $this->get_product_id($source['product_target_name']);
            if(!empty($product_target_name_id)){
                $con = array(
                    '_product'          => $source['add_product'],
                    '_upsell_product'   => $product_target_name_id,
                    'enable'            => '1'
                );
                $this->load->model('Model_product_upsell');
                $this->Model_product_upsell->func_add($con);
            }else{
                $product_idx = $source['add_product'];
            }
        }

        /*舊版取資料方式*/
//        $enable = 1;
//        $data['data'] = $this->model_product_upsell->get_product_upsell($enable, $product_idx);
//        echo'<pre>';print_r($data);echo'</pre><hr>';
        /*舊版取資料方式END*/

        /*vincent版取資料方式*/
        $enable = 1;
        $data['data'] = $this->model_product_upsell->get_product_upsell_list($enable, $product_idx);
            /*修改畫面ID>NAME*/
            $this->load->model('model_product');
            $source['product'] = $this->model_product->get_all_id_and_name();
//            $data['id_vs_name'] = array_column($source['product'], 'name', 'idx');
            for($i=0;$i<count($source['product']);$i++){
                $data['id_vs_name'][$source['product'][$i]['idx']] = $source['product'][$i]['name'];
            }
            /*修改畫面END*/
        /*vincent版取資料方式END*/
        $data['product_idx'] = $product_idx;

        $this->load->view('templates/header_color.php');
        $this->load->view('product_upsell/index.php', $data);

    }

    public function create($product_idx)
    {
        if ($_POST) {

            $product_target_id = ($this->input->post('product_target_id')) ? $this->input->post('product_target_id') : NULL;
            $_product = ($this->input->post('_product')) ? $this->input->post('_product') : NULL;

            $data = array(

                '_upsell_product' => $product_target_id,
                '_product' => $_product,
                'enable' => "1",

            );

            $data = $this->model_product_upsell->set_product_upsell($data);

            redirect(base_url()."product/upsell/list/".$product_idx);

        }else{

            $data['product_idx'] = $product_idx;

            $this->load->view('templates/header_color.php');
            $this->load->view('product_upsell/create.php',$data);

        }
    }

    public function update($product_idx,$upsell_idx)
    {
        if ($_POST) {

            $name = ($this->input->post('name')) ? $this->input->post('name') : NULL;

            $data = array(
                'name' => $name,
                'idx' => $upsell_idx,
            );

            $this->model_product_upsell->update_product_upsell($data);

            redirect(base_url().'product/upsell/list/'.$product_idx);

        }else{

            $result = $this->model_product_upsell->get_one_product_upsell($upsell_idx);

            $data['data'] = $result[0];

            $data['upsell_idx'] = $upsell_idx;

            $this->load->view('templates/header_color.php');
            $this->load->view('product_upsell/update.php', $data);

        }
    }

    public function delete_product_upsell($product_idx,$upsell_idx)
    {
        $this->model_product_upsell->delete_product_upsell($upsell_idx);;

        redirect(base_url().'product/upsell/list/'.$product_idx);
    }

    public function query()
    {
        $this->load->model('model_product');
        $product_name = ($this->input->get('term')) ? $this->input->get('term') : NULL;
        if($product_name!=""){

            $result = $this->model_product->get_product_by_name($product_name);

//            echo'<pre>';print_r($result);echo'</pre><hr>';

            foreach($result as &$value){
                $data[] = $value['name'];
            }
//            echo'<pre>';print_r($data);echo'</pre><hr>';
            echo json_encode($data);

        }else{

            $array['data'] = '查無資料';
//            echo'<pre>';print_r($array['data']);echo'</pre><hr>';
            echo json_encode($array);
        }
    }

    public function get_product_id($name)
    {
//        $data['name'] = $this->input->post('name');
        $this->load->model('Model_product_upsell');
        return $this->Model_product_upsell->get_id_via_name($name);
//        echo $data['b'] = $this->input->post('b');
    }
}

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

        $data = $this->model_product->get_product();

        for($i=0;$i<count($data);$i++) {
            $data[$i]['upsell'] = $this->model_product_upsell->get_product_upsell(1, $data[$i]['idx']);
        }
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

    public function get_next_upsell($product_id, $upsell_id)
    {
        $rsp = array();
        //取得all upsell
        $data['upsell'] = $this->model_product_upsell->get_product_upsell(1, $product_id);

        echo "<pre>";
        print_r($data);

        //抓到是哪一個 upsell_id
        for($i=0;$i<count($data['upsell']);$i++){
            if($data['upsell'][$i]['idx'] == $upsell_id) {
                $i++;
                $counter = count($data['upsell']);
                if($i == $counter){
                    //最後一筆的意思
                    $i = 0;
                    $rsp['upsell_id'] = $data['upsell'][$i]['idx'];
                    $rsp['image'] = $data['upsell'][$i]['image'];
                    $rsp['sale_price_ntd'] = $data['upsell'][$i]['image'];
                    break;
                }else{
                    //非最後一筆的意思
                    $rsp['upsell_id'] = $data['upsell'][$i]['idx'];
                    $rsp['image'] = $data['upsell'][$i]['image'];
                    $rsp['sale_price_ntd'] = $data['upsell'][$i]['image'];
                    break;
                }

            }
        }

        print_r($rsp);
    }
}

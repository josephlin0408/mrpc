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

        $this->load->model('model_system_config');

        $this->load->model('model_product_color');

        $this->load->model('model_product_size');
    }

    public function get_data(){

        $data = $this->model_product->get_product();

        for($i=0;$i < count($data);$i++) {

            $data[$i]['color'] = $this->model_product_color->get_product_color(1, $data[$i]['idx']);

            for($j=0;$j < count($data[$i]['color']);$j++) {

                $data[$i]['color'][$j]['picture'] = $this->model_product_image->get_product_color_image($data[$i]['color'][$j]['idx']);

            }

            $data[$i]['upsell'] = $this->model_product_upsell->get_product_upsell(1, $data[$i]['idx']);

            for($k=0;$k<count($data[$i]['upsell']);$k++) {

                $data[$i]['upsell'][$k]['color'] = $this->model_product_color->get_product_color(1, $data[$i]['upsell'][$k]['_upsell_product']);

                for($l=0;$l<count($data[$i]['upsell'][$k]['color']);$l++) {

                    $data[$i]['upsell'][$k]['color'][$l]['picture'] = $this->model_product_image->get_product_color_image($data[$i]['upsell'][$k]['color'][$l]['idx']);

                }
            }
        }
        return $data;
    }

    public function index() {
        $data = $this->get_data();
        print_r($data);
    }

    public function json()
    {
        $data = $this->get_data();

        echo json_encode($data);
    }

    public function get_type_data(){

        return $this->model_product_type->get_product_type_fk(1);

    }

    public function get_system_config(){

        return $this->model_system_config->get_system_config();

    }

    public function type()
    {
        $data = $this->get_type_data();

        echo "<pre>";
        print_r($data);
    }

    public function type_json()
    {
        $data = $this->get_type_data();
        echo json_encode($data);
    }

    public function config()
    {
        $data = $this->get_system_config();

        echo "<pre>";
        print_r($data);
    }

    public function config_json()
    {
        $data = $this->get_system_config();
        echo json_encode($data);
    }
}

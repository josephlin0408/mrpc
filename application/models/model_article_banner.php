<?php

class Model_article_banner extends CI_Model
{
    public function __construct() {
        $this->load->database();
    }

    public function func_get_image($article_id) {
        $this->db->where('image_article_hash_id', $article_id);
        return $this->db->get('banner_image')->result_array();
    }

    public function func_switch_image($image_id){
        $this->db->where('image_id', $image_id);
        $result = $this->db->get('banner_image')->row_array();
        switch($result['image_status']){
            case 0:
                $data['image_status'] = 1;
                break;
            case 1:
                $data['image_status'] = 0;
                break;
            case 2:
                $data['image_status'] = 0;
                break;
            default:
                $data['image_status'] = 0;
                break;
        }
        $this->db->where('image_id', $image_id);
        return $this->db->update('banner_image', $data);
    }
    public function func_disable_image($image_id){
        $data['image_status'] = 2;
        $this->db->where('image_id', $image_id);
        return $this->db->update('banner_image', $data);
    }

}
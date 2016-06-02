<?php

class model_ads extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
        $this->load->library('upload');
    }

    public function update_ads($target)
    {
        for($i=0;$i<count($target['ad_id']);$i++){
            $this->db->where('ad_id',$target['ad_id'][$i]);
            $this->db->where('ad_company_id',$target['ad_company_id']);
            $this->db->where('ad_lang_id',$target['ad_lang_id']);
            $data = array(
                'ad_link'   => $target['ad_link'][$i],
                'ad_source' => $target['ad_source'][$i],
                'ad_text'   => $target['ad_text'][$i],
            );
            $this->db->update('pas_ad',$data);
        }
    }

    public function get_ads($category,$company_id,$lang_id)
    {
        $this->db->where('ad_company_id',$company_id);
        $this->db->where('ad_lang_id',$lang_id);
        $this->db->where('ad_category',$category);
        return $this->db->get('pas_ad')->result_array();
    }

    public function func_get_ads_status($ad_id)
    {
        $this->db->where('ad_id',$ad_id);
        $source = $this->db->get('pas_ad')->row_array();
        return $source['ad_status'];
    }

    public function func_switch_ads_status($ad_id,$ori_ad_status)
    {
        $data = array(
            'ad_status' => 2,
        );
        switch($ori_ad_status){
            case(0):
                $data = array(
                    'ad_status' => 1,
                );
                break;
            case(1):
                $data = array(
                    'ad_status' => 0,
                );
                break;
        }
        $this->db->where('ad_id',$ad_id);
        $this->db->update('pas_ad',$data);
        return $data['ad_status'];
    }

    public function set_default_ads($category,$company_id,$lang_id)
    {
        $data = array(
            'ad_category'   => $category,
            'ad_company_id' => $company_id,
            'ad_lang_id'    => $lang_id,
            'ad_source'     => 'default_img.jpg',
            'ad_link'       => '',
            'ad_hash_id'    => 'z',
            'ad_status'     => 1,
            'ad_text'       => 'ads..',
        );
        for($i=0;$i<5;$i++){
            $this->db->insert('pas_ad',$data);
        }
    }

    public function getWhereTest()
    {
        $condition = array('1','4');
//        $this->db->where_in('ad_id',$condition);
//        $this->db->select_sum('ad_category','ID');
//        $this->db->where('ad_id','1');
//        $this->db->or_where('ad_id','4');
        $this->db->where_not_in('ad_id',$condition);
        $query = $this->db->get('pas_ad');
        return $query->result_array();
    }
}

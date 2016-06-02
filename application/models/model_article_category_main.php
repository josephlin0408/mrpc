<?php

class model_article_category_main extends CI_Model
{

    public function __construct() {
        $this->load->database();
    }

    public function func_get($company_id,$lang_id,$acm_id) {
        if(isset($acm_id))$this->db->where('acm_id',$acm_id);
        $this->db->where('acm_company_id',$company_id);
        $this->db->where('acm_lang_id',$lang_id);
        $this->db->order_by('acm_sort_id','asc');
        if(isset($acm_id)){
            return $this->db->get('article_category_main')->row_array();
        }else{
            return $this->db->get('article_category_main')->result_array();
        }
    }

    public function func_add($source)
    {
        $data = array(
            'acm_name'          => $source['acm_name'],
            'acm_sort_id'       => $source['acm_sort_id'],
            'acm_status'        => $source['acm_status'],
            'acm_company_id'    => $source['acm_company_id'],
            'acm_lang_id'       => $source['acm_lang_id'],
        );
        $this->db->insert('article_category_main',$data);
    }

    public function func_update($source)
    {
        $data = array(
            'acm_name'          => $source['acm_name'],
            'acm_sort_id'       => $source['acm_sort_id'],
            'acm_status'        => $source['acm_status'],
        );
        $this->db->where('acm_id',$source['acm_id']);
        $this->db->update('article_category_main',$data);
    }
}

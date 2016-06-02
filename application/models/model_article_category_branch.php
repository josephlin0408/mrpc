<?php

class model_article_category_branch extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function func_get($company_id,$lang_id,$acb_acm_id,$acb_id)
    {
        if(isset($acb_id))$this->db->where('acb_id',$acb_id);
        $this->db->where('acb_acm_id',$acb_acm_id);
        $this->db->where('acb_company_id',$company_id);
        $this->db->where('acb_lang_id',$lang_id);
        $this->db->order_by('acb_sort_id','asc');
        if(isset($acb_id)){
            return $this->db->get('article_category_branch')->row_array();
        }else{
            return $this->db->get('article_category_branch')->result_array();
        }
    }

    public function func_add($source)
    {
        $data = array(
            'acb_name'          => $source['acb_name'],
            'acb_sort_id'       => $source['acb_sort_id'],
            'acb_status'        => $source['acb_status'],
            'acb_company_id'    => $source['acb_company_id'],
            'acb_lang_id'       => $source['acb_lang_id'],
            'acb_acm_id'        => $source['acb_acm_id'],
        );
        $this->db->insert('article_category_branch',$data);
    }

    public function func_update($source)
    {
        $data = array(
            'acb_name'          => $source['acb_name'],
            'acb_sort_id'       => $source['acb_sort_id'],
            'acb_status'        => $source['acb_status'],
        );
        $this->db->where('acb_acm_id',$source['acb_acm_id']);
        $this->db->where('acb_id',$source['acb_id']);
        $this->db->update('article_category_branch',$data);
    }

    public function func_query($name) {
        $this->db->like('acb_name',$name);
        $this->db->order_by('acb_sort_id','desc');
        return $this->db->get('article_category_branch')->result_array();
    }

}

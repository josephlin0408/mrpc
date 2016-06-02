<?php

class model_navigation extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function func_get($company_id,$lang_id)
    {
        $this->db->order_by('nt_id','desc');
        $this->db->where('nt_company_id',$company_id);
        $this->db->where('nt_lang_id',$lang_id);
        return $this->db->get('nav_type')->result_array();
    }

    public function func_add($source)
    {
        $this->db->insert('nav_type',$source);
    }

    public function func_update($source)
    {
        $this->db->where('nt_company_id',$source['nt_company_id']);
        $this->db->where('nt_lang_id',$source['nt_lang_id']);
        $this->db->where('nt_id',$source['nt_id']);
        $this->db->update('nav_type',$source);
    }
}

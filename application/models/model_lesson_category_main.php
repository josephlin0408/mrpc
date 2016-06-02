<?php

class model_lesson_category_main extends CI_Model
{
    public function __construct() {
        $this->load->database();
    }

    public function func_get($company_id,$lang_id,$lesson_category_id) {
        if(isset($lesson_category_id))$this->db->where('lesson_category_id',$lesson_category_id);
        $this->db->where('lesson_company_id',$company_id);
        $this->db->where('lesson_lang_id',$lang_id);
        if(isset($lesson_category_id)){
            return $this->db->get('lesson_category')->row_array();
        }else{
            return $this->db->get('lesson_category')->result_array();
        }
    }

    public function func_get_available($company_id,$lang_id)
    {
        $this->db->where('lesson_company_id',$company_id);
        $this->db->where('lesson_lang_id',$lang_id);
        $this->db->where('lesson_status','0');
        return $this->db->get('lesson_category')->result_array();
    }

    public function func_add($source)
    {
        $data = array(
            'lesson_category_name'  => $source['lesson_category_name'],
            'lesson_status'         => $source['lesson_status'],
            'lesson_company_id'     => $source['lesson_company_id'],
            'lesson_lang_id'        => $source['lesson_lang_id'],
        );
        $this->db->insert('lesson_category',$data);
    }

    public function func_update($source)
    {
        $data = array(
            'lesson_category_name' => $source['lesson_category_name'],
            'lesson_status'        => $source['lesson_status'],
        );
        $this->db->where('lesson_category_id',$source['lesson_category_id']);
        $this->db->where('lesson_company_id',$source['lesson_company_id']);
        $this->db->where('lesson_lang_id',$source['lesson_lang_id']);
        $this->db->update('lesson_category',$data);
    }
}

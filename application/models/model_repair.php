<?php

class model_repair extends CI_Model
{
    public function __construct() {
        $this->load->database();
    }

    public function get_repair($company_id,$repair_id) {
        if(isset($repair_id))$this->db->where('repair_id',$repair_id);
        $this->db->where('repair_company_id',$company_id);
        if(isset($repair_id)){
            return $this->db->get('repair')->row_array();
        }else{
            return $this->db->get('repair')->result_array();
        }
    }

    public function get_lesson_via_category_id($company_id,$lang_id,$lesson_category_id)
    {
        $this->db->where('lesson_company_id',$company_id);
        $this->db->where('lesson_lang_id',$lang_id);
        $this->db->where('lesson_category_id',$lesson_category_id);
        return $this->db->get('lesson')->result_array();
    }

    public function add_model($source)
    {
        $data = array(
            'repair_product_name'               => $source['repair_product_name'],
            'repair_product_owner'              => $source['repair_product_owner'],
            'repair_product_owner_phone_number' => $source['repair_product_owner_phone_number'],
            'repair_date'                       => $source['repair_date'],
            'repair_store_data'                 => $source['repair_store_data'],
            'repair_store_staff_data'           => $source['repair_store_staff_data'],
            'repair_content'                    => $source['repair_content'],

            'repair_company_id'                 => $source['repair_company_id'],
            'repair_status'                     => $source['repair_status'],
        );
        $this->db->insert('repair',$data);
    }

    public function update_model($source)
    {
        $data = array(
            'repair_content'                    => $source['repair_content'],
        );

        $this->db->where('repair_id',$source['repair_id']);
        $this->db->where('repair_company_id',$source['repair_company_id']);
        $this->db->update('repair',$data);
    }

    public function set_field($update_id, $update_name, $update_value,$company_id)
    {
        $data = array(
            "$update_name"               => $update_value,
        );
        $this->db->where('repair_id',$update_id);
        $this->db->where('repair_company_id',$company_id);
        $this->db->update('repair',$data);
    }

    public function delete_repair($company_id,$repair_id)
    {
        $this->db->where('repair_company_id',$company_id);
        $this->db->where('repair_id',$repair_id);
        $this->db->delete('repair');
    }
}

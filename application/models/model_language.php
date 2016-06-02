<?php
class model_language extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_all_language($company_id)
    {
        $this->db->order_by('language_sort','desc');
        $this->db->where('language_company_id',$company_id);
        $query = $this->db->get('language',150);
        return $query->result_array();
    }
    public function get_all_language_available($company_id)
    {
        $this->db->order_by('language_sort','desc');
        $this->db->where('language_company_id',$company_id);
        $this->db->where('language_status',0);
        $query = $this->db->get('language',150);
        return $query->result_array();
    }
    public function quick_delete($company_id,$delete_language_id)
    {
        $this->db->where('language_company_id',$company_id);
        $this->db->where('language_id',$delete_language_id);
        $this->db->delete('language');
    }

    public function check_exist_sort($company_id,$sort_id)
    {
        $this->db->where('language_company_id',$company_id);
        $this->db->where('language_sort',$sort_id);
        return $this->db->get('language')->result_array();
    }

    public function quick_set_status($company_id,$status,$language_id)
    {
        $this->db->where('language_company_id',$company_id);
        $this->db->where('language_id',$language_id);
        $data = array(
            'language_status' => $status,
        );
        $this->db->update('language',$data);
    }

    public function quick_add($source)
    {
        $data = array(
            'language_name'         => $source['add_language_name'],
            'language_abbreviation' => $source['add_language_abbreviation'],
            'language_sort'         => $source['add_language_sort'],
            'language_status'       => $source['add_language_status'],
            'language_company_id'   => $source['add_company_id'],
        );
        $this->db->insert('language',$data);
    }

}

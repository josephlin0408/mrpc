<?php

class model_payment_method extends CI_Model
{

    public function __construct() {
        $this->load->database();
    }

    public function func_get($company_id, $lang_id) {
        $this->db->where('pm_company_id',$company_id);
        $this->db->where('pm_lang_id',$lang_id);
        return $this->db->get('payment_method')->result_array();
    }

    public function func_add($data) {
        $this->db->insert('payment_method',$data);
    }

    public function func_update_fee($pm_id,$pm_fee) {
        $data = array(
            'pm_fee' => $pm_fee,
        );
        $this->db->where('pm_id',$pm_id);
        $this->db->update('payment_method',$data);
    }

    public function func_update_status($pm_id,$new_status) {
        $data = array(
            'pm_status' => $new_status,
        );
        $this->db->where('pm_id',$pm_id);
        $this->db->update('payment_method',$data);
    }
}

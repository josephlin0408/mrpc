<?php
class Model_code_category extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_task_category()
    {
        $query = $this->db->get('tracking_code_category');
        return $query->result_array();
    }
}



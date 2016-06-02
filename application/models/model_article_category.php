<?php
class Model_article_category extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }


    public function get_task_category()
    {
        $query = $this->db->get('article_category');
        return $query->result_array();
    }
}



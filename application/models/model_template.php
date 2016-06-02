<?php

class Model_template extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_active_template($template_category_id)
    {
        $this->db->where('template_task_category',$template_category_id);

        $this->db->where('template_status', 1);

        $query = $this->db->get('email_template',1);

        return $query->row_array();

    }

    public function add_template_array($source)
    {
        $data = array();

        if(!empty($source['template_title']))$data['template_title'] = $source['template_title'];
        if(!empty($source['template_content']))$data['template_content'] = $source['template_content'];
        if(!empty($source['template_category']))$data['template_category'] = $source['template_category'];
        if(!empty($source['template_hash_id']))$data['template_hash_id'] = $source['template_hash_id'];

        if(count($data)>0)$this->db->insert('email_template', $source);

    }

    public function update_template_array($source)
    {
        $data = array();

        if(!empty($source['template_title']))$data['template_title'] = $source['template_title'];
        if(!empty($source['template_content']))$data['template_content'] = $source['template_content'];
        if($source['template_task_category']!="")$data['template_task_category'] = $source['template_task_category'];
        if($source['template_status']!="")$data['template_status'] = $source['template_status'];

        if($data['template_status']==1){  //若是設定 Active 將同類別的其他信件 Disable

            $this->db->where('template_task_category', $data['template_task_category']);
            $this->db->where('template_status', 1);

            $this->db->update('email_template', array('template_status'=> 0));
        }

        $this->db->where('template_hash_id', $source['template_hash_id']);

        $this->db->update('email_template', $data);
    }


    public function get_template($template_hash_id = FALSE)
    {
        if ($template_hash_id === FALSE)
        {
            $this->db->order_by("email_template.template_task_category", "ASC");

            $this->db->from('email_template')->where('template_status < 2');

            $query = $this->db->get();

            $data = $query->result_array();

        } else {

            if(strlen($template_hash_id)<40)show_404();
            $this->db->from('email_template')->where('template_hash_id', $template_hash_id);
            $query = $this->db->get();
            $data = $query->row_array();
        }

        return $data;

    }

}

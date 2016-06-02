<?php

class model_message extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function add_message($source)
    {
        $this->db->insert('message',$source);
    }

    public function get_message($company_id,$lang_id,$article_id)
    {
        $this->db->order_by('msg_id','DESC');
        $this->db->where('msg_company_id',$company_id);
        $this->db->where('msg_lang_id',$lang_id);
        if(isset($article_id)) $this->db->where('msg_article_id',$article_id);
        return $this->db->get('message')->result_array();
    }

    public function func_delete($msg_id)
    {
        $this->db->where('msg_id',$msg_id);
        $this->db->delete('message');
    }
}

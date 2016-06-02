<?php

class model_shipping_method extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function func_get($company_id, $lang_id)
    {
        $this->db->where('sm_company_id',$company_id);
        $this->db->where('sm_lang_id',$lang_id);
        return $this->db->get('shipping_method')->result_array();
    }

    public function func_add($data)
    {
        $this->db->insert('shipping_method',$data);
    }

    public function func_update($source)
    {
        $data = array(
            'sm_name' => $source['sm_name'],
            'sm_freight' => $source['sm_freight'],
            'sm_status' => $source['sm_status'],
        );
        $this->db->where('sm_id',$source['sm_id']);
        $this->db->update('shipping_method',$data);
    }

    public function func_update_status($pm_id,$new_status)
    {
        $data = array(
            'pm_status' => $new_status,
        );
        $this->db->where('pm_id',$pm_id);
        $this->db->update('payment_method',$data);
    }

//    public function get_active_article($article_category_id)
//    {
//        $this->db->where('article_task_category',$article_category_id);
//        $this->db->where('article_status', 1);
//        $this->db->where('article_company_id', $this->session->all_userdata()['company_id']);
//        $query = $this->db->get('article',1);
//        return $query->row_array();
//
//    }
//
//    public function add_article_array($source)
//    {
//        $data = array();
//
//        if(!empty($source['article_title']))$data['article_title'] = $source['article_title'];
//        if(!empty($source['article_content']))$data['article_content'] = $source['article_content'];
//        if(!empty($source['article_category']))$data['article_category'] = $source['article_category'];
//        if(!empty($source['article_hash_id']))$data['article_hash_id'] = $source['article_hash_id'];
//
//        if(count($data)>0)$this->db->insert('article', $source);
//
//    }
//
//    public function update_article_array($source)
//    {
//        $data = array();
//
//        if(!empty($source['article_title']))$data['article_title'] = $source['article_title'];
//        if(!empty($source['article_content']))$data['article_content'] = $source['article_content'];
//        if($source['article_task_category']!="")$data['article_task_category'] = $source['article_task_category'];
//        if($source['article_status']!="")$data['article_status'] = $source['article_status'];
//
//        if($data['article_status']==1){  //若是設定 Active 將同類別的其他信件 Disable
//
//            $this->db->where('article_status', 1);
//
//            $this->db->update('article', array('article_status'=> 0));
//        }
//
//        $this->db->where('article_hash_id', $source['article_hash_id']);
//
//        $this->db->update('article', $data);
//    }
//
//
//    public function get_article($article_hash_id = FALSE)
//    {
//        if ($article_hash_id === FALSE)
//        {
//            $this->db->order_by("article.article_task_category", "ASC");
//
//            $this->db->from('article')->where('article_status < 2');
//
//            $query = $this->db->get();
//
//            $data = $query->result_array();
//
//        } else {
//
//            if(strlen($article_hash_id)<40)show_404();
//            $this->db->from('article')->where('article_hash_id', $article_hash_id);
//            $query = $this->db->get();
//            $data = $query->row_array();
//        }
//
//        return $data;
//
//    }

}

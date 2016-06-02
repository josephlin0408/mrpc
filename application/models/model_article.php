<?php

class Model_article extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_active_article($article_category_id)
    {
        $this->db->where('article_category_id',$article_category_id);
        $this->db->where('article_status', 0);
        $this->db->where('article_company_id', $this->session->userdata('company_id'));
        $this->db->where('article_lang_id', $this->session->userdata('lang_id'));
        $query = $this->db->get('article',1);
        return $query->row_array();
    }

    public function add_article_array($source)
    {
        $data = array();

        if(!empty($source['article_title']))$data['article_title'] = $source['article_title'];
        if(!empty($source['article_content']))$data['article_content'] = $source['article_content'];
        if(!empty($source['article_category']))$data['article_category'] = $source['article_category'];
        if(!empty($source['article_hash_id']))$data['article_hash_id'] = $source['article_hash_id'];
        if(!empty($source['article_address']))$data['article_address'] = $source['article_address'];
        if(!empty($source['article_alias']))$data['article_alias'] = $source['article_alias'];
        if(!empty($source['article_digest']))$data['article_digest'] = $source['article_digest'];
        if(!empty($source['article_lat']))$data['article_lat'] = $source['article_lat'];
        if(!empty($source['article_lon']))$data['article_lon'] = $source['article_lon'];
        if(!empty($source['article_image']))$data['article_image'] = $source['article_image'];

        $data['article_company_id'] =  $this->session->userdata('company_id');
        $data['article_lang_id'] = $this->session->userdata('lang_id');

        if(count($data)>0)$this->db->insert('article', $data);

    }

    public function update_article_array($source)
    {
        $data = array();
        if(isset($source['article_title']))$data['article_title'] = $source['article_title'];
        if(isset($source['article_content']))$data['article_content'] = $source['article_content'];
        if(!empty($source['article_alias']))$data['article_alias'] = $source['article_alias'];
        if(!empty($source['article_address']))$data['article_address'] = $source['article_address'];
        if(!empty($source['article_digest']))$data['article_digest'] = $source['article_digest'];
        if(!empty($source['article_lat']))$data['article_lat'] = $source['article_lat'];
        if(!empty($source['article_lon']))$data['article_lon'] = $source['article_lon'];
        if(!empty($source['article_image']))$data['article_image'] = $source['article_image'];
        if(!empty($source['article_image_width']))$data['article_image_width'] = $source['article_image_width'];
        if(!empty($source['article_image_height']))$data['article_image_height'] = $source['article_image_height'];
        if($source['article_status']!="")$data['article_status'] = $source['article_status'];

        $this->db->where('article_company_id', $this->session->userdata('company_id'));
        $this->db->where('article_lang_id', $this->session->userdata('lang_id'));
        $this->db->where('article_hash_id', $source['article_hash_id']);
        $this->db->update('article', $data);
    }

    public function get_article($article_hash_id = FALSE, $article_category_id = null)
    {
        if ($article_hash_id === FALSE)
        {
            $this->db->order_by("article.article_id", "DESC");
            if($article_category_id != null) {
                $this->db->where('article_category_id', $article_category_id);
            }
            $this->db->where('article_company_id', $this->session->userdata('company_id'));
            $this->db->where('article_lang_id', $this->session->userdata('lang_id'));
            $this->db->from('article')->where('article_status < 2');

            $query = $this->db->get();

            $data = $query->result_array();

        } else {

            if(strlen($article_hash_id)<40)show_404();
            $this->db->where('article_company_id', $this->session->userdata('company_id'));
            $this->db->where('article_lang_id', $this->session->userdata('lang_id'));
            $this->db->from('article')->where('article_hash_id', $article_hash_id);
            $query = $this->db->get();
            $data = $query->row_array();
        }
        return $data;
    }

    public function get_article_via_title($name){
        $this->db->like('article_title', $name);
        $this->db->where('article_status', '!=2');
        $this->db->where('article_company_id', $this->session->userdata('company_id'));
        $this->db->where('article_lang_id', $this->session->userdata('lang_id'));
        return $this->db->get('article')->result_array();
    }

    public function get_article_via_content($name){
        $this->db->like('article_content', $name);
        $this->db->where('article_status', '!=2');
        $this->db->where('article_company_id', $this->session->userdata('company_id'));
        $this->db->where('article_lang_id', $this->session->userdata('lang_id'));
        return $this->db->get('article')->result_array();
    }

    public function func_get_article_title_via_id($article_id)
    {
        $this->db->where('article_id',$article_id);
        $article = $this->db->get('article')->row_array();
        if(isset($article['article_title']))return $article['article_title']; else return '';
    }

    public function func_test_exist($article_name)
    {
        if(isset($article_name))$this->db->where('article_title',$article_name);
        $result = $this->db->get('article')->row_array();
        if(!empty($result)){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function get_article_for_select($company_id,$lang_id)
    {
        $this->db->where('article_company_id',$company_id);
        $this->db->where('article_lang_id',$lang_id);
        $this->db->where('article_status',0);
        $this->db->select('article_hash_id,article_title,article_id');
        return $this->db->get('article')->result_array();
    }

}

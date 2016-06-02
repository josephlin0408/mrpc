<?php

class model_article_tag extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function func_get($company_id,$lang_id,$article_tag_id)
    {
        $this->db->where('article_tag_company_id', $company_id);
        $this->db->where('article_tag_lang_id', $lang_id);
        if(isset($article_tag_id)){
            $this->db->where('article_tag_id',$article_tag_id);
            return $this->db->get('article_tag')->row_array();
        }else{
            return $this->db->get('article_tag')->result_array();
        }
    }

    public function func_add($source,$return_switch = FALSE)
    {
        if(is_array($source)){
            $data = array(
                'article_tag_string'        => $source['article_tag_string'],
                'article_tag_status'        => $source['article_tag_status'],
                'article_tag_company_id'    => $source['article_tag_company_id'],
                'article_tag_lang_id'       => $source['article_tag_lang_id'],
            );
            $this->db->insert('article_tag',$data);
        }
        if($return_switch){
            return $this->db->insert_id();
        }
    }

    public function func_update($source)
    {
        if(is_array($source)){
            $data = array(
                'article_tag_string'        => $source['article_tag_string'],
                'article_tag_status'        => $source['article_tag_status'],
            );
            $this->db->where('article_tag_company_id',$source['article_tag_company_id']);
            $this->db->where('article_tag_lang_id',$source['article_tag_lang_id']);
            $this->db->where('article_tag_id',$source['article_tag_id']);
            $this->db->update('article_tag',$data);
        }
    }

    public function disable_all_link_selected($arl_article_tag_id,$arl_article_tag_company_id)
    {
        $data['arl_article_tag_status'] = '1';
        $this->db->where('arl_article_tag_id',$arl_article_tag_id);
        $this->db->where('arl_article_tag_company_id',$arl_article_tag_company_id);
        $this->db->update('article_tag_link',$data);
    }

    public function delete_all_link_with_tag_id($arl_article_tag_id,$arl_article_tag_company_id)
    {
        $this->db->where('arl_article_tag_id',$arl_article_tag_id);
        $this->db->where('arl_article_tag_company_id',$arl_article_tag_company_id);
        $this->db->delete('article_tag_link');
    }

    public function delete_all_article_tag_link($article_id, $company_id)
    {
        $this->db->where('arl_article_id',$article_id);
        $this->db->where('arl_article_tag_company_id',$company_id);
        $this->db->delete('article_tag_link');
    }

    public function func_add_link($source)
    {
        if(is_array($source)){
            $data = array(
                'arl_article_id'                => $source['arl_article_id'],
                'arl_article_tag_id'            => $source['arl_article_tag_id'],
                'arl_article_tag_status'        => $source['arl_article_tag_status'],
                'arl_article_tag_company_id'    => $source['arl_article_tag_company_id'],
            );
            $this->db->insert('article_tag_link',$data);
        }
    }

    public function func_if_exist($tag_name,$company_id)
    {
        $this->db->where('article_tag_string',$tag_name);
        $this->db->where('article_tag_company_id',$company_id);
        $cons = $this->db->get('article_tag')->row_array();
        if(empty($cons)){
            //UN EXIST
            return FALSE;
        }else{
            //EXIST
            return $cons['article_tag_id'];
        }
    }

    public function func_get_link_via_article_id($article_id,$company_id)
    {
        $this->db->where('arl_article_id',$article_id);
        $this->db->where('arl_article_tag_company_id',$company_id);
        $this->db->where('arl_article_tag_status',0);
        return $this->db->get('article_tag_link')->result_array();
    }

    public function func_get_via_part_of_name($tag_name,$company_id,$lang_id)
    {
        $this->db->where('article_tag_company_id',$company_id);
        $this->db->where('article_tag_lang_id',$lang_id);
        $this->db->like('article_tag_string',$tag_name);
        return $this->db->get('article_tag')->result_array();
    }

    function delete_tag($article_tag_id,$article_tag_company_id,$article_tag_lang_id)
    {
        $this->db->where('article_tag_id',$article_tag_id);
        $this->db->where('article_tag_company_id',$article_tag_company_id);
        $this->db->where('article_tag_lang_id',$article_tag_lang_id);
        $this->db->delete('article_tag');
    }

    public function set_tag_nav_status($tag_id,$status)
    {
        $this->db->where('article_tag_id',$tag_id);
        $data['article_tag_navigation_status'] = $status;
        $this->db->update('article_tag',$data);
    }

}
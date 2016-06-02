<?php

class model_article_category_branch_link extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function func_get($acbl_acb_id)
    {
        $this->db->where('article_status',0);
        $this->db->where('acbl_status',0);
        $this->db->where('acbl_acb_id',$acbl_acb_id);
        $this->db->join('article','article.article_id = article_category_branch_link.acbl_article_id');
        return $this->db->get('article_category_branch_link')->result_array();
    }

    public function func_add($source)
    {
        if(isset($source['name']))$this->db->where('article_title',$source['name']);
        $result = $this->db->get('article')->row_array();
        if(is_array($source) AND isset($result)) {

            $this->db->where('acbl_article_id',$result['article_id']);
            $this->db->where('acbl_acb_id',$source['acb_id']);
            $is_exist = $this->db->get('article_category_branch_link')->row_array();

            if(count($is_exist)==0){
                $data = array(
                    'acbl_article_id' => $result['article_id'], //文章編號
                    'acbl_acb_id' => $source['acb_id'] //次分類編號
                );
                $this->db->insert('article_category_branch_link',$data);
            }else if($is_exist['acbl_status']==1) {
                $this->db->where('acbl_id',$is_exist['acbl_id']);
                $data['acbl_status'] = 0;
                $this->db->update('article_category_branch_link',$data);
            }
        }
    }

    public function func_disable($acbl_id) {
        $this->db->where('acbl_id',$acbl_id);
        $data['acbl_status'] = 1;
        return $this->db->update('article_category_branch_link',$data);
    }
}
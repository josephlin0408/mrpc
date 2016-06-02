<?php

class model_article_recommend_link extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    //用文章id 查詢掛載這個文章上的次類別列表，狀態為啟用中
    public function func_get($arl_article_id)
    {
        $this->db->where('arl_article_hash_id',$arl_article_id);
        $this->db->where('arl_status',0);
        $this->db->join('article_category_main','article_category_main.acm_id = article_recommend_link.arl_acm_id');
        $this->db->join('article_category_branch','article_category_branch.acb_id = article_recommend_link.arl_acb_id');
        $result = $this->db->get('article_recommend_link')->result_array();

        //用次類別id 到 article_category_branch_link 查詢文章列表
        for($i = 0; $i < count($result); $i++){
            $this->db->where('acbl_acb_id',$result[$i]['arl_acb_id']);
            $this->db->where('acbl_status',0);
            $this->db->join('article','article.article_id = article_category_branch_link.acbl_article_id');
            $result[$i]['article_list'] = $this->db->get('article_category_branch_link')->result_array();
        }
        return $result;
    }

    public function func_add($source)
    {
        if(isset($source['name']))$this->db->where('acb_name',$source['name']);
        $result = $this->db->get('article_category_branch')->row_array();

        if(is_array($source) AND isset($result)){

            $this->db->where('arl_acm_id',$result['acb_acm_id']);
            $this->db->where('arl_acb_id',$result['acb_id']);
            $this->db->where('arl_article_hash_id',$source['article_hash_id']);
            $is_exist = $this->db->get('article_recommend_link')->row_array();

            if(empty($is_exist['arl_id'])) {
                $data = array(
                    'arl_acm_id' => $result['acb_acm_id'],
                    'arl_acb_id' => $result['acb_id'],
                    'arl_article_hash_id' => $source['article_hash_id']
                );
                $this->db->insert('article_recommend_link',$data);
            }else if(isset($is_exist['arl_status']) AND $is_exist['arl_status']==1) {
                $this->db->where('arl_id',$is_exist['arl_id']);
                $data['arl_status'] = 0;
                $this->db->update('article_recommend_link',$data);
            }
        }
    }

    public function func_disable($source){
        if($source['arl_id']!=""){
            $data['arl_status'] = 1;
            $this->db->where('arl_id', $source['arl_id']);
            $this->db->update('article_recommend_link', $data);
        }


    }
}
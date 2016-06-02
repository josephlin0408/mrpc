<?php

class model_advertiser extends CI_Model
{
    var $PROSPECT = 0;
    var $MEMBER = 1;

    public function __construct()
    {
        $this->load->database();
        $this->load->helper('ip');
        $this->load->library('session');
    }

    public function get_advertiser_search($recorder_per_page = 20,$current_page = 0)
    {
        $this->db->where('user_company_id',1);//指定為廣告商
        $this->db->where('user_lang_id',1);//指定為廣告商
        $this->db->where('user_role',1);//指定為廣告商
        $this->db->from('company_user');
        $count_all_results = $this->db->count_all_results();

        $this->db->where('user_company_id',1);//指定為廣告商
        $this->db->where('user_lang_id',1);//指定為廣告商
        $this->db->where('user_role',1);//指定為廣告商
        $this->db->order_by('user_id','desc');
        $current_recorder = $recorder_per_page * $current_page;
//        $this->db->limit($recorder_per_page, $current_recorder);
        $query = $this->db->get('company_user');

        $data['company_user']       = $query->result_array();
        $data['count_all_results']  = $count_all_results;
        $data['recorder_per_page']  = $recorder_per_page;
        $data['current_page']       = $current_page;

        return $data;
    }

    public function add_advertiser($source)
    {
        $this->db->insert('company_user',$source);
    }

    public function get_id_via_account($account)
    {
        $this->db->where('user_account',$account);
        $this->db->where('user_company_id',1);
        $this->db->where('user_lang_id',1);
        return $this->db->get('company_user')->row_array()['user_id'];
    }

}

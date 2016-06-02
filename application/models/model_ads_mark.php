<?php

class model_ads_mark extends CI_Model
{
    var $PROSPECT = 0;
    var $MEMBER = 1;

    public function __construct()
    {
        $this->load->database();
        $this->load->helper('ip');
        $this->load->library('session');
    }

    public function get_ads_mark($recorder_per_page = 20,$current_page = 0)
    {
        /*求得資料筆數*/
        $this->db->where('ads_mark_company_id',1);
        $this->db->where('ads_mark_lang_id',1);
        $this->db->from('ads_mark');
        $count_all_results = $this->db->count_all_results();
        /*求得資料筆數END*/
        /*求得資料*/
        $this->db->where('ads_mark_company_id',1);
        $this->db->where('ads_mark_lang_id',1);
        $this->db->order_by('ads_mark_type','asc');
        $current_recorder = $recorder_per_page * $current_page;
//        $this->db->limit($recorder_per_page, $current_recorder);
        $query = $this->db->get('ads_mark');
        /*求得資料END*/

        /*整理輸出*/
        $data['ads_mark']           = $query->result_array();
        $data['count_all_results']  = $count_all_results;
        $data['recorder_per_page']  = $recorder_per_page;
        $data['current_page']       = $current_page;
        /*整理輸出END*/
        return $data;
    }

    public function add_ads_mark($source)
    {
        $this->db->insert('ads_mark',$source);
    }

    public function delete_ads_mark($ads_mark_id)
    {
        $this->db->where('ads_mark_id',$ads_mark_id);
        $this->db->where('ads_mark_company_id',1);
        $this->db->where('ads_mark_lang_id',1);
        $this->db->delete('ads_mark');
    }
}

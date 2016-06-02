<?php

class model_lesson extends CI_Model
{
    public function __construct() {
        $this->load->database();
    }

    public function get_lesson($company_id,$lang_id,$lesson_id) {
        if(isset($lesson_id))$this->db->where('lesson_id',$lesson_id);
        $this->db->where('lesson_company_id',$this->session->userdata('company_id'));
        $this->db->where('lesson_lang_id',$this->session->userdata('lang_id'));
        if(isset($lesson_id)){
            return $this->db->get('lesson')->row_array();
        }else{
            return $this->db->get('lesson')->result_array();
        }
    }

    public function get_lesson_via_category_id($company_id,$lang_id,$lesson_category_id)
    {
        $this->db->where('lesson_company_id',$this->session->userdata('company_id'));
        $this->db->where('lesson_lang_id',$this->session->userdata('lang_id'));
        $this->db->where('lesson_category_id',$lesson_category_id);
        return $this->db->get('lesson')->result_array();
    }

    public function add_model($source)
    {
        $data = array(
            'lesson_title'                  => $source['lesson_title'],
            'lesson_booking_start_time'     => $source['lesson_booking_start_time'],
            'lesson_booking_end_time'       => $source['lesson_booking_end_time'],
            'lesson_booking_number_limit'   => $source['lesson_booking_number_limit'],

            'lesson_tag_price'              => $source['lesson_tag_price'],
            'lesson_sell_status'            => $source['lesson_sell_status'],
            'lesson_link'                   => $source['lesson_link'],
            'lesson_meta'                   => $source['lesson_meta'],

            'lesson_source'                 => $source['lesson_source'],
            'lesson_open_status'            => $source['lesson_open_status'],
            'lesson_status'                 => $source['lesson_status'],
            'lesson_lecturer'               => $source['lesson_lecturer'],

            'lesson_address'                => $source['lesson_address'],
            'lesson_latitude'               => $source['lesson_latitude'],
            'lesson_longitude'              => $source['lesson_longitude'],
            'lesson_content'                => $source['lesson_content'],
            'lesson_category_id'            => $source['lesson_category_id'],

            'lesson_booking_number_now'     => 0,
            'lesson_company_id'             => $this->session->userdata('company_id'),
            'lesson_lang_id'                => $this->session->userdata('lang_id'),
        );
        $this->db->insert('lesson',$data);
    }

    public function update_model($source)
    {
        $data = array(
            'lesson_title'                  => $source['lesson_title'],
            'lesson_booking_start_time'     => $source['lesson_booking_start_time'],
            'lesson_booking_end_time'       => $source['lesson_booking_end_time'],
            'lesson_booking_number_limit'   => $source['lesson_booking_number_limit'],

            'lesson_tag_price'              => $source['lesson_tag_price'],
            'lesson_sell_status'            => $source['lesson_sell_status'],
            'lesson_link'                   => $source['lesson_link'],
            'lesson_meta'                   => $source['lesson_meta'],

            'lesson_source'                 => $source['lesson_source'],
            'lesson_open_status'            => $source['lesson_open_status'],
            'lesson_status'                 => $source['lesson_status'],
            'lesson_lecturer'               => $source['lesson_lecturer'],

            'lesson_address'                => $source['lesson_address'],
            'lesson_latitude'               => $source['lesson_latitude'],
            'lesson_longitude'              => $source['lesson_longitude'],
            'lesson_content'                => $source['lesson_content'],
            'lesson_category_id'            => $source['lesson_category_id'],
        );
        $this->db->where('lesson_id',$source['lesson_id']);
        $this->db->where('lesson_company_id',$this->session->userdata('company_id'));
        $this->db->where('lesson_lang_id',$this->session->userdata('lang_id'));
        $this->db->update('lesson',$data);
    }
}

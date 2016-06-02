<?php

class Model_member extends CI_Model
{
    var $PROSPECT = 0;
    var $MEMBER = 1;

    public function __construct()
    {
        $this->load->database();
        $this->load->helper('ip');
        $this->load->library('session');
    }

    //後台dashboard 準會員數量
    public function get_dashboard_prospect_number()
    {
        $this->db->from('member')->where('member_status', 0 );

        return $this->db->count_all_results();
    }

    //後台dashboard 會員數量
    public function get_dashboard_member_number()
    {
        $this->db->from('member')->where('member_status', 1 );

        return $this->db->count_all_results();
    }

    public function get_member_by_id($member_id)
    {
        $query = $this->db->from('member')->where('member_id', $member_id )->get();

        $data = $query->row_array();

        return $data;
    }

    public function get_member($email)
    {
        $query = $this->db->from('member')->where('member_account', $email )->get();

        $data = $query->row_array();

      return $data;
    }

    public function set_member()
    {

        if($this->input->post('new_password')!=$this->input->post('verify_password'))return redirect('logout','location',301);

        $temp = $this->get_member($this->auto_fix($this->input->post('new_email')));

        if(empty($temp['member_account'])){

            $data = array(
                'member_account' => $this->auto_fix($this->input->post('new_email')),
                'member_password' => sha1($this->input->post('new_password')),
                'member_ip' => get_user_ip(),
                'member_hash_id' => sha1($this->input->post('password').rand())
            );

            if($this->db->insert('member', $data)){

                return true;

            } else redirect('logout','location',301);

        }else{
            redirect('account_is_already_exist','location',301);
        }

    }

    public function auto_fix($str){

        $str = str_replace ("<","",$str);
        $str = str_replace (">","",$str);
        $str = str_replace (";","",$str);
        $str = str_replace (",","",$str);
        $str = str_replace ("'","",$str);
        $str = str_replace ("''","",$str);
        $str = str_replace ("+","",$str);
        $str = str_replace ("-","",$str);
        $str = str_replace ("*","",$str);
        $str = str_replace ("&","",$str);
        $str = str_replace ("=","",$str);
        $str = str_replace ("DROP","",$str);
        $str = str_replace ("SELECT","",$str);
        $str = str_replace ("(","",$str);
        $str = str_replace (")","",$str);

        return $str;
    }

    public function update_member()
    {
        $data = array(
            'member_name' => $this->auto_fix($this->input->post('fullname')),
            'member_address' => $this->auto_fix($this->input->post('address')),
            'member_phone' => $this->auto_fix($this->input->post('cellphone')),
            'member_shipping' => $this->auto_fix($this->input->post('receiveTime'))
        );


        $cardNumber = $this->auto_fix($this->input->post('cardNumber'));

        if(isset($cardNumber))
        {
            //2015.04.30 追加設定成正式會員
            //若有信用卡就額外追加 last4 欄位
            if(!empty($cardNumber))$data['member_last4'] = substr($cardNumber, -4);
            if(!empty($cardNumber))$data['member_status'] = 1;
            $user = $this->session->all_userdata();
            $user['member_status'] = 1;
            $this->session->set_userdata($user);
        }

        $this->db->where('member_id',  $this->auto_fix($this->input->post('member_id')));

        return $this->db->update('member', $data);
    }

    public function password_forget_member($member_hash_id)
    {
        $data = array(
            'member_verify' => sha1(strtotime("now").rand()),
            'member_validation' => strtotime("now")
        );

        $this->db->where('member_hash_id', $member_hash_id);

        $this->db->update('member', $data);

        return $data['member_verify'];
    }

    public function reset_password_member($member_hash_id, $member_password)
    {
        $data['member_password'] = $member_password;

        $this->db->where('member_hash_id', $member_hash_id);

        $this->db->update('member', $data);

    }

    //05.01新增會員服務狀態
    public function get_members($is_prospect = false)
    {
        /*進入頁面時，若有賦予搜尋條件時，依照搜尋條件給予資料*/
        $search['member_name']      = $this->input->post('fullname');
        $search['member_phone']     = $this->input->post('cellphone');
        $search['member_address']   = $this->input->post('address');
        $search['member_id']        = $this->input->post('id');
        $search['member_account']   = $this->input->post('account');

        if(isset($search['member_name']))$this->db->like('member_name',$search['member_name']);
        if(isset($search['member_phone']))$this->db->like('member_phone',$search['member_phone']);
        if(isset($search['member_address']))$this->db->like('member_address',$search['member_address']);
        if(isset($search['member_id']))$this->db->like('member_id',$search['member_id']);
        if(isset($search['member_account']))$this->db->like('member_account',$search['member_account']);
        if($is_prospect)
        {
            $this->db->where('member_status', 0);
        }else{
            $this->db->where('member_status', 1);
        }
        /*進入頁面時，若有賦予搜尋條件時，依照搜尋條件給予資料END*/

        $this->db->order_by("member_id", "desc");

        $this->db->limit(500, 1);

        $query = $this->db->from('member')->get();

        $data = $query->result_array();

        return $data;
    }

    public function view_member($member_hash_id)
    {
        $query = $this->db->from('member')->where('member_id', $member_hash_id )->get();

        $data = $query->row_array();

        return $data;
    }

    public function update_prospect_to_member($member_id)
    {
        $data['member_status'] = 1;

        $this->db->where('member_id', $member_id);

        $this->db->update('member', $data);
    }

    public function get_member_search($recorder_per_page = 20 ,
                                     $current_page = 0,
                                     $fullname,
                                     $cellphone,
                                     $address,
                                     $account,$member_level)
    {
        $this->db->from('member');

        if( isset($fullname))if($fullname != '')$this->db->like("member_name",$fullname);
        if( isset($cellphone))if($cellphone != '')$this->db->like("member_phone",$cellphone);
        if( isset($address))if($address != '')$this->db->like("member_address",$address);
        if( isset($account))if($account != '')$this->db->like("member_account",$account);
        if($member_level<>''){
            if($member_level<>'all'){
                $this->db->where('member_level',$member_level);
            }
        }
        $count_all_results = $this->db->count_all_results();

        if( isset($fullname))if($fullname != '')$this->db->like("member_name",$fullname);
        if( isset($cellphone))if($cellphone != '')$this->db->like("member_phone",$cellphone);
        if( isset($address))if($address != '')$this->db->like("member_address",$address);
        if( isset($account))if($account != '')$this->db->like("member_account",$account);
        if($member_level<>''){
            if($member_level<>'all'){
                $this->db->where('member_level',$member_level);
            }
        }
        $this->db->from('member');
        $this->db->order_by('member_id','desc');

        $current_recorder = $recorder_per_page * $current_page;
        $this->db->limit($recorder_per_page, $current_recorder);
        $query = $this->db->get();

        $data['member'] = $query->result_array();
        $data['count_all_results'] = $count_all_results;
        $data['recorder_per_page'] = $recorder_per_page;
        $data['current_page'] = $current_page;

        return $data;
    }

}

<?php

class Model_coupon extends CI_Model
{
    private $TABLE_NAME = "coupon";

    public $ENABLE = 1;
    public $DISABLE = 0;
    public $RESULT_TRUE = "true";
    public $RESULT_FALSE = "false";

    var $PROSPECT = 0;
    var $coupon = 1;

    public function __construct()
    {
        $this->load->database();
        $this->load->helper('ip');
        $this->load->library('session');
    }

    public function get_coupon()
    {
        $query = $this->db->from('coupon')->where('coupon_status < ', 2 )->get();

        $data = $query->result_array();

        return $data;
    }

    public function get_coupon_by_code($coupon_code)
    {
        $query = $this->db->from('coupon')->where('coupon_code', strtoupper($coupon_code) )->get();

        $data = $query->result_array();

        return $data;
    }

    public function get_dashboard_prospect_number()
    {
        $this->db->from('coupon')->where('coupon_status', 0 );

        return $this->db->count_all_results();
    }

    //後台dashboard 會員數量
    public function get_dashboard_coupon_number()
    {
        $this->db->from('coupon')->where('coupon_status', 1 );

        return $this->db->count_all_results();
    }

    public function get_coupon_by_id($coupon_id)
    {
        $query = $this->db->from('coupon')->where('coupon_id', $coupon_id )->get();

        $data = $query->row_array();

        return $data;
    }



    public function set_coupon($post)
    {
        $counter = $this->get_coupon_by_code(strtoupper($post['coupon_code']));

        if($post['coupon_code'] == "")return false;
        if(count($counter) != 0)return false;
        if(count($post) == 0)return false;

        foreach ($post as $key => $value) {
            if($value != "")
            {
                switch ($key) {
                    case "coupon_code":
                        $data[$key] = strtoupper($value);
                        break;
                    case "coupon_discount_type":
                    case "coupon_text":
                    case "coupon_status":
                    case "coupon_type":
                    case "coupon_counter":
                    case "coupon_limit":
                        $data[$key] = $value;
                        break;
                    case "coupon_begin":
                    case "coupon_expire":
                        if($value!="")$data[$key] = strtotime($value);
                        break;
                    case 'coupon_discount':
                        if($post['coupon_discount_type']==0)$data['coupon_discount_double'] = $value;
                        if($post['coupon_discount_type']==1)$data['coupon_discount_int'] = $value;
                        break;
                }
            }
        }

        $result = $this->db->insert($this->TABLE_NAME, $data);

        if (empty($result)) {
            $response['result'] = $this->RESULT_FALSE;
            $response['reason'] = "帳號註冊失敗，請聯絡管理員";

        } else {
            $response['result'] = $this->RESULT_TRUE;
        }
        return $response;
    }

    public function update_coupon($post)
    {
        foreach ($post as $key => $value) {
            if($value != "")
            {
                switch ($key) {
                    case "coupon_code":
                    case "coupon_discount_type":
                    case "coupon_text":
                    case "coupon_status":
                    case "coupon_type":
                    case "coupon_counter":
                    case "coupon_limit":
                        $data[$key] = $value;
                        break;

                    case "coupon_begin":
                    case "coupon_expire":
                        $data[$key] = strtotime($value);
                        break;
                    case 'coupon_discount':
                        if($post['coupon_discount_type']==0)$data['coupon_discount_double'] = $value;
                        if($post['coupon_discount_type']==1)$data['coupon_discount_int'] = $value;
                        break;
                }
            }
        }

        $this->db->where('coupon_id',  $post['coupon_id']);

        $result = $this->db->update('coupon', $data);

        if (empty($result)) {
            $response['result'] = $this->RESULT_FALSE;

        } else {
            $response['result'] = $this->RESULT_TRUE;
        }

        return $response;
    }

    public function password_forget_coupon($coupon_hash_id)
    {
        $data = array(
            'coupon_verify' => sha1(strtotime("now").rand()),
            'coupon_validation' => strtotime("now")
        );

        $this->db->where('coupon_hash_id', $coupon_hash_id);

        $this->db->update('coupon', $data);

        return $data['coupon_verify'];
    }

    public function reset_password_coupon($coupon_hash_id, $coupon_password)
    {
        $data['coupon_password'] = $coupon_password;

        $this->db->where('coupon_hash_id', $coupon_hash_id);

        $this->db->update('coupon', $data);

    }

    //05.01新增會員服務狀態
    public function get_coupons($is_prospect = false)
    {
        /*進入頁面時，若有賦予搜尋條件時，依照搜尋條件給予資料*/
        $search['coupon_name']      = $this->input->post('fullname');
        $search['coupon_phone']     = $this->input->post('cellphone');
        $search['coupon_address']   = $this->input->post('address');
        $search['coupon_id']        = $this->input->post('id');
        $search['coupon_account']   = $this->input->post('account');

        if(isset($search['coupon_name']))$this->db->like('coupon_name',$search['coupon_name']);
        if(isset($search['coupon_phone']))$this->db->like('coupon_phone',$search['coupon_phone']);
        if(isset($search['coupon_address']))$this->db->like('coupon_address',$search['coupon_address']);
        if(isset($search['coupon_id']))$this->db->like('coupon_id',$search['coupon_id']);
        if(isset($search['coupon_account']))$this->db->like('coupon_account',$search['coupon_account']);
        if($is_prospect)
        {
            $this->db->where('coupon_status', 0);
        }else{
            $this->db->where('coupon_status', 1);
        }
        /*進入頁面時，若有賦予搜尋條件時，依照搜尋條件給予資料END*/

        $this->db->order_by("coupon_id", "desc");

        $query = $this->db->from('coupon')->get();

        $data = $query->result_array();

        return $data;
    }

    public function view_coupon($coupon_hash_id)
    {
        $query = $this->db->from('coupon')->where('coupon_id', $coupon_hash_id )->get();

        $data = $query->row_array();

        return $data;
    }

    public function update_prospect_to_coupon($coupon_id)
    {
        $data['coupon_status'] = 1;

        $this->db->where('coupon_id', $coupon_id);

        $this->db->update('coupon', $data);
    }

    function delete_coupon($coupon_id)
    {
        return $this->db->delete('coupon', array('coupon_id' => $coupon_id));
    }

}

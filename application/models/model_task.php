<?php
class Model_task extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function set_task_array($source)
    {
        $data = array();
        if (!empty($source['task_member_id'])) $data['task_member_id'] = $source['task_member_id'];
        if (!empty($source['task_order_id'])) $data['task_order_id'] = $source['task_order_id'];
        if (!empty($source['task_category_id'])) $data['task_category_id'] = $source['task_category_id'];
        if (!empty($source['task_status'])) $data['task_status'] = $source['task_status'];
        if (!empty($source['task_target_email'])) $data['task_target_email'] = $source['task_target_email'];
        if (!empty($source['task_execute_time'])) $data['task_execute_time'] = $source['task_execute_time'];

        if (count($data) > 0) {$this->db->insert('email_task', $source); return $this->db->insert_id();} else return null;
    }

    public function get_task($task_id)
    {
        if(!empty($task_id)) {

            $this->db->where('task_id', $task_id);
            $query = $this->db->get('email_task');
            return $query->row_array();
        }
    }

    public function update_task( $task )
    {
        if(!empty($task['task_id'])){

        $data = array(
            'task_article_id' => $task['task_article_id'],
            'task_status' => $task['task_status']
        );

        $this->db->where('task_id', $task['task_id']);
        $this->db->update('email_task', $data);

        }
    }

/*

task_category_id：

1. 訂單建立
2. 出貨
3. 訂單取消
4. 出貨後2日
5. 轉帳確認

*/

    public function set_task_order_paid($task_member_id,$task_order_id)
    {
        $data = array();
        $data['task_company_id']    = $this->session->userdata('company_id');
        $data['task_lang_id']       = $this->session->userdata('lang_id');
        $data['task_member_id']     = $task_member_id;
        $data['task_order_id']      = $task_order_id;
        $data['task_category_id']   = 5;
        $this->set_task_array($data);
    }

    public function set_task_order_cancel($task_member_id,$task_order_id)
    {
        $data = array();
        $data['task_company_id']    = $this->session->userdata('company_id');
        $data['task_lang_id']       = $this->session->userdata('lang_id');
        $data['task_member_id']     = $task_member_id;
        $data['task_order_id']      = $task_order_id;
        $data['task_category_id']   = 3;
        $this->set_task_array($data);
    }

    public function set_task_order_shipped($task_member_id,$task_order_id)
    {
        $data = array();
        $data['task_company_id']    = $this->session->userdata('company_id');
        $data['task_lang_id']       = $this->session->userdata('lang_id');
        $data['task_member_id']     = $task_member_id;
        $data['task_order_id']      = $task_order_id;
        $data['task_category_id']   = 2;
        $this->set_task_array($data);
        unset($data);

        $data = array();
        $data['task_company_id']    = $this->session->userdata('company_id');
        $data['task_lang_id']       = $this->session->userdata('lang_id');
        $data['task_member_id']     = $task_member_id;
        $data['task_order_id']      = $task_order_id;
        $data['task_category_id']   = 4;
        $data['task_execute_time']  = date("Y-m-d H:i:s", strtotime("+2days"));
        $this->set_task_array($data);
    }
}



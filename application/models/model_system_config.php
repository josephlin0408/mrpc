<?php

class Model_system_config extends CI_Model
{
    private $TABLE_NAME     = "system_config";

    public  $MEMBER_ENABLE  = 1; //啟用

    public  $MEMBER_DISABLE = 0;//停用

    public  $RESULT_TRUE    = "true";

    public  $RESULT_FALSE   = "false";

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

//輸入陣列統一用 $data
//回傳陣列統一用 $response
//資料表名稱統一用 $this->TABLE_NAME
//公用方法依照CRUD分類
//子方法註解貼齊 function

//========================
//CREATE
//========================
    function set_config($data)
    {

        $result = $this->db->insert($this->TABLE_NAME, $data);

        $id = $this->db->insert_id();

        if (empty($result)) {

            $response['result'] = $this->RESULT_FALSE;
            $response['reason'] = "新增失敗，請聯絡管理員";

        } else {

            $response['result'] = $this->RESULT_TRUE;
            $response['id'] = $id;

        }

        return $response;
    }



//========================
//READ
//========================

    function get_system_config()
    {
        $this->db->from($this->TABLE_NAME);

        $this->db->where('enable', 1);

        $query = $this->db->get();

        return $query->row_array();
    }

//========================
//UPDATE
//========================
    function update_system_config($data)
    {

        $this->db->where('idx', $data['idx']);

        if ($this->db->update($this->TABLE_NAME, $data)) {

            $response['result'] = $this->RESULT_TRUE;

        } else {

            $response['result'] = $this->RESULT_FALSE;

            $response['reason'] = "更新失敗";

        }

        return $response;
    }

    function update_product_image($data)
    {

        $this->db->where('idx', $data['idx']);

        if ($this->db->update("product_image", $data)) {

            $response['result'] = $this->RESULT_TRUE;

        } else {

            $response['result'] = $this->RESULT_FALSE;

            $response['reason'] = "更新失敗";

        }

        return $response;
    }

//========================
//DELETE
//========================

    function delete_product($data)
    {

        $this->db->where('idx', $data['idx']);

        if ($this->db->update($this->TABLE_NAME, $data)) {

            $response['result'] = $this->RESULT_TRUE;

        } else {

            $response['result'] = $this->RESULT_FALSE;

            $response['reason'] = "更新失敗";

        }

        return $response;
    }

    function delete_product_image($id)
    {

        $this->db->delete("product_image", array('idx' => $id));

    }

    public function get_product_by_name($product_name)
    {
        $this->db->select("product.name,product.idx");

        $this->db->from($this->TABLE_NAME);

        $this->db->like('product.name', $product_name);

        $this->db->where('product.enable = 1');

        $this->db->limit(30, 0);

        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_all_id_and_name()
    {
        $this->db->select('idx,name');
        return $this->db->get('product')->result_array();
    }
}


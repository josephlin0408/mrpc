<?php

class Model_product_size extends CI_Model
{
    private $TABLE_NAME = "product_size";

    public $MEMBER_ENABLE = 1; //啟用
    public $MEMBER_DISABLE = 0;//停用
    public $RESULT_TRUE = "true";
    public $RESULT_FALSE = "false";

    function __construct() {
        parent::__construct();
    }

//輸入陣列統一用 $data
//回傳陣列統一用 $response
//資料表名稱統一用 $this->TABLE_NAME
//公用方法依照CRUD分類
//子方法註解貼齊 function

//========================
//CREATE
//========================
    function set_product_size($data) {

        $result = $this->db->insert($this->TABLE_NAME, $data);

        if (empty($result)) {

            $response['result'] = $this->RESULT_FALSE;
            $response['reason'] = "新增失敗，請聯絡管理員";

        } else {

            $response['result'] = $this->RESULT_TRUE;

        }
        return $response;
    }
//========================
//READ
//========================

    function get_product_size($enable = null, $id = null){

        if(isset($enable)) $this->db->where('enable', $enable);

        if(isset($id)) $this->db->where('_product', $id);

        $this->db->from($this->TABLE_NAME);

        $query = $this->db->get();

        return $query->result_array();

    }

    function get_one_product_size($id){

        $this->db->from($this->TABLE_NAME);

        $this->db->where('idx', $id);

        $query = $this->db->get();

        return $query->result_array();

    }

    function get_size($size_idx){

        $this->db->from($this->TABLE_NAME);

        $this->db->where('idx', $size_idx);

        $query = $this->db->get();

        return $query->row_array();

    }



//========================
//UPDATE
//========================
    function update_product_size($data)
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

//========================
//DELETE
//========================


    function delete_product_size($id)
    {
        $data = array('enable' => "0");

        $this->db->where('idx', $id);

        return $this->db->update($this->TABLE_NAME, $data);
    }
}


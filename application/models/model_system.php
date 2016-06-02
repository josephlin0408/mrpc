<?php

class Model_system extends CI_Model
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


//========================
//READ
//========================

    function get_system_config()
    {
        $this->db->from($this->TABLE_NAME);

        $this->db->where('idx', 1);

        $query = $this->db->get();

        return $query->row_array();

    }


//========================
//UPDATE
//========================
    function update_system($data)
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

}


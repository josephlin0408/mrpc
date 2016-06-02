<?php

class Model_product_color extends CI_Model
{
    private $TABLE_NAME = "product_color";

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
    function set_product_color($data) {

        $this->db->insert($this->TABLE_NAME, $data);

        return $this->db->insert_id();
    }


//========================
//READ
//========================

    function update_product_color_all($post) {

        for($i = 0 ; $i < count($post['idx']) ; $i++) {

            $idx = $post['idx'][$i];

            $instock = $post['instock'][$i];

            $this->db->where('idx', $idx);

            $data['instock'] = $instock;

            $this->db->update($this->TABLE_NAME, $data);

        }
        return;
    }

    function get_product_color_all($enable = 1, $id = null) {

        if(isset($enable)) $this->db->where('product.enable', $enable);

        if(isset($enable)) $this->db->where('product_color.enable', $enable);

        if(isset($id)) $this->db->where('product.idx', $id);

        $this->db->select('*, product_color.idx as product_color_idx, product_color.name as product_color_name, product_color.instock as product_color_instock');

        $this->db->from($this->TABLE_NAME);

        $this->db->join('product','product.idx = product_color._product', 'left');

        $this->db->order_by('product.idx','asc');

        $this->db->order_by('product_color.priority','desc');

        $query = $this->db->get();

        return $query->result_array();

    }

    function get_product_color($enable = 1, $id = null){

        if(isset($enable)) $this->db->where('enable', $enable);

        if(isset($id)) $this->db->where('_product', $id);

        $this->db->from($this->TABLE_NAME);

        $this->db->order_by('priority','desc');

        $query = $this->db->get();

        return $query->result_array();

    }

    function get_one_product_color($id){

        $this->db->from($this->TABLE_NAME);

        $this->db->where('idx', $id);

        $query = $this->db->get();

        return $query->result_array();

    }

    function get_color($color_idx){

        $this->db->from($this->TABLE_NAME);

        $this->db->where('idx', $color_idx);

        $query = $this->db->get();

        return $query->row_array();

    }



//========================
//UPDATE
//========================
    function update_product_color($data)
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


    function delete_product_color($id)
    {
        $data = array('enable' => "0");

        $this->db->where('idx', $id);

        return $this->db->update($this->TABLE_NAME, $data);
    }
}


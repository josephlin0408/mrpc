<?php

class Model_product_upsell extends CI_Model
{
    private $TABLE_NAME = "product_upsell";

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
    function set_product_upsell($data) {

        $this->db->insert($this->TABLE_NAME, $data);

    }
//========================
//READ
//========================

    function get_product_upsell($enable = null, $id = null){

        $this->db->select('*, product_upsell.idx AS product_upsell_idx');

        $this->db->join('product', 'product_upsell._upsell_product = product.idx', 'left');

        $this->db->where('product.enable', 1);

        $this->db->where('product_upsell.enable', 1);

        $this->db->where('product_upsell._product', $id);

        $this->db->order_by('product._product_type');

        $this->db->order_by('product.priority','desc');

        $this->db->from($this->TABLE_NAME);

        $query = $this->db->get();

        return $query->result_array();
    }

    //Ctrl_product_upsell:index
    public function get_product_upsell_list($enable,$id)
    {
        $this->db->where('enable',$enable);
        $this->db->where('_product',$id);
        return $this->db->get('product_upsell')->result_array();
    }

    function get_one_product_upsell($id){

        $this->db->from($this->TABLE_NAME);

        $this->db->where('idx', $id);

        $query = $this->db->get();

        return $query->result_array();

    }



//========================
//UPDATE
//========================
    function update_product_upsell($data)
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


    function delete_product_upsell($id)
    {
        $data = array('enable' => "0");

        $this->db->where('idx', $id);

        return $this->db->update($this->TABLE_NAME, $data);
    }

    public function get_id_via_name($name)
    {
        $this->db->where('product.name',$name);
        $query = $this->db->get('product');
        $product =  $query->row_array();
        return $product['idx'];
    }

    public function func_add($source)
    {
        $this->db->insert('product_upsell',$source);
    }
}


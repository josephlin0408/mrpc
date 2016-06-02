<?php

class Model_product_image extends CI_Model
{
    private $TABLE_NAME     = "product_image";

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

    function set_product_image($data)
    {
        $result = $this->db->insert("product_image", $data);

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

    function get_product_image($product_idx)
    {
        $this->db->from('product_image');

        $this->db->join('product_color', 'product_image._color = product_color.idx', 'left');

        $this->db->where('product_image._product', $product_idx);

        $query = $this->db->get();

        return $query->result_array();

    }

    function get_product_single_image($product_idx)
    {
        $this->db->from('product_image');

        $this->db->where('product_image._product', $product_idx);

        $query = $this->db->get();

        return $query->row_array();
    }

    function get_product_color_image($color_idx)
    {
        $this->db->from('product_image');

        $this->db->where('enable ', 1);

        $this->db->where('_color', $color_idx);

        $query = $this->db->get();

        return $query->result_array();

    }

//========================
//DELETE
//========================

    function delete_product_image($images_idx)
    {
        $this->db->where('idx',$images_idx);

        $this->db->update("product_image", array('enable' => 0));

    }
}


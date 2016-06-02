<?php

class Model_product_item extends CI_Model
{
    private $TABLE_NAME = "product_item";

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
    function set_product_item($data) {

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

    function get_product_item($enable = null, $id = null){

        if(isset($id)) $this->db->where('product_item._product', $id);

        $this->db->select('
            *,
            product_item.idx AS item_idx,
            product_item.remain_count'
            );

        $this->db->from($this->TABLE_NAME);

        if(isset($enable)) $this->db->where('product_item.enable', $enable);

        $query = $this->db->get();

        return $query->result_array();
    }

    function get_product_item_for_stock_list($enable = null, $id = null){

        if(isset($id)) $this->db->where('product_item._product', $id);

        $this->db->select('
            product_item.idx AS item_idx,
            product_item.*,
            product_color.name AS color_name,
            product_size.name AS size_name,
            '
        );

        $this->db->from($this->TABLE_NAME);

        $this->db->join('product', 'product_item._product = product.idx', 'left');
        $this->db->join('product_color', 'product_item._color = product_color.idx', 'left');
        $this->db->join('product_size', 'product_item._size = product_size.idx', 'left');

        if(isset($id)) $this->db->where('product_size.enable', 1);
        if(isset($id)) $this->db->where('product_color.enable', 1);
        if(isset($id)) $this->db->where('product_item.enable', 1);

        $query = $this->db->get();

        return $query->result_array();
    }

    function get_product_item_by_product_idx($product_idx) {

        $this->db->select('
            product_item.token AS idx,
            product_color.name AS product_color,
            product_image.image AS product_image_url,
            ');

        $this->db->from($this->TABLE_NAME);

        $this->db->join('product_color', 'product_item._color = product_color.idx', 'left');
        $this->db->join('product_size', 'product_item._size = product_size.idx', 'left');
        $this->db->join('product_image', 'product_image._color = product_color.idx', 'left');

        $this->db->group_by("product_item.idx");

        $this->db->where('product_item._product', $product_idx);
        $this->db->where('product_image.enable', 1);
        $this->db->where('product_size.enable', 1);
        $this->db->where('product_color.enable', 1);
        $this->db->where('product_item.enable', 1);

        $query = $this->db->get();

        return $query->result_array();
    }

    function get_product_item_for_item_list($enable = null){

        $this->db->select('
            product_item.token AS id,
            product.name AS product_name,
            product_color.name AS product_color,
            product.content AS product_simple_name,
            product_image.image AS product_image_url,
            product.sale_price_ntd AS product_price,
            product.price_ntd AS product_ori_price,
            floor((1 - product.sale_price_ntd / product.price_ntd)*100) AS product_discount
            '
        );

        $this->db->from($this->TABLE_NAME);

        $this->db->join('product', 'product_item._product = product.idx', 'left');
        $this->db->join('product_color', 'product_item._color = product_color.idx', 'left');
        $this->db->join('product_size', 'product_item._size = product_size.idx', 'left');
        $this->db->join('product_image', 'product_image._color = product_color.idx', 'left');

        $this->db->where('product_image.enable', 1);
        $this->db->where('product_size.enable', 1);
        $this->db->where('product_color.enable', 1);
        $this->db->where('product_item.enable', 1);

        $this->db->group_by("product_item.idx");

        $query = $this->db->get();

        // echo $this->db->last_query();

        return $query->result_array();
    }

    function get_one_product_item($id){

        $this->db->from($this->TABLE_NAME);

        $this->db->where('idx', $id);

        $query = $this->db->get();

        return $query->result_array();

    }

    function get_product_item_by_color_and_size($_size, $_color){

        $this->db->from($this->TABLE_NAME);

        $this->db->where('_color', $_color);
        $this->db->where('_size', $_size);

        $query = $this->db->get();

        return $query->row_array();

    }


//========================
//UPDATE
//========================
    function update_product_item($data)
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


    function delete_product_item($id)
    {
        $data = array('enable' => "0");

        $this->db->where('idx', $id);

        return $this->db->update($this->TABLE_NAME, $data);
    }
}


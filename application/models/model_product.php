<?php

class Model_product extends CI_Model
{
    private $TABLE_NAME     = "product";

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
    function set_product($data)
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

    function get_product()
    {
        $this->db->select(
            '
                        product.idx             as  idx,
                        product.content         as  content,
                        product.name            as  name,
                        product.price_ntd       as  price_ntd,
                        product.sale_price_ntd  as  sale_price_ntd,
                        product_type_fk.idx    as  type_idx,
                        product_type_fk.name    as  type_name,
                        product.shipping_fee_tw as  shipping_fee_tw,
                        product.shipping_fee_tw_free_condition as  shipping_fee_tw_free_condition,
                        product.shipping_fee_il as  shipping_fee_il,
                        product.shipping_fee_il_free_condition as  shipping_fee_il_free_condition,
                        product.shipping_fee_as as  shipping_fee_as,
                        product.shipping_fee_as_free_condition as  shipping_fee_as_free_condition,
                        floor((1 - product.sale_price_ntd / product.price_ntd)*100) AS product_discount
                        ')
        ;

        $this->db->from($this->TABLE_NAME);

        $this->db->join('product_type_fk', 'product._product_type = product_type_fk.idx', 'left');

        $this->db->where('product.enable', 1);

        $this->db->order_by('product.priority','desc');

        $query = $this->db->get();

        return $query->result_array();

    }

    function get_product_detail($id)
    {
        $this->db->from($this->TABLE_NAME);

        $this->db->where($this->TABLE_NAME.'.idx', $id);

        $query = $this->db->get();

        return $query->result_array();

    }
    function get_product_image($id)
    {
        $this->db->from('product_image');

        $this->db->join('product_color', 'product_image._color = product_color.idx', 'left');

        $this->db->where('product_image._product', $id);

        $query = $this->db->get();

        return $query->result_array();
    }

    function where_condition($post)
    {
        $this->db->from($this->TABLE_NAME);
        $this->db->join('product_type_fk', 'product_type_fk.idx = product._product_type', 'left');
        $this->db->join('product_image', 'product.idx = product_image._product', 'inner');
        $this->db->join('product_color', 'product_color.idx = product_image._color', 'left');
        $this->db->select( '*, product.idx as product_idx,product.name as product_name, product_type_fk.name as  type_name');

        $this->db->where('product.' . 'enable', 1);
        $this->db->where('product_image.' . 'enable', 1);
        $this->db->where('product_color.' . 'enable', 1);

        $this->db->group_by('product_image._product');

//        if(isset($post['enable']) AND $post['enable']!="")$this->db->where($this->TABLE_NAME . '.' . 'enable', $post['enable']);
//        else $this->db->where($this->TABLE_NAME . '.' . 'enable', 1);

        if(isset($post['keyword']) and $post['keyword']!=""){

            if(strpos($post['keyword'],',') > 0){
                $key_array = explode(',',$post['keyword']);
                foreach ($key_array as $key => $value) {
                    $this->db->or_like($this->TABLE_NAME . '.' . "name", $value);
                    $this->db->or_like('product_type_fk.' . "name", $value);
                    $this->db->or_like($this->TABLE_NAME . '.' . "desc", $value);
                    $this->db->or_like($this->TABLE_NAME . '.' . "sale_price_ntd", $value);
                }
            }else{
                $this->db->or_like($this->TABLE_NAME . '.' . "name", $post['keyword']);
                $this->db->or_like('product_type_fk.' . "name", $post['keyword']);
                $this->db->or_like($this->TABLE_NAME . '.' . "desc", $post['keyword']);
                $this->db->or_like($this->TABLE_NAME . '.' . "sale_price_ntd", $post['keyword']);
            }

        }
    }

    function read($post)
    {
        $this->where_condition($post);

        $count_all_results = $this->db->count_all_results();

        $this->where_condition($post);

        $this->db->order_by($this->TABLE_NAME.'._product_type, product.idx', 'ASC');

        $current_recorder = $post['recorder_per_page'] * ($post['current_page'] - 1);

        $this->db->limit($post['recorder_per_page'], $current_recorder);

        $query = $this->db->get();

        $data = $query->result_array();

        if (empty($data)) {

            $response['result'] = $this->RESULT_FALSE;

            $response['reason'] = "查無任何資料";

        } else {

            if (!empty($post['msg'])) {

                for ($index = 0; $index < count($data); $index++) {

                    $data[$index]['user'] = $this->get_user($data[$index]['_user']);
                }
            }

            $response['count_all_results'] = $count_all_results;

            $response['result'] = $this->RESULT_TRUE;

            $response['data'] = $data;

        }

        return $response;
    }

//========================
//UPDATE
//========================
    function update_product($data)
    {

        $this->db->where('idx', $data['idx']);

        print_r($data);

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

        $this->db->delete($this->TABLE_NAME);

//        if ($this->db->update($this->TABLE_NAME, $data)) {
//
//            $response['result'] = $this->RESULT_TRUE;
//
//        } else {
//
//            $response['result'] = $this->RESULT_FALSE;
//
//            $response['reason'] = "更新失敗";
//
//        }

        return null;
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


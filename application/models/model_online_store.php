<?php
class model_online_store extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function func_get($company_id,$lang_id,$status,$os_id=NULL)
    {
        if(isset($os_id))$this->db->where('os_id',$os_id);
        $this->db->where('online_store.os_company_id',$company_id);
        $this->db->where('online_store.os_language_id',$lang_id);
        if(is_int($status))$this->db->where('online_store.os_status',$status);
        $query =  $this->db->get('online_store');
        if(isset($os_id)){
            return $query->row_array();
        }else{
            return $query->result_array();
        }

    }

    public function func_add($source)
    {
        $data = array(
            'os_name'              => $source['os_name'],
            'os_link'              => $source['os_link'],
            'os_source'            => $source['os_source'],
            'os_status'            => $source['os_status'],
            'os_company_id'        => $source['os_company_id'],
            'os_language_id'       => $source['os_language_id'],
        );
        $this->db->insert('online_store',$data);
    }

    public function func_update($source)
    {
        $this->db->where('os_id',$source['os_id']);
        $data = array(
            'os_name'              => $source['os_name'],
            'os_link'              => $source['os_link'],
            'os_source'            => $source['os_source'],
            'os_status'            => $source['os_status'],
        );
        $this->db->update('online_store',$data);
    }

    public function func_delete($os_id)
    {
        $this->db->where('os_id',$os_id);
        $this->db->delete('online_store');
    }

//    public function get_all_fabric($condition)
//    {
//        if(!empty($condition['search_name']))$this->db->like('fabric_name',$condition['search_name']);
//        if($condition['search_status'] != 'all'){
//            if(!empty($condition['search_status']))$this->db->where('fabric_status',$condition['search_status']);
//        }
//        if(!empty($condition['search_mode'])){
//            switch($condition['search_mode']){
//                case('order'):
//                    $this->db->order_by('fabric_id','asc');
//                    break;
//                case('stock'):
//                    $this->db->order_by('fabric_stock','desc');
//                    break;
//                default:
//                    $this->db->order_by('fabric_id','asc');
//            }
//        }
//        $query = $this->db->get('fabric_admin','200');
//        return $query->result_array();
//    }
//
//    public function get_all_fabric_available()
//    {
//        $this->db->where('fabric_status','1');
//        $query = $this->db->get('fabric_admin');
//        return $query->result_array();
//    }
//    public function get_all_fabric_for_show()
//    {
//        $query = $this->db->get('fabric_admin');
//        return $query->result_array();
//    }
//
//    public function quick_add($fabric_name)
//    {
//        $data = array(
//            'fabric_name' => $fabric_name
//        );
//        $this->db->insert('fabric_admin',$data);
//    }
//
//    public function quick_update($source)
//    {
//        $this->db->where('fabric_id',$source['update_fabric_id']);
//        $data = array(
//            'fabric_name'     =>  $source['update_fabric_name'],
//            'fabric_status'   =>  $source['update_fabric_status'],
//            'fabric_stock'    =>  $source['update_fabric_stock'],
//            'fabric_memo'    =>  $source['update_fabric_memo'],
//        );
//        $this->db->update('fabric_admin',$data);
//    }
//
//    public function get_used_fabric_num($fabric_id)
//    {
//        $this->db->where('sheet_fabric_id',$fabric_id);
//        $query = $this->db->get('client_sheet');
//        $source = $query->result_array();
//        return count($source);
//    }
//
//    public function get_fabric_by_name($fabric_name)
//    {
//        $this->db->select("fabric_admin.fabric_id,fabric_admin.fabric_name");
//        $this->db->from('fabric_admin');
//        $this->db->like('fabric_admin.fabric_name', $fabric_name);
//        $this->db->limit(30, 0);
//        $query = $this->db->get();
//        return $query->result_array();
//    }
}

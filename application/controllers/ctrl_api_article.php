<?php
class ctrl_api_article extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $helpers 	= array('date','html','form','verify_login');
        $libraries 	= array('form_validation','session');
        $models 	= array('model_article_category_main','model_article_category_branch','model_language','model_article_category_branch_link');
        $this->load->helper($helpers);
        $this->load->library($libraries);
        $this->load->model($models);
    }

    public function func_get_category_branch_article($acb_id)
    {
        $array = array();
        $data = $this->model_article_category_branch_link->func_get($acb_id);

        for($i=0;$i<count($data);$i++) {

            $data[$i]['article_image'] = 'http://promisekeeping.com/admin/uploads/'.$data[$i]['article_image'];
            $item = array();
            $item['article_id']             = $data[$i]['article_id'];
            $item['article_category_id']    = $data[$i]['acbl_acb_id'];
            $item['article_title']          = $data[$i]['article_title'];
            $item['article_image']          = $data[$i]['article_image'];
            $item['article_image_width']    = (int)$data[$i]['article_image_width'];
            $item['article_image_height']   = (int)$data[$i]['article_image_height'];
            $item['article_digest']         = $data[$i]['article_digest'];
            $item['article_member_id']      = 1;
            $item['article_like_counter']   = 1;  //$data[$i]['article_like'];
            $item['article_share_counter']  = 1;  //$data[$i]['article_share'];
            $item['article_location_id']    = 1;  //$data[$i]['article_address'];
            $item['article_create_time']    = $data[$i]['article_create_time'];
            $item['article_url']            = "http://promisekeeping.com/article/".$data[$i]['article_hash_id'];
            $item['member_image']           = $data[$i]['article_image'];
            $item['location_name']          = $data[$i]['article_address'];
            $array[] = $item;
        }

        if(!isset($_GET['json'])){
            echo json_encode($array);
//            echo '[{"article_id":60,"article_category_id":"1","article_title":"\u6587\u7ae0\u6a19\u984c112","article_image":"http:\/\/promisekeeping.com\/admin\/uploads\/image_6.jpeg","article_image_width":400,"article_image_height":230,"article_digest":"\u8df3\u821e\u6d3e\u5c0d\u7684\u4e3b\u8981\u5167\u5bb9\u662f\u5927\u91cf\u7684\u97f3\u6a02\u548c\u5176\u76f8\u95dc\u7684\u821e\u8e48[4]\u3002\u4ea4\u8ac7\u548c\u98df\u7269\u4e0d\u662f\u9019\u7a2e\u6d3e\u5c0d\u7684\u4e3b\u984c\u3002\u5728\u821e\u6703\u4e0a\u5927\u5bb6\u90fd\u5e0c\u671b\u901a\u904e\u821e\u8e48\u9019\u4e2d\u5a92\u4ecb\u4f86\u7d50\u4ea4\u66f4\u591a\u7684\u670b\u53cb\uff0c\u4e5f\u6709\u7684\u5e0c\u671b\u80fd\u5728\u9019\u88e1\u627e\u5230\u81ea\u5df1\u4e00\u751f\u7684\u4f34\u4fb6\u3002","article_member_id":2,"article_like_counter":136,"article_share_counter":34,"article_location_id":2,"article_create_time":"2016-03-02 11:25:13","article_url":"http:\/\/promisekeeping.com\/article\/2517c146bf39e4beee430ef84f7797aec5b3d47f","member_image":"http:\/\/loremflickr.com\/168\/168\/","location_name":"\u677f\u6a4b MegaCity"},{"article_id":55,"article_category_id":"1","article_title":"\u6587\u7ae0\u6a19\u984c137","article_image":"http:\/\/promisekeeping.com\/admin\/uploads\/image_8.jpeg","article_image_width":400,"article_image_height":230,"article_digest":"\u6211\u5e73\u5e38\u4e0d\u5206\u4eab\u6771\u897f \u4f46\u6211\u4e00\u5206\u4eab \u6211\u5c31\u5206\u4eab\u8d85\u597d\u7684\u6771\u897f","article_member_id":1,"article_like_counter":356,"article_share_counter":34,"article_location_id":1,"article_create_time":"2016-03-01 11:25:13","article_url":"http:\/\/promisekeeping.com\/article\/45e4dcfcf8f008027c8ee7c8fca504bb26018cf9","member_image":"http:\/\/lorempixel.com\/168\/168\/","location_name":"\u4e2d\u6b63\u7d00\u5ff5\u5802 \u81ea\u7531\u5ee3\u5834"},{"article_id":60,"article_category_id":"1","article_title":"\u6587\u7ae0\u6a19\u984c163","article_image":"http:\/\/promisekeeping.com\/admin\/uploads\/image_1.jpeg","article_image_width":400,"article_image_height":230,"article_digest":"\u8df3\u821e\u6d3e\u5c0d\u7684\u4e3b\u8981\u5167\u5bb9\u662f\u5927\u91cf\u7684\u97f3\u6a02\u548c\u5176\u76f8\u95dc\u7684\u821e\u8e48[4]\u3002\u4ea4\u8ac7\u548c\u98df\u7269\u4e0d\u662f\u9019\u7a2e\u6d3e\u5c0d\u7684\u4e3b\u984c\u3002\u5728\u821e\u6703\u4e0a\u5927\u5bb6\u90fd\u5e0c\u671b\u901a\u904e\u821e\u8e48\u9019\u4e2d\u5a92\u4ecb\u4f86\u7d50\u4ea4\u66f4\u591a\u7684\u670b\u53cb\uff0c\u4e5f\u6709\u7684\u5e0c\u671b\u80fd\u5728\u9019\u88e1\u627e\u5230\u81ea\u5df1\u4e00\u751f\u7684\u4f34\u4fb6\u3002","article_member_id":2,"article_like_counter":136,"article_share_counter":34,"article_location_id":2,"article_create_time":"2016-03-02 11:25:13","article_url":"http:\/\/promisekeeping.com\/article\/2517c146bf39e4beee430ef84f7797aec5b3d47f","member_image":"http:\/\/loremflickr.com\/168\/168\/","location_name":"\u677f\u6a4b MegaCity"},{"article_id":21,"article_category_id":"1","article_title":"\u6587\u7ae0\u6a19\u984c191","article_image":"http:\/\/promisekeeping.com\/admin\/uploads\/image_4.jpeg","article_image_width":400,"article_image_height":230,"article_digest":"\u5546\u696d\u6d3e\u5c0d\u662f\u4e00\u7a2e\u7531\u516c\u53f8\u6216\u4f01\u696d\u7d93\u5e38\u8209\u884c\u6216\u5728\u8655\u7406\u5546\u52d9\u7684\u7ad9\u9ede\u6216\u5728\u76f8\u95dc\u7684\u5730\u9ede\u8209\u884c\u7684\u6176\u795d\u6d3e\u5c0d\u3002\u9019\u4e9b\u6176\u795d\u53ef\u80fd\u8207\u4e8b\u52d9\u505a\u7684\u4e00\u4e9b\u8b8a\u52d5\uff0c\u6216\u4e8b\u52d9\u60f3\u8981\u652f\u6301\u6216\u5ba3\u50b3\u65b0\u4f01\u696d\u7684\u4e8b\u696d\u76f8\u7b26\u3002\u5546\u696d\u4eba\u58eb\u76f8\u4fe1\u5546\u696d\u6d3e\u5c0d\u80fd\u4fc3\u9032\u54e1\u5de5\u5728\u8655\u7406\u91cd\u8981\u4e8b\u52d9\u4e0a\u7684\u58eb\u6c23\u3002\u9019\u53ef\u80fd\u5c0e\u81f4\u66f4\u597d\u7684\u6c23\u8cea\u5728\u5de5\u4f5c\u5834\u6240\u548c\u66f4\u9ad8\u7684\u751f\u7522\u529b\u3002","article_member_id":2,"article_like_counter":136,"article_share_counter":34,"article_location_id":2,"article_create_time":"2016-03-02 11:25:13","article_url":"http:\/\/promisekeeping.com\/article\/897250238832361af66ac0bd2a4e415ca0910f20","member_image":"http:\/\/loremflickr.com\/168\/168\/","location_name":"\u677f\u6a4b MegaCity"}]';
        }else{
            echo "<pre>";
            print_r($array);
        }
    }
}
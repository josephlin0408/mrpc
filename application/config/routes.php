<?php
//if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$route['default_controller']        = 'ctrl_login/index';

$route['api/article/category/get/(:any)']   = "ctrl_api_article/func_get_category_branch_article/$1";
$route['api/product/category/get']     = "ctrl_api_product/func_get_product_category_list";
$route['api/product/get']          = "ctrl_api_product/func_get_product_list";

$route['404_override']              = 'errors/page_missing';

$route['login']                     = 'ctrl_login/index';
$route['login/verify']              = 'ctrl_login/verify';

$route['dashboard']                 = 'ctrl_dashboard';

$route['upload/form/tracking']       = 'ctrl_excel_upload/tracking';
$route['upload/form/invoice']       = 'ctrl_excel_upload/invoice';
$route['upload/tracking']           = 'ctrl_excel_upload/do_upload_tracking';
$route['upload/invoice']            = 'ctrl_excel_upload/do_upload_invoice';

$route['prospect']                  = 'ctrl_prospect/index';
$route['prospect/view/(:any)']      = 'ctrl_prospect/view/$1';

$route['member/page/(:any)/(:any)'] = 'ctrl_member/paging/$1/$2';
$route['member/view/(:any)']        = 'ctrl_member/view/$1';
$route['member/suspend/(:any)']     = 'ctrl_member/suspend/$1';
$route['member/export/(:any)']      = 'ctrl_output/output_member/$1';
$route['member/upgrade']            = 'ctrl_member/update_member_status';

$route['advertiser/page/(:any)/(:any)']        = 'ctrl_advertiser/paging/$1/$2';
$route['advertiser/add/(:any)/(:any)']         = 'ctrl_advertiser/add/$1/$2';

$route['ads-mark/home/(:any)/(:any)']           = 'ctrl_ads_mark/paging/$1/$2';
$route['ads-mark/add/(:any)/(:any)']            = 'ctrl_ads_mark/add/$1/$2';
$route['ads-mark/delete/(:any)']                = 'ctrl_ads_mark/delete/$1';

$route['order']                                 = 'ctrl_order/index';
$route['order/page/(:any)/(:any)']              = 'ctrl_order/paging/$1/$2';
$route['order/ready/shipping']                  = 'ctrl_order/get_orders_ready_to_ship';
$route['order/view/(:any)']                     = 'ctrl_order/view/$1';
$route['order/refund/(:any)']                   = 'ctrl_order/refund/$1';
$route['order/payment/status/(:any)/(:any)/(:any)']    = 'ctrl_order/payment/$1/$2/$3';
$route['order/output']                          = 'ctrl_output/func_before_output_order';
$route['order/change/status']                   = 'ctrl_order/change_status';
$route['order/checkbox/export']                 = 'ctrl_output/func_checkbox_output_order';
$route['order/checkbox/all']                    = 'ctrl_output/func_checkbox_output_order_all';
$route['order/checkbox/manual/invoice/export']  = 'ctrl_output/func_checkbox_output_order_for_manual_invoice';


$route['order/cod']                 = 'ctrl_order/get_orders_cod';
$route['order/transfer']            = 'ctrl_order/get_orders_transfer';
$route['order/credit']              = 'ctrl_order/get_orders_credit_card';
$route['order/invoice/electronic']  = 'ctrl_order/get_orders_electronic_invoice';
$route['order/invoice/manual']      = 'ctrl_order/get_orders_manual_invoice';
$route['order/shipped']             = 'ctrl_order/get_orders_shipped';

$route['order/transfer/paid']                = 'ctrl_order/get_orders_transfer_and_ready_to_ship';
$route['order/transfer/unpaid']              = 'ctrl_order/get_orders_transfer_and_not_ready_to_ship';

$route['email']                 = 'ctrl_template/index';
$route['email/create']          = 'ctrl_template/create';
$route['email/update/(:any)']   = 'ctrl_template/update/$1';
$route['email/test']            = 'ctrl_template/test';

$route['article']                 = 'ctrl_sop/index';
$route['article/create']          = 'ctrl_sop/create';
$route['article/more/disable/(:any)/(:any)'] = 'ctrl_sop/disable_article_category/$1/$2';
$route['article/more/add/(:any)'] = 'ctrl_sop/add_article_category/$1';
$route['article/more/(:any)']     = 'ctrl_sop/more/$1';
$route['article/update/(:any)']   = 'ctrl_sop/update/$1';
$route['article/banner/disable/(:any)/(:any)'] = 'ctrl_sop/banner_image_disable/$1/$2';
$route['article/banner/switch/(:any)/(:any)'] = 'ctrl_sop/banner_image_switch/$1/$2';
$route['article/banner/upload/(:any)'] = 'ctrl_sop/banner_image_upload/$1';
$route['article/banner/(:any)']   = 'ctrl_sop/banner_image_edit/$1';

$route['code']                 = 'ctrl_tracking_code/index';
$route['code/create']          = 'ctrl_tracking_code/create';
$route['code/update/(:any)']   = 'ctrl_tracking_code/update/$1';

$route['coupon']                    = 'ctrl_coupon/index';
$route['coupon/create']             = 'ctrl_coupon/create';
$route['coupon/update']             = 'ctrl_coupon/update';
$route['coupon/delete/(:any)']      = 'ctrl_coupon/delete/$1';

/*進銷存系統-產品管理強化*/
$route['inventory/product/category/admin']              = 'ctrl_inventory/product_category_admin';//商品類別管理
$route['inventory/product/model/admin']                 = 'ctrl_inventory/product_model_admin';//類別模組管理
$route['inventory/product/attribute/admin']             = 'ctrl_inventory/product_attribute_admin';//模組屬性管理
$route['inventory/product/attribute/add']               = 'ctrl_inventory/add_attribute_type';//模組屬性add
$route['inventory/product/attribute/update']            = 'ctrl_inventory/update_attribute_type';//模組屬性add
$route['inventory/product/attribute/value/admin']       = 'ctrl_inventory/product_attribute_value_admin';//屬性值管理
$route['inventory/product/model/content/add']           = 'ctrl_inventory/product_model_content_add';//模組商品創建
$route['inventory/product/model/content/admin']         = 'ctrl_inventory/product_model_content_admin';//模組商品管理
$route['inventory/product/model/content/image/upload']  = 'ctrl_inventory/product_model_content_image_upload';//模組商品管理
$route['inventory/product/model/content/image/admin']   = 'ctrl_inventory/product_model_content_image_admin';//模組商品管理
/*進銷存系統-產品管理強化END*/

$route['payment/method']                = 'ctrl_payment_method/get_payment';//支付方法管理：列表
$route['payment/method/fee/update']     = 'ctrl_payment_method/update_fee';//支付方法管理：更新手續費
$route['payment/method/status/update']  = 'ctrl_payment_method/update_status';//支付方法管理：更新支付方法狀態

$route['shipping/method']               = 'ctrl_shipping_method/get_shipping';//運送方法管理：列表
$route['shipping/method/update']        = 'ctrl_shipping_method/func_update';//運送方法管理：更新
$route['shipping/method/add']           = 'ctrl_shipping_method/func_add';//運送方法管理：新增

$route['inventory/product/model/get/meta/description']              = 'ctrl_inventory/func_get_model_meta_description';//META描述取得
$route['inventory/product/model/update/meta/description']           = 'ctrl_inventory/func_update_model_meta_description';//META描述更新
$route['inventory/product/model/description/update/form/(:any)']    = 'ctrl_inventory/model_description_update_form/$1';//描述更新表格
$route['inventory/product/model/description/update']                = 'ctrl_inventory/model_description_update';//描述更新表格

$route['banner']                = 'ctrl_banner/banner_admin_form';//橫幅管理介面
$route['banner/status/switch']  = 'ctrl_banner/banner_status_switch';//橫幅管理介面

$route['ads']                   = 'ctrl_ads/ads_admin';//廣告管理介面
$route['ads/status/switch']     = 'ctrl_ads/ads_status_switch';//橫幅管理介面

$route['navigation']                = 'ctrl_navigation/navigation_admin';//導覽管理
$route['navigation/add']            = 'ctrl_navigation/navigation_add';//導覽管理
$route['navigation/update']         = 'ctrl_navigation/navigation_update';//導覽管理
$route['navigation/content/add']    = 'ctrl_navigation/navigation_content_add';//導覽內容管理
$route['navigation/content/update'] = 'ctrl_navigation/navigation_content_update';//導覽內容管理

$route['language/admin']            = 'ctrl_language/get_language_list'; //語系管理
$route['language/session/change']   = 'ctrl_language/session_change'; //語系管理

$route['offline/store/admin']            = 'ctrl_offline_store/get_list'; //實體商店管理
$route['offline/store/add']              = 'ctrl_offline_store/add_list'; //實體商店新增
$route['offline/store/add/perform']      = 'ctrl_offline_store/func_add'; //實體商店執行新增
$route['offline/store/update/(:any)']    = 'ctrl_offline_store/update_list/$1'; //實體商店編輯
$route['offline/store/update/perform']   = 'ctrl_offline_store/func_update'; //實體商店執行編輯
$route['offline/store/delete/(:any)']    = 'ctrl_offline_store/delete_list/$1'; //實體商店刪除

$route['online/store/admin']            = 'ctrl_online_store/func_get'; //網路商店管理
$route['online/store/add']              = 'ctrl_online_store/add_list'; //網路商店新增
$route['online/store/add/perform']      = 'ctrl_online_store/func_add'; //網路商店執行新增
$route['online/store/update/(:any)']    = 'ctrl_online_store/update_list/$1'; //網路商店編輯
$route['online/store/update/perform']   = 'ctrl_online_store/func_update'; //網路商店執行編輯
$route['online/store/delete/(:any)']    = 'ctrl_online_store/delete_list/$1'; //網路商店刪除

$route['article/category/main/admin']            = 'ctrl_article_category/func_get_category_main'; //文章主類別管理
$route['article/category/main/add']              = 'ctrl_article_category/func_category_main_add_form'; //文章主類別新增表格
$route['article/category/main/add/perform']      = 'ctrl_article_category/func_category_main_add'; //文章主類別執行新增
$route['article/category/main/update/(:any)']    = 'ctrl_article_category/update_main_list/$1'; //文章主類別編輯表格
$route['article/category/main/update/perform']   = 'ctrl_article_category/func_main_update'; //文章主類別執行編輯
$route['article/category/appoint/index/(:any)']  = 'ctrl_article_category/func_appoint_index/$1'; //文章主類別指定為首頁顯示


$route['article/category/branch/admin/(:any)']          = 'ctrl_article_category/func_get_category_branch/$1'; //文章次類別管理
$route['article/category/branch/add/(:any)']            = 'ctrl_article_category/func_category_branch_add_form/$1'; //文章次類別新增表格
$route['article/category/branch/add/perform']           = 'ctrl_article_category/func_category_branch_add'; //文章次類別執行新增
$route['article/category/branch/update/(:any)/(:any)']  = 'ctrl_article_category/func_category_branch_update_form/$1/$2'; //文章次類別編輯表格
$route['article/category/branch/update/perform']        = 'ctrl_article_category/func_category_branch_update'; //文章次類別執行編輯
$route['article/category/branch/article/(:any)']        = 'ctrl_article_category/func_add_category_article/$1'; //文章次類別管理

$route['lesson/category']           = 'ctrl_lesson_category/func_get_category_main'; //課程類別管理
$route['lesson/category/add']       = 'ctrl_lesson_category/func_category_main_add'; //課程類別新增執行
$route['lesson/category/update']    = 'ctrl_lesson_category/func_main_update'; //課程類別編輯執行

$route['lesson']                = 'ctrl_lesson/index'; //課程管理
$route['lesson/create']         = 'ctrl_lesson/create'; //課程創造
$route['lesson/update/(:any)']  = 'ctrl_lesson/update/$1'; //課程編輯

$route['message']                = 'ctrl_message/get_message'; //留言管理
$route['message/delete/(:any)']  = 'ctrl_message/delete_message/$1'; //留言刪除


$route['repair']               = 'ctrl_repair/index'; //報修管理
$route['repair/create']        = 'ctrl_repair/create'; //報修創造
$route['repair/update/(:any)'] = 'ctrl_repair/update/$1'; //報修管理
$route['repair/delete/(:any)'] = 'ctrl_repair/delete/$1'; //報修刪除

$route['article/category/branch/insert/article/(:any)/(:any)']  = 'ctrl_article_category/func_category_branch_insert_article/$1/$2'; //文章次類別掛入文章
$route['article/category/branch/disable/article/(:any)/(:any)/(:any)']  = 'ctrl_article_category/func_category_branch_disable_article/$1/$2/$3'; //文章次類別掛入文章

$route['article/tag/admin']            = 'ctrl_article_tag/func_list';
$route['article/tag/add/perform']      = 'ctrl_article_tag/func_add';
$route['article/tag/update/perform']   = 'ctrl_article_tag/func_update';


$route['config/panel']      = 'ctrl_system/update';
$route['config/data']       = 'ctrl_product_public/config';
$route['config/data/json']  = 'ctrl_product_public/config_json';

$route['config/admin']      = 'ctrl_config_admin/index';
$route['config/create']     = 'ctrl_config_admin/create';
$route['config/update']     = 'ctrl_config_admin/update';
$route['config/delete/(:any)'] = 'ctrl_config_admin/delete/$1';

//auto-complete
$route['product/upsell/query'] = 'ctrl_product_upsell/query';
$route['query/article/category'] = 'ctrl_article_category/func_query'; //文章次類別查詢
$route['query/article'] = 'ctrl_sop/func_query'; //文章次類別查詢
$route['auto/complete/article/update/tag'] = 'ctrl_sop/get_tag_for_auto_complete'; //文章編輯時提供之便利功能

//for A-jax
//$route['product/upsell/create/ajax'] = 'ctrl_product_upsell/get_product_id';
$route['repair/ajax/update'] = 'ctrl_repair/update_via_ajax';
$route['ajax/article/tag/remove'] = 'ctrl_article_tag/func_remove';
$route['ajax/article/tag/navigation/status/change'] = 'ctrl_article_tag/func_change_tag_nav_status';
//模組測試用路徑，非成品網頁
/* End of file routes.php */
/* Location: ./application/config/routes.php */
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ctrl_output extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
//        $this->load->helper('login');

        $this->load->library('form_validation');
        $this->load->library('session');

//        verify_login($this->session->all_userdata());
    }

    public function output_member($is_prospect)
    {
        /*決定欄位*/
        $fields[0] = 'member_account';
        $fields[1] = 'member_name';
        $fields[2] = 'member_phone';
        $fields[3] = 'member_region';
        $fields[4] = 'member_address';
        $fields[5] = 'member_ip';
        $fields[6] = 'member_device';
        $fields[7] = 'member_create_stamp';

        /*決定內容*/
        $this->load->model('Model_member');
        $data['member']    = $this->Model_member->get_members($is_prospect);

        $material_row = count($data['member']); //資料列數

        /*excel沒有資料時強制返回瀏覽頁面，但在BTN其實就不給點按*/
        if($material_row <= 0) {
            redirect(base_url().'member', 'location', 301);
        }

        $material = array();
        if($material_row != 0)
        {
            for($i=0;$i<$material_row;$i++)
            {
                $material[$i] = array(
                    '欄位一' => $data['member'][$i]['member_account'],
                    '欄位二' => $data['member'][$i]['member_name'],
                    '欄位三' => $data['member'][$i]['member_phone'],
                    '欄位四' => $data['member'][$i]['member_region'],
                    '欄位五' => $data['member'][$i]['member_address'],
                    '欄位六' => $data['member'][$i]['member_ip'],
                    '欄位七' => $data['member'][$i]['member_device'],
                    '欄位八' => $data['member'][$i]['member_create_stamp']
                );
            }
            $this->func_excel($fields,$material);
        }
        else
        {
            redirect(base_url().'member', 'location', 301);
        }
    }

    public function func_checkbox_output_order()
    {
        /*決定欄位*/
        $fields[0] = '匯入單號';
        $fields[1] = '自訂編號';
        $fields[2] = '客戶編號';
        $fields[3] = '統一編號';
        $fields[4] = '客戶名稱';
        $fields[5] = '客戶地址';
        $fields[6] = '客戶手機號碼';
        $fields[7] = '客戶電子信箱';
        $fields[8] = '課稅別';
        $fields[9] = '發票金額';
        $fields[10] = '發票捐贈';
        $fields[11] = '發票捐贈代碼';
        $fields[12] = '備註';
        $fields[13] = '字軌類別';
        $fields[14] = '商品名稱';
        $fields[15] = '購買數量';
        $fields[16] = '商品單位';
        $fields[17] = '單價';
        $fields[18] = '商品備註';

        $order_array = explode( ',', $this->input->get('data') );

        $this->load->model('Model_order');

        $data['order']    = $this->Model_order->get_orders_for_export($order_array);

        $material_row = count($data['order']); //資料列數

        /*excel沒有資料時強制返回瀏覽頁面，但在BTN其實就不給點按*/
        if($material_row <= 0)
        {
            redirect(base_url().'order', 'location', 301);
        }

        $i = 0;

        $array = array();

        foreach($data['order'] as $unit){

            $temp_counter = 0;
            foreach($unit['order_cart'] as $item){
                $temp_counter += $item['cart_package_qty'];
            }
            mb_internal_encoding("UTF-8");

            $i++;

            $array[0][] = $i;  //$fields[0] = '匯入單號';
            $array[1][] = $unit['order_id'];  //$fields[1] = '自訂編號';
            $array[2][] = " ";  //$fields[2] = '客戶編號';
            $array[3][] = " ";  //$fields[3] = '統一編號';
            $array[4][] = $unit['order_member_name'];  //$fields[4] = '客戶名稱';
            $array[5][] = $unit['order_member_address'];  //$fields[5] = '客戶地址';
            $array[6][] = $unit['order_member_phone'];  //$fields[6] = '客戶手機號碼';
            $array[7][] = $unit['order_member_account'];  //$fields[7] = '客戶電子信箱';
            $array[8][] = "1";  //$fields[8] = '課稅別';
            $array[9][] = $unit['order_total'];  //$fields[9] = '發票金額';
            $array[10][] = "0";  //$fields[10] = '發票捐贈';
            $array[11][] = " ";  //$fields[11] = '發票捐贈代碼';
            $array[12][] = $unit['order_notes'];  //$fields[12] = '備註';
            $array[13][] = "07";  //$fields[13] = '字軌類別';
            $array[14][] = "MAGIPEA 自拍棒";  //$fields[14] = '商品名稱';
            $array[15][] = $temp_counter;  //$fields[15] = '購買數量';
            $array[16][] = "個";  //$fields[16] = '商品單位';
            $array[17][] = round($unit['order_total']/$temp_counter, 2);  //$fields[17] = '單價';
            $array[18][] = $unit['invoice_msg'];;  //$fields[18] = '商品備註';
        }

        $material = array();
        if($material_row != 0)
        {
            for($i=0;$i<$material_row;$i++)
            {
                $material[$i] = array(
                    '欄位0'  => $array[0][$i],
                    '欄位1'  => $array[1][$i],
                    '欄位2'  => $array[2][$i],
                    '欄位3'  => $array[3][$i],
                    '欄位4'  => $array[4][$i],
                    '欄位5'  => $array[5][$i],
                    '欄位6'  => $array[6][$i],
                    '欄位7'  => $array[7][$i],
                    '欄位8'  => $array[8][$i],
                    '欄位9'  => $array[9][$i],
                    '欄位10' => $array[10][$i],
                    '欄位11' => $array[11][$i],
                    '欄位12' => $array[12][$i],
                    '欄位13' => $array[13][$i],
                    '欄位14' => $array[14][$i],
                    '欄位15' => $array[15][$i],
                    '欄位16' => $array[16][$i],
                    '欄位17' => $array[17][$i],
                    '欄位18' => $array[18][$i],
                );
            }
            $this->func_excel(null,$material);
        }
        else
        {
            redirect(base_url().'order', 'location', 301);
        }
    }

    public function func_checkbox_output_order_for_manual_invoice()
    {
        /*決定欄位*/
        $fields[0] = '匯入單號';
        $fields[1] = '自訂編號';
        $fields[2] = '客戶編號';
        $fields[3] = '統一編號';
        $fields[4] = '客戶名稱';
        $fields[5] = '客戶地址';
        $fields[6] = '客戶手機號碼';
        $fields[7] = '客戶電子信箱';
        $fields[8] = '課稅別';
        $fields[9] = '發票金額';
        $fields[10] = '發票捐贈';
        $fields[11] = '發票捐贈代碼';
        $fields[12] = '備註';
        $fields[13] = '字軌類別';
        $fields[14] = '商品名稱';
        $fields[15] = '購買數量';
        $fields[16] = '商品單位';
        $fields[17] = '單價';
        $fields[18] = '商品備註';
        $fields[19] = '單價(95%)';
        $fields[20] = '稅金(5%)';

        $order_array = explode( ',', $this->input->get('data') );

        $this->load->model('Model_order');

        $data['order']    = $this->Model_order->get_orders_for_export($order_array);

        $material_row = count($data['order']); //資料列數

        /*excel沒有資料時強制返回瀏覽頁面，但在BTN其實就不給點按*/
        if($material_row <= 0)
        {
            redirect(base_url().'order', 'location', 301);
        }

        $i = 0;

        $array = array();

        foreach($data['order'] as $unit){

            $temp_counter = 0;
            foreach($unit['order_cart'] as $item){
                $temp_counter += $item['cart_package_qty'];
            }
            mb_internal_encoding("UTF-8");

            $i++;

            $array[0][] = $i;  //$fields[0] = '匯入單號';
            $array[1][] = $unit['order_id'];  //$fields[1] = '自訂編號';
            $array[2][] = " ";  //$fields[2] = '客戶編號';
            $array[3][] = $unit['invoice_tax_id'];  //$fields[3] = '統一編號';
            $array[4][] = $unit['order_member_name'];  //$fields[4] = '客戶名稱';
            $array[5][] = $unit['order_member_address'];  //$fields[5] = '客戶地址';
            $array[6][] = $unit['order_member_phone'];  //$fields[6] = '客戶手機號碼';
            $array[7][] = $unit['order_member_account'];  //$fields[7] = '客戶電子信箱';
            $array[8][] = "1";  //$fields[8] = '課稅別';
            $array[9][] = $unit['order_total'];  //$fields[9] = '發票金額';
            $array[10][] = "0";  //$fields[10] = '發票捐贈';
            $array[11][] = " ";  //$fields[11] = '發票捐贈代碼';
            $array[12][] = $unit['order_notes'];  //$fields[12] = '備註';
            $array[13][] = "07";  //$fields[13] = '字軌類別';
            $array[14][] = "MAGIPEA 自拍棒";  //$fields[14] = '商品名稱';
            $array[15][] = $temp_counter;  //$fields[15] = '購買數量';
            $array[16][] = "個";  //$fields[16] = '商品單位';
            $array[17][] = round($unit['order_total']/$temp_counter, 0);  //$fields[17] = '單價';
            $array[18][] = $unit['invoice_msg'];  //$fields[18] = '商品備註';
            $array[19][] = round(($unit['order_total']/$temp_counter)*0.95, 0);
            $array[20][] = round($unit['order_total']/$temp_counter, 0) - round(($unit['order_total']/$temp_counter)*0.95, 0);
        }

        $material = array();
        if($material_row != 0)
        {
            for($i=0;$i<$material_row;$i++)
            {
                $material[$i] = array(
                    '欄位0'  => $array[0][$i],
                    '欄位1'  => $array[1][$i],
                    '欄位2'  => $array[2][$i],
                    '欄位3'  => $array[3][$i],
                    '欄位4'  => $array[4][$i],
                    '欄位5'  => $array[5][$i],
                    '欄位6'  => $array[6][$i],
                    '欄位7'  => $array[7][$i],
                    '欄位8'  => $array[8][$i],
                    '欄位9'  => $array[9][$i],
                    '欄位10' => $array[10][$i],
                    '欄位11' => $array[11][$i],
                    '欄位12' => $array[12][$i],
                    '欄位13' => $array[13][$i],
                    '欄位14' => $array[14][$i],
                    '欄位15' => $array[15][$i],
                    '欄位16' => $array[16][$i],
                    '欄位17' => $array[17][$i],
                    '欄位18' => $array[18][$i],
                    '欄位19' => $array[19][$i],
                    '欄位20' => $array[20][$i],
                );
            }
            $this->func_excel($fields,$material);
        }
        else
        {
            redirect(base_url().'order', 'location', 301);
        }
    }

    public function func_before_output_order()
    {
        /*決定欄位*/
        $fields[0] = '訂單編號';
        $fields[1] = '訂單編號';
        $fields[2] = '收件人';
        $fields[3] = '收件人地址';
        $fields[4] = '收件人電話';
        $fields[5] = '代收金額';
        $fields[6] = '備註欄位';
        $fields[7] = '客戶留言';

        /*決定內容*/
        $this->load->model('Model_order');
//        $data['order']    = $this->Model_order->get_orders_ready_to_ship();
        $data['order']    = $this->Model_order->get_orders_ready_to_ship_all();

        $material_row = count($data['order']); //資料列數

        /*excel沒有資料時強制返回瀏覽頁面，但在BTN其實就不給點按*/
        if($material_row <= 0)
        {
            redirect(base_url().'order', 'location', 301);
        }
        foreach($data['order'] as $unit){

            $temp_string = "";
            foreach($unit['order_cart'] as $item){
                $temp_string .= $item['cart_product_name']."x".$item['cart_package_qty'].",";
            }
            mb_internal_encoding("UTF-8");

            $array_excel_material_order_items[]                 = mb_substr($temp_string,0,-1);
            $array_excel_material_order_id[]                    = $unit['order_id'];
            $array_excel_material_order_member_name[]           = $unit['order_member_name'];
            $array_excel_material_order_member_address[]        = mb_substr($unit['order_member_address'],3,strlen($unit['order_member_address']));
            $array_excel_material_order_member_phone[]          = "'".$unit['order_member_phone'];

            if($unit['order_payment_option'] == 1)
            {
                $order_total = $unit['order_total'];
            }
            else
            {
                $order_total = '';
            }
            $array_excel_material_order_total[]                 = $order_total;
            $array_excel_material_order_notes[]                 = $unit['order_notes'];
            $array_excel_material_order_msg[]                   = $unit['invoice_msg'];
        }

        $material = array();
        if($material_row != 0)
        {
            for($i=0;$i<$material_row;$i++)
            {
                $material[$i] = array(
                    '欄位一' => $array_excel_material_order_id[$i],
                    '欄位二' => $array_excel_material_order_items[$i],
                    '欄位三' => $array_excel_material_order_member_name[$i],
                    '欄位四' => $array_excel_material_order_member_address[$i],
                    '欄位五' => $array_excel_material_order_member_phone[$i],
                    '欄位六' => $array_excel_material_order_total[$i],
                    '欄位七' => $array_excel_material_order_notes[$i],
                    '欄位八' => $array_excel_material_order_msg[$i]
                );
            }
            $this->func_excel(null,$material);
        }
        else
        {
            redirect(base_url().'order', 'location', 301);
        }
    }


    public function func_checkbox_output_order_all()
    {
        $this->load->model('Model_order');
        /*決定欄位*/
        $field_title_array = array(
            '匯入單號','自訂編號','客戶編號','統一編號',
            '客戶名稱','客戶地址','客戶手機號碼','客戶電子信箱',
            '課稅別','發票金額','發票捐贈','發票捐贈代碼',
            '載具類別','載具編號','列印註記','備註',
            '字軌類別','商品名稱','購買數量','商品單位',
            '單價','商品備註'
        );
        /*決定欄位END*/

        /*取得選取的資料，並獲得資料列數*/
        $order_array = explode( ',', $this->input->get('data') );
        $data['order'] = $this->Model_order->get_orders_for_export($order_array);
        $material_row = count($data['order']); //資料列數
        /*取得選取的資料，並獲得資料列數END*/

        /*整理選取的資料，以便於成為匯出之文件內容*/
        $document_row = 0;
        $sheet_id_now = 1;

        for($j=0;$j<$material_row;$j++){
            $cart_row = count($data['order'][$j]['order_cart']);
            $temp_doc = 1;
            $coupon = 1;
            if($data['order'][$j]['order_coupon_discount'] > 0) $coupon = $data['order'][$j]['order_coupon_discount'];

            for($i=0;$i<$cart_row;$i++){
                /*若同訂單號，省略多數相同資料欄位*/
                if($i>0) {
                    $data['order'][$j]['order_id']='';
                    $data['order'][$j]['order_member_id']='';
                    $data['order'][$j]['invoice_tax_id']='';
                    $data['order'][$j]['order_member_name']='';
                    $data['order'][$j]['order_member_address']='';
                    $data['order'][$j]['order_member_phone']='';
                    $data['order'][$j]['order_member_account']='';
                    $data['order'][$j]['order_total']='';
                    $data['order'][$j]['invoice_option']='';
                    $tax_type   = '';//欄位：課稅別
                    $tax_index  = '';//欄位：字軌類別

                    //解決折扣代碼


                }else{
                    $tax_type   = '2';//欄位：課稅別
                    $tax_index  = '7';//欄位：字軌類別
                    $temp_doc   = $i;
                }
                /*若同訂單號，省略多數相同資料欄位END*/

                $subject = $data['order'][$j]['order_cart'][$i]['cart_product_name'];

                $product_name = $subject;

                if (preg_match("/\自拍棒/i", $subject))$product_name = "MAGIPEA 自拍棒";

                if (preg_match("/\涮腳架/i", $subject))$product_name = "MAGIPEA自拍涮腳架";

                if (preg_match("/\藍芽遙控器/i", $subject))$product_name = "MAGIPEA 藍芽遙控器";

                if (preg_match("/\防水袋/i", $subject))$product_name = "MAGIPEA 防水束口袋";

                if (preg_match("/Pro/i", $subject))$product_name = "MAGIPEA自拍涮腳架配件-Gopro夾";

                if (preg_match("/iPad/i", $subject))$product_name = "MAGIPEA自拍涮腳架配件-IPAD夾";

                if (preg_match("/360/i", $subject))$product_name = "MAGIPEA自拍涮腳架配件-360度旋轉台";

                if (preg_match("/\藍芽音響/i", $subject))$product_name = "MAGIPEA 藍芽音響";

                if (preg_match("/\白天鵝/i", $subject))$product_name = "MAGIPEA 白天鵝無線藍芽音響檯燈";

                if (preg_match("/\千鳥/i", $subject))$product_name = "MAGIPEA 學舌鳥組合";


                $document[$document_row] = $data['order'][$j]+array(
                        'cart_product_name'     => $product_name,
                        'cart_package_qty'      => $data['order'][$j]['order_cart'][$i]['cart_package_qty'],
                        'cart_package_price'    => round($data['order'][$j]['order_cart'][$i]['cart_package_price']*$coupon),
                        'tax_type'              => $tax_type,
                        'tax_index'             => $tax_index,
                        'sheet_id'              => $sheet_id_now,
                    );
                unset($document[$document_row]['order_cart']);
                $document_row++;
            }
            /*若同訂單號，省略多數相同資料欄位*/
            if($temp_doc==0){
                $data['order'][$j]['order_id']='';
                $data['order'][$j]['order_member_id']='';
                $data['order'][$j]['invoice_tax_id']='';
                $data['order'][$j]['order_member_name']='';
                $data['order'][$j]['order_member_address']='';
                $data['order'][$j]['order_member_phone']='';
                $data['order'][$j]['order_member_account']='';
                $data['order'][$j]['order_total']='';
                $data['order'][$j]['invoice_option']='';
                $tax_type   = '';//欄位：課稅別
                $tax_index  = '';//欄位：字軌類別
            }
            /*若同訂單號，省略多數相同資料欄位END*/
            /*若此單交易含有運費/服務費另列一筆資料供匯出*/
            if($data['order'][$j]['order_shipping_fee']>0){
                $document[$document_row] = $data['order'][$j]+array(
                        'cart_product_name'     => '運費',
                        'cart_package_qty'      => '1',
                        'cart_package_price'    => $data['order'][$j]['order_shipping_fee'],
                        'tax_type'              => $tax_type,
                        'tax_index'             => $tax_index,
                        'sheet_id'              => $sheet_id_now,
                    );
                unset($document[$document_row]['order_cart']);
                $document_row++;
            }
            if($data['order'][$j]['order_service_fee']>0){

                //有優先的話
                switch ($data['order'][$j]['order_shipping_option']) {
                    case 2:
                    case 4:
                    case 6:
                        //其他服務費
                        $document[$document_row] = $data['order'][$j]+array(
                                'cart_product_name'     => '優先到貨手續費',
                                'cart_package_qty'      => '1',
                                'cart_package_price'    => 30,
                                'tax_type'              => $tax_type,
                                'tax_index'             => $tax_index,
                                'sheet_id'              => $sheet_id_now,
                            );
                    $data['order'][$j]['order_service_fee'] = $data['order'][$j]['order_service_fee'] -30;
                    unset($document[$document_row]['order_cart']);
                        $document_row++;
                        break;
                }



                //其他服務費
                if($data['order'][$j]['order_service_fee']>0){

                    $document[$document_row] = $data['order'][$j]+array(
                            'cart_product_name'     => '貨到付款手續費',
                            'cart_package_qty'      => '1',
                            'cart_package_price'    => $data['order'][$j]['order_service_fee'],
                            'tax_type'              => $tax_type,
                            'tax_index'             => $tax_index,
                            'sheet_id'              => $sheet_id_now,
                        );
                    unset($document[$document_row]['order_cart']);
                    $document_row++;
                }



            }
            /*若此單交易含有運費/服務費另列一筆資料供匯出END*/
            $sheet_id_now++;
        }
        /*整理選取的資料，以便於成為匯出之文件內容END*/

        /*沒有資料可以列印時，導回畫面*/
        if($material_row <= 0) redirect(base_url().'order', 'location', 301);
        /*沒有資料可以列印時，導回畫面END*/

        /*將資料帶進匯出標準格式並匯出*/
        $material_row = count($document);
        $material = array();
        if($material_row != 0)
        {
            for($i=0;$i<$material_row;$i++)
            {
                $material[$i] = array(
                    '欄位一'       => $document[$i]['sheet_id'],
                    '欄位二'       => $document[$i]['order_id'],
                    '欄位三'       => '',
                    '欄位四'       => $document[$i]['invoice_tax_id'],
                    '欄位五'       => $document[$i]['order_member_name'],
                    '欄位六'       => $document[$i]['order_member_address'],
                    '欄位七'       => $document[$i]['order_member_phone'],
                    '欄位八'       => $document[$i]['order_member_account'],
                    '欄位九'       => $document[$i]['order_total'] > 0 ? 1 : '',
                    '欄位十'       => $document[$i]['order_total'] > 0 ? $document[$i]['order_total'] : '',
                    '欄位十一'      => '',
                    '欄位十二'      => '',
                    '欄位十三'      => '',
                    '欄位十四'      => '',
                    '欄位十五'      => '',
                    '欄位十六'      => '',
                    '欄位十七'      => $document[$i]['tax_index'],
                    '欄位十八'      => $document[$i]['cart_product_name'],
                    '欄位十九'      => $document[$i]['cart_package_qty'],
                    '欄位二十'      => '個',
                    '欄位二一'      => $document[$i]['cart_package_price'],
                    '欄位二二'      => '',
                );
            }
            $this->func_excel($field_title_array,$material);
        }
        else
        {
            redirect(base_url().'order', 'location', 301);
        }
        /*將資料帶進匯出標準格式並匯出END*/
    }

    public function func_excel($fields_customize, $result)
    {
        $this->load->library('PHPExcel');
        $this->load->library('PHPExcel/IOFactory');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle("export")->setDescription("none");

        $objPHPExcel->setActiveSheetIndex(0);

        $row = 1;
        $col = 0;
        if($fields_customize!=null){
            foreach ($fields_customize as $field)
            {
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $field);
                $col++;
            }
        }
        $fields = array_keys($result[0]);

        if($col > 0)$row = 2; else $row = 1;
        foreach($result as $data)
        {
            $col = 0;
            foreach ($fields as $field)
            {
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data[$field]);
                $col++;
            }
            $row++;
        }

        $objPHPExcel->setActiveSheetIndex(0);

        $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');

        $file_name = "export_".date('dMy');
        // Sending headers to force the user to download the file
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$file_name.'.xls"');
        header('Cache-Control: max-age=0');

        $objWriter->save('php://output');

    }
}
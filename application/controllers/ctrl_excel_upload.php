<?php

class Ctrl_excel_upload extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));

        $this->load->model('model_order');
        $this->load->model('model_task');

        $this->load->library('form_validation');
        $this->load->library('session');

        $this->load->helper('date');
        $this->load->helper('html');
        $this->load->helper('form');
        $this->load->helper('email');

        $this->load->helper('verify_login');

        verify_login_admin($this->session->all_userdata());
    }

    function tracking()
    {
        $this->load->view('templates/header');
        $this->load->view('dashboard/upload_form', array('error' => '','target_url' => 'tracking' ));
        $this->load->view('templates/footer');
    }

    function invoice()
    {
        $this->load->view('templates/header');
        $this->load->view('dashboard/upload_form', array('error' => '','target_url' => 'invoice' ));
        $this->load->view('templates/footer');
    }

    function do_upload_tracking()
    {
        $config['upload_path'] = 'uploads/';
        $config['allowed_types'] = '*'; //因為CI bug xls 無法正確讀取，所以只好開放萬用字元
        $config['max_size'] = '4096'; //4MB

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {
            $error = array('error' => $this->upload->display_errors());

            $this->load->view('templates/header');
            $this->load->view('dashboard/upload_form', $error);
            $this->load->view('templates/footer');
        } else {
            $data = array('upload_data' => $this->upload->data());

            $this->update_tracking($data['upload_data']);

            $this->load->view('templates/header');
            $this->load->view('dashboard/upload_success', $data);
            $this->load->view('templates/footer');
        }
    }

    function do_upload_invoice()
    {
        $config['upload_path'] = 'uploads/';

        $config['allowed_types'] = '*'; //因為CI bug xls 無法正確讀取，所以只好開放萬用字元
        $config['max_size'] = '4096'; //4MB

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {
            $error = array('error' => $this->upload->display_errors());

            $this->load->view('templates/header');
            $this->load->view('dashboard/upload_form', $error);
            $this->load->view('templates/footer');
        } else {
            $data = array('upload_data' => $this->upload->data());

            $this->update_invoice($data['upload_data']);

            $this->load->view('templates/header');
            $this->load->view('dashboard/upload_success', $data);
            $this->load->view('templates/footer');
        }
    }

    public function update_tracking($upload_data)
    {
        if ($upload_data['file_ext'] == '.csv') { //匯入黑貓出貨單追蹤碼用

            $file = fopen("uploads/" . $upload_data['file_name'], "r");

            $i = 0;
            while (!feof($file))
            {
                $row = fgetcsv($file);
                $order_id = intval(mb_convert_encoding($row[0], "UTF-8", "BIG5"));
                $order_tracking_number = mb_convert_encoding(str_replace("'","",$row[1]), "UTF-8", "BIG5");

                if(!is_numeric($order_id))continue;

                $order = $this->model_order->get_order((int)$order_id);

                if(!empty($order['order_member_id']) AND $order['order_status']!=2){
                    $this->model_task->set_task_order_shipped($order['order_member_id'],$order_id);
                }
                $this->model_order->update_order_tracking_number($order_id, $order_tracking_number);
                $i++;

            }
            fclose($file);

        } else if ($upload_data['file_ext'] == '.xls') //貨到付款對帳用
        {
            $this->load->library('PHPExcel/IOFactory');

            $reader = IOFactory::createReader('Excel5'); // 讀取舊版 excel 檔案

            $PHPExcel = $reader->load("uploads/" . $upload_data['file_name']); // 檔案名稱

            $sheet = $PHPExcel->getSheet(0); // 讀取第一個工作表(編號從 0 開始)

            $highestRow = $sheet->getHighestRow(); // 取得總列數

            for ($row = 4; $row <= $highestRow; $row++) //第4列以後才是資料列
            {
                $order_tracking_number = $sheet->getCellByColumnAndRow(6, $row)->getValue();
                $order_status_string = $sheet->getCellByColumnAndRow(9, $row)->getValue();
                if($order_status_string == '是'){
                    $order_status = -2; //退貨
                    $this->model_order->update_order_status($order_tracking_number, $order_status);
                }else{
                    $order_status = 2; //已收
                    $this->model_order->update_order_status($order_tracking_number, $order_status);
                }
            }
        }
    }

    public function update_invoice($upload_data)
    {
        if ($upload_data['file_ext'] == '.csv') { //匯入黑貓出貨單追蹤碼用

            $file = fopen("uploads/" . $upload_data['file_name'], "r");

            $i = 0;
            while (!feof($file))
            {
                $row = fgetcsv($file);

                $order_id = intval(mb_convert_encoding($row[0], "UTF-8", "BIG5"));
                $order_invoice_number = mb_convert_encoding(str_replace("'","",$row[1]), "UTF-8", "BIG5");

                if(!is_numeric($order_id))continue;

                $this->model_order->update_order_invoice_number($order_id, $order_invoice_number);
                $i++;
            }
            fclose($file);

        }
    }
}

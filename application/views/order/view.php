<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="<?=base_url()?>dashboard">Home 首頁</a></li>
        <li><a href="<?=base_url()?>order/page/20/1">Order 訂單</a></li>
        <li class="active">Update 更新</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Update Order <small>更新訂單</small></h1>
    <div class="email-btn-row hidden-xs">
        <a href="<?=base_url()?>order/page/20/1" class="btn btn-sm btn-inverse"><i class="fa fa-bars m-r-5"></i> List 列表</a>
    </div>
    <!-- end page-header -->

    <!-- begin row -->
    <div class="row">
        <!-- begin col-12 -->
        <div class="col-md-9">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                <div class="panel-heading">
                    <div class="panel-heading-btn"></div>
                    <h4 class="panel-title">表單</h4>
                </div>
                <div class="panel-body">
                    <?=validation_errors(); ?>
                    <?php $payment_array = array( 1=>'貨到付款', 2 => '轉帳付款', 3 =>'刷卡付款');?>
                    <?php $invoice_option_array = array( 1=> '發票捐贈', 2 => '開立電子發票', 3 =>'開立三聯式手動發票');?>


                    <form method="post" action="<?=base_url().'order/view/'.$order_item['order_id']?>" class="form-horizontal" enctype="multipart/form-data">
                        <div class="col-md-12">

                            <input name='order_service_id' value='<?echo $order_item['order_service_id'] ?>' readonly type='hidden'>
                            <input type="hidden" name="order_lose_money" id="order_lose_money">

                            <div class="form-group">
                                <label class="col-md-3 control-label">單號</label>
                                <div class="col-md-9">
                                    <input name='order_id' value='<?echo $order_item['order_id'] ?>' type='text' class='form-control' readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">內容</label>
                                <div class="col-md-9">
                                    <?php $total = 0; foreach ($order_item['order_cart'] as $order_cart): ?><?= $order_cart['cart_product_name'];?> (<?= $order_cart['cart_package_qty'];?>)<br><?php $total += $order_cart['cart_package_price']*$order_cart['cart_package_qty']; endforeach ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">帳號</label>
                                <div class="col-md-9">
                                    <input name='order_member_account' value='<?echo $order_item['order_member_account'] ?>' type='text' class='form-control' readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">姓名</label>
                                <div class="col-md-9">
                                    <input name='order_member_name' value='<?echo $order_item['order_member_name']?>' type='text' class='form-control' >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">地址</label>
                                <div class="col-md-9">
                                    <input name='order_member_address' value='<?echo $order_item['order_member_address']?>' type='text' class='form-control'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">電話</label>
                                <div class="col-md-9">
                                    <input name='order_member_phone' value='<?echo $order_item['order_member_phone']?>' type='text' class='form-control'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">狀態</label>
                                <div class="col-md-9">
                                    <?=$order_item['order_status_select']?>
                                </div>
                            </div>
                            <div class="form-group hidden">
                                <label class="col-md-3 control-label">追蹤碼</label>
                                <div class="col-md-9">
                                    <input type="text" name="order_tracking_number" value="<?php echo $order_item['order_tracking_number'];?>" class='form-control'/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">付款方式</label>
                                <div class="col-md-9">
                                    <?= $payment_array[$order_item['order_payment_option']];?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">轉帳帳號後5碼</label>
                                <div class="col-md-9">
                                    <input type="text" name="order_account_last_5" value="<?php echo $order_item['order_account_last_5'];?>" class='form-control'/>
                                </div>
                            </div>

                            <div class="form-group hidden">
                                <label class="col-md-3 control-label">發票選項</label>
                                <div class="col-md-9">

                                    <input class="form-control" value="<? if(isset($order_item['invoice_option']))echo $invoice_option_array[$order_item['invoice_option']]; else echo "捐贈"; ?>" type="text" disabled>
                                </div>
                            </div>
                            <div class="form-group hidden">
                                <label class="col-md-3 control-label">統一編號</label>
                                <div class="col-md-9">
                                    <input class="form-control" value="<?echo $order_item['invoice_tax_id'] ?>" type="text" disabled>
                                </div>
                            </div>
                            <div class="form-group hidden">
                                <label class="col-md-3 control-label">發票號碼</label>
                                <div class="col-md-9">
                                    <input type="text" name="order_invoice_number" value="<?php echo $order_item['order_invoice_number'];?>" class='form-control'/>
                                </div>
                            </div>
                            <div class="form-group hidden">
                                <label class="col-md-3 control-label">折扣代碼</label>
                                <div class="col-md-9">
                                    <input class="form-control" value="<?echo $order_item['order_coupon_code'] ?>" type="text" disabled>
                                </div>
                            </div>
                            <?php if($order_item['invoice_msg']!=""){ ?>
                            <div class="form-group hidden">
                                <label class="col-md-3 control-label">留言</label>
                                <div class="col-md-9">
                                    <?echo nl2br($order_item['invoice_msg']) ?>
                                </div>
                            </div>
                            <?php } ?>
                        </div>

                        <div class="col-md-12" style="text-align: right">
                            <a class='btn btn-sm btn-default' href="<?=base_url()?>member/page/20/1">返回</a> <button type="submit" class="btn btn-sm btn-success">Submit 送出</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- end panel -->
        </div>
        <!-- end col-12 -->
    </div>
    <!-- end row -->
</div>
<!-- end #content -->

<!-- begin scroll to top btn -->
<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
<!-- end scroll to top btn -->
</div>
<!-- end page container -->

<!-- ================== BEGIN BASE JS ================== -->
<script src="<?=base_url()?>assets/plugins/jquery/jquery-1.9.1.min.js"></script>
<script src="<?=base_url()?>assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
<script src="<?=base_url()?>assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
<script src="<?=base_url()?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<!--[if lt IE 9]>
<script src="<?=base_url()?>assets/crossbrowserjs/html5shiv.js"></script>
<script src="<?=base_url()?>assets/crossbrowserjs/respond.min.js"></script>
<script src="<?=base_url()?>assets/crossbrowserjs/excanvas.min.js"></script>
<![endif]-->
<script src="<?=base_url()?>assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?=base_url()?>assets/plugins/jquery-cookie/jquery.cookie.js"></script>
<!-- ================== END BASE JS ================== -->

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="<?=base_url()?>assets/js/apps.min.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->

<script>
    $(document).ready(function() {
        App.init();
    });
</script>
</body>
</html>
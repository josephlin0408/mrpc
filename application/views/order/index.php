<link href="<?=base_url()?>dist/css/bootstrap-switch.css" rel="stylesheet" >
<link href="<?=base_url()?>assets/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet">
<link href="<?=base_url()?>assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet">
<link href="<?=base_url()?>assets/plugins/ionRangeSlider/css/ion.rangeSlider.css" rel="stylesheet" />
<link href="<?=base_url()?>assets/plugins/ionRangeSlider/css/ion.rangeSlider.skinNice.css" rel="stylesheet" />

<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="javascript:;">Home 首頁</a></li>
        <li><a href="javascript:;">Order 訂單</a></li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Order Management <small>訂單管理</small></h1>
    <!-- end page-header -->

    <!-- begin row -->
    <div class="row">
        <!-- begin col-12 -->
        <div class="col-md-12 ui-sortable">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">搜尋</h4>
                </div>
                <div class="panel-body">

                        <?php echo validation_errors(); ?>
                        <?php $attributes = array( 'id' => 'search', 'class'=> 'form-horizontal');
                        echo form_open( base_url()."order/page/20/1", $attributes); ?>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-3 control-label">訂單編號</label>
                                <div class="col-md-9">
                                    <input type='text' value='<?php if(isset($order_search))echo $order_search['ID'] ?>' name='ID' class='search_input form-control'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">帳號後五碼</label>
                                <div class="col-md-9">
                                    <input type='text' value='<?php if(isset($order_search))echo $order_search['LAST_FIVE'] ?>' name='LAST_FIVE' class='search_input form-control'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">客戶姓名</label>
                                <div class="col-md-9">
                                    <input type='text' value='<?php if(isset($order_search))echo $order_search['FULLNAME'] ?>' name='FULLNAME' class='search_input form-control'></td>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">客戶地址</label>
                                <div class="col-md-9">
                                    <input type='text' value='<?php if(isset($order_search))echo $order_search['ADDRESS'] ?>' name='ADDRESS' class='search_input form-control'></td>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">客戶手機</label>
                                <div class="col-md-9">
                                    <input type='text' value='<?php if(isset($order_search))echo $order_search['PHONE'] ?>' name='PHONE' class='account_input search_input form-control'>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">電子信箱</label>
                                <div class="col-md-9">
                                    <input type='text' value='<?php if(isset($order_search))echo $order_search['ACCOUNT'] ?>' name='ACCOUNT' class='account_input search_input form-control'>
                                </div>
                            </div>
                    </div>
                    <div class="col-md-6">

                        <div class="form-group">
                            <label class="col-md-3 control-label">下訂起始日期</label>
                            <div class="col-md-9">
                                <input type='text' name='startDate' id='startDate' class='form-control search_input datepicker'
                                       value='<?php if(isset($order_search))echo $order_search['startDate'] ?>'>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">下訂結束日期</label>
                            <div class="col-md-9">
                                <input type='text' name='endDate' id='endDate' class='form-control search_input datepicker'
                                       value='<?php if(isset($order_search))echo $order_search['endDate'] ?>'>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">訂單狀態</label>
                            <div class="col-md-9">
                                <select name='STATUS' class='form-control STATUS'>
                                    <option value=''>請選擇狀態</option>
                                    <option value='0'  <?php if(isset($order_search)){ if($order_search['STATUS']==0 AND $order_search['STATUS']!='')echo "selected='selected'"; } ?>>未完成</option>
                                    <option value='1'  <?php if(isset($order_search)){ if($order_search['STATUS']==1)echo "selected='selected'"; } ?> >可出貨</option>
                                    <option value='2'  <?php if(isset($order_search)){ if($order_search['STATUS']==2)echo "selected='selected'"; } ?> >已出貨</option>
                                    <option value='-1'  <?php if(isset($order_search)){ if($order_search['STATUS']==-1)echo "selected='selected'"; } ?> >已退款</option>
                                    <option value='-2'  <?php if(isset($order_search)){ if($order_search['STATUS']==-2)echo "selected='selected'"; } ?> >已取消</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">付款選項</label>
                            <div class="col-md-9">
                                <select name='PAYMENT_OPTION' class='form-control'>
                                    <option value=''>請選擇</option>
                                    <option value='1'  <?php if(isset($order_search)){ if($order_search['PAYMENT_OPTION']==1)echo "selected='selected'"; } ?> >貨到付款</option>
                                    <option value='2'  <?php if(isset($order_search)){ if($order_search['PAYMENT_OPTION']==2)echo "selected='selected'"; } ?> >轉帳付款</option>
                                    <option value='3'  <?php if(isset($order_search)){ if($order_search['PAYMENT_OPTION']==3)echo "selected='selected'"; } ?> >線上刷卡</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">發票選項</label>
                            <div class="col-md-9">
                                <select name='INVOICE' class='form-control'>
                                    <option value=''>請選擇</option>
                                    <option value='2'  <?php if(isset($order_search)){ if($order_search['INVOICE']==2)echo "selected='selected'"; } ?> >電子發票</option>
                                    <option value='3'  <?php if(isset($order_search)){ if($order_search['INVOICE']==3)echo "selected='selected'"; } ?> >手開發票</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">是否已開出發票</label>
                            <div class="col-md-9">
                                <select name='INVOICE_STATUS' class='form-control STATUS'>
                                    <option value=''    <?php if(isset($order_search)){ if($order_search['INVOICE_STATUS']==0 )echo "selected='selected'"; } ?>>請選擇</option>
                                    <option value='1'  <?php if(isset($order_search)){ if($order_search['INVOICE_STATUS']==1 )echo "selected='selected'"; } ?>>否</option>
                                    <option value='2'  <?php if(isset($order_search)){ if($order_search['INVOICE_STATUS']==2 )echo "selected='selected'"; } ?> >是</option>
                                </select>
                            </div>
                        </div>

                    </div>
                        <div class="col-md-12" style="text-align: right">
                            <input type="hidden" name="RESET" value="0" id="reset">
                            <input type="reset" value="重置條件" class="btn btn-sm btn-success" onclick="$('#reset').val(1)">
                            <button type="submit" class="btn btn-sm btn-success">Search 搜尋</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- end panel -->
        </div>
    </div>
    <!-- end row -->
    <div class="row">
        <!-- begin col-12 -->
        <div class="col-md-12">

            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="table-basic-7">
                <div class="panel-heading">

                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">列表</h4>
                </div>
                <div class="panel-body">
                    <div style="margin:  0 10px;display: inline;"><input type="checkbox" id="checkbox-check-all"> 全選列出的訂單</div>
                    <button class="btn btn-success btn-sm" id="btn-export-all">匯出</button>
                    <button class="btn btn-success btn-sm" id="btn-manual-invoice-export">匯出三聯式發票</button>
                    <div class="table-responsive">
                        <?php
                        $range = 6;
                        if(isset($count_all_results)) {
                            $page_count = ceil($count_all_results / $recorder_per_page);
                            if (($current_page - $range) < 1) $for_start = 1; else $for_start = $current_page - $range++;
                            if (($current_page - $range) < 1) $more_start = 1; else $more_start = $current_page - $range;
                            if (($current_page + $range) > $page_count) $for_end = $page_count; else $for_end = $current_page + $range++;
                            if (($current_page + $range) > $page_count) $more_end = $page_count; else $more_end = $current_page + $range;
                        }
                        ?>
                        <ul class="pagination pagination-without-border pull-right m-t-0">
                            <li <?php if($current_page == 0) echo "class='disabled'";?>><a href="<?=base_url()."order/page/".$recorder_per_page."/".$more_start?>">«</a></li>
                            <?php
                            for($i = $for_start;$i <= $for_end; $i++){
                                if($i == ($current_page + 1)) {
                                    $selected = "class='active'";
                                } else {
                                    $selected = "";
                                }
                                echo "<li ".$selected." ><a href=".base_url()."order/page/".$recorder_per_page."/".$i.">".$i."</a></li>";
                            }
                            ?>
                            <li <?php if(($current_page+1) == $page_count) echo "class='disabled'";?>><a href="<?=base_url()."order/page/".$recorder_per_page."/".$more_end?>">»</a></li>
                        </ul>
                        <table class="table table-striped table-bordered table-hover" id="data_table">
                            <thead>
                            <tr>
                                <th>訂單編號 </th>
                                <th style="width: 120px">姓名/時間</th>
                                <th style="width: 140px">產品名稱/數量</th>
                                <th>總價</th>
                                <th>地址</th>
                                <th>付款方式</th>
                                <th style="width: 100px">帳號後五碼</th>
                                <th style="width: 50px">狀態</th>
                                <th style="width: 170px">功能</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $payment_array = array( 1=>'貨到付款', 2 => '轉帳付款', 3 =>'刷卡付款', 4 =>'WEB ATM付款', 5 =>'超商列印繳費' ,6 => '印條碼至超商繳費');
                            foreach ($order as $order_item): ?>
                                <tr class="odd gradeX">
                                    <td><input type="checkbox" name="export" value="<?= $order_item['order_id']; ?>" />
                                        <a class="btn btn-link" style="display: inline" href="<?= base_url();?>order/view/<?= $order_item['order_id']; ?>"><?= $order_item['order_id'] ?></a></td>
                                    <td>
                                        <span class="hint-bottom" data-hint="<?=$order_item['invoice_msg']?>">
                                            <?php if($order_item['order_shipping_option']%2==0)echo "<i class='fa fa-forward' style='color:green'></i> "?>
                                            <?= $order_item['order_member_name'] ?><?if($order_item['invoice_msg']!="")echo " <i class='fa fa-comment'></i>"?><br><?= $order_item['order_create_stamp'] ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php $total = 0; foreach ($order_item['order_cart'] as $order_cart): ?><?= $order_cart['cart_product_name'];?> x <?= $order_cart['cart_package_qty'];?><br><?php $total += $order_cart['cart_package_price']*$order_cart['cart_package_qty']; endforeach ?>
                                    </td>
                                    <td>
                                        <span class="hint--bottom" data-hint="<?php echo "運費：$".$order_item['order_shipping_fee']." + 手續費：$".$order_item['order_service_fee']." + 購物車：$".$order_item['order_cart_total']?>">$<?= $order_item['order_cart_total']+$order_item['order_shipping_fee']+$order_item['order_service_fee'] ?></span>
                                    </td>
                                    <td><?= $order_item['order_member_address'] ?></td>
                                    <td><?= $payment_array[$order_item['order_payment_option']];?></td>
                                    <td>
                                        <?php if($order_item['order_payment_option'] != 2) {
                                            echo "-";
                                        } else {
                                            echo $order_item['order_account_last_5'];
                                        } ?>
                                    </td>
                                    <td>
                                        <!--訂單狀態-->
                                        <div id="order_status_<?= $order_item['order_id'] ?>">
                                            <span style="display: none"><?php echo $order_item['order_status'] ?></span>
                                            <?php if($order_item['order_status'] == -2){
                                                echo "<span class='hint--bottom' data-hint='這筆訂單損失：".$order_item['order_lose_money']."元'>";
                                            }?><?php echo $order_item['STATUS_IMAGE'] ?>
                                        </div>
                                    </td>
                                    <!--                                            <td>--><?//= $order_item['order_tracking_number'] ?><!--</td>-->
                                    <!--                                            <td>--><?//= $order_item['order_notes'] ?><!--</td>-->
                                    <td>
                                        <?php $attributes = array('style' => 'display:inline');?>
                                        <?php echo form_open('order/change/status',$attributes);?>
                                        <input type="hidden" value="<?= $order_item['order_id']; ?>" name="order_id"/>
                                        <input type="hidden" value="INVENTORY_SHIPPED" name="email_status"/>
                                        <input type="hidden" value="INVENTORY_SHIPPED" name="order_status"/>
                                        <button type="submit" class="btn btn-sm btn-success <?php if($order_item['order_status'] != 1){echo 'hidden';};?>"><i class="fa fa-truck"></i></button>
                                        <!--                                                <input type="submit" value="已出貨"  class="btn btn-primary"/>-->
                                        </form>

                                        <a class="btn btn-sm btn-success" href="<?= base_url();?>order/view/<?= $order_item['order_id']; ?>"><i class="fa fa-wrench"></i></a>

                                        <?php echo form_open('order/change/status',$attributes);?>
                                        <input type="hidden" value="<?= $order_item['order_id']; ?>" name="order_id"/>
                                        <input type="hidden" value="ORDER_CANCEL" name="email_status"/>
                                        <input type="hidden" value="ORDER_CANCEL" name="order_status"/>
                                        <button type="submit" class="btn btn-sm btn-default <?php if($order_item['order_status'] == -2){echo 'hidden';};?>" onclick="return confirm('確定取消訂單嗎？')"><i class="fa fa-close"></i></button>
                                        <!--                                                <input type="submit" value="取消訂單" --><?php //if($order_item['order_status'] == -2){echo 'hidden';};?><!--/>-->
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                            <!--                                  --><?php //echo'<pre>';print_r($order);echo'<br></pre><hr>';?>
                            </tbody>
                        </table>
                        <?php
                        $range = 6;
                        if(isset($count_all_results)) {
                            $page_count = ceil($count_all_results / $recorder_per_page);
                            if (($current_page - $range) < 1) $for_start = 1; else $for_start = $current_page - $range++;
                            if (($current_page - $range) < 1) $more_start = 1; else $more_start = $current_page - $range;
                            if (($current_page + $range) > $page_count) $for_end = $page_count; else $for_end = $current_page + $range++;
                            if (($current_page + $range) > $page_count) $more_end = $page_count; else $more_end = $current_page + $range;
                        }
                        ?>
                        <ul class="pagination pagination-without-border pull-right m-t-0">
                            <li <?php if($current_page == 0) echo "class='disabled'";?>><a href="<?=base_url()."order/page/".$recorder_per_page."/".$more_start?>">«</a></li>
                            <?php
                            for($i = $for_start;$i <= $for_end; $i++){
                                if($i == ($current_page + 1)) {
                                    $selected = "class='active'";
                                } else {
                                    $selected = "";
                                }
                                echo "<li ".$selected." ><a href=".base_url()."order/page/".$recorder_per_page."/".$i.">".$i."</a></li>";
                            }
                            ?>
                            <li <?php if(($current_page+1) == $page_count) echo "class='disabled'";?>><a href="<?=base_url()."order/page/".$recorder_per_page."/".$more_end?>">»</a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-footer">
                    <div style="width: 100%;text-align: right">
                        每頁顯示
                        <select class="form-control" id="select_recorder_per_page" style="width: 70px;display: inline">
                            <option value="20" <?php if($recorder_per_page == 20)echo "selected"?>>20</option>
                            <option value="50" <?php if($recorder_per_page == 50)echo "selected"?>>50</option>
                            <option value="100" <?php if($recorder_per_page == 100)echo "selected"?>>100</option>
                            <option value="500" <?php if($recorder_per_page == 500)echo "selected"?>>500</option>
                            <option value="1000" <?php if($recorder_per_page == 1000)echo "selected"?>>1000</option>
                        </select>
                        筆資料
                    </div>
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
<script src="<?=base_url()?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?=base_url()?>assets/js/form-plugins.demo.js"></script>
<script src="<?=base_url()?>dist/js/bootstrap-switch.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->

<script>
    $(document).ready(function() {
        App.init();
        FormPlugins.init();
    });
</script>

<script>
    $(document).ready(function() {
        $("#btn-export-all").click(function() {
            var export_order_id = new Array();
            $('input[name="export"]:checkbox:checked').each(function(i) {
                export_order_id[i] = this.value;
            });
            if(export_order_id.length > 0){
                if(export_order_id.length < 1600){
                    var URLs = "<?=base_url()?>order/checkbox/all?data="+export_order_id.toString();
                    window.open(URLs);
                }else{
                    alert("需要大量匯出嗎？請呼叫 Falcon替您服務 lol");
                }
            }else{
                alert("請至少選取一筆訂單");
            }
        });

        $("#btn-export").click(function() {
            var export_order_id = new Array();
            $('input[name="export"]:checkbox:checked').each(function(i) {
                export_order_id[i] = this.value;
            });
            if(export_order_id.length > 0){
                if(export_order_id.length < 1600){
                    var URLs = "<?=base_url()?>order/checkbox/export?data="+export_order_id.toString();
                    window.open(URLs);
                }else{
                    alert("需要大量匯出嗎？請呼叫 Falcon替您服務 lol");
                }

            }else{
                alert("請至少選取一筆訂單");
            }
        });

        $("#btn-manual-invoice-export").click(function() {
            var export_order_id = new Array();
            $('input[name="export"]:checkbox:checked').each(function(i) {
                export_order_id[i] = this.value;
            });

            if(export_order_id.length > 0){

                if(export_order_id.length < 1600){
                    var URLs = "<?=base_url()?>order/checkbox/manual/invoice/export?data="+export_order_id.toString();
                    window.open(URLs);
                }else{
                    alert("需要大量匯出嗎？請呼叫 Falcon替您服務 lol");
                }

            }else{
                alert("請至少選取一筆訂單");
            }
        });

        $("#checkbox-check-all").click(function() {
            if($(this).is(':checked')){
                $('input[name="export"]:checkbox').prop("checked", "checked");
            }else{
                $('input[name="export"]:checkbox').removeAttr("checked");
            }
        });

        $('#reset').click(function() {
            $( '.search_input' ).attr("value",'');
        });

        $('#btn-search-function').click(function() {
            $("#panel-search").toggle();
        });

        $("#select_recorder_per_page").change(function(){
            window.location.href = "<?=base_url()?>order/page/"+$(this).val()+"/1";
        });
        $("#select_page").change(function(){
            window.location.href = "<?=base_url()?>order/page/"+$("#select_recorder_per_page").val()+"/"+$(this).val();
        });

        $("[name='order_paid']").bootstrapSwitch();

        $("input[name='order_paid']").on('switchChange.bootstrapSwitch', function(event, state) {
            var order_id = $(this).attr("id");
            var URLs="/admin/order/payment/status/"+$(this).attr("id")+"/"+state+"/"+$(this).attr("member_id");
            $.ajax({
                url: URLs,
                dataType:'text',
                success: function(msg){
                    if(msg == 1){
                        $('#order_status_'+order_id).html("<div class='j_alert alert-success'>可出貨</div>");
                    }else{
                        $('#order_status_'+order_id).html("<div class='j_alert alert-info'>已下單</div>");
                    }
                },
                error:function(xhr, ajaxOptions, thrownError){
                    console.log(xhr.status);
                    console.log(thrownError);
                    alert('噢不，電腦可能有一點小感冒，我們正在盡全力搶修中...');
                }
            });
        });

    });

    $("#select_recorder_per_page").change(function(){
        window.location.href = "<?=base_url()?>order/page/"+$(this).val()+"/1";
    });
    $("#select_page").change(function(){
        window.location.href = "<?=base_url()?>order/page/"+$("#select_recorder_per_page").val()+"/"+$(this).val();
    });

    $("[name='order_paid']").bootstrapSwitch();

    $("input[name='order_paid']").on('switchChange.bootstrapSwitch', function(event, state) {
        var order_id = $(this).attr("id");
        var URLs="/admin/order/payment/status/"+$(this).attr("id")+"/"+state+"/"+$(this).attr("member_id");
        $.ajax({
            url: URLs,
            dataType:'text',
            success: function(msg){
                if(msg == 1){
                    $('#order_status_'+order_id).html("<div class='j_alert alert-success'>可出貨</div>");
                }else{
                    $('#order_status_'+order_id).html("<div class='j_alert alert-info'>已下單</div>");
                }
            },
            error:function(xhr, ajaxOptions, thrownError){
                console.log(xhr.status);
                console.log(thrownError);
                alert('噢不，電腦可能有一點小感冒，我們正在盡全力搶修中...');
            }
        });
    });


</script>

</body>
</html>
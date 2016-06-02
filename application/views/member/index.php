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
        <li class="active">Member 會員</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Member Management <small>會員管理</small></h1>
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
                    echo form_open( base_url()."member/page/20/1", $attributes); ?>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-3 control-label">姓名</label>
                            <div class="col-md-9">
                                <input type='text' value='<?php if(isset($member_search))echo $member_search['fullname'] ?>' name='fullname' class='search_input form-control'></td>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">手機</label>
                            <div class="col-md-9">
                                <input type='text' value='<?php if(isset($member_search))echo $member_search['cellphone'] ?>' name='cellphone' class='account_input search_input form-control'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">會員等級</label>
                            <div class="col-md-9">
                                <select name="member_level" class='account_input search_input form-control'>
                                    <option value="all">全部</option>
                                    <option value="1" <?php if($member_search['member_level'] === '1')echo 'selected';?>>會員</option>
                                    <option value="0" <?php if($member_search['member_level'] === '0')echo 'selected';?>>準會員</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-3 control-label">電子信箱</label>
                            <div class="col-md-9">
                                <input type='text' value='<?php if(isset($member_search))echo $member_search['account'] ?>' name='account' class='account_input search_input form-control'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">地址</label>
                            <div class="col-md-9">
                                <input type='text' value='<?php if(isset($member_search))echo $member_search['address'] ?>' name='address' class='search_input form-control'></td>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" style="text-align: right">
                        <input type="button" class='btn btn-defualt btn-sm' value='重置條件' id="reset"> <button type="submit" class="btn btn-sm btn-success">Search 搜尋</button>
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
                <?php if(!empty($member)):;?>
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
                            <li <?php if($current_page == 0) echo "class='disabled'";?>><a href="<?=base_url()."member/page/".$recorder_per_page."/".$more_start?>">«</a></li>
                            <?php
                            for($i = $for_start;$i <= $for_end; $i++){
                                if($i == ($current_page + 1)) {
                                    $selected = "class='active'";
                                } else {
                                    $selected = "";
                                }
                                echo "<li ".$selected." ><a href=".base_url()."member/page/".$recorder_per_page."/".$i.">".$i."</a></li>";
                            }
                            ?>
                            <li <?php if(($current_page+1) == $page_count) echo "class='disabled'";?>><a href="<?=base_url()."member/page/".$recorder_per_page."/".$more_end?>">»</a></li>
                        </ul>
                        <table class="table table-striped table-bordered table-hover" id="data_table">
                            <thead>
                            <tr>
                                <th>帳號</th>
                                <th>姓名</th>
                                <th>手機</th>
                                <th>地址</th>
                                <th>加入日期</th>
                                <th>功能</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($member as $member_item): ?>

                                <tr class="odd gradeX">
                                    <td><?php echo $member_item['member_account']; ?></td>
                                    <td><?php echo $member_item['member_name'] ?></td>
                                    <td><?php echo $member_item['member_phone'] ?></td>
                                    <td><?php echo $member_item['member_address'] ?></td>
                                    <td><?php echo $member_item['member_create_stamp'] ?></td>
                                    <td><a class="btn btn-success btn-sm"
                                           href="<?php echo base_url();?>member/view/<?php echo $member_item['member_id'] ?>">編輯</a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
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
                            <li <?php if($current_page == 0) echo "class='disabled'";?>><a href="<?=base_url()."member/page/".$recorder_per_page."/".$more_start?>">«</a></li>
                            <?php
                            for($i = $for_start;$i <= $for_end; $i++){
                                if($i == ($current_page + 1)) {
                                    $selected = "class='active'";
                                } else {
                                    $selected = "";
                                }
                                echo "<li ".$selected." ><a href=".base_url()."member/page/".$recorder_per_page."/".$i.">".$i."</a></li>";
                            }
                            ?>
                            <li <?php if(($current_page+1) == $page_count) echo "class='disabled'";?>><a href="<?=base_url()."member/page/".$recorder_per_page."/".$more_end?>">»</a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-footer">
                    <input type="checkbox" id="checkbox-check-all"> 全選
                    <button class="btn btn-success btn-sm " id="btn-export-all" style="margin-left: 10px" disabled>匯出</button>
                    <div class="pull-right">
                        每頁顯示
                        <select class="form-control " id="select_recorder_per_page" style="width: 70px;display: inline">
                            <option value="20" <?php if($recorder_per_page == 20)echo "selected"?>>20</option>
                            <option value="50" <?php if($recorder_per_page == 50)echo "selected"?>>50</option>
                            <option value="100" <?php if($recorder_per_page == 100)echo "selected"?>>100</option>
                            <option value="500" <?php if($recorder_per_page == 500)echo "selected"?>>500</option>
                            <option value="1000" <?php if($recorder_per_page == 1000)echo "selected"?>>1000</option>
                        </select>
                        筆資料
                    </div>
                </div>
                <?php endif;if(empty($member))echo '<b>系統提示：查無資料！</b>';?>
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

        $('#reset').click(function() {
            $( '.search_input' ).attr("value",'');
        });


        $("#select_recorder_per_page").change(function(){
            window.location.href = "<?=base_url()?>member/page/"+$(this).val()+"/1";
        });
        $("#select_page").change(function(){
            window.location.href = "<?=base_url()?>member/page/"+$("#select_recorder_per_page").val()+"/"+$(this).val();
        });


    });

    $("#select_recorder_per_page").change(function(){
        window.location.href = "<?=base_url()?>member/page/"+$(this).val()+"/1";
    });
    $("#select_page").change(function(){
        window.location.href = "<?=base_url()?>member/page/"+$("#select_recorder_per_page").val()+"/"+$(this).val();
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
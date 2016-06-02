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
        <li class="active">廣告商管理</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header" style="display: inline">Advertiser Management <small>廣告商管理  </small></h1>
    <button type="button" data-toggle="modal" data-target="#edit_Modal"class="btn btn-success"><i class="fa fa-plus m-r-5"></i>新增廣告商</button>
    <!-- end page-header -->
<?php if(FALSE):?>
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
<?php endif;?>
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
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="data_table">
                            <thead>
                            <tr>
                                <th>帳號</th>
                                <th>名稱</th>
                                <th>電話</th>
                                <th>停權狀態</th>
                                <th class="hidden">功能</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($company_user as $member_item):?>
                                <tr class="odd gradeX">
                                    <td><?php echo $member_item['user_account'];?></td>
                                    <td><?php echo $member_item['user_name'];?></td>
                                    <td><?php echo $member_item['user_phone'];?></td>
                                    <td><?php echo $member_item['user_status'];?></td>
                                </tr>
                            <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="panel-footer"></div>
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
<!-- Modal -->
<div class="modal fade" id="edit_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">廣告商新增</h4>
            </div>
            <div class="modal-body">
                <?php $attr = array('class'=>'form-horizontal','role'=>'form');?>
                <?php echo form_open('advertiser/add/20/1',$attr);?>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">帳號</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" placeholder="請填寫您的電子信箱" name="user_account" >
                            <p>注意：若電子信箱重複申請是不會通過的喔！</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">名稱</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="請填寫您的大名或暱稱" name="user_name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">電話</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" placeholder="" name="user_phone">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">停權狀態</label>
                        <div class="col-sm-10">
                            <select name="user_status" id="" class="form-control">
                                <option value="">正常</option>
                                <option value="">停權</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">送出</button>
                        </div>
                    </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>
<!-- Modal END-->

</body>
</html>


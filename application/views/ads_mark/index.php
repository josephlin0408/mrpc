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
        <li class="active">廣告管理與分析</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header" style="display: inline">Ads Mark<small>  廣告管理與分析  </small></h1>
    <?php if($add_btn_switch):;?>
    <button type="button" data-toggle="modal" data-target="#edit_Modal"class="btn btn-success"><i class="fa fa-plus m-r-5"></i>新增廣告標記</button>
    <?php endif;?>
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
                    <?php $attributes = array( 'id' => 'search', 'class'=> 'form-horizontal');?>
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
                                <th>編號</th>
                                <th>商品類型</th>
                                <th>買家名稱(帳號)</th>
                                <th>文章主題</th>
                                <th>購買期間</th>
                                <th>廣告狀態</th>
                                <th>期間點擊次數</th>
                                <th>功能</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(empty($ads_mark)):;?>
                                <tr>
                                    <td colspan="8">尚無資料</td>
                                </tr>
                            <?php endif;?>
                            <?php $counter = 1;foreach ($ads_mark as $item):?>
                                <tr class="odd gradeX">
                                    <td><?php echo $counter;?></td>
                                    <td><?php echo $ads_mark_type_name[$item['ads_mark_type']];?></td>
                                    <td><?php echo $advertiser_name[$item['ads_mark_buyer']];?></td>
                                    <td><?php echo $article_name[$item['ads_mark_article_id']];?></td>
                                    <td><?php echo $item['ads_mark_period_start'].' 至 '.$item['ads_mark_period_end'];?></td>
                                    <td><?php echo $ads_mark_status_name[$item['ads_mark_status']];?></td>
                                    <td><?php echo $item['ads_mark_popularity'];?></td>
                                    <td><a class="btn btn-success btn-sm"
                                           href="<?php echo base_url('ads-mark/delete/'.$item['ads_mark_id']);?>">刪除</a>
                                    </td>
                                </tr>
                            <?php $counter++;endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="panel-footer"></div>
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
                <?php echo form_open('ads-mark/add/20/1',$attr);?>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">商品類型</label>
                        <div class="col-sm-10">
                            <select name="ads_mark_type" id="" class="form-control">
                                <option value="0"><?php echo $ads_mark_type_name[0];?></option>
                                <option value="1"><?php echo $ads_mark_type_name[1];?></option>
                                <option value="2"><?php echo $ads_mark_type_name[2];?></option>
                                <option value="3"><?php echo $ads_mark_type_name[3];?></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">帳號選擇</label>
                        <div class="col-sm-10">
                            <select name="ads_mark_buyer" class="form-control" required="required">
                                <?php foreach($advertiser as $unit):;?>
                                <option value="<?php echo $unit['user_account'];?>"><?php echo $unit['user_name'].'  ('.$unit['user_account'].')';?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">文章選擇</label>
                        <div class="col-sm-10">
                            <select name="ads_mark_article_id" class="form-control" required="required">
                                <?php foreach($article as $unit):;?>
                                    <option value="<?php echo $unit['article_hash_id'];?>"><?php echo $unit['article_title'];?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">起始時間</label>
                        <div class="col-sm-10">
                            <div class="col-sm-10">
                                <input type="datetime-local" class="form-control"  name="ads_mark_period_start" required="required">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">結束時間</label>
                        <div class="col-sm-10">
                            <div class="col-sm-10">
                                <input type="datetime-local" class="form-control"  name="ads_mark_period_end" required="required">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">廣告狀態</label>
                        <div class="col-sm-10">
                            <select name="ads_mark_status" id="" class="form-control">
                                <option value="">正常</option>
                                <option value="">停止</option>
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


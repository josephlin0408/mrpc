<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="active">類別管理</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Payment Method Management <small>支付方法管理</small></h1>
    <!-- end page-header -->

    <!-- begin row -->
    <div class="row">
        <!-- begin col-12 -->
        <div class="col-md-12 ui-sortable">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="table-basic-7">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">支付方式列表</h4>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <tr>
                                <th style="width:25%">名稱</th>
                                <th style="width:25%">手續費</th>
                                <th style="width:25%">狀態</th>
                                <th style="width:25%">功能</th>
                            </tr>
                            <?php $index=0;foreach($payment_method_list as $unit):;?>
                            <tr>
                                <th>
                                    <?php echo $unit['pm_name'];?>
                                </th>
                                <th>
                                    <b id="pm_fee_amount<?=$index;?>"><?php echo $unit['pm_fee'];?></b>
                                    <input type="text" value="<?php echo $unit['pm_fee'];?>" id="pm_fee_update<?=$index;?>" class="form-control" required="required" style="width: 80px;display: none;" >
                                    <input type="submit" value="確認編輯" id="pm_fee_submit<?=$index;?>" class="btn btn-success btn-sm" style="display: none;"/>
                                </th>
                                <th id="pm_status<?=$index;?>">
                                    <?php  switch($unit['pm_status']){
                                        case(0):
                                            echo '啟用';
                                            break;
                                        case(1):
                                            echo '停用';
                                            break;
                                        case(2):
                                            echo '暫停使用';
                                            break;
                                    };?>
                                </th>
                                <th>
                                    <input type="submit" value="變更手續費" id="switch_edit_bar<?=$index;?>" class="btn btn-success btn-sm"/>
                                    <input type="submit" value="切換狀態" id="switch_fee_status<?=$index;?>" class="btn btn-success btn-sm"/>
                                    <i id="pm_status_id<?=$index;?>" hidden="hidden"><?=$unit['pm_status'];?></i>
                                    <script>
                                        var switchFee<?=$index;?> = true;
                                        $('#switch_edit_bar<?=$index;?>').on('click',function(){
                                            if(switchFee<?=$index;?>){
                                                $('#pm_fee_update<?=$index;?>').css('display','inline');
                                                $('#pm_fee_submit<?=$index;?>').css('display','inline');
                                                $('#pm_fee_amount<?=$index;?>').css('display','none');
                                                switchFee<?=$index;?> = false;
                                            }else{
                                                $('#pm_fee_update<?=$index;?>').css('display','none');
                                                $('#pm_fee_submit<?=$index;?>').css('display','none');
                                                $('#pm_fee_amount<?=$index;?>').css('display','inline');
                                                switchFee<?=$index;?> = true;
                                            }
                                        });
                                        $( "#pm_fee_submit<?=$index;?>" ).on('click',function() {
                                            var URLs="<?php echo base_url();?>payment/method/fee/update";
                                            $.ajax({
                                                url: URLs,
                                                data: "pm_id=<?=$unit['pm_id'];?> & pm_fee="+$('#pm_fee_update<?=$index;?>').val(),
                                                type:"POST",
                                                dataType:'text',

                                                success: function(msg){
//                                                    console.log(msg);
                                                    var fee = $('#pm_fee_update<?=$index;?>').val();
                                                    $('#pm_fee_amount<?=$index;?>').html(fee);
                                                    $('#pm_fee_update<?=$index;?>').css('display','none');
                                                    $('#pm_fee_submit<?=$index;?>').css('display','none');
                                                    $('#pm_fee_amount<?=$index;?>').css('display','inline');
                                                    switchFee<?=$index;?> = true;
                                                },
                                                error:function(xhr, ajaxOptions, thrownError){
                                                    console.log(xhr.status);
                                                    console.log(thrownError);
                                                }
                                            });
                                        });
                                        $( "#switch_fee_status<?=$index;?>" ).on('click',function() {
                                            var URLs="<?php echo base_url();?>payment/method/status/update";
                                            $.ajax({
                                                url: URLs,
                                                data: "pm_id=<?=$unit['pm_id'];?> & pm_status="+$('#pm_status_id<?=$index;?>').html(),
                                                type:"POST",
                                                dataType:'text',

                                                success: function(msg){
                                                    console.log(msg);
                                                    switch(msg){
                                                        case('0'):
                                                            $('#pm_status<?=$index;?>').html('啟用');
                                                            $('#pm_status_id<?=$index;?>').val(0).html('0');
                                                            break;
                                                        case('1'):
                                                            $('#pm_status<?=$index;?>').html('停用');
                                                            $('#pm_status_id<?=$index;?>').val(1).html('1');
                                                            break;
                                                        case('2'):
                                                            $('#pm_status<?=$index;?>').html('暫停使用');
                                                            $('#pm_status_id<?=$index;?>').val(2).html('2');
                                                            break;
                                                        default:
                                                            $('#pm_status<?=$index;?>').html('停用');
                                                            $('#pm_status_id<?=$index;?>').val(1).html('1-default');
                                                    }
                                                },
                                                error:function(xhr, ajaxOptions, thrownError){
                                                    console.log(xhr.status);
                                                    console.log(thrownError);
                                                }
                                            });
                                        });
                                    </script>
                                </th>
                            </tr>
                            <?php $index++;endforeach;?>
                        </table>
                    </div>
                </div><!-- end panel -->
            </div><!-- end col-12 -->
        </div><!-- end row -->
    </div><!-- end #content -->

<!-- begin scroll to top btn -->
<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
<!-- end scroll to top btn -->
</div><!-- end page container -->

<?php $this->load->view('templates/footer_color');?>

</body>
</html>
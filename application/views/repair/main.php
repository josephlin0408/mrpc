<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="javascript:;">Home 首頁</a></li>
        <li class="active">Repair Management 報修管理</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Repair Management <small>報修管理</small></h1>
    <div class="email-btn-row hidden-xs">
        <a href="<?=base_url()?>repair/create" class='btn btn-inverse btn-sm'><i class="fa fa-plus"></i> 新增</a>
    </div>
    <!-- end page-header -->
    <!-- end row -->
    <div class="row">
        <!-- begin col-12 -->
        <div class="col-md-12">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="table-basic-7" style="background-color:#d9e0e7">
                <link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/style.css"/>
                    <div class="panel-body" style="background-color:#fff;margin-bottom: 20px;">
                        <div class="row">
                            <div class="col-lg-12">
                                <table class="table table-bordered table-condensed"
                                       style="background-color:#FFFFFF;">
                                    <tr>
                                        <th colspan="11">課程類別：</th>
                                    </tr>
                                    <tr>
                                        <th>產品名稱</th>
                                        <th>產品擁有人</th>
                                        <th>產品擁有人電話資訊</th>
                                        <th>報單日期</th>
                                        <th>分店資訊</th>
                                        <th>分店填單人資訊</th>
                                        <th>報修狀態</th>
                                        <th>維護</th>
                                    </tr>
                                    <?php foreach($repair as $content_unit):;?>
                                    <tr>
                                        <td><?php echo $content_unit['repair_product_name'];?></td>
                                        <td><?php echo $content_unit['repair_product_owner'];?></td>
                                        <td><?php echo $content_unit['repair_product_owner_phone_number'];?></td>
                                        <td><?php echo $content_unit['repair_date'];?></td>
                                        <td><?php echo $content_unit['repair_store_data'];?></td>
                                        <td><?php echo $content_unit['repair_store_staff_data'];?></td>
                                        <td><?php switch($content_unit['repair_status']){
                                                case(0):
                                                    echo '立單';
                                                    break;
                                                case(1):
                                                    echo '已送修';
                                                    break;
                                                case(2):
                                                    echo '已回收';
                                                    break;
                                                case(3):
                                                    echo '已交還';
                                                    break;
                                            };?>
                                        </td>
                                        <td>
                                            <a href="<?php echo base_url('repair/update').'/'.$content_unit['repair_id'];?>" class="btn btn-success btn-sm pull-right"><i class="fa fa-edit"></i> 查看/編輯</a>
                                            <a href="<?php echo base_url('repair/delete').'/'.$content_unit['repair_id'];?>" class="btn btn-success btn-sm pull-right"><i class="fa fa-edit"></i> 刪除</a>
                                        </td>
                                    </tr>
                                <?php endforeach;?>
                                </table>
                            </div>
                        </div>
                    </div>
                <!-- end panel -->
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
            $("iframe").each(function() {
                $(this).css("width","100%");
            });
        });
    </script>
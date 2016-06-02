<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="javascript:;">Home 首頁</a></li>
        <li class="active">Lesson Management 課程設定</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Lesson Management <small>課程設定</small></h1>
    <div class="email-btn-row hidden-xs">
        <a href="<?=base_url()?>lesson/create" class='btn btn-inverse btn-sm'><i class="fa fa-plus"></i> 新增</a>
    </div>
    <!-- end page-header -->
    <!-- end row -->
    <div class="row">
        <!-- begin col-12 -->
        <div class="col-md-12">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="table-basic-7" style="background-color:#d9e0e7">
<!--                --><?php //print_r($lesson);?>
                <link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/style.css"/>
                <?php if(isset($lesson_category)){ foreach ($lesson_category as $unit): ?>
                    <div class="panel-body" style="background-color:#fff;margin-bottom: 20px;<?php if(empty($unit['category_content']))echo 'display: none';?>;">
                        <div class="row">
                            <div class="col-lg-12">
                                <table class="table table-bordered table-condensed"
                                       style="background-color:#FFFFFF;">
                                    <tr>
                                        <th colspan="11">課程類別：<?php echo $unit['lesson_category_name'];?></th>
                                    </tr>
                                    <tr>
                                        <th>主題</th>
                                        <th>縮圖</th>
                                        <th>報名期間</th>
                                        <th>報名人數限制</th>
                                        <th>當前報名人數</th>
                                        <th>開放狀態</th>
                                        <th>顯示狀態</th>
                                        <th>標價</th>
                                        <th>免費狀態</th>
                                        <th>維護</th>
                                    </tr>
                                    <?php foreach($unit['category_content'] as $content_unit):;?>
                                    <tr>
                                        <td><?php echo $content_unit['lesson_title'];?></td>
                                        <td>
                                            <img src="<?php echo base_url().'uploads/'.$content_unit['lesson_source'];?>" alt="" class="img_size"/>
                                        </td>
                                        <td><?php echo $content_unit['lesson_booking_start_time'].'<br>至<br>'.$content_unit['lesson_booking_end_time'];?></td>
                                        <td><?php echo $content_unit['lesson_booking_number_limit'];?></td>
                                        <td><?php echo $content_unit['lesson_booking_number_now'];?></td>
                                        <td><?php switch($content_unit['lesson_open_status']){
                                                case(0):
                                                    echo '所有人皆可參加';
                                                    break;
                                                case(1):
                                                    echo '僅會員可以參加';
                                                    break;
                                            };?>
                                        </td>
                                        <td><?php switch($content_unit['lesson_status']){
                                                case(0):
                                                    echo '顯示';
                                                    break;
                                                case(1):
                                                    echo '不顯示';
                                                    break;
                                            };?>
                                        </td>
                                        <td><?php echo '$'.number_format($content_unit['lesson_tag_price']);?></td>
                                        <td><?php switch($content_unit['lesson_sell_status']){
                                                case(0):
                                                    echo '免費';
                                                    break;
                                                case(1):
                                                    echo '收費';
                                                    break;
                                            };?>
                                        </td>
                                        <td>
                                            <a href="<?php echo base_url('lesson/update').'/'.$content_unit['lesson_id'];?>" class="btn btn-success btn-sm pull-right"><i class="fa fa-edit"></i> 編輯內容 </a>
                                        </td>
                                    </tr>
                                <?php endforeach;?>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php  endforeach; } ?>
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
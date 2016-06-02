<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="javascript:;">Home 首頁</a></li>
        <li class="active">Article 文章</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Article Management <small>文章管理</small></h1>
    <div class="email-btn-row hidden-xs">
        <a href="<?=base_url()?>article/create" class='btn btn-inverse btn-sm'><i class="fa fa-plus"></i> 新增</a>
    </div>
    <!-- end page-header -->
    <!-- end row -->
    <div class="row">
        <!-- begin col-12 -->
        <div class="col-md-12">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="table-basic-7" style="background-color:#d9e0e7">
                    <?php if(isset($article)){ foreach ($article as $unit): ?>
                    <div class="panel-body" style="background-color:#fff;margin-bottom: 20px">
                        <div class="row">
                            <div class="col-lg-12">
                                <a href='<?php echo front_url_address();?>/tw/article/<?=$unit['article_hash_id'];?>' target='_blank'><span style="font-size: 15px"><?= $unit['article_title'] ?></span></a>
                                <a href="<?php echo base_url(); ?>article/more/<?=$unit['article_hash_id'] ?>" class="btn btn-success btn-sm pull-right"><i class="fa fa-edit"></i> 延伸閱讀 </a>
                                <a href="<?php echo base_url(); ?>article/update/<?=$unit['article_hash_id'] ?>" class="btn btn-success btn-sm pull-right"><i class="fa fa-edit"></i> 編輯文章 </a>
                                <a href="<?php echo base_url(); ?>article/banner/<?=$unit['article_hash_id'] ?>" class="btn btn-success btn-sm pull-right"><i class="fa fa-edit"></i> 編輯橫幅 </a>
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
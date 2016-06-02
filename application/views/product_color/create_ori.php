<!-- begin #content -->
<link href="<?php echo base_url(); ?>dist/colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">

<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="<?=base_url()?>dashboard">Home 首頁</a></li>
        <li><a href="<?=base_url()?>product/item/list/20/1">Product 產品</a></li>
        <li><a href="<?=base_url()?>product/item/update/<?=$product_idx?>">Update 產品</a></li>
        <li><a href="<?=base_url()?>product/color/list/<?=$product_idx?>">Color 顏色</a></li>
        <li class="active">Create 新增</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Create Product Color <small>新增產品顏色</small></h1>
    <div class="email-btn-row hidden-xs">
        <a href="<?=base_url()?>product/color/list/<?=$product_idx?>" class="btn btn-sm btn-inverse"><i class="fa fa-bars m-r-5"></i> List 列表</a>
    </div>
    <!-- end page-header -->

    <!-- begin row -->
    <div class="row">
        <!-- begin col-12 -->
        <div class="col-md-6">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="form-stuff-1" enctype="multipart/form-data">
                <div class="panel-heading">
                    <div class="panel-heading-btn"></div>
                    <h4 class="panel-title">新增</h4>
                </div>
                <div class="panel-body">
                    <form method="post" action="" class="form-horizontal">
                        <input type="hidden" name="idx" value="<?=$color_idx?>">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-md-3 control-label">顏色名稱</label>
                                <div class="col-md-9">
                                    <input type="text" value="<?=isset($name) ? $name : "" ?>" name="name" class="search_input form-control" required autofocus>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">色碼</label>
                                <div class="col-md-9">
                                    <input type="text" value="<?=isset($code) ? $code : "#ff0000" ?>" name="code" class="search_input form-control code" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">庫存</label>
                                <div class="col-md-9">
                                    <input type="text" value="<?=isset($instock) ? $instock : "0" ?>" name="instock" class="search_input form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">排序</label>
                                <div class="col-md-9">
                                    <input type="text" value="0" name="priority" class="search_input form-control" required>
                                </div>
                            </div>
                            <div class="form-group">

                                <label class="col-md-3 control-label">圖片</label>
                                <div class="col-md-9">
                                    <input type="file" name="userfile" >
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" style="text-align: right">
                            <button type="submit" class="btn btn-sm btn-success">Submit 送出</button>
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

<!-- Colorpicker JavaScript -->
<script src="<?php echo base_url(); ?>dist/colorpicker/js/bootstrap-colorpicker.min.js"></script>

<script>
    $(document).ready(function() {
        App.init();
        $('.code').colorpicker();
    });
</script>
</body>
</html>
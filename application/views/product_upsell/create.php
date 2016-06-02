<!-- begin #content -->
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" />

<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="<?=base_url()?>dashboard">Home 首頁</a></li>
        <li><a href="<?=base_url()?>product/item/list/20/1">Product 產品</a></li>
        <li><a href="<?=base_url()?>product/item/update/<?=$product_idx?>">Update 產品</a></li>
        <li><a href="<?=base_url()?>product/upsell/list/<?=$product_idx?>">Upsell 加購</a></li>
        <li class="active">Create 新增</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Create Product Upsell <small>新增產品加購</small></h1>
    <div class="email-btn-row hidden-xs">
        <a href="<?=base_url()?>product/upsell/list/<?=$product_idx?>" class="btn btn-sm btn-inverse"><i class="fa fa-bars m-r-5"></i> List 列表</a>
    </div>
    <!-- end page-header -->

    <!-- begin row -->
    <div class="row">
        <!-- begin col-12 -->
        <div class="col-md-6">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                <div class="panel-heading">
                    <div class="panel-heading-btn"></div>
                    <h4 class="panel-title">表單</h4>
                </div>
                <div class="panel-body">
                    <form method="post" action="" class="form-horizontal" enctype="multipart/form-data">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-md-3 control-label">產品名稱</label>
                                <div class="col-md-9">
                                    <input type="text" value="<?=isset($name) ? $name : "" ?>" name="name" class="auto form-control" required autofocus>
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

<script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>

<script>
    $(document).ready(function() {
        App.init();
        $(".auto").autocomplete({
            source: "<?=base_url()?>product/upsell/query",
            minLength: 1
        });
    });
</script>
</body>
</html>
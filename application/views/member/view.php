<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="<?=base_url()?>dashboard">Home 首頁</a></li>
        <li><a href="<?=base_url()?>member/page/20/1">Member 會員</a></li>
        <li class="active">Update 更新</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Update Member <small>更新訂單</small></h1>
    <div class="email-btn-row hidden-xs">
        <a href="<?=base_url()?>member/page/20/1" class="btn btn-sm btn-inverse"><i class="fa fa-bars m-r-5"></i> List 列表</a>
    </div>
    <!-- end page-header -->

    <!-- begin row -->
    <div class="row">
        <!-- begin col-12 -->
        <div class="col-md-9">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                <div class="panel-heading">
                    <div class="panel-heading-btn"></div>
                    <h4 class="panel-title">表單</h4>
                </div>
                <div class="panel-body">
                    <?=validation_errors(); ?>
                    <form method="post" action="<?=base_url().'member/view/'.$member_item['member_id']?>" class="form-horizontal" enctype="multipart/form-data">
                        <div class="col-md-12">

                            <input name='member_id' value='<?echo $member_item['member_id'] ?>' type='hidden'>

                            <div class="form-group">
                                <label class="col-md-3 control-label">帳號</label>
                                <div class="col-md-9">
                                    <input name='account' value='<?echo $member_item['member_account'] ?>' type='text' class='form-control' readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">姓名</label>
                                <div class="col-md-9">
                                    <input name='fullname' value='<?echo $member_item['member_name']?>' type='text' class='form-control' >
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">地址</label>
                                <div class="col-md-9">
                                    <input name='address' value='<?echo $member_item['member_address']?>' type='text' class='form-control'>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">電話</label>
                                <div class="col-md-9">
                                    <input name='cellphone' value='<?echo $member_item['member_phone']?>' type='text' class='form-control'>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12" style="text-align: right">
                            <a class='btn btn-sm btn-default' href="<?=base_url()?>member/page/20/1">返回</a> <button type="submit" class="btn btn-sm btn-success">Submit 送出</button>
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

<script>
    $(document).ready(function() {
        App.init();
    });
</script>
</body>
</html>
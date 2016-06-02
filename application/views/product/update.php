<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="<?=base_url()?>dashboard">Home 首頁</a></li>
        <li><a href="<?=base_url()?>product/item/list/20/1">Product 產品</a></li>
        <li class="active">Update 更新</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Update Product <small>產品編輯</small></h1>
    <div class="email-btn-row hidden-xs">
        <a href="<?=base_url().$list_url?>" class="btn btn-sm btn-inverse"><i class="fa fa-bars m-r-5"></i> List 列表</a>
        <a href="<?=base_url().$color_list_url?>" class="btn btn-sm btn-inverse"><i class="fa fa-bars m-r-5"></i> Color 顏色</a>
        <a href="<?=base_url().$upsell_list_url?>" class="btn btn-sm btn-inverse"><i class="fa fa-bars m-r-5"></i> Upsell 加購</a>
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
                    <h4 class="panel-title">編輯表單</h4>
                </div>
                <div class="panel-body">
                    <form method="post" action="" class="form-horizontal" enctype="multipart/form-data">
                        <input type="hidden" name="idx" value="<?=$data['idx']?>">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-md-3 control-label">產品名稱</label>
                                <div class="col-md-9">
                                    <input type="text" value="<?=isset($data['name']) ? $data['name'] : "" ?>" name="name" class="search_input form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">產品簡稱</label>
                                <div class="col-md-9">
                                    <input type="text" value="<?=isset($data['content']) ? $data['content'] : "" ?>" name="content" class="search_input form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">產品分類</label>
                                <div class="col-md-9">
                                    <select name="_product_type" class="form-control STATUS">
                                        <?php for($i=0;$i < count($product_type_fk); $i++){ ?>
                                            <option value="<?=$product_type_fk[$i]['idx']?>" <?if(isset($data['_product_type'])){if($data['_product_type']==$product_type_fk[$i]['idx']) echo "selected";}?>><?=$product_type_fk[$i]['name']?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">定價</label>
                                <div class="col-md-9">
                                    <input type="text" name="price_ntd" class="form-control" value="<?=isset($data['price_ntd']) ? $data['price_ntd'] : "0" ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">售價</label>
                                <div class="col-md-9">
                                    <input type="text" name="sale_price_ntd" class="form-control" value="<?=isset($data['sale_price_ntd']) ? $data['sale_price_ntd'] : "0" ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">優先度</label>
                                <div class="col-md-9">
                                    <input type="text" name="priority" class="form-control" value="<?=isset($data['priority']) ? $data['priority'] : "0" ?>" required>
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

<script>
    $(document).ready(function() {
        App.init();
    });
</script>
</body>
</html>
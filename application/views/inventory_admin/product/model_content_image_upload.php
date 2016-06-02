<link href="<?php echo base_url();?>dist/dropzone/css/dropzone.css" type="text/css" rel="stylesheet" />
<script src="<?php echo base_url();?>dist/dropzone/js/dropzone.min.js"></script>
<?php $attr='style="margin:0px;display: inline"';?>
<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="<?=base_url()?>inventory/product/category/admin">類別管理</a></li>
        <li><a href="<?=base_url()?>inventory/product/model/admin">模組管理</a></li>
        <li class="active">圖庫管理</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Product Image Management <small>商品圖庫管理</small></h1>
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
                    <h4 class="panel-title">列表</h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="<?php echo base_url();?>uploads/upload.php" class="dropzone" id="myAwesomeDropzone" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="image_product_id" id="article_hash_id" value="<?if(isset($image_product_id))echo $image_product_id;?>">
                            </form>
                            <script>
                                Dropzone.options.myAwesomeDropzone = {
                                    paramName: "file", // The name that will be used to transfer the file
                                    maxFilesize: 2, // MB
                                    acceptedFiles: "image/*"
                                };
                            </script>

                        </div>
                    </div>
                </div><!-- end panel -->
                <div class="panel-footer">
                    <?php echo form_open('inventory/product/model/content/admin',$attr);?>
                    <input type="hidden" name="con_model_id" value="<?php echo $con_model_id;?>"/>
                    <input type="submit" value="回模組產品列表" class="btn btn-primary btn-sm"/>
                    <?php echo '</form>';?>
                </div>
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
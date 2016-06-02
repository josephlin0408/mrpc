<link type="text/css" rel="stylesheet" href="<?=base_url()?>dist/summernote_ori/summernote.css">
<link type="text/css" rel="stylesheet" href="<?= base_url();?>dist/parsley/src/parsley.css">

<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="javascript:;">Home 首頁</a></li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">商品描述管理</h1>
    <!-- end page-header -->
    <!-- end row -->
    <div class="row">
        <!-- begin col-12 -->
        <div class="col-md-12">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="table-basic-7">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?= validation_errors(); ?>
                            <? $attributes = array('id' => 'article','data-parsley-validate'=>'');
                            echo form_open('inventory/product/model/description/update', $attributes);?>
                            <input type="hidden" name="model_id" value="<?=$model_id;?>">
<!--                            <div class="form-group">-->
<!--                                <label>標題</label>-->
<!--                                <input class="form-control" type="text" name="article_title"-->
<!--                                       data-parsley-trigger="change" value="--><?//=$article_title?><!--"-->
<!--                                       data-parsley-required-->
<!--                                       data-parsley-maxlength="100"/>-->
<!--                                <p class="help-block">限定長度100字以內</p>-->
<!--                            </div>-->
                            <div class="form-group">
                                <label>內文編輯器</label>
                                <div class="form-group">
                                    <textarea class="summernote" name="model_description"><?=$description?></textarea>
                                </div>
                            </div>
<!--                            <div class="form-group">-->
<!--                                <label>本文狀態</label>：-->
<!--                                <input type="radio" name="article_status" value="1" --><?//if($article_status!=2)echo "checked='checked'"?>
<!--                                正常 &nbsp;-->
<!--                                <input type="radio" name="article_status" value="2" --><?//if($article_status==2)echo "checked='checked'"?>
<!--                                刪除 &nbsp;-->
<!--                            </div>-->
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-sm" >儲存</button>
                                <a href="<?=base_url()."inventory/product/model/admin"?>" class="btn btn-default btn-sm">返回</a>
                            </div>
                            </form>
                        </div>
                        <!-- /.col-lg-6 (nested) -->
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- end row -->
        </div>
        <!-- end #content -->

        <!-- begin scroll to top btn -->
        <a href="javascript:;" class="btn btn-icon btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
        <!-- end scroll to top btn -->
    </div>
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
<script src="<?=base_url();?>dist/summernote_ori/summernote.js"></script>
<script src="<?=base_url();?>dist/summernote/summernote-zh-TW.js"></script>
<script src="<?=base_url();?>dist/parsley/dist/parsley.js"></script>
<script src="<?=base_url();?>dist/parsley/src/i18n/zh_tw.js"></script>




<script>
    $(document).ready(function() {
        App.init();
        FormPlugins.init();

        $('#article').parsley();
        $('.summernote').summernote({
            height: 780,
            lang: 'zh-TW',
            onImageUpload: function(files, editor, welEditable) {
                sendFile(files[0], editor, welEditable);
            }
        });

        function sendFile(file, editor, welEditable) {
            data = new FormData();
            data.append("file", file);
            $.ajax({
                data: data,
                type: "POST",
                url: "<?=base_url()?>dist/upload.php",
                cache: false,
                contentType: false,
                processData: false,
                success: function(msg) {
                    editor.insertImage(welEditable, msg);
                }
            });
        }
    });

</script>
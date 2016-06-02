<link type="text/css" rel="stylesheet" href="<?=base_url()?>dist/summernote_ori/summernote.css">
<link type="text/css" rel="stylesheet" href="<?= base_url();?>dist/parsley/src/parsley.css">

<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="javascript:;">Home 首頁</a></li>
        <li class="active">Repair Management 報修管理</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Repair Management <small>新增報修</small></h1>
    <!-- end page-header -->
    <!-- end row -->
    <div class="row">
        <!-- begin col-12 -->
        <div class="col-md-12">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?= validation_errors(); ?>
                            <?php
                            $attributes = array('id' => 'new_article','data-parsley-validate'=>'');
                            echo form_open_multipart('repair/create', $attributes);
                                ;?>
                                <div class="form-group">
                                    <label>產品名稱</label>
                                    <input class="form-control" type="text" name="repair_product_name"
                                           data-parsley-trigger="change"
                                           data-parsley-required
                                           data-parsley-maxlength="100" required
                                           value="default_repair_product_name"
                                        />
                                </div>
                                <div class="form-group">
                                    <label>產品擁有人</label>
                                    <input class="form-control" type="text" name="repair_product_owner"
                                           data-parsley-trigger="change"
                                           data-parsley-required
                                           data-parsley-maxlength="100" required
                                           value="default_repair_product_owner"
                                        />
                                </div>
                                <div class="form-group">
                                    <label>產品擁有人電話資訊</label>
                                    <input class="form-control" type="text" name="repair_product_owner_phone_number"
                                           data-parsley-trigger="change"
                                           data-parsley-required
                                           data-parsley-maxlength="100" required
                                           value="0910-000-000"
                                        />
                                </div>
                                <div class="form-group">
                                    <label>報單日期</label>
                                    <input type="date" class="form-control" name="repair_date" value="<?php echo date('Y-m-d',time()); ?>"/>
                                </div>
                                <div class="form-group">
                                    <label>分店資訊</label>
                                    <input class="form-control" type="text" name="repair_store_data"
                                           data-parsley-trigger="change"
                                           data-parsley-required
                                           data-parsley-maxlength="100" required
                                           value="default_repair_store_data"
                                        />
                                </div>
                                <div class="form-group">
                                    <label>分店填單人資訊</label>
                                    <input class="form-control" type="text" name="repair_store_staff_data"
                                           data-parsley-trigger="change"
                                           data-parsley-required
                                           data-parsley-maxlength="100" required
                                           value="default_repair_store_staff_data"
                                        />
                                </div>
                                <div class="form-group">
                                    <label>備註</label>
                                    <div class="form-group">
                                        <textarea class="summernote" name="repair_content">default-content</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-sm">送出</button>
                                    <a href="<?=base_url()."repair/"?>" class="btn btn-default btn-sm">返回</a>
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
//            ,toolbar: [
//                ['view', ['codeview' ]]
//            ],oninit: function() {
//                $("div.note-editor button[data-event='codeview']").click();
//                $("div.note-editor button[data-event='codeview']").hide();
//            }
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
        $('input:radio[name="article_task_category"]').filter('[value="1"]').attr('checked', true);

    });

</script>
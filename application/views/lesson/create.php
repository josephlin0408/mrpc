<link type="text/css" rel="stylesheet" href="<?=base_url()?>dist/summernote_ori/summernote.css">
<link type="text/css" rel="stylesheet" href="<?= base_url();?>dist/parsley/src/parsley.css">

<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="javascript:;">Home 首頁</a></li>
        <li class="active">Lesson 課程</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">New Lesson <small>新增課程</small></h1>
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
                            <?php /**/;?>
                            <?= validation_errors(); ?>
                            <?php
                            $attributes = array('id' => 'new_article','data-parsley-validate'=>'');
                            echo form_open_multipart('lesson/create', $attributes);
                                ;?>
                                <input type="hidden" name="article_hash_id" value="<?=sha1(rand());?>">
                                <div class="form-group">
                                    <label>課程類別</label>
                                    <select name="lesson_category_id" class="form-control" id="">
                                        <?php foreach($lesson_category as $unit):;?>
                                        <option value="<?php echo $unit['lesson_category_id'];?>"><?php echo $unit['lesson_category_name'];?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>標題 Title</label>
                                    <input class="form-control" type="text" name="lesson_title"
                                           data-parsley-trigger="change"
                                           data-parsley-required
                                           data-parsley-maxlength="100" required
                                           value="default_lesson_title"
                                        />
                                    <p class="help-block">限定長度100字以內</p>
                                </div>
                                <div class="form-group">
                                    <label>報名起始時間</label>
                                    <input type="datetime-local" class="form-control" name="lesson_booking_start_time" value="<?php echo date('Y-m-d').'T'.date('H:i'); ?>"/>
                                </div>
                                <div class="form-group">
                                    <label>報名結束時間</label>
                                    <input type="datetime-local" class="form-control" name="lesson_booking_end_time" value="<?php echo date('Y-m-d').'T'.date('H:i'); ?>"/>
                                </div>
                                <div class="form-group">
                                    <label>報名人數限制</label>
                                    <input type="number" class="form-control" name="lesson_booking_number_limit" value="200"/>
                                </div>
                                <div class="form-group">
                                    <label>課程標價</label>
                                    <input type="number" class="form-control" name="lesson_tag_price" value="7500"/>
                                </div>
                                <div class="form-group">
                                    <label>是否售票</label>
                                    <select name="lesson_sell_status" class="form-control" id="">
                                        <option value="0">否</option>
                                        <option value="1">是</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>連結網址</label>
                                    <input type="text" class="form-control" name="lesson_link"
                                           data-parsley-trigger="change"
                                           data-parsley-maxlength="150"
                                            value="http://default-set"
                                        />
                                </div>
                                <div class="form-group">
                                    <label>Meta</label>
                                    <input type="text" class="form-control" name="lesson_meta"
                                           data-parsley-trigger="change"
                                           data-parsley-maxlength="150"
                                           value="default-meta"
                                        />
                                </div>
                                <div class="form-group">
                                    <label>課程預覽圖</label>
                                    <input type="file" class="form-control" name="lesson_source"/>
                                </div>
                                <div class="form-group">
                                    <label>課程開放狀態</label>
                                    <select name="lesson_open_status" class="form-control" id="">
                                        <option value="0">所有人皆可參加</option>
                                        <option value="1">僅會員可以參加</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>課程顯示狀態</label>
                                    <select name="lesson_status" class="form-control" id="">
                                        <option value="0">顯示</option>
                                        <option value="1">不顯示</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>講師 lecturer</label>
                                    <input class="form-control" type="text" name="lesson_lecturer"
                                           data-parsley-trigger="change"
                                           data-parsley-maxlength="150"
                                           value="default-lecturer"
                                        />
                                </div>
                                <div class="form-group">
                                    <label>地址 Address</label>
                                    <input class="form-control" type="text" name="lesson_address"
                                           data-parsley-trigger="change"
                                           data-parsley-maxlength="150"
                                            value="default_address"
                                        />
                                </div>
                                <div class="form-group">
                                    <label>緯度 Latitude</label>
                                    <input class="form-control" type="text" name="lesson_latitude"
                                           data-parsley-trigger="change"
                                           data-parsley-maxlength="100"
                                           value="25.055652"
                                           placeholder="例如 : 25.055652"/>
                                </div>
                                <div class="form-group">
                                    <label>經度 Longitude</label>
                                    <input class="form-control" type="text" name="lesson_longitude"
                                           data-parsley-trigger="change"
                                           data-parsley-maxlength="100"
                                           value="121.582363"
                                           placeholder="例如 : 121.582363"/>
                                </div>
                                <div class="form-group">
                                    <label>內文編輯器</label>
                                    <div class="form-group">
                                        <textarea class="summernote" name="lesson_content">default-content</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-sm">送出</button>
                                    <a href="<?=base_url()."lesson/"?>" class="btn btn-default btn-sm">返回</a>
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
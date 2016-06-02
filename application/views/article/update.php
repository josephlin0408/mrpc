<link type="text/css" rel="stylesheet" href="<?=base_url()?>dist/summernote_ori/summernote.css">
<link type="text/css" rel="stylesheet" href="<?= base_url();?>dist/parsley/src/parsley.css">

<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="javascript:;">Home 首頁</a></li>
        <li class="active">Article 文章管理</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Article Management <small>文章管理</small></h1>
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
                            <? $attributes = array('id' => 'article','enctype'=>"multipart/form-data");
                               echo form_open('article/update/'.$article_hash_id, $attributes);?>
                                <input type="hidden" name="article_hash_id" value="<?=$article_hash_id;?>">
                                <div class="form-group">
                                    <label>標題 Title</label>
                                    <input class="form-control" type="text" name="article_title"
                                           data-parsley-trigger="change" value="<?=$article_title?>"
                                           data-parsley-maxlength="100"/>
                                    <p class="help-block">限定長度100字以內</p>
                                </div>
                                <div class="form-group">
                                    <label>文章預覽圖</label>
                                    <img src="<?=base_url()?>uploads/<?=$article_image?>" class="img-responsive">
                                    <input type="file" class="form-control" name="article_image"/>
                                </div>
                                <div class="form-group">
                                    <label>代稱 Alias</label>
                                    <input class="form-control" type="text" name="article_alias"
                                           data-parsley-trigger="change" value="<?=$article_alias?>"
                                           data-parsley-maxlength="50" />
                                    <p class="help-block">限定長度50字以內</p>
                                </div>
                                <div class="form-group hidden">
                                    <label>文章摘要 Digest</label>
                                    <textarea class="form-control" rows="2" name="article_digest" data-parsley-maxlength="200" ><?=$article_digest?></textarea>
                                    <p class="help-block">限定長度200字以內</p>
                                </div>
                                <div class="form-group hidden">
                                    <label>地址 Address</label>
                                    <input class="form-control" type="text" name="article_address"
                                           data-parsley-trigger="change"
                                           value="<?=$article_address?>"
                                           data-parsley-maxlength="150"/>
                                </div>
                                <div class="form-group hidden">
                                    <label>緯度 Latitude</label>
                                    <input class="form-control" type="text" name="article_lat"
                                           data-parsley-trigger="change"
                                           data-parsley-maxlength="100" value="<?if(!empty($article_lat))echo $article_lat?>"
                                           placeholder="例如 : 25.055652"/>
                                    <p class="help-block">限定長度100字以內</p>
                                </div>
                                <div class="form-group hidden">
                                    <label>經度 Longitude</label>
                                    <input class="form-control" type="text" name="article_lon"
                                           data-parsley-trigger="change" value="<?if(!empty($article_lon))echo $article_lon?>"
                                           data-parsley-maxlength="100" placeholder="例如 : 121.582363"/>
                                    <p class="help-block">限定長度100字以內</p>
                                </div>
                                <div class="form-group">
                                    <label>內文編輯器</label>

                                    <div class="form-group">
                                        <textarea class="summernote" name="article_content"><?=$article_content?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>本文狀態</label>：
                                    <input type="radio" name="article_status" value="0" <?if($article_status==0)echo "checked='checked'"?>> 正常 &nbsp;
                                    <input type="radio" name="article_status" value="1" <?if($article_status==1)echo "checked='checked'"?>> 隱藏 &nbsp;
                                    <input type="radio" name="article_status" value="2" <?if($article_status==2)echo "checked='checked'"?>> 刪除 &nbsp;
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="article_image_ori" value="<?=$article_image;?>"/>
                                    <button type="submit" class="btn btn-success btn-sm" >儲存</button>
                                    <a href="<?=base_url()?>article" class="btn btn-default btn-sm">返回</a>
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

<!-- Modal -->
<!-- #modal-without-animation -->
<div class="modal fade" id="processModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <progress style="width: 100%"></progress>
            </div>
        </div>
    </div>
</div>

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
                $('#processModal').modal('show');
                sendFile(files[0], editor, welEditable);
            }
        });

        // send the file
        function sendFile(file, editor, welEditable) {
            data = new FormData();
            data.append("file", file);
            $.ajax({
                data: data,
                type: 'POST',
                xhr: function() {
                    var myXhr = $.ajaxSettings.xhr();
                    if (myXhr.upload) myXhr.upload.addEventListener('progress',progressHandlingFunction, false);
                    return myXhr;
                },
                url: '<?=base_url().'dist/upload.php?v='.rand()?>',
                cache: false,
                contentType: false,
                processData: false,
                success: function(url) {
                    editor.insertImage(welEditable, url+'?v=<?=rand()?>');
                    $('#processModal').modal('hide');
                }
            });
        }

        // update progress bar
        function progressHandlingFunction(e){
            if(e.lengthComputable){
                $('progress').attr({value:e.loaded, max:e.total});
                // reset progress on complete
                if (e.loaded == e.total) {
                    $('progress').attr('value','0.0');
                }
            }
        }
    });



</script>
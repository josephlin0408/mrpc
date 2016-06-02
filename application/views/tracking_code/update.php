<link type="text/css" rel="stylesheet" href="<?=base_url()?>dist/summernote_ori/summernote.css">
<link type="text/css" rel="stylesheet" href="<?= base_url();?>dist/parsley/src/parsley.css">

<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="javascript:;">Home 首頁</a></li>
        <li class="active">Tracking Code Management 追蹤碼管理</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Tracking Code Management <small>追蹤碼管理</small></h1>
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
                            <? $attributes = array('id' => 'code','data-parsley-validate'=>'');
                               echo form_open('code/update/'.$code_hash_id, $attributes);?>
                                <input type="hidden" name="code_hash_id" value="<?=$code_hash_id;?>">
                            <div class="form-group">
                                <label>自訂追蹤碼</label>
                                <div class="form-group">
                                    <textarea class="summernote" name="code_content"><?=$code_content?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Facebook Pixel 追蹤碼 ID</label>
                                <input class="form-control" type="text" name="code_fb_id"
                                       data-parsley-trigger="change" value="<?=$code_fb_id?>"
                                       data-parsley-maxlength="100" placeholder="範例：1734959276733311"/>
                            </div>
                            <div class="form-group">
                                <label>Google Analytic 追蹤碼 ID</label>
                                <input class="form-control" type="text" name="code_ga_id"
                                       data-parsley-trigger="change" value="<?=$code_ga_id?>"
                                       data-parsley-maxlength="100" placeholder="範例：UA-64092761-1"/>
                            </div>
                            <div class="form-group">
                                <label>MouseFlow 追蹤碼 ID</label>
                                <input class="form-control" type="text" name="code_mf_id"
                                       data-parsley-trigger="change" value="<?=$code_mf_id?>"
                                       data-parsley-maxlength="100" placeholder="範例：75ea2d6d-390e-4b92-b517-ff3e7edba821"/>
                            </div>
                            <div class="form-group">
                                <label>VWO 追蹤碼 ID</label>
                                <input class="form-control" type="text" name="code_vwo_id"
                                       data-parsley-trigger="change" value="<?=$code_vwo_id?>"
                                       data-parsley-maxlength="100" placeholder="範例：234065" />
                            </div>
                            <div class="form-group">
                                <label>Mailchimp 追蹤碼 ID</label>
                                <input class="form-control" type="text" name="code_mc_id"
                                       data-parsley-trigger="change" value="<?=$code_mc_id?>"
                                       data-parsley-maxlength="100" placeholder="範例：528c00f4326256c03530f4c485389a43-us12" />
                            </div>
                            <div class="form-group">
                                <label>Mailchimp 準會員列表 Token</label>
                                <input class="form-control" type="text" name="code_mc_token_prospect"
                                       data-parsley-trigger="change" value="<?=$code_mc_token_prospect?>"
                                       data-parsley-maxlength="100" placeholder="範例：59717b8a4a" />
                            </div>
                            <div class="form-group">
                                <label>Mailchimp 會員列表 Token</label>
                                <input class="form-control" type="text" name="code_mc_token_member"
                                       data-parsley-trigger="change" value="<?=$code_mc_token_member?>"
                                       data-parsley-maxlength="100" placeholder="範例：5712aa5f68" />
                            </div>
                                <div class="form-group hidden">
                                    <label>本文狀態</label>：
                                    <input type="radio" name="code_status" value="1" <?if($code_status!=2)echo "checked='checked'"?>> 正常 &nbsp;
                                    <input type="radio" name="code_status" value="2" <?if($code_status==2)echo "checked='checked'"?>> 刪除 &nbsp;
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-sm" >儲存</button>
                                    <a href="<?=base_url()."code"?>" class="btn btn-default btn-sm">返回</a>
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

    <script src="//google-code-prettify.googlecode.com/svn/loader/run_prettify.js"></script>


<script>
    $(document).ready(function() {
        App.init();
        FormPlugins.init();
        $('.summernote').summernote({
            height: 280,
            lang: 'zh-TW',
            toolbar: [
                ['view', ['codeview' ]]
            ],oninit: function() {
                $("div.note-editor button[data-event='codeview']").click();
                $("div.note-editor button[data-event='codeview']").hide();
            }
        });

    });

</script>
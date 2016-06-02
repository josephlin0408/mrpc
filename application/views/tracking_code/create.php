<link type="text/css" rel="stylesheet" href="<?=base_url()?>dist/summernote_ori/summernote.css">
<link type="text/css" rel="stylesheet" href="<?= base_url();?>dist/parsley/src/parsley.css">
<script src="//google-code-prettify.googlecode.com/svn/loader/run_prettify.js"></script>
<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="javascript:;">Home 首頁</a></li>
        <li class="active">Member 會員</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Code Management <small>追蹤碼管理</small></h1>
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
                            <? $attributes = array('id' => 'new_code','data-parsley-validate'=>'');
                               echo form_open('code/create/', $attributes);?>
                                <input type="hidden" name="code_hash_id" value="<?=sha1(rand());?>">
                                <div class="form-group">
                                    <label>Facebook Pixel Code 範例</label>
                                    <pre class="prettyprint">
&#60;script&#62; !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','https://connect.facebook.net/en_US/fbevents.js');

fbq('init', '這邊是每一個帳號都不同的編號');
fbq('track', "PageView");&#60;/script&#62;
&#60;noscript&#62;&#60;img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=1734959276733310&ev=PageView&noscript=1"
/&#62;&#60;/noscript&#62;
</pre>
                                    <label>MouseFlow 範例</label>
                                    <pre class="prettyprint">
&#60;script&#62; var _mfq = _mfq || [];
(function() {
var mf = document.createElement("script");
mf.type = "text/javascript"; mf.async = true;

mf.src = "//cdn.mouseflow.com/projects/這邊是每一個帳號都不同的編號.js";
document.getElementsByTagName("head")[0].appendChild(mf);
})();&#60;/script&#62;

</pre>
                                    <label>Google Analytic 範例</label>
                                    <pre class="prettyprint">
&#60;script&#62; (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

ga('create', '這邊是每一個帳號都不同的編號', 'auto');
ga('send', 'pageview');
&#60;/script&#62;
</pre>

                                </div>
                                <div class="form-group">
                                    <label>程式碼請直接貼在下方</label>
                                    <textarea class="summernote" name="code_content"></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-sm">送出</button>
                                    <a href="<?=base_url()."code/"?>" class="btn btn-default btn-sm">返回</a>
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

        $('#code').parsley();

        $('.summernote').summernote({
            height: 780,
            lang: 'zh-TW',
            toolbar: [
                ['view', ['codeview' ]]
            ],oninit: function() {
                $("div.note-editor button[data-event='codeview']").click();
                $("div.note-editor button[data-event='codeview']").hide();
            }
        });

        $('input:radio[name="code_task_category"]').filter('[value="1"]').attr('checked', true);

    });

</script>
<link type="text/css" rel="stylesheet" href="<?=base_url()?>dist/summernote_ori/summernote.css">

<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="<?=base_url()?>dashboard">Home 首頁</a></li>
        <li><a href="<?=base_url()?>email">Template 電郵模板</a></li>
        <li class="active">Update Email Template 更新電郵模板</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Update Email Template <small>更新電郵模板</small></h1>
    <div class="email-btn-row hidden-xs">
        <a href="<?=base_url()?>email" class="btn btn-sm btn-inverse"><i class="fa fa-bars m-r-5"></i> List 列表</a>
    </div>
    <!-- end page-header -->

    <!-- begin row -->
    <div class="row">
        <!-- begin col-12 -->
        <div class="col-md-12">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                <div class="panel-heading">
                    <div class="panel-heading-btn"></div>
                    <h4 class="panel-title">表單</h4>
                </div>
                <div class="panel-body">
                    <form method="post" action="" class="form-horizontal" enctype="multipart/form-data">
                        <?= validation_errors(); ?>
                        <? $attributes = array('id' => 'article','data-parsley-validate'=>'');
                        echo form_open('email/update/'.$template_hash_id, $attributes);?>
                        <input type="hidden" name="template_hash_id" value="<?=$template_hash_id;?>">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>信件標題</label>
                                <input class="form-control" type="text" name="template_title"
                                       data-parsley-trigger="change" value="<?=$template_title?>"
                                       data-parsley-required
                                       data-parsley-maxlength="100"/>
                                <p class="help-block">限定長度100字以內</p>
                            </div>
                            <div class="form-group hidden">
                                <label>寄送信件的時機</label>：
                                <div class="row">
                                    <?foreach($category AS $unit):?>
                                        <div class="col-lg-3"><input type="radio" name="template_task_category" value="<?=$unit['category_id']?>" <?if($template_task_category==$unit['category_id'])echo "checked='checked'"?>> <?=$unit['category_name']?> &nbsp;</div>
                                    <?endforeach?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><h4>會被系統自動取代的會員資料關鍵字</h4></div>
                                <div class="col-md-3"><label>會員姓名：</label><span>{name}</span></div>
                                <div class="col-md-3"><label>會員住址：</label><span>{address}</span></div>
                                <div class="col-md-3"><label>訂單編號：</label><span>{order_no}</span></div>
                                <div class="col-md-3"><label>訂單日期：</label><span>{order_date}</span></div>
                                <div class="col-md-3"><label>訂單的購物內容：</label><span>{order_cart}</span></div>
                                <div class="col-md-3"><label>購物車總金額：</label><span>{order_cart_total}</span></div>
                                <div class="col-md-3"><label>運費：</label><span>{order_shipping_fee}</span></div>
                                <div class="col-md-3"><label>手續費：</label><span>{order_service_fee}</span></div>
                                <div class="col-md-3"><label>訂單總金額：</label><span>{order_total}</span></div>
                            </div>
                            <div class="form-group">
                                <label>內文編輯器</label>
                                <div class="form-group">
                                    <textarea class="summernote" name="template_content"><?=$template_content?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>本文狀態</label>：
                                <input type="radio" name="template_status" value="0" <?if($template_status==0)echo "checked='checked'"?>> 隱藏 &nbsp;
                                <input type="radio" name="template_status" value="1" <?if($template_status==1)echo "checked='checked'"?>> 顯示 &nbsp;
                                <input type="radio" name="template_status" value="2" <?if($template_status==2)echo "checked='checked'"?>> 刪除 &nbsp;
                            </div>
                        </div>
                        <div class="col-md-12" style="text-align: right">
                            <a href="<?=base_url()."email/"?>" class="btn btn-default btn-sm" style="margin-right: 10px;">返回</a><button type="submit" class="btn btn-sm btn-success">Submit 送出</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- end panel -->
        </div>
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

<!-- ================== Summernote JS ================== -->
<script src="<?=base_url();?>dist/summernote_ori/summernote.js"></script>
<script src="<?=base_url();?>dist/summernote/summernote-zh-TW.js"></script>


<script>
    $(document).ready(function() {
        App.init();

        $('.summernote').summernote({
            height: 620,
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
                url: "/admin/dist/upload.php",
                cache: false,
                contentType: false,
                processData: false,
                success: function(msg) {
                    console.log(msg);
                    editor.insertImage(welEditable, msg);
                }
            });
        }

    });
</script>
</body>
</html>
</nav>

<link type="text/css" rel="stylesheet" href="<?=base_url()?>dist/summernote_ori/summernote.css">

<link type="text/css" rel="stylesheet" href="<?= base_url();?>dist/parsley/src/parsley.css">

<!-- Page Content -->
<div id="page-wrapper" style="margin-left: 0px; padding-top: 20px">
<div class="container">
    <div class="row">
        <div class="col-lg-12">

            <?=$msg;?>

            <div class="panel panel-default">
                <div class="panel-heading">Email Content</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?= validation_errors(); ?>
                            <? $attributes = array('id' => 'article','data-parsley-validate'=>'');
                               echo form_open('email/update/'.$template_hash_id, $attributes);?>
                                <input type="hidden" name="template_hash_id" value="<?=$template_hash_id;?>">
                                <div class="form-group">
                                    <label>信件標題</label>
                                    <input class="form-control" type="text" name="template_title"
                                           data-parsley-trigger="change" value="<?=$template_title?>"
                                           data-parsley-required
                                           data-parsley-maxlength="100"/>
                                    <p class="help-block">限定長度100字以內</p>
                                </div>

                                <div class="form-group">
                                    <label>寄送信件的時機</label>：
                                    <div class="row">
                                        <?foreach($category AS $unit):?>
                                            <div class="col-lg-3"><input type="radio" name="template_task_category" value="<?=$unit['category_id']?>" <?if($template_task_category==$unit['category_id'])echo "checked='checked'"?>> <?=$unit['category_name']?> &nbsp;</div>
                                        <?endforeach?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>會被系統自動取代的會員資料關鍵字</label><br>
                                    <table class="table">
                                        <tr>
                                            <th>會員姓名</th>
                                            <th>會員住址</th>
                                            <th>訂單編號</th>
                                            <th>訂單日期</th>
                                            <th>訂單的購物內容</th>
                                            <th>購物車總金額</th>
                                            <th>運費</th>
                                            <th>手續費</th>
                                            <th>訂單總金額</th>
                                        </tr>
                                        <tr style="color:blue">
                                            <td>{name}</td>
                                            <td>{address}</td>
                                            <td>{order_no}</td>
                                            <td>{order_date}</td>
                                            <td>{order_cart}</td>
                                            <td>{order_cart_total}</td>
                                            <td>{order_shipping_fee}</td>
                                            <td>{order_service_fee}</td>
                                            <td>{order_total}</td>
                                        </tr>
                                    </table>
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
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg" style="width: 100%">送出</button>

                                    <a href="<?=base_url()."email/"?>" class="btn btn-default btn-lg" style="margin-top: 10px; float: right">返回</a>
                                </div>
                            </form>
                        </div>
                        <!-- /.col-lg-6 (nested) -->
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
</div>
<!-- /.row -->

</div>
<!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="<?=base_url();?>dist/bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?=base_url();?>dist/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="<?=base_url();?>dist/bower_components/metisMenu/dist/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="<?=base_url();?>dist/js/sb-admin-2.js"></script>

<!-- summernote JavaScript -->
<script src="<?=base_url();?>dist/summernote_ori/summernote.js"></script>

<script src="<?=base_url();?>dist/summernote/summernote-zh-TW.js"></script>

<!-- parsley form validation JavaScript -->
<script src="<?=base_url();?>dist/parsley/dist/parsley.js"></script>

<script src="<?=base_url();?>dist/parsley/src/i18n/zh_tw.js"></script>


<script>
    $(document).ready(function() {

        $('#article').parsley();

        $('.summernote').summernote({
            height: 420,
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
<link type="text/css" rel="stylesheet" href="<?=base_url()?>dist/summernote_ori/summernote.css">
<!--<link type="text/css" rel="stylesheet" href="--><?//= base_url();?><!--dist/parsley/src/parsley.css">-->

<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="javascript:;">Home 首頁</a></li>
        <li class="active">Repair Management 報修管理</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Repair Data View / Update <small>編輯報修</small></h1>
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
                            <link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/style.css"/>
                            <?= validation_errors(); ?>
                            <div class="form-group">
                                <table class="table table-bordered table-condensed">
                                    <tr>
                                        <td>產品名稱</td>
                                        <td>
                                            <b id="reset_repair_product_name" onclick="get_input('reset_repair_product_name','repair_product_name')">
                                                <?php echo $repair['repair_product_name'];?>
                                            </b>
                                            <label class="sr-only">產品名稱</label>
                                            <input type="text" name="repair_product_name"
                                                   data-parsley-trigger="change"
                                                   data-parsley-required
                                                   data-parsley-maxlength="100" required
                                                   id="repair_product_name"
                                                   value="<?php echo $repair['repair_product_name'];?>"
                                                   style="display: none"
                                                   class="form-control"
                                                   onblur="get_field('reset_repair_product_name','repair_product_name')"
                                                   onclick="enter_to_get_field('reset_repair_product_name','repair_product_name')"
                                                />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>產品擁有人</td>
                                        <td>
                                            <b id="reset_repair_product_owner" onclick="get_input('reset_repair_product_owner','repair_product_owner')">
                                                <?php echo $repair['repair_product_owner'];?>
                                            </b>
                                            <label class="sr-only">產品擁有人</label>
                                            <input class="form-control" type="text" name="repair_product_owner"
                                                   data-parsley-trigger="change"
                                                   data-parsley-required
                                                   data-parsley-maxlength="100" required
                                                   value="<?php echo $repair['repair_product_owner'];?>"
                                                   style="display: none"
                                                   id="repair_product_owner"
                                                   onblur="get_field('reset_repair_product_owner','repair_product_owner')"
                                                   onclick="enter_to_get_field('reset_repair_product_owner','repair_product_owner')"
                                                />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>產品擁有人電話資訊</td>
                                        <td>
                                            <b id="reset_repair_product_owner_phone_number" onclick="get_input('reset_repair_product_owner_phone_number','repair_product_owner_phone_number')">
                                                <?php echo $repair['repair_product_owner_phone_number'];?>
                                            </b>
                                            <label class="sr-only">產品擁有人電話資訊</label>
                                            <input class="form-control" type="text" name="repair_product_owner_phone_number"
                                                   data-parsley-trigger="change"
                                                   data-parsley-required
                                                   data-parsley-maxlength="100" required
                                                   value="<?php echo $repair['repair_product_owner_phone_number'];?>"
                                                   style="display: none"
                                                   id="repair_product_owner_phone_number"
                                                   onblur="get_field('reset_repair_product_owner_phone_number','repair_product_owner_phone_number')"
                                                   onclick="enter_to_get_field('reset_repair_product_owner_phone_number','repair_product_owner_phone_number')"
                                                />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>報單日期</td>
                                        <td>
                                            <b id="reset_repair_date" onclick="get_input('reset_repair_date','repair_date')">
                                                <?php echo $repair['repair_date'];?>
                                            </b>
                                            <label class="sr-only">報單日期</label>
                                            <input type="date"
                                                   class="form-control"
                                                   name="repair_date"
                                                   value="<?php echo date('Y-m-d',strtotime($repair['repair_date'])); ?>"
                                                   style="display: none"
                                                   id="repair_date"
                                                   onblur="get_field('reset_repair_date','repair_date')"
                                                   onclick="enter_to_get_field('reset_repair_date','repair_date')"
                                                />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>分店資訊</td>
                                        <td>
                                            <b id="reset_repair_store_data" onclick="get_input('reset_repair_store_data','repair_store_data')">
                                                <?php echo $repair['repair_store_data'];?>
                                            </b>
                                            <label class="sr-only">分店資訊</label>
                                            <input class="form-control" type="text" name="repair_store_data"
                                                   data-parsley-trigger="change"
                                                   data-parsley-required
                                                   data-parsley-maxlength="100" required
                                                   value="<?php echo $repair['repair_store_data'];?>"
                                                   style="display: none"
                                                   id="repair_store_data"
                                                   onblur="get_field('reset_repair_store_data','repair_store_data')"
                                                   onclick="enter_to_get_field('reset_repair_store_data','repair_store_data')"
                                                />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>分店填單人資訊</td>
                                        <td>
                                            <b id="reset_repair_store_staff_data" onclick="get_input('reset_repair_store_staff_data','repair_store_staff_data')">
                                                <?php echo $repair['repair_store_staff_data'];?>
                                            </b>
                                            <label class="sr-only">分店填單人資訊</label>
                                            <input class="form-control" type="text" name="repair_store_staff_data"
                                                   data-parsley-trigger="change"
                                                   data-parsley-required
                                                   data-parsley-maxlength="100" required
                                                   value="<?php echo $repair['repair_store_staff_data'];?>"
                                                   style="display: none"
                                                   id="repair_store_staff_data"
                                                   onblur="get_field('reset_repair_store_staff_data','repair_store_staff_data')"
                                                   onclick="enter_to_get_field('reset_repair_store_staff_data','repair_store_staff_data')"
                                                />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>單據狀態</td>
                                        <td>
                                            <b id="reset_repair_status">
                                                <?php switch($repair['repair_status']){
                                                    case(0):
                                                        echo '立單';
                                                        break;
                                                    case(1):
                                                        echo '已送修';
                                                        break;
                                                    case(2):
                                                        echo '已回收';
                                                        break;
                                                    case(3):
                                                        echo '已交還';
                                                        break;
                                                };?>
                                            </b>
                                            <label class="sr-only">單據狀態</label>
                                            <select class="form-control" name="repair_status"
                                                    style="display: none"
                                                    id="repair_status"
                                                >
                                                <option value="0">立單</option>
                                                <option value="1" <?php if($repair['repair_status']=='1')echo 'selected';?>>已送修</option>
                                                <option value="2" <?php if($repair['repair_status']=='2')echo 'selected';?>>已回收</option>
                                                <option value="3" <?php if($repair['repair_status']=='3')echo 'selected';?>>已交還</option>
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <?php
                            $attributes = array('id' => 'new_article','data-parsley-validate'=>'');
                            echo form_open_multipart('repair/update/'.$repair['repair_id'], $attributes);
                            ;?>
                            <div class="form-group">
                                <label>備註</label>
                                <div class="form-group">
                                    <textarea class="summernote" name="repair_content"><?php echo $repair['repair_content'];?></textarea>
                                </div>
                            </div>

                                <div class="form-group">
                                    <b id="try"></b>
<!--                                    <button type="button" onclick="update_textarea_db('repair_content')">將備註存檔</button>-->
                                    <button type="submit" class="btn btn-success btn-sm">存檔</button>
                                    <a href="<?=base_url()."repair/"?>" class="btn btn-default btn-sm">返回</a>
                                </div>
                            <?php echo form_close();?>
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
    function enter_to_get_field(field_id,input_id){
        $("#"+input_id).keydown(function(event)
        {
            if(event.keyCode == 13){
                get_field(field_id,input_id);
            }
        });
    }
    function get_input(field_id,input_id){
        $( "#"+input_id ).css('display','').focus().select();
        $( "#"+field_id ).attr('style','display: none');
    }
    function get_field(field_id,input_id){
        $("#"+field_id).html($( "#"+input_id ).val()).css('display','');
        $("#"+input_id).attr('style','display: none');
        update_db(input_id);
    }
</script>
<script>
    var obj_field = $( "#reset_repair_status" );
    var obj_input = $( "#repair_status" );
    obj_field.click(function() {
        obj_input.css('display','').focus().select();
        obj_field.attr('style','display: none');
    });

    obj_input.on('blur',function(){
        switch(obj_input.val()) {
            case '0':
                obj_field.html('立單');
                break;
            case '1':
                obj_field.html('已送修');
                break;
            case '2':
                obj_field.html('已回收');
                break;
            case '3':
                obj_field.html('已交還');
                break;
        }
        obj_field.css('display','');
        obj_input.attr('style','display: none');
        update_db('repair_status');
    });
</script>
<script>
    function update_db(input_id){
        var URLs="<?php echo base_url();?>repair/ajax/update";
        $.ajax({
            url: URLs,
            data: "update_name="+input_id+" & update_value="+$( "#"+input_id ).val()+" & update_id=<?php echo $repair['repair_id'];?>",
            type:"POST",
            dataType:'text',

            success: function(msg){
                console.log(msg+'set success');
            },
            error:function(xhr, ajaxOptions, thrownError){
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
    }

//    function update_textarea_db(input_id){
//        var URLs="<?php //echo base_url();?>//repair/ajax/update";
//        $.ajax({
//            url: URLs,
//            data: "update_name="+input_id+" & update_value="+$( "#"+input_id ).html()+" & update_id=<?php //echo $repair['repair_id'];?>//",
//            type:"POST",
//            dataType:'text',
//
//            success: function(msg){
//                console.log(input_id);
//                $("#try").html(msg);
//            },
//            error:function(xhr, ajaxOptions, thrownError){
//                console.log(xhr.status);
//                console.log(thrownError);
//            }
//        });
//    }
</script>
<script>

    $(document).ready(function() {

        App.init();
        FormPlugins.init();

        //$('#article').parsley();

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
        //$('input:radio[name="article_task_category"]').filter('[value="1"]').attr('checked', true);

    });

</script>
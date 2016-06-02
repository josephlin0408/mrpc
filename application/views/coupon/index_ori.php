</nav>
<!-- parsley CSS -->
<link href="<?= base_url(); ?>dist/parsley/src/parsley.css" rel="stylesheet" type="text/css">

<!-- pickadate CSS -->
<link rel="stylesheet" href="<?= base_url(); ?>dist/pickadate/themes/default.css">
<link rel="stylesheet" href="<?= base_url(); ?>dist/pickadate/themes/default.date.css">
<div id="pickadate_container"></div>

<!-- Page Content -->
    <div id="page-wrapper" style="margin-left: 0px">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">折扣代碼
                        <button data-toggle="modal" data-target="#modal_create" class='btn btn-primary btn-circle'><i
                                class="fa fa-plus"></i></button>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <!-- /.col-lg-12 -->
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            列表
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                    <tr>
                                        <th>折扣代碼</th>
                                        <th>折扣型態</th>
                                        <th>折扣</th>
                                        <th>說明</th>
                                        <th>狀態</th>
                                        <th>限制型態</th>
                                        <th>已使用次數</th>
                                        <th>可使用次數</th>
                                        <th>啟用時間</th>
                                        <th>過期時間</th>
                                        <th>選項</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php

                                    $coupon_discount_type_text = array("打N折","折N元");
                                    $coupon_status_text = array("正常","停用");
                                    $coupon_type_text = array("無限制","日期限制","次數限制");

                                    foreach ($coupon as $item): ?>

                                        <tr class="odd gradeX">
                                            <td><?php echo $item['coupon_code']; ?></td>
                                            <td><?php echo $coupon_discount_type_text[$item['coupon_discount_type']] ?></td>
                                            <td>
                                                <?php if($item['coupon_discount_type']==1)echo $item['coupon_discount_int'] ?>
                                                <?php if($item['coupon_discount_type']==0)echo $item['coupon_discount_double'] ?>
                                            </td>
                                            <td><?php echo $item['coupon_text'] ?></td>
                                            <td><?php echo $coupon_status_text[$item['coupon_status']] ?></td>
                                            <td><?php echo $coupon_type_text[$item['coupon_type']] ?></td>
                                            <td><?php echo $item['coupon_counter'] ?></td>
                                            <td><?php echo $item['coupon_limit'] ?></td>
                                            <td><?php echo date('Y-m-d', $item['coupon_begin']); ?></td>
                                            <td><?php echo date('Y-m-d', $item['coupon_expire']); ?></td>
                                            <td><button class="btn btn-primary btn-editor"
                                                        update_coupon_id="<?php echo $item['coupon_id']; ?>"
                                                        update_coupon_code="<?php echo $item['coupon_code']; ?>"
                                                        update_coupon_discount_type="<?php echo $item['coupon_discount_type']?>"
                                                        update_coupon_discount="<?php if($item['coupon_discount_type']==1)echo $item['coupon_discount_int'] ?><?php if($item['coupon_discount_type']==0)echo $item['coupon_discount_double'] ?>"
                                                        update_coupon_text="<?php echo $item['coupon_text'] ?>"
                                                        update_coupon_status="<?php echo $item['coupon_status']?>"
                                                        update_coupon_type="<?php echo $item['coupon_type']?>"
                                                        update_coupon_counter="<?php echo $item['coupon_counter']?>"
                                                        update_coupon_limit="<?php echo $item['coupon_limit']?>"
                                                        update_coupon_begin="<?php echo date('Y-m-d', $item['coupon_begin'])?>"
                                                        update_coupon_expire="<?php echo date('Y-m-d', $item['coupon_expire'])?>"
                                                    >編輯</button>
                                            <a class="btn btn-default" onclick="return confirm('確定刪除嗎？')" href="<?=base_url()?>coupon/delete/<?=$item['coupon_id']?>">刪除</a></td>
                                        </tr>
                                    <?php endforeach ?>

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->

                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

<!-- Modal -->
<div class="modal fade" id="modal_create" tabindex="-1" role="dialog" aria-labelledby="modal_create">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">新增折扣代碼 Create a coupon code</h4>
            </div>
            <div class="modal-body">
                <form id="form_create" data-parsley-validate>
                    <div class="form-group">
                        <label>折扣代碼</label>
                        <input class="form-control" name="coupon_code" placeholder="" data-parsley-trigger="change" required>
                    </div>
                    <div class="form-group">
                        <label>折扣型態</label>
                        <select class="form-control" name="coupon_discount_type">
                            <option value="0">打N折</option>
                            <option value="1">折N元</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>折扣</label>
                        <input class="form-control" name="coupon_discount" placeholder="打7折請填0.7；折10元請直接填10" data-parsley-trigger="change" required>
                    </div>
                    <div class="form-group">
                        <label>說明文字</label>
                        <input class="form-control" name="coupon_text" placeholder="" data-parsley-trigger="change" required>
                    </div>
                    <div class="form-group">
                        <label>限制類型</label>
                        <select class="form-control" name="coupon_type" id="coupon_type">
                            <option value="0">無限制</option>
                            <option value="1">日期限制</option>
                            <option value="2">次數限制</option>
                        </select>
                    </div>
                    <div id="number_limit">
                        <div class="form-group">
                            <label>被使用的次數</label>
                            <input class="form-control" name="coupon_counter" placeholder="" data-parsley-trigger="change" value="0" >
                        </div>
                        <div class="form-group">
                            <label>使用次數上限</label>
                            <input class="form-control" name="coupon_limit" placeholder="" data-parsley-trigger="change" value="0" >
                        </div>
                    </div>
                    <div id="date_limit">
                        <div class="form-group">
                            <label>啟用日</label>
                            <input class="form-control datepicker" name="coupon_begin" placeholder="" data-parsley-trigger="change" >
                        </div>
                        <div class="form-group">
                            <label>過期日</label>
                            <input class="form-control datepicker" name="coupon_expire" placeholder="" data-parsley-trigger="change" >
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
                <button type="button" class="btn btn-primary" id="btn_create_submit">儲存</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="modal_update">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">更新功能</h4>
            </div>
            <div class="modal-body">
                <form id="form_update" data-parsley-validate>
                    <input id="update_coupon_id" name="coupon_id" type="hidden" data-parsley-trigger="change" required>

                    <div class="form-group">
                        <label>折扣代碼</label>
                        <input id="update_coupon_code" class="form-control" name="coupon_code" placeholder="" data-parsley-trigger="change" required>
                    </div>
                    <div class="form-group">
                        <label>折扣型態</label>
                        <select id="update_coupon_discount_type" class="form-control" name="coupon_discount_type">
                            <option value="0">打N折</option>
                            <option value="1">折N元</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>折扣</label>
                        <input id="update_coupon_discount" class="form-control" name="coupon_discount" placeholder="打7折請填0.7；折10元請直接填10" data-parsley-trigger="change" required>
                    </div>
                    <div class="form-group">
                        <label>說明文字</label>
                        <input id="update_coupon_text" class="form-control" name="coupon_text" placeholder="" data-parsley-trigger="change" required>
                    </div>
                    <div class="form-group">
                        <label>狀態</label>
                        <select id="update_coupon_status" class="form-control" name="coupon_status">
                            <option value="0">正常</option>
                            <option value="1">停用</option>
                            <option value="2">刪除</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>限制類型</label>
                        <select id="update_coupon_type" class="form-control" name="coupon_type">
                            <option value="0">無限制</option>
                            <option value="1">日期限制</option>
                            <option value="2">次數限制</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>被使用的次數</label>
                        <input id="update_coupon_counter" class="form-control" name="coupon_counter" placeholder="" data-parsley-trigger="change" required>
                    </div>
                    <div class="form-group">
                        <label>使用次數上限</label>
                        <input id="update_coupon_limit" class="form-control" name="coupon_limit" placeholder="" data-parsley-trigger="change" required>
                    </div>
                    <div class="form-group">
                        <label>啟用日</label>
                        <input id="update_coupon_begin" class="form-control datepicker" name="coupon_begin" placeholder="" data-parsley-trigger="change" required>
                    </div>
                    <div class="form-group">
                        <label>過期日</label>
                        <input id="update_coupon_expire" class="form-control datepicker" name="coupon_expire" placeholder="" data-parsley-trigger="change" required>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
                <button type="button" class="btn btn-primary" id="btn_update_submit">更新</button>
            </div>
        </div>
    </div>
</div>

    <!-- jQuery -->
    <script src="<?php echo base_url();?>dist/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>dist/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url();?>dist/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url();?>dist/js/sb-admin-2.js"></script>

    <!-- Parsley JavaScript -->
    <script src="<?php echo base_url(); ?>dist/parsley/dist/parsley.min.js"></script>
    <script src="<?php echo base_url(); ?>dist/parsley/src/i18n/zh_tw.js"></script>

    <!-- pickadate JavaScript -->
    <script src="<?=base_url();?>dist/pickadate/picker.js"></script>
    <script src="<?=base_url();?>dist/pickadate/picker.date.js"></script>
    <script src="<?=base_url();?>dist/pickadate/legacy.js"></script>
    <script src="<?=base_url();?>dist/pickadate/translations/zh_TW.js"></script>


<script>
        $(document).ready(function() {

            $(document).on('click', ".btn-editor", function() {
                $("#update_coupon_id").val($(this).attr( 'update_coupon_id' ));
                $("#update_coupon_code").val($(this).attr( 'update_coupon_code' ));
                $("#update_coupon_discount_type").val($(this).attr( 'update_coupon_discount_type' ));
                $("#update_coupon_discount").val($(this).attr( 'update_coupon_discount' ));
                $("#update_coupon_text").val($(this).attr( 'update_coupon_text' ));
                $("#update_coupon_status").val($(this).attr( 'update_coupon_status' ));
                $("#update_coupon_type").val($(this).attr( 'update_coupon_type' ));
                $("#update_coupon_counter").val($(this).attr( 'update_coupon_counter' ));
                $("#update_coupon_limit").val($(this).attr( 'update_coupon_limit' ));
                $("#update_coupon_begin").val($(this).attr( 'update_coupon_begin' ));
                $("#update_coupon_expire").val($(this).attr( 'update_coupon_expire' ));
                $("#modal_update").modal("show");
            });

            var instance_from_create = $('#form_create').parsley();
            var instance_from_update = $('#form_update').parsley();

            $("#btn_create_submit").click(function () {
                if(instance_from_create.isValid()){
                    var URLs="coupon/create";
                    $.ajax({
                        url: URLs,
                        data: $( "#form_create" ).serialize(),
                        type:"POST",
                        dataType:'text',
                        success: function(msg){

                            console.log(msg);

                            var obj = jQuery.parseJSON(msg);
                            if(obj.result == "true"){
                                window.location.reload();
                            }else{
                                alert("新增失敗，請檢查是否有重複的折扣代碼");
                                $("#modal_create").modal("hide");
                            }
                        },
                        error:function(xhr, ajaxOptions, thrownError){
                            console.log(xhr.status);
                            console.log(thrownError);
                            alert('噢不，電腦可能有一點小感冒，我們正在盡全力搶修中...');
                        }
                    });
                }else{
                    $('#form_create').parsley().validate();
                }
            });

            $("#btn_update_submit").click(function () {
                if(instance_from_update.isValid()){
                    var URLs="coupon/update";
                    $.ajax({
                        url: URLs,
                        data: $( "#form_update" ).serialize(),
                        type:"POST",
                        dataType:'text',
                        success: function(msg){
                            console.log(msg);
                            var obj = jQuery.parseJSON(msg);
                            if(obj.result == "true"){
                                window.location.reload();
                            }else{
                                alert("更新失敗...");
                                $("#modal_update").modal("hide");
                            }
                        },
                        error:function(xhr, ajaxOptions, thrownError){
                            console.log(xhr.status);
                            console.log(thrownError);
                            alert('噢不，電腦可能有一點小感冒，我們正在盡全力搶修中...');
                        }
                    });
                }else{
                    $('#form_create').parsley().validate();
                }
            });

            $('.datepicker').pickadate({
                format: 'yyyy-mm-dd',
                formatSubmit: 'yyyy-mm-dd',
                closeOnSelect: true,
                closeOnClear: false,
                selectMonths: true,
                selectYears: true
            });

        });

        function toggleContent(id) {
            // Get the DOM reference
            var contentId = document.getElementById(id);
            contentId.style.display == "" ? contentId.style.display = "none" :
                contentId.style.display = "";
        }


    </script>

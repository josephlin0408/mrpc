</nav>
<style>
    .j_alert {
        padding: 5px;
        margin-bottom: 1px;
        border: 1px solid transparent;
        border-radius: 4px;
    }
</style>
<link rel="stylesheet" href="<?= base_url(); ?>dist/css/bootstrap-switch.css">
<link rel="stylesheet" href="<?= base_url(); ?>dist/pickadate/themes/default.css">
<link rel="stylesheet" href="<?= base_url(); ?>dist/pickadate/themes/default.date.css">
<div id="pickadate_container"></div>
<!-- Page Content -->
<!--<div id="page-wrapper" style="margin-left: 0px">-->
<div id="content" class="content">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">客戶名單</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <button class="btn btn-primary" id="btn-search-function">搜尋功能</i></button>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body" id="panel-search" style="display: none">
                    <div class="dataTable_wrapper">
                        <div class="table-responsive">

                            <table class="table table-hover" style="margin-bottom: 10px;">
                                <?php echo validation_errors(); ?>
                                <?php $attributes = array( 'id' => 'search');
                                echo form_open( base_url()."member/page/20/1", $attributes); ?>
                                <tr>
                                    <td><label>姓名</label></td><td>
                                        <input type='text' value='<?php if(isset($member_search))echo $member_search['fullname'] ?>' name='fullname' class='search_input form-control'></td>
                                    <td><label>客戶地址</label></td><td>
                                        <input type='text' value='<?php if(isset($member_search))echo $member_search['address'] ?>' name='address' class='search_input form-control'></td>

                                </tr>
                                <tr>
                                    <td><label>電子信箱</label></td><td>
                                        <input type='text' value='<?php if(isset($member_search))echo $member_search['account'] ?>' name='account' class='account_input search_input form-control'>
                                    </td>
                                    <td><label>會員手機</label></td><td>
                                        <input type='text' value='<?php if(isset($member_search))echo $member_search['cellphone'] ?>' name='cellphone' class='account_input search_input form-control'>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan='4'>
                                        <!--                                                    --><?//print_r($member_search)?>
                                        <input type="button" class='btn btn-primary' value='清除' id="reset">
                                        <input type='submit'  class='btn btn-primary'  value='搜尋'>
                                    </td>
                                </tr>
                                </form>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    資料表
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="data_table">
                            <thead>
                            <tr>
                                <th>帳號</th>
                                <th>姓名</th>
                                <th>手機</th>
                                <th>地址</th>
                                <th>加入日期</th>
                                <th>功能</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($member as $member_item): ?>

                                <tr class="odd gradeX">
                                    <td><?php echo $member_item['member_account']; ?></td>
                                    <td><?php echo $member_item['member_name'] ?></td>
                                    <td><?php echo $member_item['member_phone'] ?></td>
                                    <td><?php echo $member_item['member_address'] ?></td>
                                    <td><?php echo $member_item['member_create_stamp'] ?></td>
                                    <td><a class="btn btn-primary"
                                           href="<?php echo base_url();?>member/view/<?php echo $member_item['member_id'] ?>">編輯</a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.panel-body -->
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-lg-4">
                        </div>
                        <div class="col-lg-4">
                            每頁顯示
                            <select class="form-control" id="select_recorder_per_page" style="width: 70px;display: inline">
                                <option value="20" <?php if($recorder_per_page == 20)echo "selected"?>>20</option>
                                <option value="50" <?php if($recorder_per_page == 50)echo "selected"?>>50</option>
                                <option value="100" <?php if($recorder_per_page == 100)echo "selected"?>>100</option>
                                <option value="500" <?php if($recorder_per_page == 500)echo "selected"?>>500</option>
                                <option value="1000" <?php if($recorder_per_page == 1000)echo "selected"?>>1000</option>
                            </select>
                            筆資料
                        </div>
                        <div class="col-lg-4">
                            <div class=" div-pages">
                                <?php if(isset($count_all_results)) echo "全部".$count_all_results."筆資料，第"?>
                                <select class="form-control" id="select_page" style="width: 70px;display: inline">
                                    <?php
                                    if(isset($count_all_results)){
                                        $page_count = $count_all_results/$recorder_per_page;
                                        $page_count = ceil($page_count);
                                        for($i = 1;$i <= $page_count; $i++){
                                            if($i == $current_page){
                                                $selected = "selected";
                                            } else {
                                                $selected = "";
                                            }
                                            echo "<option value=".$i." ".$selected.">".$i."</option>";
                                        }}?>
                                </select>
                                <?php if(isset($page_count)) echo "頁，共".$page_count."頁"?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
</div>
<!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->

<!-- ================== BEGIN BASE JS ================== -->
<script src="<?= base_url();?>assets/plugins/jquery/jquery-1.9.1.min.js"></script>
<script src="<?= base_url();?>assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
<script src="<?= base_url();?>assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
<script src="<?= base_url();?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<!--[if lt IE 9]>
<script src="<?= base_url();?>assets/crossbrowserjs/html5shiv.js"></script>
<script src="<?= base_url();?>assets/crossbrowserjs/respond.min.js"></script>
<script src="<?= base_url();?>assets/crossbrowserjs/excanvas.min.js"></script>
<![endif]-->
<script src="<?= base_url();?>assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?= base_url();?>assets/plugins/jquery-cookie/jquery.cookie.js"></script>
<!-- ================== END BASE JS ================== -->

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="<?= base_url();?>assets/js/apps.min.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->

<script src="<?=base_url();?>dist/pickadate/picker.js"></script>
<script src="<?=base_url();?>dist/pickadate/picker.date.js"></script>
<script src="<?=base_url();?>dist/pickadate/legacy.js"></script>

</body>
</html>


<script>
    $(document).ready(function() {
        App.init();
        $("#btn-export-all").click(function () {
            var export_order_id = new Array();
            $('input[name="export"]:checkbox:checked').each(function (i) {
                export_order_id[i] = this.value;
            });
            if (export_order_id.length > 0) {
                if (export_order_id.length < 1600) {
                    var URLs = "<?=base_url()?>member/checkbox/all?data=" + export_order_id.toString();
                    window.open(URLs);
                } else {
                    alert("需要大量匯出嗎？請呼叫 Falcon替您服務 lol");
                }
            } else {
                alert("請至少選取一筆訂單");
            }
        });

        $("#btn-export").click(function () {
            var export_order_id = new Array();
            $('input[name="export"]:checkbox:checked').each(function (i) {
                export_order_id[i] = this.value;
            });
            if (export_order_id.length > 0) {
                if (export_order_id.length < 1600) {
                    var URLs = "<?=base_url()?>member/checkbox/export?data=" + export_order_id.toString();
                    window.open(URLs);
                } else {
                    alert("需要大量匯出嗎？請呼叫 Falcon替您服務 lol");
                }

            } else {
                alert("請至少選取一筆訂單");
            }
        });

        $("#checkbox-check-all").click(function () {
            if ($(this).is(':checked')) {
                $('input[name="export"]:checkbox').prop("checked", "checked");
            } else {
                $('input[name="export"]:checkbox').removeAttr("checked");
            }
        });

        $('#reset').click(function () {
            $('.search_input').attr("value", '');
        });

        $('#btn-search-function').click(function () {
            $("#panel-search").toggle();
        });

        $('.datepicker').pickadate({
            format: 'yyyy-mm-dd',
            formatSubmit: 'yyyy-mm-dd',
            closeOnSelect: true,
            closeOnClear: false
        });

        $("#select_recorder_per_page").change(function () {
            window.location.href = "<?=base_url()?>member/page/" + $(this).val() + "/1";
        });
        $("#select_page").change(function () {
            window.location.href = "<?=base_url()?>member/page/" + $("#select_recorder_per_page").val() + "/" + $(this).val();
        });
    });
</script>
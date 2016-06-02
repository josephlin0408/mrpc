</nav>
<link href="<?php echo base_url(); ?>dist/colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">

<!-- Page Content -->
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">更新產品顏色 <a class="btn btn-default" href="<?=base_url()?>product/color/list/<?=$product_idx?>">返回</a></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">

        <div class="col-lg-12">

            <div class="panel panel-default">

                <div class="panel-body">
                    <form method="post" accept-charset="utf-8" id="search" enctype="multipart/form-data">
                        <input type="hidden" name="idx" value="<?=$color_idx?>">
                        <table class="table table-hover" style="margin-bottom: 10px;">
                            <tbody>
                            <tr>
                                <td><label>顏色名稱</label></td>
                                <td>
                                    <input type="text" value="<?=isset($data['name']) ? $data['name'] : "" ?>" name="name" class="search_input form-control" required>
                                </td>
                            </tr>
                            <tr>
                                <td><label>色碼</label></td>
                                <td>
                                    <input type="text" value="<?=isset($data['code']) ? $data['code'] : "" ?>" name="code" class="search_input form-control code" required>
                                </td>
                            </tr>
                            <tr>
                                <td><label>庫存</label></td>
                                <td>
                                    <input type="text" value="<?=isset($data['instock']) ? $data['instock'] : "0" ?>" name="instock" class="search_input form-control" required>
                                </td>
                            </tr>
                            <tr>
                                <td><label>排序</label></td>
                                <td>
                                    <input type="text" value="<?=isset($data['priority']) ? $data['priority'] : "0" ?>" name="priority" class="search_input form-control" required>
                                </td>
                            </tr>
                            <tr>
                                <td><label>圖片 (可多次上傳)</label></td>
                                <td>
                                    <input type="file" name="userfile" >
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="submit" class="btn btn-primary" value="更新">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->

        <div class="col-lg-12">
            <div class="panel panel-default">

            <div class="panel-body">
            <?php

            foreach ($images as $key => $value) {

                echo "<div class='col-lg-3'>
                      <a onclick='return confirm(\"確定刪除嗎？\")' href='".base_url()."product/image/delete/".$product_idx."/".$color_idx."/".$value["idx"]."' class=\"close\">
                      <span aria-hidden=\"true\">x</span></a><img src='".base_url()."uploads/".$value["image"]."' class='img-responsive'></div>";

            }
            ?>
                </div>
            </div>
        </div>
        <!-- /.col-lg-12 -->

    </div>
</div>
</div>
<!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="<?php echo base_url(); ?>dist/bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url(); ?>dist/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="<?php echo base_url(); ?>dist/bower_components/metisMenu/dist/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url(); ?>dist/js/sb-admin-2.js"></script>

<!-- Parsley JavaScript -->
<script src="<?php echo base_url(); ?>dist/parsley/dist/parsley.min.js"></script>
<script src="<?php echo base_url(); ?>dist/parsley/src/i18n/zh_tw.js"></script>
<!-- Colorpicker JavaScript -->
<script src="<?php echo base_url(); ?>dist/colorpicker/js/bootstrap-colorpicker.min.js"></script>

<script>
    $(function(){
        $('.code').colorpicker();
    });
</script>
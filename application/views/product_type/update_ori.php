</nav>
<!-- Page Content -->
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">產品分類管理 <a class="btn btn-default" href="<?=base_url().$list_url?>">回列表</a></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">

        <div class="col-lg-12">

            <div id="create_status"></div>

            <div class="panel panel-default">
                <!-- /.panel-heading -->
                <div class="panel-body" id="panel-search">
                    <div class="dataTable_wrapper">
                        <div class="table-responsive">
                            <form method="post" action="" accept-charset="utf-8" id="search">
                                <input type="hidden" name="idx" value="<?=$data['idx']?>">
                                <table class="table table-hover" style="margin-bottom: 10px;">
                                    <input name="search" type="hidden" value="1">
                                    <tbody>
                                    <tr>
                                        <td><label>分類名稱</label></td>
                                        <td>
                                            <input type="text" value="<?=isset($data['name']) ? $data['name'] : "" ?>" name="name" class="search_input form-control" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>分類排序</label></td>
                                        <td>
                                            <input type="text" value="<?=isset($data['order']) ? $data['order'] : "" ?>" name="order" class="search_input form-control" required>
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
                </div>
                <!-- /.panel-body -->
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

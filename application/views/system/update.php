</nav>
<!-- Page Content -->
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">系統設定</h1>
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
                            <form method="post" action="" accept-charset="utf-8" enctype="multipart/form-data">
                                <input type="hidden" name="idx" value="<?=$data['idx']?>">
                                <table class="table table-hover" style="margin-bottom: 10px;">
                                    <input name="search" type="hidden" value="1">
                                    <tbody>
                                    <tr>
                                        <td><label>國內運費</label></td>
                                        <td>
                                            <input type="text" value="<?=isset($data['shipping_fee_tw']) ? $data['shipping_fee_tw'] : "" ?>" name="shipping_fee_tw" class="search_input form-control" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>國內免運門檻</label></td>
                                        <td>
                                            <input type="text" value="<?=isset($data['shipping_fee_tw_free_condition']) ? $data['shipping_fee_tw_free_condition'] : "" ?>" name="shipping_fee_tw_free_condition" class="search_input form-control" required>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><label>外島運費</label></td>
                                        <td>
                                            <input type="text" name="shipping_fee_il" class="form-control" value="<?=isset($data['shipping_fee_il']) ? $data['shipping_fee_il'] : "0" ?>" required>
                                        </td>
                                    </tr>
<!--                                    <tr>-->
<!--                                        <td><label>國外運費</label></td>-->
<!--                                        <td>-->
<!--                                            <input type="text" name="shipping_fee_as" class="form-control" value="--><?//=isset($data['shipping_fee_as']) ? $data['shipping_fee_as'] : "0" ?><!--" required>-->
<!--                                        </td>-->
<!--                                    </tr>-->
                                    <tr>
                                        <td><label>貨到付款服務費</label></td>
                                        <td>
                                            <input type="text" name="cod_service_fee" class="form-control" value="<?=isset($data['cod_service_fee']) ? $data['cod_service_fee'] : "0" ?>" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>優先出貨服務費</label></td>
                                        <td>
                                            <input type="text" name="priority_service_fee" class="form-control" value="<?=isset($data['priority_service_fee']) ? $data['priority_service_fee'] : "0" ?>" required>
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

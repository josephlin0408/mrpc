</nav>

<!-- Page Content -->
<div id="page-wrapper" style="margin-left: 0px">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">檔案上傳</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?php $enum_array = array('invoice'=>"發票號碼" , 'tracking'=>'黑貓追蹤碼')?>
                    <?=$enum_array[$target_url]?> .csv 格式上傳
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <div class="table-responsive">
                            <?php echo $error;?>
                            <?php echo form_open_multipart('upload/'.$target_url);?>
                            <div class="form-group">
                                <input id="file" type="file" name="userfile" size="20" />
                            </div>
                            <div class="form-group">
                                <input type="submit" value="上傳" class="btn btn-primary"/>
                            </div>
                            </form>
                        </div>
                    </div>
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

<!-- jQuery -->
<script src="<?php echo base_url();?>dist/bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url();?>dist/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="<?php echo base_url();?>dist/bower_components/metisMenu/dist/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url();?>dist/js/sb-admin-2.js"></script>

<!-- DataTables JavaScript -->
<script src="<?php echo base_url();?>dist/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>

<script src="<?php echo base_url();?>dist/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

<script>
    $(document).ready(function() {

    });



</script>



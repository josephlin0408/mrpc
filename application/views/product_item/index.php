
</nav>

<!-- Page Content -->
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">產品庫存 <a class="btn btn-default" href="<?=base_url()?>product/item/list/20/1/">回產品管理</a></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">

                <div class="panel-heading">
                    資料列表
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <?php if(count($data)>0) { ?>
                            <form method="post">
                            <table class="table table-striped table-bordered table-hover" id="dataTables">
                                <thead>
                                <?php
                                $temp_name = "";
                                foreach ($data as $single):
                                    echo "<tr>";
                                    foreach ($single as $key => $value):
                                        switch($key){
                                            case 'product_color_idx':
                                                echo "<td style='display: none'>ID</td>";
                                                break;
                                            case 'name':
                                                echo "<td>產品名稱</td>";
                                                break;
                                            case 'product_color_name':
                                                echo "<td>顏色名稱</td>";
                                                break;
                                            case 'product_color_instock':
                                                echo "<td>產品庫存</td>";
                                                break;
                                        }
                                    endforeach;?>
                                    <?php echo "</tr>";
                                break;
                                endforeach;?>
                                </thead>
                                <tbody>
                                <?php
                                $temp_name = "";
                                foreach ($data as $single):
                                    echo "<tr>";
                                    foreach ($single as $key => $value):
                                        switch($key){
                                            case 'product_color_idx':
                                                echo "<td style='display: none'><input type='hidden' name='idx[]' value='".$value."'></td>";
                                                break;
                                            case 'name':
                                                if($value != $temp_name) {
                                                    echo "<td>".$value."</td>";
                                                    $temp_name = $value;
                                                }else{
                                                    $temp_name = $value;
                                                    echo "<td></td>";
                                                }
                                                break;
                                            case 'product_color_name':
                                                echo "<td>".$value."</td>";
                                                break;
                                            case 'product_color_instock':
                                                echo "<td><input type='text' class='form-control' name='instock[]' value='".$value."'></td>";
                                                break;
                                        }
                                    endforeach;?>
                                    <?php echo "</tr>";
                                endforeach;?>
                                </tbody>
                            </table>
                                <input type="submit" class="btn btn-primary btn-block" value="全部儲存">
                            </form>
                        <?php }else{

                            echo "查無資料";

                        } ?>
                    </div>
                </div>
            </div>
            <!-- /.panel -->
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

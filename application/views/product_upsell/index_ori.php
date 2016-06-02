
</nav>
<!-- Page Content -->
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">產品加購 <a class="btn btn-default" href="<?=base_url()?>product/item/update/<?=$product_idx?>">回產品編輯</a>  <a class="btn btn-primary" href="<?=base_url()?>product/upsell/create/<?=$product_idx?>">新增</a></h1>
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
                        <?php if(count($data)>0){ ?>
                            <table class="table table-striped table-bordered table-hover" id="dataTables">
                                <thead>
                                <tr>
                                    <?php
                                    $key_i18n = array('idx' => "序號",
                                        '_upsell_product' => "加購產品名稱",
                                        'name' => "產品名稱",
                                        'enable' => "是否啟用",
                                        'create_time' => "建立時間",
                                    );

                                    foreach ($data[0] as $key => $value):
                                        switch($key){
                                            case '_upsell_product':
                                            case 'name':
                                            case 'enable':
                                            case 'create_time':
                                                echo "<th>".$key_i18n[$key]."</th>";
                                                break;
                                        }
                                        ?>
                                    <?php endforeach; ?>
                                    <th>選項</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($data as $single):
                                    echo "<tr>";
                                    foreach ($single as $key => $value):
                                        switch($key){
                                            case '_upsell_product':
                                                echo "<td>".$id_vs_name[$value]."</td>";
                                                break;
                                            case 'name':
                                            case 'create_time':
                                                echo "<td>".$value."</td>";
                                                break;
                                            case 'enable':
                                                if($value==0)echo "<td>停用</td>";
                                                if($value==1)echo "<td>啟用</td>";
                                                break;
                                        }
                                    endforeach;?>
                                    <td style="width: 350px">
                                        <a class='btn btn-default' onclick='return confirm("確定停用嗎？")' href='<?=base_url()?>product/upsell/delete/<?=$product_idx?>/<?=$single['idx']?>'>停用</a>
                                    </td>
                                    <?php echo "</tr>";
                                endforeach;?>
                                </tbody>
                            </table>
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

<!-- pickadate JavaScript -->
<script src="<?=base_url();?>dist/pickadate/picker.js"></script>
<script src="<?=base_url();?>dist/pickadate/picker.date.js"></script>
<script src="<?=base_url();?>dist/pickadate/legacy.js"></script>
<script src="<?=base_url();?>dist/pickadate/translations/zh_TW.js"></script>


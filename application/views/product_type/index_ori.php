
</nav>
<!-- Page Content -->
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">產品分類 <a class="btn btn-default" href="<?=base_url()?>product/item/list/20/1">產品列表</a> <a class="btn btn-primary" href="<?=base_url()?>product/type/create">新增分類</a> </h1>
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
                                        'name' => "分類名稱",
                                        'order' => "排序",
                                        'enable' => "是否啟用",
                                        'create_time' => "建立時間",
                                    );

                                    foreach ($data[0] as $key => $value):
                                        switch($key){
                                            case 'name':
                                            case 'order':
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
                                <?php
                                foreach ($data as $single):
                                    echo "<tr>";
                                    foreach ($single as $key => $value):
                                        switch($key){
                                            case 'name':
                                            case 'create_time':
                                            case 'order':
                                                echo "<td>".$value."</td>";
                                                break;
                                        }
                                    endforeach;?>
                                    <td style="width: 350px">
                                        <a class="btn btn-default" href="<?=base_url()?>product/type/update/<?=$single['idx']?>">編輯</a>
                                        <a class='btn btn-default' onclick='return confirm("確定刪除嗎？")' href='<?=base_url()?>product/type/delete/<?=$single['idx']?>'>刪除</a>
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

<!-- Customize JavaScript -->
<!--<script src="--><?php //echo base_url(); ?><!--dist/js/member.js"></script>-->

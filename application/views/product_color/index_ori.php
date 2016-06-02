</nav>
<!-- Page Content -->
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">產品顏色管理 <a class="btn btn-default" href="<?=base_url()?>product/item/update/<?=$id?>">回產品管理</a> <a class="btn btn-primary" href="<?=base_url()?>product/color/create/<?=$id?>">新增</a></h1>
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
                                        '_product' => "產品編號",
                                        'priority' => "排序",
                                        'name' => "顏色名稱",
                                        'instock' => "庫存量",
                                        'code' => "顏色代碼",
                                        'images' => "圖片",
                                    );

                                    foreach ($data[0] as $key => $value):
                                        switch($key){
                                            case 'priority':
                                            case 'name':
                                            case 'code':
                                            case 'instock':
                                            case 'images':
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
                                            case 'priority':
                                            case 'instock':
                                            case 'name':
                                                echo "<td>".$value."</td>";
                                                break;
                                            case 'code':
                                                echo "<td>"."<div style='background-color:$value;width:10px;height:10px;border:1px solid #000'></div>".$value."</td>";
                                                break;
                                            case 'images':
                                                echo "<td>";
                                                foreach ($value as $item_key => $item_value) {
                                                    echo "<img src='".base_url()."uploads/".$item_value['image']."' style='width: 50px'>";
                                                }
                                                echo "</td>";
                                                break;
                                        }
                                    endforeach;?>
                                    <td style="width: 350px">
                                        <a class="btn btn-default" href="<?=base_url()?>product/color/update/<?=$id?>/<?=$single['idx']?>">編輯</a>
                                        <a class='btn btn-default' onclick='return confirm("確定刪除嗎？")' href='<?=base_url()?>product/color/delete/<?=$id?>/<?=$single['idx']?>'>停用</a>
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

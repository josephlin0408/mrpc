<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="<?=base_url()?>dashboard">Home 首頁</a></li>
        <li><a href="<?=base_url()?>product/item/list/20/1">Product 產品</a></li>
        <li><a href="<?=base_url()?>product/item/update/<?=$id?>">Item 單品</a></li>
        <li class="active">Color 顏色</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Product Color <small>產品顏色</small></h1>
    <div class="email-btn-row hidden-xs">
        <a href="<?=base_url()?>product/item/update/<?=$id?>" class="btn btn-sm btn-inverse"><i class="fa fa-bars m-r-5"></i> Product 產品</a>
        <a href="<?=base_url()?>product/color/create/<?=$id?>" class="btn btn-sm btn-inverse"><i class="fa fa-plus m-r-5"></i> New 新增</a>
    </div>
    <!-- end page-header -->

    <!-- begin row -->
    <div class="row">
        <div class="col-md-12">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="table-basic-7">
                <div class="panel-heading">
                    <h4 class="panel-title">列表</h4>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <?php if(count($data)>0){ ?>
                            <table class="table">
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
                                                echo "<td>"."<div style='background-color:$value;width:10px;height:10px;border:1px solid #000;'></div>".$value."</td>";
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
                                    <td>
                                        <a class="btn btn-success btn-sm" href="<?=base_url()?>product/color/update/<?=$id?>/<?=$single['idx']?>">編輯</a>
                                        <a class='btn btn-default btn-sm' onclick='return confirm("確定刪除嗎？")' href='<?=base_url()?>product/color/delete/<?=$id?>/<?=$single['idx']?>'>停用</a>
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
            <!-- end panel -->
        </div>
        <!-- end col-12 -->
    </div>
    <!-- end row -->
</div>
<!-- end #content -->

<!-- begin scroll to top btn -->
<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
<!-- end scroll to top btn -->
</div>
<!-- end page container -->

<!-- ================== BEGIN BASE JS ================== -->
<script src="<?=base_url()?>assets/plugins/jquery/jquery-1.9.1.min.js"></script>
<script src="<?=base_url()?>assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
<script src="<?=base_url()?>assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
<script src="<?=base_url()?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<!--[if lt IE 9]>
<script src="<?=base_url()?>assets/crossbrowserjs/html5shiv.js"></script>
<script src="<?=base_url()?>assets/crossbrowserjs/respond.min.js"></script>
<script src="<?=base_url()?>assets/crossbrowserjs/excanvas.min.js"></script>
<![endif]-->
<script src="<?=base_url()?>assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?=base_url()?>assets/plugins/jquery-cookie/jquery.cookie.js"></script>
<!-- ================== END BASE JS ================== -->

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="<?=base_url()?>assets/js/apps.min.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->

<script>
    $(document).ready(function() {
        App.init();
    });
</script>
</body>
</html>
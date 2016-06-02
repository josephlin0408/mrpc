<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="<?=base_url()?>dashboard">Home 首頁</a></li>
        <li><a href="<?=base_url()?>product/item/list/20/1">Product list 產品列表</a></li>
        <li><a href="<?=base_url()?>product/item/update/<?=$product_idx?>">Product 產品</a></li>
        <li class="active">Upsell 加購</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Product Upsell <small>產品加購</small></h1>
    <div class="email-btn-row hidden-xs">
        <a href="<?=base_url()?>product/item/update/<?=$product_idx?>" class="btn btn-sm btn-inverse"><i class="fa fa-bars m-r-5"></i> Product 產品</a>
        <a href="<?=base_url()?>product/upsell/create/<?=$product_idx?>" class="btn btn-sm btn-inverse"><i class="fa fa-plus m-r-5"></i> New 新增</a>
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
                                        <a class='btn btn-sm btn-default' onclick='return confirm("確定停用嗎？")' href='<?=base_url()?>product/upsell/delete/<?=$product_idx?>/<?=$single['idx']?>'>停用</a>
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
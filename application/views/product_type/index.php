<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="<?=base_url()?>dashboard">Home 首頁</a></li>
        <li><a href="<?=base_url()?>product/item/list/20/1">Product 產品</a></li>
        <li class="active">Types 分類</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Product Types Management <small>產品分類管理</small></h1>
    <div class="email-btn-row hidden-xs">
        <a href="<?=base_url()?>product/type/create" class="btn btn-sm btn-inverse"><i class="fa fa-plus m-r-5"></i> New 新增</a>
    </div>
    <!-- end page-header -->

    <!-- begin row -->
    <div class="row">
        <div class="col-md-6">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="table-basic-7">
                <div class="panel-heading">
                    <h4 class="panel-title">分類列表</h4>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <?php if(count($data)>0){ ?>
                        <table class="table">
                            <thead>
                            <tr>
                                <?php
                                $key_i18n = array('idx' => "序號",
                                    'name' => "分類名稱",
                                    'order' => "排序",
                                    'enable' => "是否啟用",
                                    'create_time' => "建立時間",
                                );
                                $enable_array = array('0' => "否",
                                    '1' => "是"
                                );

                                foreach ($data[0] as $key => $value):
                                    switch($key){
                                        case 'name':
                                        case 'order':
                                        case 'enable':
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
                                        case 'order':
                                            echo "<td>".$value."</td>";
                                            break;
                                        case 'enable':
                                            echo "<td>".$enable_array[$value]."</td>";
                                            break;
                                    }
                                endforeach;?>
                                <td style="min-width: 70px">
                                    <a class="btn btn-primary btn-sm" href="<?=base_url()?>product/type/update/<?=$single['idx']?>">編輯</a>

                                    <a class='btn btn-default btn-sm' onclick='return confirm("確定停用嗎？")' href='<?=base_url()?>product/type/delete/<?=$single['idx']?>'>停用</a>
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
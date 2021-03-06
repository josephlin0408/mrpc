<!-- begin #content -->
<link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/style.css"/>
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="active">文章主類別</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">article category main 文章主類別
        <small>
            <label for="system_hint">系統提示：</label>
            <input type="text" value="" readonly id="system_hint"/>
        </small>
    </h1>
    <div class="email-btn-row hidden-xs">
        <a href="<?php echo base_url('article/category/main/add');?>">
            <button class="btn btn-success" type="button"><i class="fa fa-plus m-r-5"></i>Create 新增</button>
        </a>
    </div>
    <?php $attr='style="margin:0px;display: inline"';?>
    <!-- end page-header -->

    <!-- begin row -->
    <div class="row">
        <!-- begin col-12 -->
        <div class="col-md-12 ui-sortable">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="table-basic-7">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">列表</h4>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-condensed"
                               style="background-color:#FFFFFF;">
                            <tr <?php if(!empty($category_main))echo'hidden="hidden"';?>> <th colspan="7">查無資料！</th> </tr>
                            <tr class="active" <?php if(empty($category_main))echo'hidden="hidden"';?>>
                                <?php $font_size="font-size:14px;";?>
                                <th><i class="fa fa-list-ol"></i>&nbsp;序號</th>
                                <th><i class="fa fa-book fa-fw"></i>&nbsp;名稱</th>
                                <th><i class="fa fa-cubes"></i>&nbsp;排序</th>
                                <th><i class="fa fa-ellipsis-h"></i>&nbsp;顯示狀態</th>
                                <th><i class="fa fa-ellipsis-h"></i>&nbsp;URL標籤</th>
                                <th><i class="fa fa-cog"></i>&nbsp;維護</th>
                            </tr>
                            <?php $index=1;if(isset($category_main))if(is_array($category_main))foreach($category_main as $unit):;?>
                                <tr>
                                    <td><?=$index;?></td>
                                    <td><?=$unit['acm_name'];?></td>
                                    <td><?=$unit['acm_sort_id'];?></td>
                                    <td>
                                        <?php
                                        switch($unit['acm_status']){
                                            case(0):
                                                echo '顯示';
                                                break;
                                            case(1):
                                                echo '不顯示';
                                                break;
                                        }
                                        ;?>
                                    </td>
                                    <td>tw/category/<?=$unit['acm_id'];?></td>
                                    <td>
                                        <a class="btn btn-success btn-sm" href="<?php echo base_url('article/category/main/update/'.$unit['acm_id']);?>">編輯</a>
                                        <a class="btn btn-success btn-sm" href="<?php echo base_url('article/category/branch/admin/'.$unit['acm_id']);?>">次分類</a>
                                    </td>
                                </tr>
                                <?php $index++;endforeach;?>
                        </table>
                    </div>
                </div><!-- end panel -->
            </div><!-- end col-12 -->
        </div><!-- end row -->
    </div><!-- end #content -->

    <!-- begin scroll to top btn -->
    <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
    <!-- end scroll to top btn -->
</div><!-- end page container -->
<script>
    function contentShow(id){
        $('#'+id).toggle('','',true);
    }
</script>
<?php $this->load->view('templates/footer_color');?>

</body>
</html>
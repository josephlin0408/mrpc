<!-- begin #content -->
<link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/style.css"/>
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="active">文章次類別</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Article category main 文章次類別
        <small>
            <label for="system_hint">系統提示：</label>
            <input type="text" value="" readonly id="system_hint"/>
        </small>
    </h1>
    <div class="email-btn-row hidden-xs">
        <a class="btn btn-inverse" href="<?php echo base_url('article/category/main/admin');?>"><i class="fa fa-bars"></i> 返回主類別列表</a>
        <a class="btn btn-success" href="<?php echo base_url('article/category/branch/add/'.$acb_acm_id);?>"><i class="fa fa-plus m-r-5"></i>Create 新增</a>
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
                    <h4 class="panel-title">列表 - <?php if(isset($main_data))echo $main_data['acm_name'];?></h4>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-condensed"
                               style="background-color:#FFFFFF;">
                            <tr <?php if(!empty($category_branch))echo'hidden="hidden"';?>> <th colspan="7">查無資料！</th> </tr>
                            <tr class="active" <?php if(empty($category_branch))echo'hidden="hidden"';?>>
                                <?php $font_size="font-size:14px;";?>
<!--                                <th><i class="fa fa-list-ol"></i>&nbsp;序號</th>-->
                                <th><i class="fa fa-book fa-fw"></i>&nbsp;名稱</th>
                                <th><i class="fa fa-cubes"></i>&nbsp;排序</th>
                                <th><i class="fa fa-ellipsis-h"></i>&nbsp;顯示狀態</th>
                                <th><i class="fa fa-cog"></i>&nbsp;維護</th>
                            </tr>
                            <?php $index=1;if(isset($category_branch))if(is_array($category_branch))foreach($category_branch as $unit):;?>
                                <tr>
<!--                                    <td>--><?//=$index;?><!--</td>-->
                                    <td><?=$unit['acb_name'];?></td>
                                    <td><?=$unit['acb_sort_id'];?></td>
                                    <td>
                                        <?php
                                        switch($unit['acb_status']){
                                            case(0):
                                                echo '顯示';
                                                break;
                                            case(1):
                                                echo '不顯示';
                                                break;
                                        }
                                        ;?>
                                    </td>
                                    <td>
                                        <a href="<?php echo base_url('article/category/branch/update/'.$acb_acm_id.'/'.$unit['acb_id']);?>" class="btn btn-success btn-sm">編輯</a>
                                        <a href="<?php echo base_url('article/category/branch/insert/article/'.$acb_acm_id.'/'.$unit['acb_id']);?>" class="btn btn-success btn-sm">加入文章</a>
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
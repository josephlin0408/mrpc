<?php $attr='style="margin:0px;display: inline"';?>
<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="active">橫幅圖片管理</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Banner Image Management <small>橫幅圖片管理</small></h1>
    <!-- end page-header -->
    <div class="email-btn-row hidden-xs">
        <a href="<?=base_url()?>article" class="btn btn-sm btn-inverse"><i class="fa fa-bars m-r-5"></i> 回文章列表</a>
        <a href="<?=base_url()?>article/banner/upload/<?=$article_hash_id?>" class="btn btn-sm btn-success"><i class="fa fa-upload m-r-5"></i> 上傳橫幅</a>
    </div>
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
                        <table class="table table-striped table-bordered table-hover">
                            <tr>
                                <th style="width:40%">圖片</th>
                                <th style="width:20%">狀態</th>
                                <th>維護</th>
                            </tr>
                            <?php foreach($image_list as $unit): if($unit['image_status']==2)continue;?>
                            <tr>
                                <td>
                                    <center>
                                        <img src="<?php echo base_url().$unit['image_url'];?>"
                                             class="img-thumbnail" style="height: 200px;">
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <?php
                                        switch($unit['image_status']){
                                            case 0:
                                                echo '啟用';
                                                break;
                                            case 1:
                                                echo '<b style="color:red">停用</b>';
                                                break;
                                            default:
                                                echo '啟用';
                                                break;
                                        }?>
                                    </center>
                                </td>
                                <td>
                                    <a href="<?=base_url()?>article/banner/switch/<?=$article_hash_id?>/<?=$unit['image_id']?>" class="btn btn-success">變更狀態</a>
                                    <a href="<?=base_url()?>article/banner/disable/<?=$article_hash_id?>/<?=$unit['image_id']?>" class="btn btn-default">刪除</a>
                                </td>
                            </tr>
                            <?php endforeach;?>
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

<?php $this->load->view('templates/footer_color');?>

</body>
</html>
<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="active">語系管理</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Off-line store 實體商店
        <small class="hidden">
            <label for="system_hint">系統提示：</label>
            <input type="text" value="" readonly id="system_hint"/>
        </small>
    </h1>
    <div class="email-btn-row hidden-xs">
        <a href="<?php echo base_url('offline/store/add');?>">
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
                            <tr <?php if(!empty($ofs_store))echo'hidden="hidden"';?>> <th colspan="7">查無資料！</th> </tr>
                            <tr class="active" <?php if(empty($ofs_store))echo'hidden="hidden"';?>>
                                <?php $font_size="font-size:14px;";?>
                                <th><i class="fa fa-list-ol"></i>&nbsp;序號</th>
                                <th><i class="fa fa-list-ol"></i>&nbsp;圖示</th>
                                <th><i class="fa fa-book fa-fw"></i>&nbsp;商店名稱</th>
                                <th><i class="fa fa-cubes"></i>&nbsp;商店地址</th>
                                <th><i class="fa fa-list-alt"></i>&nbsp;說明</th>
                                <th><i class="fa fa-ellipsis-h"></i>&nbsp;顯示狀態</th>
                                <th><i class="fa fa-cog"></i>&nbsp;維護</th>
                            </tr>
                            <?php $index=1;foreach($ofs_store as $unit):;?>
                            <tr>
                                <td><?=$index;?></td>
                                <td>
                                    <center>
                                        <?php if(!empty($unit['ofs_source']))echo '<img src="' . base_url() . 'uploads/' . $unit['ofs_source'].'" '.'class="img-thumbnail img_size">';?>
                                    </center>
                                </td>
                                <td><?=$unit['ofs_name'];?></td>
                                <td><?=$unit['ofs_addr'];?></td>
                                <td><?=$unit['ofs_desc'];?></td>
                                <td>
                                    <?php
                                        switch($unit['ofs_status']){
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
                                    <a href="<?php echo base_url('offline/store/update/'.$unit['ofs_id']);?>" style="color: black">
                                        <button class="btn btn-success btn-sm">編輯</button>
                                    </a>
                                    <a href="<?php echo base_url('offline/store/delete/'.$unit['ofs_id']);?>" style="color: black">
                                        <button  class="btn btn-default btn-sm" onclick="return confirm('確定刪除嗎？')">刪除</button>
                                    </a>
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
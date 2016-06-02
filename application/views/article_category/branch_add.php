<!-- begin #content -->
<link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/style.css"/>
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="active">文章次類別</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Article category branch 文章次類別新增
        <small>
            <label for="system_hint">系統提示：</label>
            <input type="text" value="<?=$acb_acm_id;?>" readonly id="system_hint"/>
        </small>
    </h1>
    <?php $attr='style="margin:0px;display: inline"';?>
    <?php $font_size="font-size:14px;";?>
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
                        <?php $attr_pic = 'style="margin:0px;display: inline" enctype="multipart/form-data"';?>
                        <?php echo form_open('article/category/branch/add/perform',$attr_pic);?>
                        <table class="table table-bordered table-condensed" style="background-color:#FFFFFF;">
                            <tr class="active">
                                <th>項目</th>
                                <th>內容</th>
                            </tr>
                            <tr>
                                <td><i class="fa fa-book fa-fw"></i>&nbsp;次類別名稱</td>
                                <td><input type="text" name="acb_name" class="form-control" required="required"/></td>
                            </tr>
                            <tr>
                                <td><i class="fa fa-cubes"></i>&nbsp;排序</td>
                                <td><input type="number" name="acb_sort_id" class="form-control" required="required" max="99" min="0" value="0"/></td>
                            </tr>
                            <tr>
                                <td><i class="fa fa-ellipsis-h"></i>&nbsp;顯示狀態</td>
                                <td>
                                    <select name="acb_status" id="" class="form-control">
                                        <option value="0">顯示</option>
                                        <option value="1">不顯示</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <center>
                                        <input type="hidden" name="acb_acm_id" value="<?=$acb_acm_id;?>"/>
                                        <input type="submit" value="確定新增"/>
                                        <button type="button" onclick="window.location.href = '<?php echo base_url('article/category/branch/admin/'.$acb_acm_id);?>';">返回</button>
                                    </center>
                                </td>
                            </tr>
                        </table>
                        <?php echo form_close();?>
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
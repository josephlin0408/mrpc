<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="active">網路商城</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">online store 網路商城
        <small class="hidden">
            <label for="system_hint">系統提示：</label>
            <input type="text" value="" readonly id="system_hint"/>
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
                        <?php echo form_open('online/store/add/perform',$attr_pic);?>
                        <table class="table table-bordered table-condensed" style="background-color:#FFFFFF;">
                            <tr class="active">
                                <th>項目</th>
                                <th>內容</th>
                            </tr>
                            <tr>
                                <td><i class="fa fa-book fa-fw"></i>&nbsp;名稱</td>
                                <td><input type="text" name="os_name" class="form-control" required="required"/></td>
                            </tr>
                            <tr>
                                <td><i class="fa fa-cubes"></i>&nbsp;連結</td>
                                <td><input type="text" name="os_link" class="form-control" required="required"/></td>
                            </tr>
                            <tr>
                                <td><i class="fa fa-list-ol"></i>&nbsp;圖示</td>
                                <td>
                                    <input type="file" class="form-control" name="os_source"/>
                                </td>
                            </tr>
                            <tr>
                                <td><i class="fa fa-ellipsis-h"></i>&nbsp;顯示狀態</td>
                                <td>
                                    <select name="os_status" id="" class="form-control">
                                        <option value="0">顯示</option>
                                        <option value="1">不顯示</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <center>
                                        <input class="btn btn-success btn-sm" type="submit" value="確定新增"/>
                                        <button class="btn btn-default btn-sm" type="button" onclick="window.location.href = '<?php echo base_url('online/store/admin');?>';">返回</button>
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
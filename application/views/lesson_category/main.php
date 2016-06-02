<!-- begin #content -->
<link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/style.css"/>
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="active">課程類別</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">lesson category 課程類別
    </h1>
    <div class="email-btn-row hidden-xs">
        <button class="btn btn-success" type="button" onclick="show_add_table()">
            <i class="fa fa-plus m-r-5"></i>Create 新增
        </button>
        <script>
            function show_add_table(){
                $('#add_table').slideToggle('','',true);
            }
        </script>
        <?php echo form_open('lesson/category/add');?>
        <table class="table table-bordered table-condensed"
               style="background-color:#FFFFFF;display:none" id="add_table" >
            <tr>
                <th>名稱</th>
                <th>狀態</th>
                <th>功能</th>
            </tr>
            <tr>
                <td>
                    <input type="text" name="lesson_category_name"/>
                </td>
                <td>
                    <select name="lesson_status" id="">
                        <option value="0">啟用</option>
                        <option value="1">停用</option>
                    </select>
                </td>
                <td>
                    <input type="submit"/>
                </td>
            </tr>
        </table>
        <?php echo form_close();?>
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
                                <th><i class="fa fa-ellipsis-h"></i>&nbsp;顯示狀態</th>
                                <th><i class="fa fa-cog"></i>&nbsp;維護</th>
                            </tr>
                            <?php $index=1;if(isset($category_main))if(is_array($category_main))foreach($category_main as $unit):;?>
                                <?php echo form_open('lesson/category/update');?>
                                <tr>
                                    <td><?=$index;?></td>
                                    <td><input type="text"  class="form-control" value="<?=$unit['lesson_category_name'];?>" name="lesson_category_name"/></td>
                                    <td>
                                        <select name="lesson_status"  class="form-control">
                                            <option value="0">顯示</option>
                                            <option value="1" <?php if($unit['lesson_status']==1)echo'selected';?>>不顯示</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="submit" value="確定編輯"/>
                                        <?php echo form_hidden('lesson_category_id',$unit['lesson_category_id']);?>
                                    </td>
                                </tr>
                                <?php echo form_close();?>
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
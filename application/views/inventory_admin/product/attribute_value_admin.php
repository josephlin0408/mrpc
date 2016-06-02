<?php $attr='style="margin:0px;display: inline"';?>
<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="<?=base_url()?>inventory/product/category/admin">類別管理</a></li>
        <li><a href="<?=base_url()?>inventory/product/model/admin">模組管理</a></li>
        <li><a href="<?=base_url()?>inventory/product/attribute/admin">屬性管理</a></li>
        <li class="active">屬性值管理</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Attribute Value Management <small>模組屬性值管理 (<?php echo $attr_type_name_id[$attr_type_id];?>)</small></h1>
    <div class="email-btn-row hidden-xs">
        <button class="btn  btn-success" onclick="$('#add_bar').toggle();" ><i class="fa fa-plus m-r-5"></i> Create 新增</button>
        <a href="<?=base_url().'inventory/product/model/admin'?>" class="btn btn-inverse">回模組列表</a>
        <a href="<?=base_url().'inventory/product/attribute/admin'?>" class="btn btn-inverse">回屬性列表</a>
    </div>
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
                        <table class="table table-striped table-bordered table-hover">
                            <tr>
                                <th>名稱 <small class="j-question-circle"><i class="fa fa-question-circle" aria-hidden="true"></i> 點擊可編輯</small></th>
                                <th style="width: 20%">維護</th>
                            </tr>
                            <?php echo form_open('inventory/product/attribute/value/admin',$attr);?>
                            <tr id="add_bar" bgcolor="#f5f5dc" style="display: none">
                                <td>
                                    <input type="text" value="" class="form-control" name="add_attr_value_name" required=""/>
                                </td>
                                <td>
                                    <input type="hidden" name="SWITCH" value="add_attr_val"/>
                                    <input type="hidden" name="attr_type_id" value="<?php echo $attr_type_id;?>"/>
                                    <input type="hidden" name="attr_model_id" value="<?php echo $attr_model_id;?>"/>
                                    <input class="btn btn-primary btn-sm btn-block" type="submit" value="確定"/>
                                </td>
                            </tr>
                            </form>
                            <?php foreach($doc as $unit):;?>
                                <tr id="list_bar<?php echo $unit['attr_id'];?>">
                                    <td onclick="$('#edit_bar<?php echo $unit['attr_id'];?>').toggle('','',true);$('#edit_val_input_<?php echo $unit['attr_id'];?>').focus().val('<?php echo $unit['attr_value'];?>')"><?php echo $unit['attr_value'];?></td>
                                    <td><button class="btn btn-success btn-sm" onclick="$('#edit_bar<?php echo $unit['attr_id'];?>').toggle('','',true);$('#edit_val_input_<?php echo $unit['attr_id'];?>').focus().val('<?php echo $unit['attr_value'];?>')">編輯</button></td>
                                </tr>
                            <?php echo form_open('inventory/product/attribute/value/admin');?>
                                <tr id="edit_bar<?php echo $unit['attr_id'];?>" bgcolor="#f5f5dc" style="display: none">
                                    <td>
                                        <input type="text" name="update_attr_val_name" value="" required="required" class="form-control" id="edit_val_input_<?php echo $unit['attr_id'];?>"/>
                                    </td>
                                    <td>
                                            <input type="hidden" name="SWITCH" value='update_attr_val'/>
                                            <input type="hidden" name="update_attr_id" value="<?php echo $unit['attr_id'];?>"/>
                                            <input type="hidden" name="attr_type_id" value="<?php echo $attr_type_id;?>"/>
                                            <input type="hidden" name="attr_model_id" value="<?php echo $attr_model_id;?>"/>
                                            <input type="submit" class="btn btn-primary btn-sm" value="確定"/>
                                    </td>
                                </tr>
                            <?php echo '</form>';?>
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
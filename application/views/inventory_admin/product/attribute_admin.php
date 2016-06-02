<?php $attr='style="margin:0px;display: inline"';?>
<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="<?=base_url()?>inventory/product/category/admin">類別管理</a></li>
        <li><a href="<?=base_url()?>inventory/product/model/admin">模組管理</a></li>
        <li class="active">屬性管理</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Model Attribute Management <small>模組屬性管理</small></h1>
    <div class="email-btn-row hidden-xs">
        <a href="<?=base_url().'inventory/product/model/admin'?>" class="btn btn-inverse">回模組列表</a>
        <button class="btn  <?php if($model_content_exist)echo 'btn-default'; else echo 'btn-success';?>"
                data-toggle="modal" data-target="#add_Modal" <?php if($model_content_exist)echo 'disabled';?>>
            <?php if($model_content_exist)echo '商品模組已啟用，無法新增屬性'; else echo '
            <i class="fa fa-plus m-r-5"></i> Create 新增屬性';?>
        </button>
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
<!--                <div>--><?php //print_r($MyEcho);?><!--www</div>-->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <tr>
                                <th>名稱 <small class="j-question-circle"><i class="fa fa-question-circle" aria-hidden="true"></i> 點擊可編輯</small></th>
                                <th style="width:20%;">維護</th>
                            </tr>
                                <?php foreach ($doc as $unit):; ?>
                                    <tr data-toggle="modal" data-target="#edit_Modal">
                                        <td style="cursor:pointer;" onclick="sentID(<?php echo $unit['attr_type_id'];?>)"><?php echo $unit['attr_type_name'];?></td>
                                        <td>
                                            <?php echo form_open('inventory/product/attribute/value/admin', $attr); ?>
                                            <input type="hidden" name="attr_type_id"
                                                   value="<?php echo $unit['attr_type_id']; ?>"/>
                                            <input type="hidden" name="attr_model_id"
                                                   value="<?php echo $con_model_id; ?>"/>
                                            <input type="submit" value="管理這項屬性的值"
                                                   class="btn btn-success btn-sm"/>
                                            <?php echo '</form>'; ?>
                                        </td>
                                    </tr>
                                <?php endforeach;

                            ?><?php if(count($doc) < 2){ ?><?php ?>
                                <tr>
                                    <td colspan="3">
                                        若您的商品需要擁有顏色、尺寸或數量方案等等的選項，請在此編輯或新增，編輯完畢請啟用模組。
                                    </td>
                                </tr>
                            <? } ?>
                        </table>

                        <?php if(!$model_content_exist){
                        echo form_open('inventory/product/model/content/add',$attr);?>
                        <input type="hidden" value="<?php echo $con_model_id;?>" name="con_model_id"/>
                        <input type="hidden" value="first_add_product" name="SWITCH"/>
                        <button type="submit" class="btn btn-primary btn-block" <?php if(count($doc)==0)echo "disabled='disabled'" ?>>確認正式啟用模組 </button>
                            <br><center class="alert-danger" style="padding: 15px"><i class='fa fa-exclamation-triangle' aria-hidden='true'></i> 啟用模組後可再新增原有屬性的選項，但是『無法再新增或刪除商品屬性』</center>
                        <?php echo '</form>'; } ?>
                    </div>
                </div><!-- end panel -->
            </div><!-- end col-12 -->
        </div><!-- end row -->
    </div><!-- end #content -->

    <!-- begin scroll to top btn -->
    <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
    <!-- end scroll to top btn -->
</div><!-- end page container -->
<!-- Modal -->
<div class="modal fade" id="edit_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">編輯屬性名稱</h4>
            </div>
            <div class="modal-body">
                <?php $attr = array('class'=>'form-horizontal','role'=>'form');?>
                <?php echo form_open('inventory/product/attribute/update',$attr);?>
                <div class="form-group">
                    <label for="update_attr_type_name" class="col-sm-2 control-label">屬性名稱</label>
                    <div class="col-sm-10">
                        <input type="text"
                               class="form-control"
                               id="update_attr_type_name"
                               name="update_attr_type_name"
                               required="required"
                               placeholder="填寫新的屬性名稱"
                            >
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="hidden" value="" id="update_attr_type_id" name="update_attr_type_id"/>
                        <button type="submit" class="btn btn-default">送出</button>
                    </div>
                </div>
                <?php echo form_close();?>
            </div>
        </div><?//板子內容：包著modal-header、modal-body;?>
    </div><?//板子外圍;?>
</div><?//板子殼;?>
<!-- Modal END-->
<!-- Modal -->
<div class="modal fade" id="add_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">編輯屬性名稱</h4>
            </div>
            <div class="modal-body">
                <?php $attr = array('class'=>'form-horizontal','role'=>'form');?>
                <?php echo form_open('inventory/product/attribute/add',$attr);?>
                <div class="form-group">
                    <label for="update_attr_type_name" class="col-sm-2 control-label">屬性名稱</label>
                    <div class="col-sm-10">
                        <input type="text"
                               class="form-control"
                               id="add_attr_type_name"
                               name="add_attr_type_name"
                               required="required"
                               placeholder="填寫欲新增的屬性名稱"
                            >
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="hidden" name="con_model_id" value="<?=$con_model_id;?>"/>
                        <button type="submit" class="btn btn-default">送出</button>
                    </div>
                </div>
                <?php echo form_close();?>
            </div>
        </div><?//板子內容：包著modal-header、modal-body;?>
    </div><?//板子外圍;?>
</div><?//板子殼;?>
<!-- Modal END-->
<script>
    function sentID(attr_type_id){
        $('#update_attr_type_id').val(attr_type_id);
    }
</script>
<?php $this->load->view('templates/footer_color');?>

</body>
</html>



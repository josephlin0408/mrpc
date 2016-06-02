<?php $attr='style="margin:0px;display: inline"';?>
<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="<?=base_url()?>inventory/product/category/admin">商品類別管理</a></li>
        <li class="active">模組管理</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Product Model Management <small>商品模組管理</small></h1>
    <div class="email-btn-row hidden-xs">
        <button
            data-toggle="modal"
            data-target="#edit_model_Modal"
            class="btn btn-success"
            type="button"
            onclick="sent_model_data_to_model_board('','','','add_model','')"><i class="fa fa-plus m-r-5"></i> Create 新增商品模組
        </button>
        <a class="btn btn-inverse" href="<?=base_url()?>inventory/product/category/admin">回類別列表</a>
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
                    <?php echo form_open('inventory/product/model/admin',$attr);?>
                    <div class="m-b-20 input-group">
                        <div class="col-lg-4 col-md-12">
                            <select name="search_model_category" class="form-control" style="margin-bottom: 5px" onchange="this.form.submit()">
                                <option value="">全部</option>
                                <?php foreach($category_doc as $unit):;?>
                                    <option value="<?php echo $unit['category_id'];?>"
                                        <?php if($search_model_category == $unit['category_id'])echo 'selected';?> >
                                        <?php echo $unit['category_name'];?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="col-lg-8 col-md-12">
                            <div class="input-group">
                                <input name="search_model_name" type="text" class="form-control"
                                       placeholder="Enter keywords here... 搜尋模組名稱" value="<?php echo (isset($search_model_name))?$search_model_name:'';?>"/>
                                <input type="hidden" name="SWITCH"  value="search_bar_action"/>
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-inverse"><i class="fa fa-search"></i> Search 搜尋</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php echo '</form>';?>
                    <div class="table-responsive">
<!--                資料顯示區-->
            <table class="table table-striped table-bordered table-hover">
                <tr>
                    <th >類別</th>
                    <th >名稱</th>
                    <th >模組狀態</th>
                    <th class="hidden" >單位</th>
                    <th class="hidden">加購價</th>
                    <th >售價</th>
                    <th class="hidden" >預設單位成本</th>
                    <th class="hidden" >預設期初數量</th>
                    <th class="hidden" >預設期初單位成本</th>
                    <th class="hidden">預設產品</th>
                    <th class="hidden" >商品數</th>
                    <th>功能</th>
                </tr>
                <?php foreach($doc as $unit):;?>
                <tr>
                    <td><?php echo $category_name_id[$unit['model_category_id']];?></td>
                    <td><?php echo $unit['model_name'];?></td>
                    <td>
                        <?php switch($unit['model_status']){
                            case(0):
                                echo '啟用';
                                break;
                            case(1):
                                echo '<b style="color: red">尚未啟用模組，請至屬性管理操作</b>';
                                break;
                            case(2):
                                echo '<b style="color: red">停用</b>';
                                break;
                        };?>
                    </td>
                    <td class="hidden"><?php echo $unit['model_unit_name'];?></td>
                    <td><?php echo $unit['model_default_unit_price'];?></td>
                    <td class="hidden"><?php echo $unit['model_default_unit_cost'];?></td>
                    <td class="hidden"><?php echo $unit['model_default_ori_qty'];?></td>
                    <td class="hidden"><?php echo $unit['model_default_ori_unit_cost'];?></td>
                    <td class="hidden"><?php if($unit['model_init_product_id']<>0){
                            for($i=0;$i<count($attr_str[$unit['model_init_product_id']]);$i++){
                                echo $attr_str[$unit['model_init_product_id']][$i].'<br/>';
                            }
                        } ;?></td>
                    <td class="hidden"><?php echo $unit['model_product_num'];?></td>
                    <td>
                        <button data-toggle="modal"
                                data-target="#edit_model_Modal"
                                type="button"
                                class="btn btn-success btn-sm"
                                onclick="sent_model_data_to_model_board('<?php echo $unit['model_name'];?>','<?php echo $unit['model_default_unit_price'];?>','<?php echo $unit['model_id'];?>','update_model','<?php echo $unit['model_category_id'];?>')"
                            >編輯商品模組</button>
                        <?php echo form_open('inventory/product/attribute/admin',$attr);?>
                        <input type="hidden" value="<?php echo $unit['model_id'];?>" name="con_model_id"/>
                        <input type="submit" value="管理這項模組的屬性" class="btn btn-success btn-sm" />
                        <?php echo form_close();?>

                        <?php if($unit['model_product_num'] > 0) { ?>
                            <?php echo form_open('inventory/product/model/content/admin',$attr);?>
                            <input type="hidden" value="<?php echo $unit['model_id'];?>" name="con_model_id"/>
                            <input type="submit" value="商品列表" class="btn btn-success btn-sm"  />
                            <?php echo '</form>';?>
                            <?php if(FALSE):;?>
                            <?php echo form_open('inventory/product/model/admin',$attr);?>
                            <input type="hidden" name="SWITCH" value="switch_model_status"/>
                            <input type="hidden" name="status_model_id" value="<?php echo $unit['model_id'];?>"/>
                            <input type="hidden" name="model_status" value="<?php echo $unit['model_status'];?>"/>
                            <?php $unit['model_status'] == 1 ? $my_type = 'hidden':$my_type='submit';?>
                            <input type="<?php echo $my_type;?>" value="停用/啟用" class="btn btn-success btn-sm"  />
                            <?php echo '</form>';?>
                            <?php endif ?>
                            <button class="btn btn-success btn-sm" type="button" data-toggle="modal" data-target="#edit_Modal"  onclick="mark_meta_description(<?php echo $unit['model_id'];?>)">META敘述</button>
                            <a class="btn btn-success btn-sm" href="<?=base_url('inventory/product/model/description/update/form');?><?='/'.$unit['model_id'];?>">商品描述管理</a>

                        <?php } ?>
                    </td>
                </tr>
                <?php endforeach;?>
            </table>
<!--                資料顯示區END-->
                </div>
                    <div class="panel-footer">
                        <small class="j-question-circle"><i class="fa fa-question-circle" aria-hidden="true"></i> 商品模組是一組類似規格的商品，只有顏色、尺寸或規格上的差別，舉例如下：
                            <br>iPhone6 玫瑰金 32GB, iPhone6 金色 32GB, iPhone6 銀色 32GB,
                            <br>iPhone6 玫瑰金 64GB, iPhone6 金色 64GB, iPhone6 銀色 64GB
                            <br>創建時只需考慮總稱 iPhone6 即可，這組商品可共用相同的商品規格描述圖文
                            <br>當停用商品模組後，前台不會顯示該商品
                        </small>
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
            <?php echo form_open('inventory/product/model/update/meta/description');?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">敘述</h4>
            </div>
            <div class="modal-body">
                <textarea name="model_meta_description" id="modal_text" cols="30" rows="10" class="form-control"></textarea>
                <input type="hidden" value="" name="model_id" id="textarea_model_id"/>
                <input class="btn btn-primary" type="submit" value="確認編輯"/>
            </div>
            <?php echo form_close();?>
        </div>
    </div>
</div>
<!-- Modal END-->

<!-- Modal -->
<div class="modal fade" id="edit_model_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">商品模組管理</h4>
            </div>
            <div class="modal-body">
                    <?php $attr = array('class'=>'form-horizontal','role'=>'form');?>
                    <?php echo form_open('inventory/product/model/admin',$attr);?>
                    <div class="form-group">
                        <label for="update_model_name" class="col-sm-2 control-label">新的名稱</label>
                        <div class="col-sm-10">
                            <input type="text"
                                   class="form-control"
                                   id="update_model_name"
                                   name="model_name"
                                >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="update_model_default_unit_price" class="col-sm-2 control-label">新的售價</label>
                        <div class="col-sm-10">
                            <input type="number"
                                   class="form-control"
                                   id="update_model_default_unit_price"
                                   name="model_default_unit_price"
                                >
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="hidden" name="add_model_category" value="<?php echo $search_model_category;?>"/>
                            <input type="hidden" name="update_model_category_id" id="update_model_category_id" value=""/>
                            <input type="hidden" name="update_model_id" id="update_model_id" value=""/>
                            <input type="hidden" name="SWITCH" value="update_model" id="edit_model_switch"/>
                            <button type="submit" class="btn btn-default">送出</button>
                        </div>
                    </div>
                    <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>
<!-- Modal END-->

<script>
    function mark_meta_description(id)
    {
        var URLs="<?php echo base_url();?>inventory/product/model/get/meta/description";
        $.ajax({
            url: URLs,
            data: "model_id="+id,
            type:"POST",
            dataType:'text',

            success: function(msg){
                $('#modal_text').html(msg);
                $('#textarea_model_id').attr('value',id);
            },
            error:function(xhr, ajaxOptions, thrownError){
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
    }
    function sent_model_data_to_model_board(name,price,id,mySwitch,model_category_id)
    {
        $('#update_model_name').val(name);
        $('#update_model_default_unit_price').val(price);
        $('#update_model_id').val(id);
        $('#edit_model_switch').val(mySwitch);
        $('#update_model_category_id').val(model_category_id);
    }
</script>
<?php $this->load->view('templates/footer_color');?>

</body>
</html>
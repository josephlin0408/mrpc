<?php $attr='style="margin:0px;display: inline"';?>
<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="<?=base_url()?>inventory/product/category/admin">類別管理</a></li>
        <li><a href="<?=base_url()?>inventory/product/model/admin">模組管理</a></li>
        <li class="active">商品管理</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Product Management <small>商品管理 (<?php echo $doc_model['model_name'];?>)</small></h1>
    <!-- begin row -->

    <div class="email-btn-row hidden-xs">
        <a href="<?=base_url().'inventory/product/model/admin'?>" class="btn btn-inverse">回模組列表</a>
    </div>
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
                                <th>產品主圖</th>
                                <th>產品屬性</th>
                                <th class="hidden">產品加購價</th>

                                <th>物流產品編號</th>
                                <th>物流基數</th>
                                <th>單位定價</th>
                                <th class="hidden">單位成本</th>
                                <th class="hidden">起始數量</th>
                                <th class="hidden">起始單位成本</th>
                                <th>狀態</th>
                                <th>維護</th>
                            </tr>
                            <?php foreach($doc_product as $unit):;?>
                                <tr>
                                    <td>
                                        <img src="<?php if($unit['product_image'])echo $unit['product_image']; else echo "http://placehold.it/50?text=%E7%84%A1";?>"
                                             class="img-thumbnail"
                                             style="width: 60px;height: 60px;">
                                    </td>
                                    <td>
                                        <?php for($i=0;$i<count($echo_attr_link[$unit['product_id']]);$i++){
                                            echo '{'.$echo_attr_link[$unit['product_id']][$i].'}<br>';
                                        }?>
                                    </td>
                                    <td>
                                        <?php echo $unit['product_base_id'];?>
                                    </td>
                                    <td>
                                        <?php echo number_format($unit['product_base_count']);?>
                                    </td>
                                    <td class="hidden">
                                        <?php echo number_format($unit['product_list_price']);?>
                                    </td>
                                    <td><?php echo number_format($unit['product_unit_price']);?></td>
                                    <td class="hidden"><?php echo number_format($unit['product_unit_cost']);?></td>
                                    <td class="hidden"><?php echo number_format($unit['product_ori_qty']);?></td>
                                    <td class="hidden"><?php echo number_format($unit['product_ori_unit_cost']);?></td>
                                    <td><?php switch($unit['product_status']){
                                            case(0):
                                                echo '啟用';
                                                break;
                                            case(1):
                                                echo '停用';
                                                break;
                                        };?></td>
                                    <td>
                                        <button id="edit_btn<?php echo $unit['product_id'];?>" class="btn btn-success btn-sm">編輯</button>
                                        <?php echo form_open('inventory/product/model/content/image/admin',$attr);?>
                                        <input type="hidden" name="image_product_id" value="<?php echo $unit['product_id'];?>"/>
                                        <input type="hidden" name="con_model_id" value='<?php echo $doc_model['model_id'];?>'/>
                                        <input type="submit" value="查看圖庫" class="btn btn-success btn-sm"/>
                                        <?php echo '</form>';?>
                                        <?php echo form_open('inventory/product/model/content/image/upload',$attr);?>
                                        <input type="hidden" name="image_product_id" value="<?php echo $unit['product_id'];?>"/>
                                        <input type="hidden" name="con_model_id" value='<?php echo $doc_model['model_id'];?>'/>
                                        <input type="submit" value="上傳圖庫" class="btn btn-success btn-sm"/>
                                        <?php echo '</form>';?>
                                    </td>
                                </tr>
                            <?php echo form_open('inventory/product/model/content/admin');?>
                                <tr id="edit_bar<?php echo $unit['product_id'];?>" bgcolor="#f5f5dc" style="display: none">
                                    <td></td>
                                    <td></td>
                                    <td class="hidden">
                                        <input type="number" name="update_product_list_price" class="form-control" value="<?php echo $unit['product_list_price'];?>" required="required"/>
                                    </td>

                                    <td>
                                        <input type="text" name="update_product_base_id" class="form-control" value="<?php echo $unit['product_base_id'];?>" required="required"/>
                                    </td>
                                    <td>
                                        <input type="number" name="update_product_base_count" class="form-control" value="<?php echo $unit['product_base_count'];?>" required="required"/>
                                    </td>
                                    <td>
                                        <input type="number" name="update_product_unit_price" class="form-control" value="<?php echo $unit['product_unit_price'];?>" required="required"/>
                                    </td>
                                    <td class="hidden">
                                        <input type="number" name="update_product_unit_cost" class="form-control"  value="<?php echo $unit['product_unit_cost'];?>" required="required"/>
                                    </td>
                                    <td class="hidden">
                                        <input type="number" name="update_product_ori_qty" class="form-control"  value="<?php echo $unit['product_ori_qty'];?>" required="required"/>
                                    </td>
                                    <td class="hidden">
                                        <input type="number" name="update_product_ori_unit_cost" class="form-control"  value="<?php echo $unit['product_ori_unit_cost'];?>" required="required"/>
                                    </td>
                                    <td>
                                        <select name="update_product_status" class="form-control">
                                            <option value="0" <?php if($unit['product_status']==0)echo'selected';?>>啟用</option>
                                            <option value="1" <?php if($unit['product_status']==1)echo'selected';?>>停用</option>
                                        </select>
            <!--                            <input type="text" name="update_product_status" class="form-control"  value="--><?php //echo $unit['product_status'];?><!--"/>-->
                                    </td>
                                    <td>
                                        <input type="hidden" name="SWITCH" value='update_product'/>
                                        <input type="hidden" name="update_product_id" value='<?php echo $unit['product_id'];?>'/>
                                        <input type="hidden" name="con_model_id" value='<?php echo $doc_model['model_id'];?>'/>
                                        <input type="submit" class="btn btn-primary btn-sm" value="確定"/>
                                    </td>
                                </tr>
                                <script>
                                    $("#edit_btn<?php echo $unit['product_id'];?>").click(function(){
                                        $('#edit_bar<?php echo $unit['product_id'];?>').toggle('','',true)
                                    });
                                </script>
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
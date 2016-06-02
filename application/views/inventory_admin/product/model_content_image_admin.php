<?php $attr='style="margin:0px;display: inline"';?>
<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="active">商品圖片管理</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Product Image Management <small>商品圖庫管理 (<?php echo $image_product_id;?>)</small></h1>
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
                                <th style="width:40%">圖片</th>
                                <th style="width:20%">狀態</th>
                                <th>維護</th>
                            </tr>
                            <?php foreach($image_product_list as $unit):;?>
                            <tr>
                                <td>
                                    <center>
                                        <img src="<?php echo base_url().$unit['image_url'];?>"
                                             class="img-thumbnail"
                                             style="width: 180px;height: 180px;<?php if($main_img_id['product_image_id']==$unit['image_id'])echo'border:2px solid #880000'?>">
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <?php if($unit['image_status']==0){
                                            echo '啟用';
                                        }else{
                                            echo '<b style="color: red">停用</b>';
                                        }?>
                                    </center>
                                </td>
                                <td>

                                    <?php if($main_img_id['product_image_id']!=$unit['image_id']) {
                                    echo form_open('inventory/product/model/content/image/admin',$attr);?>
                                    <input type="hidden" name="image_id" value="<?php echo $unit['image_id'];?>"/>
                                    <input type="hidden" name="image_status" value="<?php echo $unit['image_status'];?>"/>
                                    <input type="hidden" name="image_product_id" value="<?php echo $image_product_id;?>"/>
                                    <input type="hidden" name="con_model_id" value="<?php echo $con_model_id;?>"/>
                                    <input type="hidden" name="SWITCH" value="change_image_status_selected"/>
                                    <input type="submit" value="啟用/停用" class="btn btn-default btn-sm" <?php if($main_img_id['product_image_id']==$unit['image_id']) echo'disabled';;?>/>
                                    <?php echo '</form>'; }?>
                                    <?php if($unit['image_status']==0 AND ($main_img_id['product_image_id']!=$unit['image_id'])) { echo form_open('inventory/product/model/content/image/admin',$attr);?>
                                        <input type="hidden" name="image_id" value="<?php echo $unit['image_id'];?>"/>
                                        <input type="hidden" name="image_url_full" value="<?php echo base_url().$unit['image_url'];?>"/>
                                        <input type="hidden" name="image_product_id" value="<?php echo $image_product_id;?>"/>
                                        <input type="hidden" name="con_model_id" value="<?php echo $con_model_id;?>"/>
                                        <input type="hidden" name="SWITCH" value="main_this_image"/>
                                        <input type="submit" value="選為主圖" class="btn btn-primary btn-sm" <?php if($unit['image_status']==1)echo 'disabled';?>/>
                                        <?php echo '</form>'; }?>
                                </td>
                            </tr>
                            <?php endforeach;?>
                        </table>
                        <?php echo form_open('inventory/product/model/content/admin',$attr);?>
                        <input type="hidden" name="con_model_id" value="<?php echo $con_model_id;?>"/>
                        <input type="submit" value="回模組產品列表" class="btn btn-primary btn-sm"/>
                        <?php echo '</form>';?>
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
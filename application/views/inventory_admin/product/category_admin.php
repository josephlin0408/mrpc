<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="active">類別管理</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Product Category Management <small>商品類別管理</small></h1>
    <div class="email-btn-row hidden-xs">
        <button class="btn btn-success" type="button" onclick="$('#add_bar').toggle();""><i class="fa fa-plus m-r-5"></i> Create 新增商品類別</button>
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
                    <?php echo form_open('inventory/product/category/admin');?>
                    <div class="input-group m-b-20">
                        <input name="search_name" type="text" class="form-control"
                               placeholder="Enter keywords here... 搜尋類別名稱" value="<?=$search_name;?>"/>
                        <input type="hidden" name="SWITCH"  value="search_bar_action"/>
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-inverse"><i class="fa fa-search"></i> Search 搜尋</button>
                        </div>
                    </div>
                    <?php echo '</form>';?>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <tr>
                                <th>名稱 <small class="j-question-circle"><i class="fa fa-question-circle" aria-hidden="true"></i> 點擊可編輯</small></th>
                                <th>連結</th>
                                <th>狀態</th>
                                <th>擁有商品模組數量</th>
                                <th>維護</th>
                            </tr>
                            <?php echo form_open('inventory/product/category/admin');?>
                            <tr id="add_bar" style="display: none;">
                                <td>
                                    <input type="text" value="" class="form-control" name="category_name"/>
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <input type="hidden" name="SWITCH" value="add_category"/>
                                    <input class="btn btn-primary btn-sm" type="submit" value="新增"/>
                                </td>
                            </tr>
                            </form>
                            <?php foreach($doc as $unit):;?>
                                <tr id="list_bar<?php echo $unit['category_id'];?>" >
                                    <td onclick="$('#edit_bar<?php echo $unit['category_id'];?>').toggle();" style="cursor: pointer">
                                        <?php echo $unit['category_name']?>
                                    </td>
                                    <td>
                                        <a href="<?=$this->session->userdata('company_name')."category/".$unit['category_id'];?>"><?=$this->session->userdata('company_name')."category/".$unit['category_id'];?></a>
                                    </td>
                                    <td>    <?php switch($unit['category_status']){
                                            case(0):
                                                echo '啟用中';
                                                break;
                                            case(1):
                                                echo '<b style="color: red"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> 停用中</b>';
                                                break;
                                        };?>
                                    </td>
                                    <td><?php echo $own_num[$unit['category_id']];?></td>
                                    <td>
                                        <?php $attr='style="margin:0px;display: inline"';?>
                                        <?php echo form_open('inventory/product/model/admin',$attr);?>
                                        <input type="hidden" name="SWITCH" value="search_bar_action"/>
                                        <input type="hidden" name="search_model_category" value="<?php echo $unit['category_id'];?>"/>
                                        <input type="submit" value="管理這項類別的模組" class="btn btn-success btn-sm"/>
                                        <?php echo '</form>';?>
                                        <?php echo form_open('inventory/product/category/admin',$attr);?>
                                        <input type="hidden" name="SWITCH" value="switch_category_status"/>
                                        <input type="hidden" name="status_category_id" value="<?php echo $unit['category_id'];?>"/>
                                        <input type="hidden" name="status_category_status" value="<?php echo $unit['category_status'];?>"/>
                                        <input type="submit" value="<?php if($unit['category_status']!=0)echo '正式啟用';
                                        if($unit['category_status']==0)echo '停用';?>" class="btn btn-<?php if($unit['category_status']!=0)echo 'danger';
                                        if($unit['category_status']==0)echo 'default';?> btn-sm"/>
                                        <?php echo '</form>';?>
                                    </td>
                                </tr>
                                <tr id="edit_bar<?php echo $unit['category_id'];?>" bgcolor="#f5f5dc" style="display: none">

                                    <form action="<?=base_url()?>inventory/product/category/admin" method="post" accept-charset="utf-8">
                                    <td><input type="text" name="update_category_name" class="form-control" placeholder="請填入新的類別名稱！" value="<?php echo $unit['category_name'];?>" required=""/></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <input type="hidden" name="update_category_id" value="<?php echo $unit['category_id'];?>"/>
                                        <input type="hidden" name="SWITCH" value='update_category_name'/>
                                        <input type="submit" class="btn btn-primary btn-sm" value="送出更新"/>
                                    </td>
                                    </form>
                                </tr>
                            <?php endforeach;?>
                        </table>
                    </div>
                    <div class="panel-footer">
                        <small class="j-question-circle"><i class="fa fa-question-circle" aria-hidden="true"></i> 商品類別通常是一群商品的統稱類型，舉例如下：
                        Mac,
                        iPad,
                        iPhone ,
                        Watch ,
                        TV ,
                        Music ,
                        iTunes ,
                        iPod ,
                        配件
                        <br></small>
                        <center class="alert-danger"style="margin-top:5px;padding: 15px"><i class='fa fa-exclamation-triangle' aria-hidden='true'></i>
                            當手動正式啟用商品類別後，前台即會顯示，請確認所有商品『價格與圖文說明』皆已正確設定</center>
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
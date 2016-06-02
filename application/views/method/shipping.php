<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="active">運貨管理</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Shipping Management <small>運貨方法管理</small></h1>

    <div class="email-btn-row hidden-xs">
        <button onclick="toggleContent('toggle_add_bar')" class='btn btn-inverse btn-sm'><i class="fa fa-plus"></i> 新增</button>
    </div>

    <!-- end page-header -->

    <!-- begin row -->
    <div class="row">
        <!-- begin col-12 -->
        <div class="col-md-12 ui-sortable">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="table-basic-7">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <tr>
                                <th style="width:25%">名稱</th>
                                <th style="width:25%">運費</th>
                                <th style="width:25%">狀態</th>
                                <th style="width:25%">功能</th>
                            </tr>
                            <?php echo form_open('shipping/method/add');?>
                            <tr id="toggle_add_bar" style="display: none">
                                <td><input type="text" value="" name="sm_name" class="form-control" required="required"/></td>
                                <td><input type="text" value="" name="sm_freight" class="form-control" required="required"/></td>
                                <td><center>-</center></td>
                                <td><input type="submit" value="確定新增" class="btn btn-primary btn-sm"/></td>
                            </tr>
                            <?php echo '</form>';?>
                            <?php $index=0;foreach($shipping_method_list as $unit):;?>
                            <tr>
                                <th>
                                    <?php echo $unit['sm_name'];?>
                                </th>
                                <th>
                                    <b id="pm_fee_amount<?=$index;?>"><?php echo $unit['sm_freight'];?></b>
                                    <input type="text" value="<?php echo $unit['sm_freight'];?>" id="pm_fee_update<?=$index;?>" class="form-control" style="display: none">
                                    <input type="submit" value="確認編輯" id="pm_fee_submit<?=$index;?>" class="btn btn-primary btn-sm" style="display: none"/>
                                </th>
                                <th id="pm_status<?=$index;?>">
                                    <?php  switch($unit['sm_status']){
                                        case(0):
                                            echo '啟用';
                                            break;
                                        case(1):
                                            echo '停用';
                                            break;
                                        case(2):
                                            echo '暫停使用';
                                            break;
                                    };?>
                                </th>
                                <th>
                                    <button onclick="toggleContent('toggle_edit_bar<?=$unit['sm_id']?>')" class="btn btn-success btn-sm">編輯內容</button>
                                </th>
                            </tr>
                                <?php echo form_open('shipping/method/update');?>
                            <tr style="display:none;" id="toggle_edit_bar<?=$unit['sm_id']?>">
                                <td>
                                    <input type="text" value="<?php echo $unit['sm_name'];?>" name="sm_name" required="required" class="form-control"/>
                                </td>
                                <td>
                                    <input type="text" value="<?php echo $unit['sm_freight'];?>" name="sm_freight" required="required" class="form-control"/>
                                </td>
                                <td>
                                    <select name="sm_status" class="form-control">
                                        <option value="0" <?php if($unit['sm_status']==0)echo'selected';?>>啟用</option>
                                        <option value="2" <?php if($unit['sm_status']==2)echo'selected';?>>暫停使用</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="hidden" value="<?php echo $unit['sm_id'];?>" name="sm_id"/>
                                    <button type="submit" class="btn btn-primary btn-sm">確定編輯</button>
                                </td>
                            </tr>
                                <?php echo '</form>';?>
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
    function toggleContent(id) {
        $('#'+id).toggle('','',true);
    }

</script>
<?php $this->load->view('templates/footer_color');?>

</body>
</html>
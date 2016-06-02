<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="active">導覽管理</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Navigation Management <small>導覽管理</small></h1>
    <div class="email-btn-row hidden-xs">
        <button class="btn btn-success" type="button" onclick="$('#add_bar').toggle();""><i class="fa fa-plus m-r-5"></i> Create 新增</button>
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
                                <th style="width: 16%">名稱</th>
                                <th style="width: 16%">URL</th>
                                <th style="width: 16%">目標</th>
                                <th style="width: 16%">狀態</th>
                                <th style="width: 16%">位置辨別號</th>
                                <th style="width: 16%">維護</th>
                            </tr>
                            <?php echo form_open('navigation/add');?>
                            <tr id="add_bar" style="display: none;">
                                <td>
                                    <input type="text" value="" class="form-control" name="nt_name" required="required" placeholder="名稱"/>
                                </td>
                                <td>
                                    <input type="text" value="" class="form-control" name="nt_url" required="required" placeholder="http://..."/>
                                </td>
                                <td>
                                    <select name="nt_target" id="" class="form-control">
                                        <option value="_self">_self</option>
                                        <option value="_blank">_blank</option>
<!--                                        <option value="_parent">_parent</option>-->
<!--                                        <option value="_top">_top</option>-->
                                    </select>
                                </td>
                                <td>
                                    <select name="nt_status" id="" class="form-control">
                                        <option value="1">停用</option>
                                        <option value="0">啟用</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="nt_position" id="" class="form-control">
                                        <option value="0">無設定</option>
                                        <option value="1">Header</option>
                                        <option value="2">Footer</option>
                                    </select>
                                </td>
                                <td>
                                    <input class="btn btn-primary btn-sm" type="submit" value="新增"/>
                                </td>
                            </tr>
                            </form>
                            <?php foreach($navigation as $unit):;?>
                                <tr id="list_bar<?php echo $unit['nt_id'];?>">
                                    <td><?php echo $unit['nt_name'];?></td>
                                    <td><?php echo $unit['nt_url'];?></td>
                                    <td><?php echo $unit['nt_target'];?></td>
                                    <td>    <?php switch($unit['nt_status']){
                                            case(0):
                                                echo '啟用';
                                                break;
                                            case(1):
                                                echo '<b style="color: red">停用</b>';
                                                break;
                                        };?>
                                    </td>
                                    <td>
                                        <?php switch($unit['nt_position']){
                                            case('1'):
                                                echo 'Header';
                                                break;
                                            case('2'):
                                                echo 'Footer';
                                                break;
                                            default:
                                                echo '無設定';
                                        };?>
                                    </td>
                                    <td>
                                        <button id="edit_btn<?php echo $unit['nt_id'];?>" class="btn btn-success btn-sm" onclick="$('#edit_bar<?php echo $unit['nt_id'];?>').toggle();">編輯導覽</button>
                                        <?php $attr='style="margin:0px;display: inline"';?>
                                        <input type="button" value="展開內容" class="btn btn-success btn-sm" id="contentBtn<?php echo $unit['nt_id'];?>" onclick="contentShow('content<?php echo $unit['nt_id'];?>')"/>
                                    </td>
                                </tr>
                                <form action="<?=base_url()?>navigation/update" method="post" accept-charset="utf-8">
                                <tr id="edit_bar<?php echo $unit['nt_id'];?>" bgcolor="#f5f5dc" style="display: none">
                                    <td>
                                        <input type="text" name="nt_name" class="form-control" value="<?php echo $unit['nt_name'];?>" required="required"/>
                                    </td>
                                    <td>
                                        <input type="text" name="nt_url" class="form-control"  value="<?php echo $unit['nt_url'];?>" required="required"/>
                                    </td>
                                        <td>
                                            <select name="nt_target" id="" class="form-control">
                                                <option value="_blank">_blank</option>
                                                <option value="_self" <?php if($unit['nt_target']=='_self')echo'selected';?>>_self</option>
<!--                                                <option value="_parent" --><?php //if($unit['nt_target']=='_parent')echo'selected';?>
<!--                                                    >_parent</option>-->
<!--                                                <option value="_top" --><?php //if($unit['nt_target']=='_top')echo'selected';?>
<!--                                                    >_top</option>-->
                                            </select>
                                        </td>
                                        <td>
                                            <select name="nt_status" id="" class="form-control">
                                                <option value="1">停用</option>
                                                <option value="0" <?php if($unit['nt_status']=='0')echo'selected';?>>啟用</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="nt_position" id="" class="form-control">
                                                <option value="0">無設定</option>
                                                <option value="1" <?php if($unit['nt_position']=='1')echo'selected';?>>Header</option>
                                                <option value="2" <?php if($unit['nt_position']=='2')echo'selected';?>>Footer</option>
                                            </select>
                                        </td>
                                    <td>
                                        <input type="hidden" name="nt_id" value="<?php echo $unit['nt_id'];?>"/>
                                        <input type="submit" class="btn btn-primary btn-sm btn-block" value="確定"/>
                                    </td>
                                </tr>
                                </form>
                                <tr id="content<?php echo $unit['nt_id'];?>" style="display: none">
                                    <td colspan="6">
                                        <table class="table table-bordered table-hover">
                                            <tr>
                                                <td>導覽內容名稱</td>
                                                <td>導覽內容URL</td>
                                                <td>導覽內容目標</td>
                                                <td>導覽內容狀態</td>
                                                <td>維護</td>
                                            </tr>
                                            <?php echo form_open('navigation/content/add');?>
                                            <tr bgcolor="#9acd32">
                                                <td>
                                                    <input type="text" name="nc_name" class="form-control" placeholder="such as 'Black Jacket'.." required="required"/>
                                                </td>
                                                <td>
                                                    <input type="text" name="nc_url" class="form-control" placeholder="http://..." required="required"/>
                                                </td>
                                                <td>
                                                    <select name="nc_target" id="" class="form-control">
                                                        <option value="_blank">_blank</option>
                                                        <option value="_self">_self</option>
                                                        <option value="_parent">_parent</option>
                                                        <option value="_top">_top</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select name="nc_status" id="" class="form-control">
                                                        <option value="1">停用</option>
                                                        <option value="0">啟用</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <center>
                                                        <input type="hidden" name="nc_nt_id" value="<?php echo $unit['nt_id'];?>"/>
                                                        <input type="submit" value="新增內容"/>
                                                    </center>
                                                </td>
                                            </tr>
                                            <?php echo '</form>';?>
                                            <?php if(empty($navigation_content[$unit['nt_id']]))echo '<tr> <td colspan="6"><center>無資料</center></td></tr>';?>
                                            <?php foreach($navigation_content[$unit['nt_id']] as $unit_sec):;?>
                                            <?php echo form_open('navigation/content/update');;?>
                                            <tr>
                                                <td><input type="text" name="nc_name" value="<?php echo $unit_sec['nc_name'];?>" class="form-control"/></td>
                                                <td><input type="text" name="nc_url" value="<?php echo $unit_sec['nc_url'];?>" class="form-control"/></td>
                                                <td>
                                                    <select name="nc_target" id="" class="form-control">
                                                        <option value="_blank">_blank</option>
                                                        <option value="_self" <?php if($unit_sec['nc_target']=='_self')echo 'selected';?>>_self</option>
                                                        <option value="_parent" <?php if($unit_sec['nc_target']=='_parent')echo 'selected';?>>_parent</option>
                                                        <option value="_top" <?php if($unit_sec['nc_target']=='_top')echo 'selected';?>>_top</option>
                                                    </select>
<!--                                                    <input type="text" name="nc_target" value="--><?php //echo $unit_sec['nc_target'];?><!--" class="form-control"/>-->
                                                </td>
                                                <td>
                                                    <select name="nc_status" id="" class="form-control">
                                                        <option value="1">停用</option>
                                                        <option value="0" <?php if($unit_sec['nc_status']=='0')echo 'selected';?>>啟用</option>
                                                    </select>
<!--                                                    <input type="text" name="nc_status" value="--><?php //echo $unit_sec['nc_status'];?><!--" class="form-control"/>-->
                                                </td>
                                                <td>
                                                    <center>
                                                        <input type="hidden" name="nc_id" value="<?php echo $unit_sec['nc_id'];?>"/>
                                                        <button type="submit">編輯內容</button>
                                                    </center>
                                                </td>
                                            </tr>
                                            <?php echo '</form>';?>
                                            <?php endforeach;?>
                                        </table>
                                    </td>
                                </tr>
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
<script>
    function contentShow(id){
        $('#'+id).toggle('','',true);
    }
</script>
<?php $this->load->view('templates/footer_color');?>

</body>
</html>
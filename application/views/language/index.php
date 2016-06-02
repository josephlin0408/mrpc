<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="active">語系管理</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Language Management 語系管理
        <small>
            <label for="system_hint">系統提示：</label>
            <input type="text" value="<?=$error_hint;?>" readonly id="system_hint"/>
        </small>

    </h1>

    <div class="email-btn-row hidden-xs">
        <button class="btn btn-success" type="button" onclick="$('#add_bar').toggle();""><i class="fa fa-plus m-r-5"></i> Create 新增</button>
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
                            <tr <?php if(!empty($all_language))echo 'hidden="hidden"';?>>
                                <th colspan="6">查無資料！</th>
                            </tr>
                            <tr class="active" <?php if(empty($all_language))echo 'hidden="hidden"';?>>
                                <?php $font_size="font-size:14px;";?>
                                <th style="<?=$font_size;?>;width: 10%;">流水號</th>
                                <th style="<?=$font_size;?>;width: 10%;"><i class="fa fa-list-ol"></i>&nbsp;自訂編號</th>
                                <th style="<?=$font_size;?>;width: 20%;"><i class="fa fa-book fa-fw"></i>&nbsp;語言名稱</th>
                                <th style="<?=$font_size;?>;width: 20%;"><i class="fa fa-book fa-fw"></i>&nbsp;名稱縮寫</th>
                                <th style="<?=$font_size;?>;width: 10%;"><i class="fa fa-male"></i>&nbsp;顯示狀態</th>
                                <th style="<?=$font_size;?>;width: 10%;" hidden="hidden"><i class="fa fa-child"></i>&nbsp;職業</th>
                                <th style="<?=$font_size;?>;width: 30%;"><i class="fa fa-cog"></i>&nbsp;功能</th>
                            </tr>
                            <tr id="add_bar" style="display: none;">
                                <?php echo form_open('language/admin',$attr);?>
                                <td>
                                    <center>-</center>
                                </td>
                                <td>
                                    <input type="number" value="" name="add_language_sort" class="form-control" placeholder="自訂編號0~100，不可與現有資料重複"/>
                                </td>
                                <td>
                                    <input type="text" value="" name="add_language_name" class="form-control" placeholder="輸入語言名稱"/>
                                </td>
                                <td>
                                    <input type="text" value="" name="add_language_abbreviation" class="form-control" placeholder="輸入名稱縮寫"/>
                                </td>
                                <td>
                                    <select name="add_language_status" class="form-control">
                                        <option value="0">顯示</option>
                                        <option value="1">不顯示</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="hidden" name="SWITCH" value="create_new_language"/>
                                    <input type="submit" value="新增" class="btn btn-primary btn-block"/>
                                </td>
                                </form>
                            </tr>
                            <?php $id_num=0;?>
                            <?php foreach($all_language as $unit):;?>
                                <tr <?php if($lastClientId==$unit['language_sort'])
                                        echo'style="border-style:solid;border-width:5px;"';$id_num++;?>
                                    >
                                    <td style="<?=$font_size;?>;">
                                        <center>
                                            <?php echo $id_num;?>
                                        </center>
                                    </td>
                                    <td style="<?=$font_size;?>;">
                                        <center>
                                            <?php if($lastClientId==$unit['language_sort'])echo'<span class="hint--bottom" data-hint="最後關注" style="color: red"><i class="fa fa-star"></i></span>';?>
                                            <?php $language_sort = str_pad($unit['language_sort'],3,'0',STR_PAD_LEFT);echo $language_sort;?>
                                        </center>
                                    </td>
                                    <td style="<?=$font_size;?>;">
                                        <center>
                                            <?php echo $unit['language_name'];if(empty($unit['language_name']))echo'-';?>
                                        </center>
                                    </td>
                                    <td style="<?=$font_size;?>;">
                                        <center>
                                            <?php echo $unit['language_abbreviation'];if(empty($unit['language_abbreviation']))echo'-';?>
                                        </center>
                                    </td>
                                    <td style="<?=$font_size;?>;">
                                        <center>
                                            <font color="<?php if($unit['language_status'] == '0'){
                                                echo 'blue';
                                            }else{
                                                echo 'red';
                                            };?>">
                                                <?php if($unit['language_status'] == '0'){
                                                    echo '顯示';
                                                }else{
                                                    echo '不顯示';
                                                };?>
                                            </font>
                                        </center>
                                    </td>
                                    <td hidden="hidden">
                                        <center>
                                            <?php $job_name = mb_strimwidth ($unit['client_occupation'],0,12,"...","UTF-8");?>
                                            <?php echo $job_name;if(empty($unit['client_occupation']))echo'-';?>
                                        </center>
                                    </td>
                                    <td style="<?=$font_size;?>;">
                                        <center>
                                            <?php echo form_open('language/admin',$attr);?>
                                            <input type="hidden" value="visible_this_language" name="SWITCH"/>
                                            <input type="hidden" value="<?php echo $unit['language_id'];?>" name="this_language_id"/>
                                            <input type="<?php if($unit['language_status'] == '0'){
                                                echo 'hidden';
                                            }else{
                                                echo 'submit';
                                            };?>" value="前台顯示" class="btn btn-success btn-sm" style="width: 30%" />
                                            <!--                                        <button type="button" --><?php //if($unit['language_status'] == '0') echo 'hidden';?><!-- class="btn btn-success btn-sm show" style="width: 15%;display: inline">顯示</button>-->
                                            </form>
                                            <?php echo form_open('language/admin',$attr);?>
                                            <input type="hidden" value="hidden_this_language" name="SWITCH"/>
                                            <input type="hidden" value="<?php echo $unit['language_id'];?>" name="this_language_id"/>
                                            <!--                                        <button type="button" --><?php //if($unit['language_status'] == '1') echo 'hidden';?><!-- class="btn btn-warning btn-sm show" style="width: 15%;display: inline">不顯示</button>-->
                                            <input type="<?php if($unit['language_status'] == '1'){
                                                echo 'hidden';
                                            }else{
                                                echo 'submit';
                                            };?>" value="前台不顯示" class="btn btn-warning btn-sm" style="width: 30%"/>
                                            </form>
                                        </center>
                                    </td>
                                </tr>
                            <?php endforeach ;?>
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
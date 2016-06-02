<!-- begin #content -->
<link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/style.css"/>
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="active">文章標籤</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">article tag 文章標籤
        <small>
            <label for="system_hint">系統提示：</label>
            <input type="text" value="" readonly id="system_hint"/>
        </small>
    </h1>
    <div class="email-btn-row hidden-xs">
        <button class="btn btn-success" type="button" id="add_btn"><i class="fa fa-plus m-r-5"></i>Create 新增</button>
        <script>
            $('#add_btn').on('click',function(){
                $('#add_table').slideToggle('','',true);
            });
        </script>
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
                        <?php echo form_open('article/tag/add/perform');?>
                        <table class="table table-bordered table-condensed"
                               style="background-color:#FFFFFF;display: none;" id="add_table">
                            <tr class="active">
                                <?php $font_size="font-size:14px;";?>
                                <th><i class="fa fa-list-ol"></i>&nbsp;序號</th>
                                <th><i class="fa fa-book fa-fw"></i>&nbsp;標籤內容</th>
                                <th><i class="fa fa-ellipsis-h"></i>&nbsp;顯示狀態</th>
                                <th><i class="fa fa-cog"></i>&nbsp;維護</th>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input type="text" name="article_tag_string" class="form-control" placeholder="在此填寫標籤內容！"/>
                                </td>
                                <td>
                                    <select name="article_tag_status" id="" class="form-control">
                                        <option value="0">顯示</option>
                                        <option value="1">不顯示</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="submit"/>
                                </td>
                            </tr>
                        </table>
                        <?php echo form_close();?>

                        <table class="table table-bordered table-condensed"
                               style="background-color:#FFFFFF;">
                            <tr <?php $list = $article_tag;if(!empty($list))echo'hidden="hidden"';?>> <th colspan="7">查無資料！</th> </tr>
                            <tr class="active" <?php if(empty($list))echo'hidden="hidden"';?> id="list_field">
                                <?php $font_size="font-size:14px;";?>
                                <th><i class="fa fa-list-ol"></i>&nbsp;序號</th>
                                <th><i class="fa fa-book fa-fw"></i>&nbsp;標籤內容</th>
                                <th><i class="fa fa-ellipsis-h"></i>&nbsp;顯示狀態  </th>
                                <th><i class="fa fa-cog"></i>&nbsp;維護</th>
                            </tr>
                            <?php $index=1;if(isset($list))if(is_array($list))foreach($list as $unit):;?>
                                <?php echo form_open('article/tag/update/perform');?>
                                <tr id="tag<?php echo $index;?>">
                                    <td style="width: 25%"><?=$index;?><?php if($unit['article_tag_navigation_status']==0)echo '(主標籤)';?></td>
                                    <td style="width: 25%">
                                        <input type="text" value="<?=$unit['article_tag_string'];?>" name="article_tag_string" class="form-control"/>
                                    </td>
                                    <td style="width: 25%">
                                        <select name="article_tag_status" id="" class="form-control">
                                            <option value="0">顯示</option>
                                            <option value="1" <?php if($unit['article_tag_status']==1)echo 'selected';?>>隱藏</option>
                                        </select>
                                    </td>
                                    <td style="width: 25%">
                                        <input type="hidden" value="<?=$unit['article_tag_id'];?>" name="article_tag_id" id="tag_id<?php echo $index;?>"/>
                                        <button type="submit">送出編輯</button>
                                        <button type="button" onclick="remove_tag('tag<?php echo $index;?>','tag_id<?php echo $index;?>')">移除標籤</button>
                                        <?php if($unit['article_tag_navigation_status']==1){;?>
                                        <button type="button" onclick="set_tag_navigation_status('tag_id<?php echo $index;?>',0)">設為主標籤</button>
                                        <?php }else{;?>
                                        <button type="button" onclick="set_tag_navigation_status('tag_id<?php echo $index;?>',1)">移除主標籤</button>
                                        <?php };?>
                                    </td>
                                </tr>
                                <?php echo form_close();?>
                                <?php $index++;endforeach;?>
                        </table>
                        <p>1. ※狀態為隱藏之標籤，所有文章將<b style="color:red">無法</b>選擇貼上此標籤</p>
                        <p>2. ※狀態轉為隱藏的同時，將同步<b style="color:red">刪除</b>該標籤之所有文章連結，且<b style="color:red">不能</b>回朔 </p>
                        <p>3. ※移除標籤的同時，將同步<b style="color:red">刪除</b>該標籤之所有文章連結，且<b style="color:red">不能</b>回朔 </p>
                        <p>4. 設為主標籤後，將於前台以標籤形式顯示，若超過六個主標籤，則以隨機選擇六個做呈現</p>
                        <script>
                            function remove_tag(id,tag_id){
                                var my_tag_id = $('#'+tag_id).val();
                                console.log(my_tag_id);
                                $('#'+id).remove();
                                console.log(tag_id);
                                var URLs="<?php echo base_url();?>ajax/article/tag/remove";
                                $.ajax({
                                    url: URLs,
                                    data: "tag_id="+my_tag_id,
                                    type:"POST",
                                    dataType:'text',

                                    success: function(msg){
                                        console.log(msg);
                                    },
                                    error:function(xhr, ajaxOptions, thrownError){
                                        console.log(xhr.status);
                                        console.log(thrownError);
                                    }
                                });

                            }
                            function set_tag_navigation_status(tag_id,status){
                                var my_tag_id = $('#'+tag_id).val();
//                                console.log(my_tag_id);
//                                console.log(status);
                                var URLs="<?php echo base_url();?>ajax/article/tag/navigation/status/change";
                                $.ajax({
                                    url: URLs,
                                    data: "tag_id="+my_tag_id+"&status="+status,
                                    type:"POST",
                                    dataType:'text',

                                    success: function(msg){
//                                        console.log(msg);
                                        window.location ='<?=base_url()?>article/tag/admin';
                                    },
                                    error:function(xhr, ajaxOptions, thrownError){
                                        console.log(xhr.status);
                                        console.log(thrownError);
                                    }
                                });
                            }
                        </script>

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
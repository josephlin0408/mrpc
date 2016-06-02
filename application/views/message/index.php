<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="active">留言管理</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Message Management <small>留言管理</small></h1>
    <div class="email-btn-row hidden-xs"></div>
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
                                <th>流水號</th>
                                <th>文章標題</th>
                                <th>留言者</th>
                                <th>留言國家</th>
                                <th>留言者帳號</th>
                                <th>評分</th>
                                <th>留言內容</th>
                                <th>留言時間</th>
                                <th>被檢舉次數</th>
                                <th>留言狀態</th>
                                <th>維護</th>
                            </tr>
                            <?php $i=1;foreach($msg as $unit):;?>
                                <tr id="list_bar<?php echo $i;?>">
                                    <td><?php echo $unit['msg_id'];?></td>
                                    <td><?php echo $unit['msg_article_title'];?></td>
                                    <td><?php echo $unit['msg_critic_name'];?></td>
                                    <td><?php echo $unit['msg_critic_country'];?></td>
                                    <td><?php if(!empty($unit['msg_account'])){
                                            echo $unit['msg_account'];
                                        }else{
                                            echo '(訪客)';
                                        }?></td>
                                    <td><?php echo $unit['msg_star_rank_give'];?></td>
                                    <td><?php echo $unit['msg_content'];?></td>
                                    <td><?php echo $unit['msg_update_time'];?></td>
                                    <td><?php echo $unit['msg_ban_times'];?></td>
                                    <td>    <?php switch($unit['msg_status']){
                                            case(0):
                                                echo '正常顯示';
                                                break;
                                            case(1):
                                                echo '被檢舉逾3次而停用';
                                                break;
                                        };?>
                                    </td>
                                    <td><a href="<?php echo base_url('message/delete/'.$unit['msg_id']);?>" onclick="return confirm('確定刪除嗎？')">刪除</a></td>
                                </tr>
                            <?php $i++;endforeach;?>
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
<?php /*橫幅管理載入*/;?>
<!-- jQuery library (served from Google) -->
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>-->

<!-- bxSlider Javascript file -->
<script src="<?php echo base_url()?>dist/js/jquery.bxslider.min.js"></script>
<!-- bxSlider CSS file -->
<link href="<?php echo base_url()?>dist/css/jquery.bxslider.css" rel="stylesheet" />
<?php /*橫幅管理載入END*/;?>

<style>
    .youtube {
        height: 483px;
    }
</style>

<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="active">橫幅管理</li>
    </ol>
    <!-- end breadcrumb -->

    <!-- begin page-header -->
    <h1 class="page-header">Index Banner Management
        <small>首頁橫幅管理</small>
    </h1>
    <!-- end page-header -->

    <!-- begin row -->
    <div class="row">
        <!-- begin col-12 -->
        <div class="col-md-12 ui-sortable">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="table-basic-7">
                <div class="panel-heading">
                    <h4 class="panel-title">首頁橫幅</h4>
                </div>
                <div class="panel-body">
                    <div class="table-responsive" <?php if($banner_status_exam)echo 'hidden="hidden"';?>>
                        <center>
                            <ul class="bxslider">
                                <?php foreach($banner as $single):;?>
                                    <?php if($single['banner_status']<>1)echo $single['banner_unit'];?>
                                <?php endforeach;?>
                            </ul>
                        </center>
                    </div>
                    <?php $attr_pic = 'style="margin:0px;display: inline" enctype="multipart/form-data"';?>
                    <?php echo form_open('banner',$attr_pic);?>
                    <input type="hidden" name="category" value="banner"/>
                    <table class="table ">
                        <thead>
                        <th>連結網址</th>
                        <th class="hidden">影片網址</th>
                        <th>圖檔連結</th>
                        <th>上傳圖片</th>
                        <th>當前狀態</th>
                        </thead>
                        <tbody>
                        <?php $foreach_index=0;foreach ($banner as $single): ?>
                            <?php  if($foreach_index==8){ ?>
                                <tr>
                                    <td colspan="5"><hr></td>
                                </tr>
                            <?php } ?>
                            <!--form unit-->
                            <input type="hidden" name="id[]" value="<?=$single['banner_id']?>" id="banner_id<?=$foreach_index;?>">
                            <tr>
                                <td>
                                    <input class="form-control" type="text"
                                           data-parsley-trigger="change"
                                           data-parsley-type="url"
                                           name="link[]" value="<?=$single['banner_link']?>">
                                </td>
                                <td class="hidden">
                                    <input class="form-control" type="text"
                                           data-parsley-trigger="change"
                                           data-parsley-pattern="youtube"
                                           data-parsley-type="url"
                                           name="youtube[]" value="<?=$single['banner_youtube']?>">
                                </td>
                                <td>
                                    <?php if($single['banner_image']){ ?><img src="<?=base_url().'uploads/'.$single['banner_image']?>" width="100px"><?php } ?>
                                    <input class="form-control" type="text" name="path[]" value="<?=$single['banner_image']?>" style="display: none">
                                </td>
                                <td>
                                    <input class="form-control" type="file" name="files[]" >
                                </td>
                                <td>
                                    <button type="button" class="btn btn-<?php switch($single['banner_status']){
                                        case('0'):
                                            echo 'success';
                                            break;
                                        case('1'):
                                            echo 'default';
                                            break;
                                    };?>" onclick="func_switch_banner_status('<?=$single['banner_id']?>')" id="banner_status<?=$single['banner_id']?>">
                                        <?php switch($single['banner_status']){
                                            case('0'):
                                                echo '顯示中';
                                                break;
                                            case('1'):
                                                echo '隱藏中';
                                                break;
                                        };?>
                                    </button>
                                </td>
                            </tr>
                            <!--form unit-->
                        <?php $foreach_index++;endforeach?>
                        <tr>
                            <td colspan="4">
                                <input class="btn btn-success" type="submit" value="更新橫幅設定">
                                <h3>
                                    <small>
                                        圖片限制10MB以下 / 檔案格式 jpg, gif, png (1245*483) / 當Youtube 連結存在時，會取代連結網址與圖片
                                    </small>
                                </h3>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <?php echo '</form>';?>
<!--                    <pre><b>--><?php //print_r($banner) ;?><!--</b>-->
                </div><!-- end panel -->
            </div><!-- end col-12 -->
        </div><!-- end row -->
    </div><!-- end #content -->

    <!-- begin scroll to top btn -->
    <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
    <!-- end scroll to top btn -->
</div><!-- end page container -->

<?php $this->load->view('templates/footer_color');?>
<script>
    $(document).ready(function(){
        $('.bxslider').bxSlider();
    });
    function func_switch_banner_status(bannerId){
//        console.log(bannerId);
        var URLs="<?=base_url();?>banner/status/switch";
        $.ajax({
            url: URLs,
            data: "bannerId="+bannerId,
            type:"POST",
            dataType:'text',

            success: function(msg){
//                console.log(msg);
                $("#banner_status"+bannerId).html(msg);
                window.location = '<?=base_url().'banner';?>';
            },
            error:function(xhr, ajaxOptions, thrownError){
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
    }
</script>
</body>
</html>

<?php /*橫幅管理載入*/;?>
<!-- jQuery library (served from Google) -->
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>-->

<!-- bxSlider Javascript file -->
<script src="<?php echo base_url()?>dist/js/jquery.bxslider.min.js"></script>
<!-- bxSlider CSS file -->
<link href="<?php echo base_url()?>dist/css/jquery.bxslider.css" rel="stylesheet" />
<?php /*廣告管理載入END*/;?>

<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="active">廣告管理</li>
    </ol>
    <!-- end breadcrumb -->

    <!-- begin page-header -->
    <h1 class="page-header">Index Ads Management
        <small>首頁廣告管理</small>
    </h1>
    <!-- end page-header -->

    <!-- begin row -->
    <div class="row">
        <!-- begin col-12 -->
        <div class="col-md-12 ui-sortable">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="table-basic-7">
                <div class="panel-heading">
                    <h4 class="panel-title">首頁廣告</h4>
<!--                    <pre>--><?php //print_r($ad);?><!--</pre>-->
                </div>
                <div class="panel-body">
                    <div class="row" <?php if($ad_status_exam)echo 'hidden="hidden"';?>>
                        <?php foreach($ad as $single):;if($single['ad_status']==1)continue;?>
                        <div class="col-lg-3">
                            <a href="<?php if($single['ad_link']!="")echo $single['ad_link']; else echo "#"; ?>" target="_blank">
                                <?php echo '<img src="'.base_url().'uploads/'.$single['ad_source'].'" '.'class="img-responsive">';?>
                            </a>
                        </div>
                        <?php endforeach;?>
                    </div>
                    <?php $attr_pic = 'style="margin:0px;display: inline" enctype="multipart/form-data"';?>
                    <?php echo form_open('ads',$attr_pic);?>
                    <table class="table ">
                        <thead>
                        <th>連結網址</th>
<!--                        <th>圖檔連結</th>-->
                        <th>短文字</th>
                        <th>圖檔名稱</th>
                        <th>上傳圖片</th>
                        <th>當前狀態</th>
                        </thead>
                        <tbody>
                        <?php $foreach_index=0;foreach ($ad as $single): if($foreach_index > 3)break; ?>
                            <!--form unit-->
                            <tr>
                                <td>
                                    <input type="hidden" name="id[]" value="<?= $single['ad_id'] ?>" id="ad_id<?= $foreach_index; ?>">
                                    <input
                                        type="text"
                                        name="link[]"
                                        value="<?=$single['ad_link']?>"
                                        class="form-control"
                                        data-parsley-trigger="change"
                                        data-parsley-type="url"
                                        >
                                </td>
                                <td>
                                    <input
                                        type="text"
                                        name="ad_text[]"
                                        value="<?=$single['ad_text']?>"
                                        class="form-control"
                                        >
                                </td>
                                <td hidden="hidden">
                                    <input
                                        type="text"
                                        name="path[]"
                                        value="<?=$single['ad_source']?>"
                                        class="form-control"
                                        readonly
                                        >
                                </td>
                                <td>
                                    <?=$single['ad_source']?>
                                </td>
                                <td>
                                    <input
                                        type="file"
                                        name="files[]"
                                        class="form-control"
                                         >
                                </td>
                                <td>
                                    <button class="btn btn-<?php switch($single['ad_status']){
                                        case('0'):
                                            echo 'success';
                                            break;
                                        case('1'):
                                            echo 'default';
                                            break;
                                    };?>" type="button" onclick="func_switch_ad_status('<?=$single['ad_id']?>')" id="ad_status<?=$single['ad_id']?>">
                                        <?php switch($single['ad_status']){
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
                            <input type="hidden" name="category" value="ads"/>
                            <td colspan="4">
                                <input class="btn btn-success" type="submit" value="更新廣告設定">
                                <h3>
                                    <small>
                                        圖片限制10MB以下 / 檔案格式 jpg, gif, png
                                    </small>
                                </h3>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <?php echo '</form>';?>
<!--                    <pre><b>--><?php //print_r($ad) ;?><!--</b>-->
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
    function func_switch_ad_status(adId){
//        console.log(adId);
        var URLs="<?=base_url();?>ads/status/switch";
        $.ajax({
            url: URLs,
            data: "adId="+adId,
            type:"POST",
            dataType:'text',

            success: function(msg){
//                console.log(msg);
                $("#ad_status"+adId).html(msg);
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

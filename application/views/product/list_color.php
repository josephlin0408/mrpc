
<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="<?=base_url()?>dashboard">Home</a></li>
        <li class="active">Product</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Product Management <small>產品管理</small></h1>
    <div class="email-btn-row hidden-xs">
        <a href="<?=base_url()?>product/item/create" class="btn btn-sm btn-inverse"><i class="fa fa-plus m-r-5"></i> Create 新增</a>
    </div>
    <!-- end page-header -->

    <!-- begin row -->
    <div class="row">
        <!-- begin col-12 -->
        <div class="col-md-12">
            <div class="result-container">
                <form method="post" action="<?=base_url()?>product/item/list/<?=$recorder_per_page?>/1">
                <div class="input-group m-b-20">
                    <input name="keyword" type="text" class="form-control input-white" placeholder="Enter keywords here... 輸入分類或產品名稱的關鍵字，可用逗號區隔多組關鍵字 例如：蘋果,紅色,特大號" value="<?=$keyword?>"/>
                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-inverse"><i class="fa fa-search"></i> Search 搜尋</button>
                    </div>
                </div>
                </form>
                <?php
                $range = 6;
                if(isset($count_all_results)) {
                    $page_count = ceil($count_all_results / $recorder_per_page);
                    if (($current_page - $range) < 1) $for_start = 1; else $for_start = $current_page - $range++;
                    if (($current_page - $range) < 1) $more_start = 1; else $more_start = $current_page - $range;
                    if (($current_page + $range) > $page_count) $for_end = $page_count; else $for_end = $current_page + $range++;
                    if (($current_page + $range) > $page_count) $more_end = $page_count; else $more_end = $current_page + $range;
                }
                ?>
                <ul class="pagination pagination-without-border pull-right m-t-0">
                    <li <?php if($current_page == 1) echo "class='disabled'";?>><a href="<?=base_url()."product/item/list/".$recorder_per_page."/".$more_start?>">«</a></li>
                    <?php
                    for($i = $for_start;$i <= $for_end; $i++){
                        if($i == $current_page){
                            $selected = "class='active'";
                        } else {
                            $selected = "";
                        }
                        echo "<li ".$selected." ><a href=".base_url()."product/item/list/".$recorder_per_page."/".$i.">".$i."</a></li>";
                    }
                    ?>
                    <li <?php if($current_page == $page_count) echo "class='disabled'";?>><a href="<?=base_url()."product/item/list/".$recorder_per_page."/".$more_end?>">»</a></li>
                </ul>

                <ul class="result-list">
                    <?php
                    $enum_enable = array( "停用", "正常");
                    foreach ($data as $item): ?>
                        <li>
                            <div class="result-image">
                                <a href="javascript:;"><img src="<?=base_url()."uploads/".$item['image'];?>" alt="<?=$item['product_name']?>" class="img-responsive"/></a>
                            </div>
                            <div class="result-info">
                                <h4 class="title"><a href="javascript:;"><?=$item['product_name']?></a></h4>
                                <p class="location"><?=$item['type_name']?></p>
                                <p class="desc"><?=$item['desc']?></p>
                            </div>
                            <div class="result-price">
                                $<?=money_format("%i",$item['sale_price_ntd'])?> <small class="ori-price">$<?=money_format("%i",$item['price_ntd'])?></small>
                                <a class="btn btn-inverse btn-sm btn-block" href="<?=base_url().$update_url?>/<?=$item['product_idx']?>">編輯</a>
                                <a class="btn btn-inverse btn-sm btn-block" onclick='return confirm("確定刪除嗎？")' href='<?=base_url().$delete_url?>/<?=$item['idx']?>'>刪除</a>

                            </div>
                        </li>
                        <?php endforeach;?>

                </ul>
                <div class="clearfix">
                    <ul class="pagination pagination-without-border pull-right">
                        <li <?php if($current_page == 1) echo "class='disabled'";?>><a href="<?=base_url()."product/item/list/".$recorder_per_page."/".$more_start?>">«</a></li>
                        <?php
                        for($i = $for_start;$i <= $for_end; $i++){
                            if($i == $current_page){
                                $selected = "class='active'";
                            } else {
                                $selected = "";
                            }
                            echo "<li ".$selected." ><a href=".base_url()."product/item/list/".$recorder_per_page."/".$i.">".$i."</a></li>";
                        }
                        ?>
                        <li <?php if($current_page == $page_count) echo "class='disabled'";?>><a href="<?=base_url()."product/item/list/".$recorder_per_page."/".$more_end?>">»</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- end col-12 -->
    </div>
    <!-- end row -->
</div>
<!-- end #content -->

<!-- begin scroll to top btn -->
<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
<!-- end scroll to top btn -->
</div>
<!-- end page container -->

<!-- ================== BEGIN BASE JS ================== -->
<script src="<?=base_url();?>assets/plugins/jquery/jquery-1.9.1.min.js"></script>
<script src="<?=base_url();?>assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
<script src="<?=base_url();?>assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
<script src="<?=base_url();?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<!--[if lt IE 9]>
<script src="<?=base_url();?>assets/crossbrowserjs/html5shiv.js"></script>
<script src="<?=base_url();?>assets/crossbrowserjs/respond.min.js"></script>
<script src="<?=base_url();?>assets/crossbrowserjs/excanvas.min.js"></script>
<![endif]-->
<script src="<?=base_url();?>assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?=base_url();?>assets/plugins/jquery-cookie/jquery.cookie.js"></script>
<!-- ================== END BASE JS ================== -->

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="<?=base_url();?>assets/js/apps.min.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->

<script>
    $(document).ready(function() {
        App.init();
        <?php if(isset($_GET['s']) and $_GET['s']=='null'){ echo "alert('沒有找到任何的商品，試試其他關鍵字吧！');"; }?>
    });
</script>
</body>
</html>

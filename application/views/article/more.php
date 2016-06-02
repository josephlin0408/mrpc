<!-- begin #content -->
<!--<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" />-->
<link href="<?=base_url()?>assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="<?=base_url()?>dashboard">Home 首頁</a></li>
        <li class="active">Create 新增</li>
    </ol>
    <!-- begin page-header -->
    <h1 class="page-header">More Article <small>延伸閱讀管理</small></h1>
    <div class="email-btn-row hidden-xs">
        <a href="<?=base_url()?>article" class="btn btn-sm btn-inverse"><i class="fa fa-bars m-r-5"></i> 文章列表</a>
    </div>
    <!-- end page-header -->
    <!-- begin row -->
    <div class="row">
        <!-- begin col-12 -->
        <div class="col-md-12">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                <div class="panel-heading">
                    <div class="panel-heading-btn"></div>
                    <h4 class="panel-title">表單</h4>
                </div>
                <div class="panel-body">
                    <form method="post" action="<?=base_url()?>article/more/add/<?=$article_hash_id?>" class="form-horizontal" >
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">分類名稱</label>
                                <input type="text" name="name" id="jquery-autocomplete" class="auto form-control" required="required" autofocus>
                                <span id="empty-message"></span>
                            </div>
                        </div>
                        <div class="col-md-12" style="text-align: right">
                            <button type="submit" class="btn btn-sm btn-success">Submit 送出</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- end panel -->
        </div>
        <?php if(isset($article_category)){ foreach ($article_category as $unit): ?>
        <div class="col-md-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="<?=base_url()?>article/more/disable/<?=$article_hash_id?>/<?=$unit['arl_id']?>" class="btn btn-xs btn-icon btn-circle btn-danger"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title"><?=$unit['acm_name']?> - <?=$unit['acb_name']?></h4>
                </div>
                <div class="panel-body">
                    <?php foreach ($unit['article_list'] as $article): ?>
                    <div class="col-md-3">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h4 class="panel-title"><?=$article['article_title']?></h4>
                            </div>
                            <div class="panel-body">
                                <img src="<?=base_url()?>uploads/<?=$article['article_image']?>" class="img-responsive">
                            </div>
                        </div>
                    </div>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
        <?php  endforeach; } ?>
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
<script src="<?=base_url()?>assets/plugins/jquery/jquery-1.9.1.min.js"></script>
<script src="<?=base_url()?>assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
<script src="<?=base_url()?>assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
<script src="<?=base_url()?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<!--[if lt IE 9]>
<script src="<?=base_url()?>assets/crossbrowserjs/html5shiv.js"></script>
<script src="<?=base_url()?>assets/crossbrowserjs/respond.min.js"></script>
<script src="<?=base_url()?>assets/crossbrowserjs/excanvas.min.js"></script>
<![endif]-->
<script src="<?=base_url()?>assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?=base_url()?>assets/plugins/jquery-cookie/jquery.cookie.js"></script>
<!-- ================== END BASE JS ================== -->

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="<?=base_url()?>assets/js/apps.min.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->


<script>
    $(document).ready(function() {
        App.init();
        $("#jquery-autocomplete").autocomplete({
            source: "<?=base_url()?>query/article/category",
            response: function(event, ui) {
                // ui.content is the array that's about to be sent to the response callback.
                if (ui.content.length === 0) {
                    $("#empty-message").text("No results found");
                } else {
                    $("#empty-message").empty();
                }
            }
        });
    });
</script>
</body>
</html>
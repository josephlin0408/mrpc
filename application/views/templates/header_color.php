<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<!--<![endif]-->
<head>
    <meta charset="utf-8" />
    <title>Backend Admin v3.0</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link rel="shortcut icon" href="<?= base_url();?>site_images/logo.png" type="image/png"/>
    <link rel="apple-touch-icon" href="<?= base_url();?>site_images/logo.png" type="image/png"/>

    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="<?= base_url();?>assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
    <link href="<?= base_url();?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?= base_url();?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="<?= base_url();?>assets/css/animate.min.css" rel="stylesheet" />
    <link href="<?= base_url();?>assets/css/style.css" rel="stylesheet" />
    <link href="<?= base_url();?>assets/css/style-responsive.min.css" rel="stylesheet" />
    <link href="<?= base_url();?>assets/css/theme/default.css" rel="stylesheet" id="theme" />
    <link href="<?= base_url();?>assets/css/theme/customize.css" rel="stylesheet" id="theme" />
    <!-- ================== END BASE CSS STYLE ================== -->

    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="<?= base_url();?>assets/plugins/jquery-jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" />
    <link href="<?= base_url();?>assets/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" />
    <link href="<?= base_url();?>assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" />
    <link href="<?= base_url();?>assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
    <!-- ================== END PAGE LEVEL STYLE ================== -->

    <link href="<?= base_url();?>dist/css/customize.css" rel="stylesheet" />

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="<?=base_url()?>assets/plugins/jquery/jquery-1.9.1.min.js"></script>
    <script src="<?= base_url();?>assets/plugins/pace/pace.min.js"></script>
    <!-- ================== END BASE JS ================== -->
    <!-- for banner admin-->
    <link href="<?php echo base_url()?>dist/css/style.css" rel="stylesheet" />

    <!--Attach Article Tag Function-->
    <?php if(isset($default_script_link))if($default_script_link):;?>
    <script src="<?=base_url()?>assets/plugins/jquery/jquery-1.9.1.min.js"></script>
    <script src="<?=base_url()?>assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
    <script src="<?=base_url()?>assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
    <?php endif;?>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="<?php echo base_url(); ?>dist/js/tag-it.js" type="text/javascript" charset="utf-8"></script>

    <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/flick/jquery-ui.css">
    <link href="<?php echo base_url(); ?>dist/css/jquery.tagit.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>dist/css/tagit.ui-zendesk.css" rel="stylesheet" type="text/css">

    <!--Attach Article Tag Function-->
</head>
<body>
<!-- begin #page-loader -->
<div id="page-loader" class="fade in"><span class="spinner"></span></div>
<!-- end #page-loader -->

<!-- begin #page-container -->
<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
    <!-- begin #header -->
    <div id="header" class="header navbar navbar-default navbar-fixed-top">
        <!-- begin container-fluid -->
        <div class="container-fluid">
            <!-- begin mobile sidebar expand / collapse button -->
            <div class="navbar-header">
                <a href="<?=base_url()?>" class="navbar-brand"><span class="navbar-logo"></span> Backend Admin</a>
                <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <!-- end mobile sidebar expand / collapse button -->

            <!-- begin header navigation right -->
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown navbar-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="hidden-xs"><?=$this->session->userdata('company_name')." - ".$this->session->userdata('user_name');?></span> <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu animated fadeInLeft">
                        <li><a href="<?=base_url()?>">Log Out</a></li>
                    </ul>
                </li>
            </ul>
            <!-- end header navigation right -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- end #header -->

    <!-- begin #sidebar -->
    <div id="sidebar" class="sidebar">
        <!-- begin sidebar scrollbar -->
        <div data-scrollbar="true" data-height="100%">
            <!-- begin sidebar user -->
            <ul class="nav">
                <li class="nav-profile" style="display:none;">
                    <div class="info">
                        <select name="" id="select_bar_language" style="color: black" onchange="change_lang_id($('#select_bar_language').val());">
                            <?php foreach($select_bar_language as $unit):;?>
                            <option value="<?php echo $unit['language_id'];?>" <?php if($language_id_selected == $unit['language_id'])echo'selected';?>><?php echo $unit['language_name'];?></option>
                            <?php endforeach;?>
                        </select>
                        <b id="lang_change_hint"></b>
                        <script>
                            function change_lang_id(lang_id){
                                var URLs="<?php echo base_url();?>language/session/change";
                                $.ajax({
                                    url: URLs,
                                    data: "language_selected="+lang_id,
                                    type:"POST",
                                    dataType:'text',

                                    success: function(msg){
                                        console.log(msg);
                                        $("#lang_change_hint").html('轉換成功！');
                                    },
                                    error:function(xhr, ajaxOptions, thrownError){
                                        console.log(xhr.status);
                                        console.log(thrownError);
                                    }
                                });

                            }
                        </script>
                    </div>
                </li>
            </ul>
            <!-- end sidebar user -->
            <!-- begin sidebar nav -->
            <ul class="nav">
                <li class="nav-header">Navigation 導覽列</li>
<!--                <li class="has-sub">-->
<!--                    <a href="--><?//= base_url();?><!--dashboard">-->
<!--                        <i class="fa fa-laptop"></i>-->
<!--                        <span>Dashboard 儀表板</span>-->
<!--                    </a>-->
<!--                </li>-->
                <li class="has-sub">
                    <a href="<?= base_url();?>navigation">
                        <i class="fa fa-bars"></i>
                        <span>Navigation 全站導航管理</span>
                    </a>
                </li>
                <li class="has-sub">
                    <a href="<?= base_url();?>banner">
                        <i class="fa fa-bookmark-o"></i>
                        <span>Banner 首頁橫幅管理</span>
                    </a>
                </li>
                <li class="has-sub hidden">
                    <a href="<?= base_url();?>ads">
                        <i class="fa fa-bookmark"></i>
                        <span>Ads 首頁廣告管理</span>
                    </a>
                </li>
                <li class="has-sub">
                    <a href="<?= base_url();?>article/category/main/admin">
                        <i class="fa fa-building"></i>
                        <span>Article Category 文章類別</span>
                    </a>
                </li>
                <li class="has-sub">
                    <a href="<?= base_url();?>article/tag/admin">
                        <i class="fa fa-building"></i>
                        <span>Article Tag 文章標籤</span>
                    </a>
                </li>
                <li class="has-sub">
                    <a href="<?= base_url();?>article">
                        <i class="fa fa-newspaper-o"></i>
                        <span>Article 文章管理</span>
                    </a>
                </li>
                <li class="has-sub" >
                    <a href="<?= base_url();?>inventory/product/category/admin">
                        <i class="fa fa-camera"></i>
                        <span>Product 產品管理</span>
                    </a>
                </li>
                <li class="has-sub">
                    <a href="<?= base_url();?>order">
                        <i class="fa fa-file-o"></i>
                        <span>Order 訂單管理</span>
                    </a>
                </li>
                <li class="has-sub">
                    <a href="<?= base_url();?>advertiser/page/20/1">
                        <i class="fa fa-file-o"></i>
                        <span>advertiser 廣告商</span>
                    </a>
                </li>
                <li class="has-sub">
                    <a href="<?= base_url();?>ads-mark/home/20/1">
                        <i class="fa fa-bookmark"></i>
                        <span>Ads Mark 廣告商註記</span>
                    </a>
                </li>
                <!--
                <li class="has-sub">
                    <a href="<?= base_url();?>ads">
                        <i class="fa fa-bookmark"></i>
                        <span>Ads 廣告管理</span>
                    </a>
                </li>
                <!--
                <li class="has-sub">
                    <a href="<?= base_url();?>member/page/20/1">
                        <i class="fa fa-star"></i>
                        <span>Member 客戶管理</span>
                    </a>
                </li>
                <li class="has-sub">
                    <a href="<?= base_url();?>email">
                        <i class="fa fa-envelope"></i>
                        <span>Email 通知信模板</span>
                    </a>
                </li>
                <li class="has-sub hidden">
                    <a href="<?= base_url();?>coupon">
                        <i class="fa fa-gift"></i>
                        <span>Coupon 折扣管理</span>
                    </a>
                </li>
                <li class="has-sub hidden">
                    <a href="<?= base_url();?>payment/method">
                        <i class="fa fa-usd"></i>
                        <span>Payment 支付方法</span>
                    </a>
                </li>
                <li class="has-sub hidden">
                    <a href="<?= base_url();?>shipping/method">
                        <i class="fa fa-truck"></i>
                        <span>Shipping 運貨方法</span>
                    </a>
                </li>
                <li class="has-sub hidden">
                    <a href="<?= base_url();?>lesson/category">
                        <i class="fa fa-bookmark"></i>
                        <span>Lesson Category 課程類別</span>
                    </a>
                </li>
                <li class="has-sub hidden">
                    <a href="<?= base_url();?>lesson">
                        <i class="fa fa-bookmark"></i>
                        <span>Lesson 課程設定</span>
                    </a>
                </li>
                <li class="has-sub hidden">
                    <a href="<?= base_url();?>language/admin">
                        <i class="fa fa-language"></i>
                        <span>Language 語系管理</span>
                    </a>
                </li>
                <li class="has-sub hidden">
                    <a href="<?= base_url();?>offline/store/admin">
                        <i class="fa fa-building-o"></i>
                        <span>Off-line store 實體商店</span>
                    </a>
                </li>
                <li class="has-sub hidden">
                    <a href="<?= base_url();?>online/store/admin">
                        <i class="fa fa-building"></i>
                        <span>Online store 網路商城</span>
                    </a>
                </li>
                <li class="has-sub">
                    <a href="<?= base_url();?>code">
                        <i class="fa fa-code"></i>
                        <span>Code 追蹤碼管理</span>
                    </a>
                </li>
                <li class="has-sub hidden">
                    <a href="<?= base_url();?>repair">
                        <i class="fa fa-bookmark"></i>
                        <span>Repair 報修管理</span>
                    </a>
                </li>
                <li class="has-sub hidden">
                    <a href="<?= base_url();?>message">
                        <i class="fa fa-bookmark"></i>
                        <span>Message 留言管理</span>
                    </a>
                </li>
                <li class="has-sub">
                    <a href="<?= base_url();?>config/admin">
                        <i class="fa fa-bookmark"></i>
                        <span>Config 系統參數</span>
                    </a>
                </li>
                </li> -->
                <!-- begin sidebar minify button -->
                <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
                <!-- end sidebar minify button -->
            </ul>
            <!-- end sidebar nav -->
        </div>
        <!-- end sidebar scrollbar -->
    </div>
    <div class="sidebar-bg"></div>
    <!-- end #sidebar -->




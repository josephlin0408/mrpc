<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?= base_url();?>site_images/logo.png" type="image/png"/>
    <link rel="apple-touch-icon" href="<?= base_url();?>site_images/logo.png" type="image/png"/>

    <title>Magipea Admin</title>

    <!-- Bootstrap Core CSS-->
    <link href="<?= base_url();?>dist/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="<?= base_url();?>dist/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?= base_url();?>dist/css/sb-admin-2.css" rel="stylesheet">

    <link href="<?= base_url();?>dist/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- hint CSS -->
    <link href="<?= base_url();?>dist/css/hint.css" rel="stylesheet"  type="text/css">
    <!-- datepicker CSS -->
    <link href="<?= base_url();?>dist/css/datepicker3.css" rel="stylesheet"  type="text/css">
    <!-- datatables CSS -->
    <link href="<?= base_url();?>dist/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet"  type="text/css">
    <link href="<?= base_url();?>dist/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet"  type="text/css">
    <!--Customize CSS-->
    <link href="<?= base_url();?>dist/css/customize.css" rel="stylesheet"  type="text/css">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
     <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
     <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <a class="navbar-brand" href="<?= base_url();?>">MAGIPEA 星揚管理後台 v1.0</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">

                <li class="dropdown">
                    <a href="<?= base_url();?>dashboard">
                        <i class="fa fa-dashboard fa-fw"></i>資料中心
                    </a>
                </li>

                <li class="dropdown">
                    <a href="<?= base_url();?>product/item/list/20/1">
                        <i class="fa fa-table fa-fw"></i>產品
                    </a>
                </li>

                <li class="dropdown">
                    <a href="<?= base_url();?>order">
                        <i class="fa fa-table fa-fw"></i>訂單
                    </a>
                </li>

                <li class="dropdown">
                    <a href="<?= base_url();?>member/page/20/1">
                        <i class="fa fa-table fa-fw"></i>客戶
                    </a>
                </li>

                <li class="dropdown">
                    <a href="<?= base_url();?>prospect">
                        <i class="fa fa-table fa-fw"></i>準客戶
                    </a>
                </li>
                <li class="dropdown">
                    <a href="<?= base_url();?>email">
                        <i class="fa fa-table fa-fw"></i>信件模板
                    </a>
                </li>
                <li class="dropdown">
                    <a href="<?= base_url();?>coupon">
                        <i class="fa fa-table fa-fw"></i>折扣
                    </a>
                </li>
                <li class="dropdown">
                    <a href="<?= base_url();?>sop">
                        <i class="fa fa-table fa-fw"></i>資訊
                    </a>
                </li>

                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> <?=$this->session->userdata('username');?></a>
                        </li>
<!--                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>-->
<!--                        </li>-->
                        <li class="divider"></li>
                        <li><a href="<?= base_url();?>"><i class="fa fa-sign-out fa-fw"></i> 登出</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->




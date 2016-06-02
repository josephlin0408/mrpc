<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="javascript:;">Home 首頁</a></li>
        <li class="active">Config Data</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Config Admin <small>Config Admin</small></h1>
    <div class="email-btn-row hidden-xs">
        <?php echo form_open('config/create');?>
        <label for="config_key">新增 : <input type="text" name="config_key" placeholder=" key "/></label>
        <label for="config_val"><input type="text" name="config_val" placeholder=" value "/></label>
        <input type="submit" value="Add"/>
        <?php echo form_close();?>
<!--        <a href="--><?//=base_url()?><!--repair/create" class='btn btn-inverse btn-sm'><i class="fa fa-plus"></i> 新增</a>-->
    </div>
    <!-- end page-header -->
    <!-- end row -->
    <div class="row">
        <!-- begin col-12 -->
        <div class="col-md-12">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="table-basic-7" style="background-color:#d9e0e7">
                    <div class="panel-body" style="background-color:#fff;margin-bottom: 20px;">
                        <div class="row">
                            <div class="col-lg-12">
                                <?php echo form_open('config/update')?>
                                <table class="table table-bordered table-condensed"
                                       style="background-color:#FFFFFF;">
                                    <tr>
                                        <th colspan="11">Config Data</th>
                                    </tr>
                                    <tr>
<!--                                        <th style="width: 16.6%">INDEX</th>-->
                                        <th>KEY</th>
                                        <th>VALUE</th>
                                        <th>STATUS</th>
                                        <th>LAST UPDATE TIME</th>
                                        <th>HOT FIX FUNCTION</th>
                                    </tr>
                                    <?php $index = 0;foreach($config as $content_unit):$index++;
                                        echo form_hidden('config_id[]',$content_unit['config_id']);
                                        ?>
                                    <tr>
<!--                                        <td>--><?php //echo $index;?><!--</td>-->
                                        <td>
                                            <input type="text" name="config_key[]" value="<?php echo $content_unit['config_key'];?>" class="form-control"/>
                                        </td>
                                        <td>
                                            <input type="text" name="config_value[]" value="<?php echo $content_unit['config_value'];?>" class="form-control"/>
                                        </td>

                                        <td>
                                            <select name="config_status[]" class="form-control">
                                                <option value="0">ON</option>
                                                <option value="1" <?php if($content_unit['config_status']==='1')echo'selected';?>>
                                                    OFF
                                                </option>
                                            </select>
                                        </td>
                                        <td>
                                            <?php echo $content_unit['config_update_time'];?>
                                        </td>
                                        <td>
                                            <a class="hidden" href="<?php echo base_url('config/delete').'/'.$content_unit['config_id'];?>" class="btn btn-default btn-sm">
                                                刪除
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach;?>
                                    <tr>
                                        <td colspan="6" style="text-align: center">
                                            <input class="btn btn-success" type="submit" value="更新 Update"/>
                                        </td>
                                    </tr>
                                </table>
                                <?php echo form_close();?>
                            </div>
                        </div>
                    </div>
                <!-- end panel -->
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
    <script src="<?=base_url()?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script src="<?=base_url()?>assets/js/form-plugins.demo.js"></script>
    <script src="<?=base_url()?>dist/js/bootstrap-switch.js"></script>
    <!-- ================== END PAGE LEVEL JS ================== -->

    <script>
        $(document).ready(function() {
            App.init();
            FormPlugins.init();
            $("iframe").each(function() {
                $(this).css("width","100%");
            });
        });
    </script>
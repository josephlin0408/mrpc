
</nav>
<link rel="stylesheet" href="<?= base_url(); ?>dist/pickadate/themes/default.css">
<link rel="stylesheet" href="<?= base_url(); ?>dist/pickadate/themes/default.date.css">
<div id="pickadate_container"></div>

<!-- Page Content -->
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">新增產品庫存</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">

        <div class="col-lg-12">

            <div class="panel panel-default">

                <div class="panel-body">
                    <div class="">

                    </div>
                    <form action="" method="post">
                        <br>
                        _product ： <input type="text" name="_product"><br>
                        _color ： <input type="text" name="_color"><br>
                        _size ： <input type="text" name="_size"><br>
                        enable ： <input type="text" name="enable"><br>
                        in_store ： <input type="text" name="in_store"><br>
                        <input type="submit" name="送出">
                    </form>
                </div>
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->

    </div>
</div>
</div>
<!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="<?php echo base_url(); ?>dist/bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url(); ?>dist/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="<?php echo base_url(); ?>dist/bower_components/metisMenu/dist/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url(); ?>dist/js/sb-admin-2.js"></script>

<!-- Parsley JavaScript -->
<script src="<?php echo base_url(); ?>dist/parsley/dist/parsley.min.js"></script>
<script src="<?php echo base_url(); ?>dist/parsley/src/i18n/zh_tw.js"></script>

<!-- pickadate JavaScript -->
<script src="<?=base_url();?>dist/pickadate/picker.js"></script>
<script src="<?=base_url();?>dist/pickadate/picker.date.js"></script>
<script src="<?=base_url();?>dist/pickadate/legacy.js"></script>
<script src="<?=base_url();?>dist/pickadate/translations/zh_TW.js"></script>

<!-- Customize JavaScript -->
<!--<script src="--><?php //echo base_url(); ?><!--dist/js/member.js"></script>-->
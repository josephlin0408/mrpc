</nav>
<!-- Page Content -->
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">產品管理 <a class="btn btn-default" href="<?=base_url().$list_url?>">回列表</a></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div id="create_status"></div>
            <div class="panel panel-default">
                <!-- /.panel-heading -->
                <div class="panel-body" id="panel-search">
                    <div class="dataTable_wrapper">
                        <div class="table-responsive">
                            <form method="post" accept-charset="utf-8" enctype="multipart/form-data">
                                <table class="table table-hover" style="margin-bottom: 10px;">
                                    <input name="search" type="hidden" value="1">
                                    <tbody>
                                    <tr>
                                        <td><label>產品名稱</label></td>
                                        <td>
                                            <input type="text" value="<?=isset($name) ? $name : "" ?>" name="name" class="search_input form-control" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>產品英文代號</label></td>
                                        <td>
                                            <input type="text" value="<?=isset($token) ? $token : "" ?>" name="token" class="search_input form-control" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>產品描述</label></td>
                                        <td>
                                            <input type="text" value="<?=isset($content) ? $content : "" ?>" name="content" class="search_input form-control" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>產品分類</label></td>
                                        <td>
                                            <select name="_product_type" class="form-control STATUS">
                                                <?php for($i=0;$i < count($product_type_fk); $i++){ ?>
                                                    <option value="<?=$product_type_fk[$i]['idx']?>" <?if(isset($enable)){if($enable==1) echo "selected";}?>><?=$product_type_fk[$i]['name']?></option>
                                                <?php }?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>圖片</label></td>
                                        <td>
                                            <input type="file" name="userfile" >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>定價</label></td>
                                        <td>
                                            <input type="text" name="price_ntd" class="form-control" value="0" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>售價</label></td>
                                        <td>
                                            <input type="text" name="sale_price_ntd" class="form-control" value="0" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>優先度</label></td>
                                        <td>
                                            <input type="text" name="priority" class="form-control" value="0" required>
                                        </td>
                                    </tr>
<!--                                    <tr>-->
<!--                                        <td><label>台灣運費</label></td>-->
<!--                                        <td>-->
<!--                                            <input type="text" name="shipping_fee_tw" class="form-control" value="0" required>-->
<!--                                        </td>-->
<!--                                    </tr>-->
<!--                                    <tr>-->
<!--                                        <td><label>台灣免運條件 (購物車商品總金額)</label></td>-->
<!--                                        <td>-->
<!--                                            <input type="text" name="shipping_fee_tw_free_condition" class="form-control" value="0" required>-->
<!--                                        </td>-->
<!--                                    </tr>-->
<!--                                    <tr>-->
<!--                                        <td><label>外島運費</label></td>-->
<!--                                        <td>-->
<!--                                            <input type="text" name="shipping_fee_il" class="form-control" value="0" required>-->
<!--                                        </td>-->
<!--                                    </tr>-->
<!--                                    <tr>-->
<!--                                        <td><label>外島免運條件 (購物車商品總金額)</label></td>-->
<!--                                        <td>-->
<!--                                            <input type="text" name="shipping_fee_il_free_condition" class="form-control" value="0" required>-->
<!--                                        </td>-->
<!--                                    </tr>-->
                                    <tr>
                                        <td><label>國外運費</label></td>
                                        <td>
                                            <input type="text" name="shipping_fee_as" class="form-control" value="0" required>
                                        </td>
                                    </tr>
<!--                                    <tr>-->
<!--                                        <td><label>國外免運條件 (購物車商品總金額)</label></td>-->
<!--                                        <td>-->
<!--                                            <input type="text" name="shipping_fee_as_free_condition" class="form-control" value="0" required>-->
<!--                                        </td>-->
<!--                                    </tr>-->
                                    <tr>
                                        <td colspan="2">
                                            <input type="submit" class="btn btn-primary" value="新增">
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
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
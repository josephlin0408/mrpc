</nav>
<div id="page-wrapper" style="margin-left: 250px">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">
                商品總管理
                <?php $attr='style="margin:0px;display: inline"';?>
            </h3>
            <h6>語系預設：Chinese (Taiwan)</h6>
            <h6>公司預設：ez_cloud</h6>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- content start -->
    <div class="row">
        <div class="col-lg-3">
            <table border="1" class="table table-bordered table-condensed" style="background-color:#FFFFFF;">
                <tr>
                    <th colspan="9">商品類別</th>
                </tr>
                <tr class="warning">
                    <?php $font_size="font-size:16px;";?>
                    <th style="<?=$font_size;?>width:10%">#</th>
                    <th style="<?=$font_size;?>width:45%">商品類別名稱</th>
                    <th style="<?=$font_size;?>width:45%">維護</th>
                </tr>
                <?php echo form_open('inventory/category/admin',$attr);?>
                <tr>
                    <td>新</td>
                    <td>
                        <input type="text" value="" class="form-control" name="product_category_name"/>
                    </td>
                    <td>
                        <input class="btn btn-primary btn-large btn-block" type="submit" value="新增"/>
                    </td>
                </tr>
                </form>
                <tr>
                    <td>1</td>
                    <td>
                        <center>
                            武器
                        </center>
                    </td>
                    <td>
                        <center>
                            <a href="">編輯</a>
                            <a href="">管理</a>
                        </center>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>
                        <center>
                            防具
                        </center>
                    </td>
                    <td>
                        <center>
                            <a href="">編輯</a>
                            <a href="">管理</a>
                        </center>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>
                        <center>
                            配件
                        </center>
                    </td>
                    <td>
                        <center>
                            <a href="">編輯</a>
                            <a href="">管理</a>
                        </center>
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-lg-3">
            <table border="1" class="table table-bordered table-condensed" style="background-color:#FFFFFF;">
                <tr>
                    <th colspan="9">類別模組 - 武器</th>
                </tr>
                <tr class="warning">
                    <?php $font_size="font-size:16px;";?>
                    <th style="<?=$font_size;?>width:10%">#</th>
                    <th style="<?=$font_size;?>width:30%">名稱</th>
                    <th style="<?=$font_size;?>width:30%">單位</th>
                    <th style="<?=$font_size;?>width:30%">維護</th>
                </tr>
                <?php echo form_open('inventory/category/admin',$attr);?>
                <tr>
                    <td>新</td>
                    <td>
                        <input type="text" value="" class="form-control" name="product_category_name"/>
                    </td>
                    <td>
                        <input type="text" value="" class="form-control" name="product_category_name"/>
                    </td>
                    <td>
                        <input class="btn btn-primary btn-large btn-block" type="submit" value="新增"/>
                    </td>
                </tr>
                </form>
                <tr>
                    <td>1</td>
                    <td>劍</td>
                    <td>把</td>
                    <td>
                        <center>
                            <a href="">編輯</a>
                            <a href="">屬性</a>
                            <a href="">商品</a>
                        </center>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>弓</td>
                    <td>支</td>
                    <td>
                        <center>
                            <a href="">編輯</a>
                            <a href="">屬性</a>
                            <a href="">商品</a>
                        </center>
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-lg-6">
            <div class="row">
                <div class="col-lg-6">
                    <table border="1" class="table table-bordered table-condensed" style="background-color:#FFFFFF;">
                        <tr>
                            <th colspan="9">模組屬性 - 劍</th>
                        </tr>
                        <tr class="warning">
                            <?php $font_size="font-size:16px;";?>
                            <th style="<?=$font_size;?>width:10%">#</th>
                            <th style="<?=$font_size;?>width:45%">名稱</th>
                            <th style="<?=$font_size;?>width:45%">維護</th>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>尺寸</td>
                            <td>
                                <center>
                                    <a href="">編輯</a>
                                    <a href="">管理</a>
                                </center>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>顏色</td>
                            <td>
                                <center>
                                    <a href="">編輯</a>
                                    <a href="">管理</a>
                                </center>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-6">
                    <table border="1" class="table table-bordered table-condensed" style="background-color:#FFFFFF;">
                        <tr>
                            <th colspan="9">屬性值管理 - 尺寸</th>
                        </tr>
                        <tr class="warning">
                            <?php $font_size="font-size:16px;";?>
                            <th style="<?=$font_size;?>width:10%">#</th>
                            <th style="<?=$font_size;?>width:45%">名稱</th>
                            <th style="<?=$font_size;?>width:45%">維護</th>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>短</td>
                            <td>
                                <center>
                                    <a href="">編輯</a>
                                    <a href="">管理</a>
                                </center>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>長</td>
                            <td>
                                <center>
                                    <a href="">編輯</a>
                                    <a href="">管理</a>
                                </center>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <table border="1" class="table table-bordered table-condensed" style="background-color:#FFFFFF;">
                        <tr>
                            <th colspan="9">模組商品 - 劍</th>
                        </tr>
                        <tr class="warning">
                            <?php $font_size="font-size:16px;";?>
                            <th style="<?=$font_size;?>width:10%">#</th>
                            <th style="<?=$font_size;?>width:12%">尺寸</th>
                            <th style="<?=$font_size;?>width:12%">顏色</th>
                            <th style="<?=$font_size;?>width:12%">定價</th>
                            <th style="<?=$font_size;?>width:12%">單位成本</th>
                            <th style="<?=$font_size;?>width:12%">期初數量</th>
                            <th style="<?=$font_size;?>width:12%">期初單位成本</th>
                            <th style="<?=$font_size;?>width:12%">維護</th>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>短</td>
                            <td>淺紫色</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <center>
                                    <a href="">編輯</a>
                                    <a href="">管理</a>
                                </center>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>短</td>
                            <td>淺紅色</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <center>
                                    <a href="">編輯</a>
                                    <a href="">管理</a>
                                </center>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- content end -->
</div>
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

</body>
</html>
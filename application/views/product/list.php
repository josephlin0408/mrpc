</nav>
<!-- Page Content -->
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">產品管理 <a class="btn btn-success" href="<?=base_url()."product/item/all"?>">庫存管理</a> <a class="btn btn-default" href="<?=base_url()."product/type/list"?>">產品分類</a> <a class="btn btn-default" href="<?=base_url()."config/panel"?>">費用設定</a> <a class="btn btn-primary" href="<?=base_url().$create_url?>">新增產品</a> </h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">

        <div class="col-lg-12">

            <div id="create_status"></div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <button class="btn btn-default" id="btn-search-function">搜尋功能</i></button>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body" id="panel-search" style="<?if($this->input->post("search")!="1")echo "display:none;"?>">
                    <div class="dataTable_wrapper">
                        <div class="table-responsive">

                            <form method="post" accept-charset="utf-8" id="search">
                            <table class="table table-hover" style="margin-bottom: 10px;">
                                <input name="search" type="hidden" value="1">
                                <tbody>
                                <tr>
                                    <td><label>產品名稱</label></td>
                                    <td>
                                        <input type="text" value="<?=isset($name) ? $name : "" ?>" name="name" class="search_input form-control">
                                    </td>
                                    <td><label>產品分類</label></td>
                                    <td>
                                        <select name="_product_type" class="form-control STATUS">
                                            <option value="">不限</option>
                                            <?php for($i=0;$i < count($product_type_fk); $i++){ ?>
                                                <option value="<?=$product_type_fk[$i]['idx']?>" <?if(isset($enable)){if($enable==1) echo "selected";}?>><?=$product_type_fk[$i]['name']?></option>
                                            <?php }?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label>狀態</label></td>
                                    <td>
                                        <select name="enable" class="form-control STATUS">
                                            <option value="">不限</option>
                                            <option value="1" <?if(isset($enable)){if($enable==1) echo "selected";}?>>正常</option>
                                            <option value="0" <?if(isset($enable)){if($enable==0) echo "selected";}?>>停用</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label>售價</label></td>
                                    <td colspan="3">
                                        <input type="text" name="price_ntd_min"
                                               class="form-control search_input"
                                               style="width:45%;display:inline;" placeholder="最小金額" value=""> ~
                                        <input type="text" name="price_ntd_max"
                                               class="form-control search_input"
                                               style="width:45%;display:inline;" placeholder="最大金額" value="">
                                    </td>
                                </tr>
<!--                                <tr>-->
<!--                                    <td><label>售價</label></td>-->
<!--                                    <td colspan="3">-->
<!--                                        <input type="text" name="price_rmb_min" id="amount_min"-->
<!--                                               class="form-control search_input"-->
<!--                                               style="width:45%;display:inline;" placeholder="最小金額" value=""> ~-->
<!--                                        <input type="text" name="price_rmb_max" id="amount_max"-->
<!--                                               class="form-control search_input"-->
<!--                                               style="width:45%;display:inline;" placeholder="最大金額" value="">-->
<!--                                    </td>-->
<!--                                </tr>-->
                                <tr>
                                    <td><label>銷量</label></td>
                                    <td colspan="3">
                                        <input type="text" name="sale_count_min" id="amount_min"
                                               class="form-control search_input"
                                               style="width:45%;display:inline;" placeholder="最小數量" value=""> ~
                                        <input type="text" name="sale_count_max" id="amount_max"
                                               class="form-control search_input"
                                               style="width:45%;display:inline;" placeholder="最大數量" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <input type="button" class='btn btn-primary' value='清除' id="reset">
                                        <input type="submit" class="btn btn-primary" value="搜尋">
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
<?php //print_r($data)?>
<div class="panel panel-default">

    <div class="panel-heading">
        產品列表
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">

        <div class="dataTable_wrapper">
            <?php if(isset($data) AND count($data)>0){ ?>
                <table class="table table-striped table-bordered table-hover" id="dataTables">
                    <thead>
                    <tr>
                        <?php
                        $key_i18n = array('idx' => "序號",
                            '_product_type' => "產品分類",
                            'name' => "產品名稱",
                            'sale_count' => "銷售量",
                            'sale_price_ntd' => "產品售價",
                        );
                        foreach ($data[0] as $key => $value):
                            switch($key){
//                                case 'idx':
                                case '_product_type':
                                case 'sale_price_ntd':
                                case 'name':
                                case 'sale_count':
                                    echo "<th>".$key_i18n[$key]."</th>";
                                    break;
                            }
                            ?>
                        <?php endforeach; ?>
                        <th>選項</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $enum_enable = array( "停用", "正常");
                    foreach ($data as $item):
                        echo "<tr>";
                        foreach ($item as $key => $value):
                            switch($key){
//                                case 'idx':
                                case 'name':
                                case 'sale_count':
                                case 'sale_price_ntd':
                                    echo "<td>".$value."</td>";
                                    break;
                                case '_product_type':
                                    foreach ($product_type_fk as $key2 => $value2){
                                        if($product_type_fk[$key2]['idx']==$value)
                                            echo "<td>".$product_type_fk[$key2]['name']."</td>";
                                    }
                                    break;

                            }
                        endforeach;?>
                        <td style="width: 350px">
                            <a class="btn btn-default" href="<?=base_url().$update_url?>/<?=$item['idx']?>">編輯</a>
                            <a class='btn btn-default' onclick='return confirm("確定刪除嗎？")' href='<?=base_url().$delete_url?>/<?=$item['idx']?>'>刪除</a>
                        </td>
                        <?php echo "</tr>";
                    endforeach;?>
                    </tbody>
                </table>
            <?php }else{

                echo "查無資料";

            } ?>
        </div>


    </div>

    <div class="panel-footer">
        <div class="row">
            <div class="col-lg-4">
                每頁顯示
                <select class="form-control" id="select_recorder_per_page" style="width: 70px;display: inline">
                    <option value="20" <?php if($recorder_per_page == 20)echo "selected"?>>20</option>
                    <option value="50" <?php if($recorder_per_page == 50)echo "selected"?>>50</option>
                    <option value="100" <?php if($recorder_per_page == 100)echo "selected"?>>100</option>
                    <option value="500" <?php if($recorder_per_page == 500)echo "selected"?>>500</option>
                    <option value="1000" <?php if($recorder_per_page == 1000)echo "selected"?>>1000</option>
                </select>
                筆資料
            </div>
            <div class="col-lg-8">
                <div class=" div-pages">
                    <?php if(isset($count_all_results)) echo "全部".$count_all_results."筆資料，第"?>
                    <select class="form-control" id="select_page" style="width: 70px;display: inline">
                        <?php
                        if(isset($count_all_results)){
                            $page_count = $count_all_results/$recorder_per_page;
                            $page_count = ceil($page_count);
                            for($i = 1;$i <= $page_count; $i++){
                                if($i == $current_page){
                                    $selected = "selected";
                                } else {
                                    $selected = "";
                                }
                                echo "<option value=".$i." ".$selected.">".$i."</option>";
                            }}?>
                    </select>
                    <?php if(isset($page_count)) echo "頁，共".$page_count."頁"?>
                </div>
            </div>
        </div>
    </div>
    <!-- /.panel-body -->
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

<script>
    $('#btn-search-function').click(function() {
        $("#panel-search").toggle();
    });
    $('#reset').click(function() {
        $(".search_input").val("");
    });
    $("#select_recorder_per_page").change(function(){
        window.location.href = "<?=base_url().$list_url?>/"+$(this).val()+"/1";
    });
    $("#select_page").change(function(){
        window.location.href = "<?=base_url().$list_url?>/"+$("#select_recorder_per_page").val()+"/"+$(this).val();
    });
</script>


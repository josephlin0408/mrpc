</nav>
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" />

<!-- Page Content -->
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">新增產品加購</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class=""></div>
<!--                    <form method="post" accept-charset="utf-8" id="search">-->
                        <?php $attr='id="search"';?>
                        <?php echo form_open('product/upsell/list/'.$product_idx,$attr);?>
                        <table class="table table-hover" style="margin-bottom: 10px;">
                            <input name="search" type="hidden" value="1">
                            <tbody>
                            <tr>
                                <td><label>加購產品名稱</label></td>
                                <td>
                                    <input type="hidden" name="add_product" value="<?=$product_idx?>"/>
                                    <input type="text" value="<?=isset($name) ? $name : "" ?>"
                                           name="product_target_name"
                                           class="typeahead search_input form-control auto"
                                           required
                                           id="input_name"
                                        >
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="submit" class="btn btn-primary" value="新增" id="submit_name">
                                </td>
                            </tr>
                            </tbody>
                        </table>
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

<!-- typeahead JavaScript -->
<script src="<?php echo base_url(); ?>dist/js/typeahead.js/typeahead.jquery.js"></script>

<!-- Parsley JavaScript -->
<script src="<?php echo base_url(); ?>dist/parsley/dist/parsley.min.js"></script>
<script src="<?php echo base_url(); ?>dist/parsley/src/i18n/zh_tw.js"></script>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>

<script type="text/javascript">
    $(function () {
        //啟動
//        $(".auto").on('blur', function() {alert('XX');});
            $(".auto").autocomplete({
                source: "<?=base_url()?>product/upsell/query",
                minLength: 1
            });
    });

//    $('#submit_name').on('click',function(){
//        var name = $('#input_name').val();
//
//        var URLs="<?php //echo base_url();?>//product/upsell/create/ajax";
//        $.ajax({
//            url: URLs,
//            data: "name="+name,
//            type:"POST",
//            dataType:'text',
//
//            success: function(msg){
//                $('#product_id').val(msg);
////                $('#search').submit();
//            },
//            error:function(xhr, ajaxOptions, thrownError){
//                console.log(xhr.status);
//                console.log(thrownError);
//            }
//        });
//
//    });

</script>

<form action="" method="post" enctype="multipart/form-data">
    <br>
    _product ： <input type="text" name="_product" value="<?=$id?>"><br>
    image ： <input type="file" name="userfile" value=""><br>
    order  ： <input type="text" name="order" value="0"><br>
    enable ： <input type="text" name="enable" value="1"><br>
    <input type="submit" name="送出">
</form>
<?PHP
if (!empty($result)) {
    echo "<pre>";
    print_r($result);
    echo "</pre>";
}

?>
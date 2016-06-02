<form action="" method="post">
    <br>
    idx ： <input type="text" name="idx" value="<?=$data['idx']?>"><br>
    order ： <input type="text" name="order" value="<?=$data['order']?>"><br>

    <input type="submit" name="送出">
</form>
<?PHP
if (!empty($data)) {
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}
?>
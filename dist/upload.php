<?php
if ($_FILES['file']['name']) {
    if (!$_FILES['file']['error']) {
        $name = sprintf('%0.0f',(round(microtime(true))*10000)).'_'.strval(rand(10000,99999)).'_'.strval(rand(10000,99999));
        $ext_name = substr($_FILES['file']['name'], -3);
        $filename = $name . '.' . $ext_name;
        $destination = '../article_images/' . $filename;
        $location = $_FILES["file"]["tmp_name"];

        while(is_file($destination)) {
            $name = sprintf('%0.0f',(round(microtime(true))*10000)).'_'.strval(rand(10000,99999)).'_'.strval(rand(10000,99999));
            $filename = $name . '.' . $ext_name;
            $destination = '../article_images/' . $filename;
        }

        if(move_uploaded_file($location,
            iconv("UTF-8", "big5", $destination ))) {
            if($_SERVER['HTTP_HOST'] == "127.0.0.1")
            {
                echo 'http://127.0.0.1/mrpc/article_images/' . $filename;
            }else{
                echo 'http://promisekeeping.com/admin/article_images/' . $filename;
            }
        } else{
            echo "檔案上傳失敗，請再試一次!";
        }

    }
    else
    {
        echo  $message = 'Ooops!  Your upload triggered the following error:  '.$_FILES['file']['error'];
    }
}
<?php
//读取文件
function fileRead($url/*文件地址和名称*/){
    $file = fopen($url, "r") or die("Unable to open file!");
    $result = fread($file,filesize($url));
    fclose($file);
    return $result;
}
function fileReadPhp($url/*文件的地址和名称*/){
    $handle = fopen($url, 'r');
    $content = '';
    while(!feof($handle)){
        $content .= fread($handle, 8080);
    }
    fclose($handle);
    return $content;
}

//用于上传图片
function photoUpload($dictionary/*存储的位置 格式：XXX/*/){
    // 获取时间
//    $date = date("Y-m-d");

    // 允许上传的图片后缀
    $allowedExts = array("gif", "jpeg", "jpg", "png");
    $temp = explode(".", $_FILES["file"]["name"]);

//    echo $_FILES["file"]["size"];
    $extension = end($temp);     // 获取文件后缀名
    if ((($_FILES["file"]["type"] == "image/gif")
            || ($_FILES["file"]["type"] == "image/jpeg")
            || ($_FILES["file"]["type"] == "image/jpg")
            || ($_FILES["file"]["type"] == "image/pjpeg")
            || ($_FILES["file"]["type"] == "image/x-png")
            || ($_FILES["file"]["type"] == "image/png"))
        && ($_FILES["file"]["size"] < 31457280)   // 小于 30 mb
        && in_array($extension, $allowedExts))
    {
        if ($_FILES["file"]["error"] > 0)
        {
            $res = [0, $_FILES["file"]["error"], ""];
//            echo "错误：: " . $_FILES["file"]["error"] . "<br>";
        }
        else
        {
//            echo "上传文件名: " . $_FILES["file"]["name"] . "<br>";
//            echo "文件类型: " . $_FILES["file"]["type"] . "<br>";
//            echo "文件大小: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
//            echo "文件临时存储的位置: " . $_FILES["file"]["tmp_name"] . "<br>";


            // 判断当前目录下的 upload 目录是否存在该文件
            // 如果没有 upload 目录，你需要创建它，upload 目录权限为 777
            if (file_exists("$dictionary" . $_FILES["file"]["name"]))
            {
                $res = [0, $_FILES["file"]["name"] . " 文件已经存在。 ", ""];
//                echo $_FILES["file"]["name"] . " 文件已经存在。 ";
            }
            else
            {
                // 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
                move_uploaded_file($_FILES["file"]["tmp_name"],
                    $dictionary . $_FILES["file"]["name"]);
//                echo "文件存储在: " . $dictionary . $_FILES["file"]["name"];
                $res = [1, "上传成功", $dictionary . $_FILES["file"]["name"]];
            }
        }
    }
    else
    {
//        echo "非法的文件格式";
        $res = [0, "非法文件，无法识别该图片文件，或文件大小超过30MB", ""];
    }
    return $res;
}

//创建目录
function dictionaryCreat($dir/*目录的位置和名称*/){
    if(!file_exists($dir)){
        mkdir($dir);
        return "";
    } else{
        return "文件已存在,用户请忽略此项提示";
    }
}

//创建或写入文件
//追加
function fileWrite($url/*地址*/, $data/*内容*/){
    $file = fopen($url, "a") or die("Unable to open file!");
    fwrite($file, $data);
    fclose($file);
}
//覆盖
function fileOverwrite($url/*地址*/, $data/*内容*/){
    $file = fopen($url, "w") or die("Unable to open file!");
    fwrite($file, $data);
    fclose($file);
}
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
function fileReadContent($url/*文件的地址和名称*/)
{
    $file = fopen($url, 'r');
    $content = array();
    if (!$file) {
        return 'file open fail';
    } else {
        $i = 0;
        while (!feof($file)) {
            $content[$i] = mb_convert_encoding(fgets($file), "UTF-8", "GBK,ASCII,ANSI,UTF-8");
            $i++;
        }
        fclose($file);
        $content = array_filter($content); //数组去空
    }
    return $content;
}

//用于上传图片
function photoUpload($dictionary/*存储的位置 格式：XXX/*/, $inputName/*input中Name参数*/){
    // 获取时间
//    $date = date("Y-m-d");

    // 允许上传的图片后缀
    $allowedExts = array("gif", "jpeg", "jpg", "png");
    $temp = explode(".", $_FILES["$inputName"]["name"]);

//    echo $_FILES["file"]["size"];
    $extension = end($temp);     // 获取文件后缀名
    if ((($_FILES["$inputName"]["type"] == "image/gif")
            || ($_FILES["$inputName"]["type"] == "image/jpeg")
            || ($_FILES["$inputName"]["type"] == "image/jpg")
            || ($_FILES["$inputName"]["type"] == "image/pjpeg")
            || ($_FILES["$inputName"]["type"] == "image/x-png")
            || ($_FILES["$inputName"]["type"] == "image/png"))
        && ($_FILES["$inputName"]["size"] < 31457280)   // 小于 30 mb
        && in_array($extension, $allowedExts))
    {
        if ($_FILES["$inputName"]["error"] > 0)
        {
            $res = [0, $_FILES["$inputName"]["error"], ""];
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
            if (file_exists("$dictionary" . $_FILES["$inputName"]["name"]))
            {
                $res = [0, $_FILES["$inputName"]["name"] . " 文件已经存在。 ", ""];
//                echo $_FILES["file"]["name"] . " 文件已经存在。 ";
            }
            else
            {
                // 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
                move_uploaded_file($_FILES["$inputName"]["tmp_name"],
                    $dictionary . $_FILES["$inputName"]["name"]);
//                echo "文件存储在: " . $dictionary . $_FILES["file"]["name"];
                $res = [1, "上传成功", $_FILES["$inputName"]["name"]];
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
//获取目录下所有文件名
function getSubdirectory($dir,$is_recursion = false)
{
    if ($is_recursion) {
        $files = array();    //定义一个数组
        if (is_dir($dir)) {        //检测是否存在文件

            if ($handle = opendir($dir)) {    //打开目录

                while (($file = readdir($handle)) !== false) {        //返回当前文件的条目

                    if ($file != "." && $file != "..") {        //去除特殊目录

                        if (is_dir($dir . "/" . $file)) {        //判断子目录是否还存在子目录

                            $files[$file] = getSubdirectory($dir . "/" . $file,$is_recursion =true);        //递归调用本函数，再次获取目录
                        } else {

                            $files[] = $dir . "/" . $file;        //获取目录数组
                        }
                    }
                }
                closedir($handle);        //关闭文件夹
                return $files;        //返回文件夹数组
            }
        }
    }
    $file = scandir($dir);

    return $file;
}


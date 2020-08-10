<?php
include 'data/php/function/makeDictionary.php';
include 'data/php/function/FileControl.php';
function main(){
    $fileName = getSubdirectory("photo");
    for($i = 2; $i <= count($fileName); $i++){
        echo "完成文件".$fileName[$i]."<br/>";
        fileWrite("data/photoList.txt",
            "https://www-potatost-user.oss-cn-hangzhou.aliyuncs.com/c2020class1/memoryImg/".
            $fileName[$i]."\n");
    }
}
main();
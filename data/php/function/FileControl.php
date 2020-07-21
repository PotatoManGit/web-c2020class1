<?php
function fileRead($url/*文件地址和名称*/){
    $handle = fopen($url, "r");//读取二进制文件时，需要将第二个参数设置成'rb'
    //通过filesize获得文件大小，将整个文件一下子读到一个字符串中
    $contents = fread($handle, filesize ($url));
    fclose($handle);
}
<?php
function fileRead($url/*文件地址和名称*/){
    $file = fopen($url, "r") or die("Unable to open file!");
    $result = fread($file,filesize($url));
    fclose($file);
    return $result;
}
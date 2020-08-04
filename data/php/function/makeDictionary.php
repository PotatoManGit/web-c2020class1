<?php
function makeDictionary($userId){
    //创建用户文件夹及文件
    //创建根目录
    dictionaryCreat(sprintf("../../user/%s", $userId));

    //创建根目录文件及文件夹
    dictionaryCreat(sprintf("../../user/%s/imgMain", $userId));
    dictionaryCreat(sprintf("../../user/%s/upload", $userId));
    dictionaryCreat(sprintf("../../user/%s/data", $userId));

    //创建data中目录
}
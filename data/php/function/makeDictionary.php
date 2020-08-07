<?php
function makeDictionary($userId){
    //创建用户文件夹及文件
    //创建根目录
    dictionaryCreat(sprintf("../../user/%s", $userId));

    //创建根目录文件及文件夹
    dictionaryCreat(sprintf("../../user/%s/data", $userId));

    //创建data中目录
    dictionaryCreat(sprintf("../../user/%s/data/imgMain", $userId));
    dictionaryCreat(sprintf("../../user/%s/data/upload", $userId));

    //创建根目录文件
    fileOverwrite(sprintf("../../user/%s/index.php", $userId),
        strtr(fileRead("../../web/userFile/index.php"), array("{userIdReal}" => $userId)));
    fileOverwrite(sprintf("../../user/%s/userSetting.php", $userId),
        fileRead("../../web/userFile/userSetting.php"));

    //创建data中文件
    fileOverwrite(sprintf("../../user/%s/data/userText.html", $userId),
        fileRead("../../web/userFile/data/userText.html"));
    fileOverwrite(sprintf("../../user/%s/data/imgMain/default_background.jpg", $userId),
        fileRead("../../web/userFile/data/imgMain/default_background.jpg"));
    fileOverwrite(sprintf("../../user/%s/data/imgMain/default_headPortrait.png", $userId),
        fileRead("../../web/userFile/data/imgMain/default_headPortrait.png"));
    fileOverwrite(sprintf("../../user/%s/data/imgMain/default_ownPhoto.jpg", $userId),
        fileRead("../../web/userFile/data/imgMain/default_ownPhoto.jpg"));

}
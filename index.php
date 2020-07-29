<?php
include 'data/php/function/MysqlControl.php';
include 'data/php/function/FileControl.php';

function main(){
    $pdo = connectMysql();
    //try {
    //    $pdo -> exec("CREATE TABLE asd(s int, b int)charset = utf8");
    //} catch (PDOException $e) { // 错误处理
    //    die($e->getMessage());
    //}
    if(true){
        echo fileRead("data/web/index.html");//构造主页
    }
}
main();
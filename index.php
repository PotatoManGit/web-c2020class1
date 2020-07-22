<?php
include 'data/php/function/MysqlControl.php';
include 'data/php/function/FileControl.php';

function main(){
    $pdo = connectMysql("127.0.0.1","root",
        "root","c2020class1_potatost_xyz","utf-8");
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
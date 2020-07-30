<?php
/*这个php文件只是Mysql数据库的控制函数库
这个文件无法执行，进应用于引用目的*/

//本函数用来连接数据库
function connectMysql(){
    $user = "root";
    $password = "root";
    $database = "c2020class1_potatost_xyz";
    $dsn = sprintf("mysql:host = %s; dbname = %s; charset = %s",
        "127.0.0.1",
        "c2020class1_potatost_xyz",
        "utf-8"
    );
    try {
        $pdo = new PDO($dsn, $user, $password);// 连接
        $pdo -> setAttribute(PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION);//错误处理方式设置
        $useDataBase = sprintf("USE %s", $database);
        $pdo -> exec($useDataBase);
    } catch (PDOException $e) { // 错误处理
        die($e->getMessage());
    }
    return $pdo;
}
//本函数用于表查询，只能查询一个结果
function inquireTable($pdo/*PDO变量*/, $table/*表名*/, $key/*查询关键词*/,
                      $inputName/*查询依据索引*/, $resName/*查询结果索引*/){
    try{
        $sql = sprintf("SELECT %s FROM %s WHERE %s LIKE '%s'",$resName ,$table, $inputName, $key);
        $res = $pdo -> query($sql);//查询结果集
        $result = $res -> fetch(PDO::FETCH_BOTH);
        return $result[0];

    }catch (PDOException $e) { // 错误处理
        die($e->getMessage());
    }
}
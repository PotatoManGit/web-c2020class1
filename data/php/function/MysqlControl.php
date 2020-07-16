<!--这个php文件只是Mysql数据库的控制函数库
这个文件无法执行，进应用于引用目的-->
<?php
//本函数用来连接数据库
function connectMysql($host/*数据库url*/, $user/*用户名*/, $password/*密码*/,
                      $database/*数据库名*/, $charset/*字符集*/){
    $dsn = sprintf("mysql:host = %s; dbname = %s; charset = %s",
        $host, $database, $charset
    );

    try {
        $pdo = new PDO($dsn, $user, $password);// 连接
        $pdo -> setAttribute(PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION);//错误处理方式设置
        $pdo -> exec("USE %s",$database);
    } catch (PDOException $e) { // 错误处理
        die($e->getMessage());
    }
    return $pdo;
}
//本函数用于创建表
function createTable($pdo/*继承PDO*/, $tableName/*表名*/, $tableCharset/*表字符集*/){

}
<?php
include 'data/php/function/MysqlControl.php';
$pdo = connectMysql();
$pdo -> exec("INSERT INTO user_basic_data (username, password) VALUES ('haha','hahaha')");
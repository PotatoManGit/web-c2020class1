<?php
    include '../function/MysqlControl.php';
    $pdo = connectMysql("127.0.0.1","root",
        "root","c2020class1_potatost_xyz","utf-8");
//    try{
//        $sql = "SELECT  FROM user WHERE user_id < :user_id";
//        $sql = "SELECT * FROM `user` WHERE `login` LIKE :login";
//
//        $stmt = $dbh -> prepare($sql);
//
//        $stmt->execute(array(':login'=>$login));
//
//        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
//
//            print_r($row);
//
//        }
//        echo $a;
//    }catch (PDOException $e) { // 错误处理
//        die($e->getMessage());
//    }
    ?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <title>SingUp--初2020届一班留念</title>
    <link rel="icon" type="image/x-icon" href="/data/web/data/img/logo/logoMain.png"/>
    <link rel="stylesheet" href="/data/web/data/css/mainStyle.css">
    <link rel="stylesheet" href="/data/web/data/css/singMain.css">

</head>
<body class="indexBodySetting">
<!--    顶部内容-->
    <div class="div_top">
        <a href="/index.php"><img style="border-radius: 50% 50%;"
                src="/data/web/data/img/logo/logoMain.png" width="10%"></a>
        <h1 style="color: #f6fff4">永远的初2020届1班</h1>
        <h2 style="color: #6eff6f;">登录</h2>
    </div>

<!--    主体内容-->
    <center><div class="div_body_1">
        <form action="/data/php/userControl/singIn.php" method="post">
            <input type="text" name="userName" class="formInputStyle_01"
                   required
                   pattern="[A-Za-z0-9]{1,10}" title="用户名输入格式错误，请检查后输入"
                   placeholder="用户名"/><br/><br/>
            <input type="password" name="passWord" class="formInputStyle_01"
                   required
                   pattern="[A-Za-z0-9]{6,16}" title="密码输入格式错误，请检查后输入"
                   placeholder="密码"/>
            <br/>
            <div class="div_bottom">
                <button class="buttonStyle_01" type="submit" autofocus>登 录</button>
            </div>
        </form>
    </div></center>
    <div class="div_body_2">
        <h4 style="color: #ffffff;">没有录入信息？点击
            <a href="/data/php/userControl/singIn.php" style="color: #cff1ba">注册</a>
        </h4>
    </div>
</body>
</html>
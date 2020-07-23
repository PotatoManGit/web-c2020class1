<?php
include '../function/FileControl.php';
include '../function/MysqlControl.php';
include '../function/PasswordMd5.php';
    function main(){

    }
?>

<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <title>登入--初2020届一班留念</title>
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
        <h2 style="color: #6eff6f;">数据录入</h2>
    </div>

<!--    主体内容-->
    <center><div class="div_body_1">
        <form action="/data/php/userControl/singUp.php" method="post">
            <input type="text" name="username" class="formInputStyle_01"
                   required
                   pattern="[A-Za-z0-9]{1,20}" title="用户名输入格式错误，请检查后输入"
                   placeholder="用户名：1-20位--必填"/><br/><br/>
            <input type="password" name="password" class="formInputStyle_01"
                   required
                   pattern="[A-Za-z0-9]{6,20}" title="密码输入格式错误，请检查后输入"
                   placeholder="密码：6-20位--必填"/><br/><br/>
            <input type="password" name="password" class="formInputStyle_01"
                   required
                   pattern="[A-Za-z0-9]{6,20}" title="密码输入格式错误，请检查后输入"
                   placeholder="再输一遍密码"/>
            <br/>
            <div class="div_bottom">
                <button class="buttonStyle_01" type="submit" autofocus>登 录</button>
            </div>
        </form>
    </div></center>
    <div class="div_body_2">
        <h4 style="color: #ffffff;">已录入信息？点击
            <a href="/data/php/userControl/singUp.php" style="color: #cff1ba">录入</a>
            <?php echo main(); ?>
        </h4>
    </div>
</body>
</html>
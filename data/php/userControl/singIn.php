<?php
include '../function/FileControl.php';
include '../function/MysqlControl.php';
include '../function/PasswordMd5.php';
    function main(){
        return fileUpload("asd");
    }
?>

<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <title>信息录入--初2020届一班留念</title>
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
        <h2 style="color: #6eff6f;">信息录入</h2>
    </div>

<!--    主体内容-->
    <center><div class="div_body_1">
        <form action="/data/php/userControl/singUp.php" method="post">
            <input type="text" name="username" class="formInputStyle_01"
                   required
                   pattern="[A-Za-z0-9]{1,20}" title="用户名输入格式错误，请检查后输入"
                   placeholder="许可码：在QQ群里公布了!"/><br/><br/>
            <input type="text" name="username" class="formInputStyle_01"
                   required
                   pattern="[A-Za-z0-9]{1,20}" title="用户名输入格式错误，请检查后输入"
                   placeholder="用户名：1-20位--必填"/><br/><br/>
            <input type="password" name="password" class="formInputStyle_01"
                   required
                   pattern="[A-Za-z0-9]{6,20}" title="密码输入格式错误，请检查后输入"
                   placeholder="密码：6-20位--必填"/><br/><br/>
            <input type="password" name="passwordAgain" class="formInputStyle_01"
                   required
                   pattern="[A-Za-z0-9]{6,20}" title="密码输入格式错误，请检查后输入"
                   placeholder="再输一遍密码"/><br/><br/>
            <h3 style="color: #dfffa4;">以下均为个人信息，请选填:</h3>
            <input type="text" name="email" class="formInputStyle_01"
                   pattern="[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$" title="邮箱输入格式错误，请检查后输入"
                   placeholder="邮箱: 选填"/><br/><br/>
            <input type="text" name="qqNum" class="formInputStyle_01"
                   pattern="[0-9]{1,20}" title="邮箱输入格式错误，请检查后输入"
                   placeholder="QQ: 选填"/><br/><br/>
            <input type="text" name="weiChatNum" class="formInputStyle_01"
                   pattern="[0-9]{1,20}" title="QQ输入格式错误，请检查后输入"
                   placeholder="微信: 选填"/><br/><br/>
            <input type="text" name="phoneNum" class="formInputStyle_01"
                   pattern="[0-9]{1,20}" title="微信输入格式错误，请检查后输入"
                   placeholder="手机号: 选填"/>
            <br/>
            <label for="file">文件名：</label>
            <input type="file" name="file" id="file"><br>
            <input type="submit" name="submit" value="提交">
            <div class="div_bottom">
                <button class="buttonStyle_01" type="submit" autofocus>录 入</button>
            </div>
        </form>
    </div></center>
    <div class="div_body_2">
        <h4 style="color: #ffffff;">已录入信息？点击
            <a href="/data/php/userControl/singUp.php" style="color: #cff1ba">登录</a>
            <?php echo main(); ?>
        </h4>
    </div>
</body>
</html>
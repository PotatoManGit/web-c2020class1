<?php
    include '../function/MysqlControl.php';
    include '../function/PasswordMd5.php';
    function main(){
        $html = "";
        //获取cookie数据
        $autoSingUpUser = passport_decrypt($_COOKIE["singUpUsername"], 189669);
        $autoSingUpPass = passport_decrypt($_COOKIE["singUpPassword"], 189669);

        //连接数据库
        $pdo = connectMysql("127.0.0.1","root",
            "root","c2020class1_potatost_xyz","utf-8");

        //获取表单数据
        $username = $_POST["username"];
        $password = $_POST["password"];


        //自动登录
        if($autoSingUpUser != "" && $autoSingUpPass != ""){
            $getAutoResult = inquireTable($pdo, "user_basic_data", $autoSingUpUser,
                "username", "password");
            if($autoSingUpPass == $getAutoResult){
                $html = "<h4 style=\"color: #efffb8\">登录成功，等待跳转</h4>";
            }
        }
        else if($username != "" || $password != ""){
            //查询
            $getResult = inquireTable($pdo, "user_basic_data", $username,
                "username", "password");

            if ($getResult != ""){//用户名错误
                if($getResult == $password){
                    $html = "<h4 style=\"color: #efffb8\">登录成功，等待跳转</h4>";

                    $cookieData = passport_encrypt($username, 189669);
                    setcookie("singUpUsername", $cookieData, time()+3600*7*30);//保存一个月

                    $cookieData = passport_encrypt($password, 189669);
                    setcookie("singUpPassword", $cookieData, time()+3600*7*30);
                }
                else{
                    $html = "<h4 style=\"color: red\">密码错误</h4>";
                }
            }
            else{
                $html = "<h4 style=\"color: red\">用户名错误</h4>";
            }
        }
        return $html;
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
        <h2 style="color: #6eff6f;">登录</h2>
    </div>

<!--    主体内容-->
    <center><div class="div_body_1">
        <form action="/data/php/userControl/singUp.php" method="post">
            <input type="text" name="username" class="formInputStyle_01"
                   required
                   pattern="[A-Za-z0-9]{1,20}" title="用户名输入格式错误，请检查后输入"
                   placeholder="用户名"/><br/><br/>
            <input type="password" name="password" class="formInputStyle_01"
                   required
                   pattern="[A-Za-z0-9]{6,20}" title="密码输入格式错误，请检查后输入"
                   placeholder="密码"/>

<!--            <h4 style="color: #dfffa4;">自动登录<input style="width: 15px; height: 15px;"-->
<!--                                                   name="autoSignUp" type="checkbox"></h4>-->


            <br/>
            <div class="div_bottom">
                <button class="buttonStyle_01" type="submit" autofocus>登 录</button>
            </div>
        </form>
    </div></center>
    <div class="div_body_2">
        <h4 style="color: #ffffff;">没有录入信息？点击
            <a href="/data/php/userControl/singIn.php" style="color: #cff1ba">录入</a>
            <?php echo main(); ?>
        </h4>
    </div>
</body>
</html>
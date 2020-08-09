<?php
include '../function/MysqlControl.php';
include '../function/PasswordMd5.php';
include '../function/makeDictionary.php';
include '../function/FileControl.php';
function main(){
    $pdo = connectMysql();
    if($_POST["license"]  != "" &&
        $_POST["username"] != "" &&
        $_POST["password"] != "" &&
        $_POST["passwordAgain"] != "" ){

        if($_POST["license"] == 189669){

            if($_POST["password"] == $_POST["passwordAgain"]){

                $userId = date('Ymdhis', time());

                //验证是否用户名密码重复
                if(inquireTable($pdo, "user_basic_data", $_POST["username"],
                        "username", "username") == "" &
                    inquireTable($pdo, "user_basic_data", $userId,
                        "userId", "userId") == ""){

                    $make = sprintf("INSERT INTO user_basic_data (userId, username, password) 
                            VALUES ('%s', '%s', '%s')",$userId , $_POST["username"], $_POST["password"]);
                    $pdo -> exec($make);

//                    $id = inquireTable($pdo, "user_basic_data", $_POST["username"],
//                        "username", "id");

                    //传输通讯信息
                    $make = sprintf("INSERT INTO user_communication_data
                                (userId, relName, email, qq, weChat, address, phoneNum)
                                VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s')",
                        $userId,
                        $_POST["relName"],
                        $_POST["email"],
                        $_POST["qqNum"],
                        $_POST["weiChatNum"],
                        $_POST["address"],
                        $_POST["phoneNum"]);

                    $pdo -> exec($make);

                    //设置自动登录cookie
                    $cookieData = passport_encrypt($_POST["username"], 189669);
                    setcookie("singUpUsername", $cookieData, time()+3600*24*7, '/');//保存7天

                    $cookieData = passport_encrypt($_POST["password"], 189669);
                    setcookie("singUpPassword", $cookieData, time()+3600*24*7, '/');


                    //创建必要文件和目录
                    makeDictionary($userId);

                    $upResult = photoUpload(sprintf("../../user/%s/data/imgMain/", $userId), "file");
                    if($upResult[0] == 1){

                        $pdo -> exec(sprintf("INSERT INTO user_img_data (userId, ownPhoto) 
                                        values ('%s','%s')", $userId, $upResult[2]));

                        return "<meta http-equiv=\"refresh\" 
                                content=\"0;url=http://c2020class1.potatost.xyz/data/php/userControl/signIn.php\">";
                    } else{
                        return $upResult[1]."<br/>如果你没有上传照片，请点击<a href='signIn.php'>忽略</a>";
                    }

                } else{
                    return "用户已存在，请登录，或更换用户名注册";
                    }
            } else{
                return "两次输入密码不一致";
            }
        } else{
            return "请输入正确的许可码";
        }
    }
    return "";
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
        <form action="/data/php/userControl/signUp.php" method="post" enctype="multipart/form-data">
            <input type="text" name="license" class="formInputStyle_01"
                   required
                   pattern="189669" title="许可码错误"
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

            <!--            个人信息获取-->
            <h3 style="color: #dfffa4;">以下均为个人信息，请选填:</h3>
            <input type="text" name="relName" class="formInputStyle_01"
                   placeholder="真实姓名: 选填"/><br/><br/>
            <input type="text" name="email" class="formInputStyle_01"
                   pattern="[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$" title="邮箱输入格式错误，请检查后输入"
                   placeholder="邮箱: 选填"/><br/><br/>
            <input type="text" name="qqNum" class="formInputStyle_01"
                   pattern="[0-9]{1,20}" title="邮箱输入格式错误，请检查后输入"
                   placeholder="QQ: 选填"/><br/><br/>
            <input type="text" name="weiChatNum" class="formInputStyle_01"
                   pattern="[0-9]{1,20}" title="QQ输入格式错误，请检查后输入"
                   placeholder="微信: 选填"/><br/><br/>
            <input type="text" name="address" class="formInputStyle_01"
                   placeholder="住址: 选填"/><br/><br/>
            <input type="text" name="phoneNum" class="formInputStyle_01"
                   pattern="[0-9]{1,11}" title="手机号输入格式错误，请检查后输入"
                   placeholder="手机号: 选填"/><br/><br/>

            <!--            文件上传-->
            <h4 style="color: rgb(223,255,164);">上传自己的照片一张--横版--选填：</h4>
            <div class="wrap">
                <span>点 击 选 择</span>
                <input id="file" name="file" class="file" type="file" />
            </div>
            <br/>
            <div class="div_bottom">
                <button class="buttonStyle_01" type="submit" autofocus>录 入</button>
            </div>
        </form>
    </div></center>
<div class="div_body_2">
    <h4 style="color: #ffffff;">已录入信息？点击
        <a href="/data/php/userControl/signIn.php" style="color: #cff1ba">登录</a>
    </h4>
    <h4 style="color: #ff2b2b;"><?php echo main(); ?></h4>
</div>
</body>
</html>

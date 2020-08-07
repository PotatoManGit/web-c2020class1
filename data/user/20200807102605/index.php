<?php
include '../../php/function/FileControl.php';
include '../../php/function/MysqlControl.php';
include '../../php/function/PasswordMd5.php';
//include '../../php/function/makeDictionary.php';

function main(){
    //登录确认
    $autoSingUpUser = passport_decrypt($_COOKIE["singUpUsername"], 189669);
    $autoSingUpPass = passport_decrypt($_COOKIE["singUpPassword"], 189669);

    $pdo = connectMysql();

    $getPassword = inquireTable($pdo, "user_basic_data", $autoSingUpUser,
        "username", "password");
    if($autoSingUpPass == $getPassword &
        $autoSingUpUser != "" &
        $autoSingUpPass != ""){
        //查询基本信息填充

        $web = fileRead("../../web/index.html");

        //数据库获取数据
        $userId = inquireTable($pdo, "user_basic_data", $autoSingUpUser,
            "username", "userId");

        //后台接应user是否为本人判断
        if($userId == "20200807102605"){
            $editCheck = "<br/><br/><a href=\"/memoryArea.php\">
                          <button type=\"submit\" class=\"buttonStyle_01\">编辑空间</button>
                          </a>";
        } else{
            $userId = "20200807102605";
            $editCheck = "";
        }

        $ownPhoto = inquireTable($pdo, "user_img_data", $userId,
            "userId", "ownPhoto");
        $headPortrait = inquireTable($pdo, "user_img_data", $userId,
            "userId", "headPortrait");
/*        $theme = inquireTable($pdo, "user_img_data", $userId,
            "userId", "theme");*/
        $background = inquireTable($pdo, "user_img_data", $userId,
            "userId", "background");

        $relName =  inquireTable($pdo, "user_communication_data", $userId,
            "userId", "relName");
        $email =  inquireTable($pdo, "user_communication_data", $userId,
            "userId", "email");
        $qq =  inquireTable($pdo, "user_communication_data", $userId,
            "userId", "qq");
        $weChat =  inquireTable($pdo, "user_communication_data", $userId,
            "userId", "weChat");
        $address =  inquireTable($pdo, "user_communication_data", $userId,
            "userId", "address");
        $phoneNum = inquireTable($pdo, "user_communication_data", $userId,
            "userId", "phoneNum");

        //文字数据获取
        $userText = fileRead("data/userText.html");

        //为空判断
        if ($userText == "NULL"){
            $userText = "<h3 style='font-size: 25px;color: white'>Ta什么都没有写</h3>";
        }
        if ($ownPhoto == ""){
            $ownPhoto = "default_ownPhoto.jpg";
        }
        if ($headPortrait == ""){
            $headPortrait = "default_headPortrait.png";
        }
        if ($background == ""){
            $background = "default_background.jpg";
        }
        if ($relName == ""){
            $relName = $autoSingUpUser;
        }
        if ($email != ""){
            $email = "我的邮箱:".$email;
        }
        if ($qq != ""){
            $qq = "我的qq:".$qq;
        }
        if ($weChat != ""){
            $weChat = "我的微信:".$weChat;
        }
        if ($address != ""){
            $address = "我的住址:".$address;
        }
        if ($phoneNum != ""){
            $phoneNum = "我的电话号码:".$phoneNum;
        }
        if ($email == "" ||
            $qq == "" ||
            $weChat == "" ||
            $address == "" ||
            $phoneNum == ""){
            $userInformationOut = "Ta什么都没有留下";
        } else{
            $userInformation = [$email, $qq, $weChat, $address, $phoneNum];

            $userInformationOut = "";
            for ($i = 0; $i <=0; $i++){
                $userInformationOut = $userInformation[$i]."<br/>";
            }
        }



        $web = strtr($web, array("{username}" => $relName,
                                "{userId}" => $userId,
                                "{ownPhoto}" => $ownPhoto,
                                "{headPortrait}" => $headPortrait,
                                "{background}" => $background,
                                "{userInformation}" => $userInformationOut,
                                "{userText}" => $userText,
                                "{editCheck}" => $editCheck));

        return $web;
    } else{
        return "您还没登录，请<a href='/data/php/userControl/signIn.php'>登录!</a>";
    }

}
echo main();
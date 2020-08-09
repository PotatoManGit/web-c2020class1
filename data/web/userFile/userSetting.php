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

        $web = fileRead("../../web/userSetting.html");

        //数据库获取数据
        $userId = inquireTable($pdo, "user_basic_data", $autoSingUpUser,
            "username", "userId");

        //后台接应user是否为本人判断
        if($userId != "{userIdReal}"){
            return "<p>您无法编辑其他人的空间请返回<a href='/data/user/$userId/'>自己的空间</a></p>";
        } else{
            //img信息获取
            $ownPhoto = inquireTable($pdo, "user_img_data", $userId,
                "userId", "ownPhoto");
            $headPortrait = inquireTable($pdo, "user_img_data", $userId,
                "userId", "headPortrait");
            /*        $theme = inquireTable($pdo, "user_img_data", $userId,
                        "userId", "theme");*/
            $background = inquireTable($pdo, "user_img_data", $userId,
                "userId", "background");

            //文字数据获取
            $userText = fileRead("data/userText.html");

            //为空判断img
            if ($ownPhoto == ""){
                $ownPhoto = "default_ownPhoto.jpg";
            }
            if ($headPortrait == ""){
                $headPortrait = "default_headPortrait.png";
            }
            if ($background == ""){
                $background = "default_background.jpg";
            }

            //进行修改后信息获取
            $tip1 = "";
            $tip2 = "";
            $tip3 = "";
            $tip4 = "";
            $tip5 = "";
            $fileHead = [null, "", ""];
            $fileOwnPhoto = [null, "", ""];
            $fileBg = [null, "", ""];

            $fileHead = photoUpload("data/imgMain/", "fileHead");
            $fileOwnPhoto = photoUpload("data/imgMain/", "fileOwnPhoto");
            $fileBg = photoUpload("data/imgMain/", "fileBg");

            if ($fileHead[0] != null){
                $tip1 = $fileHead[1];
                if ($fileHead[0] == 1){
                    unlink("data/imgMain/".$headPortrait);
                    $pdo -> exec("UPDATE user_img_data SET 
                         headPortrait = '$fileHead[2]' WHERE userId = '$userId' ");
                    $headPortrait = $fileHead[2];
                }
            }
            if ($fileOwnPhoto[0] != null){
                $tip2 = $fileOwnPhoto[1];
                if ($fileOwnPhoto[0] == 1){
                    unlink("data/imgMain/".$ownPhoto);
                    $pdo -> exec("UPDATE user_img_data SET 
                         ownPhoto = '$fileOwnPhoto[2]' WHERE userId = '$userId' ");
                    $ownPhoto = $fileOwnPhoto[2];
                }
            }
            if ($fileBg[0] != null){
                $tip5 = $fileBg[1];
                if ($fileBg[0] == 1){
                    unlink("data/imgMain/".$background);
                    $pdo -> exec("UPDATE user_img_data SET 
                         background = '$fileBg[2]' WHERE userId = '$userId' ");
                    $background = $fileBg[2];
                }
            }

            if ($_POST["relName"] != "" ||
                $_POST["email"] != "" ||
                $_POST["qqNum"] != "" ||
                $_POST["weiChatNum"] != "" ||
                $_POST["address"] != "" ||
                $_POST["phoneNum"] != ""){

                $make = sprintf("UPDATE user_communication_data SET 
                                   relName = '%s', email = '%s', qq = '%s',weChat = '%s', 
                                   address = '%s', phoneNum = '%s' 
                                   WHERE userId = '%s'",
                    $_POST["relName"],
                    $_POST["email"],
                    $_POST["qqNum"],
                    $_POST["weiChatNum"],
                    $_POST["address"],
                    $_POST["phoneNum"],
                    $userId);

                $pdo -> exec($make);
                $tip3 = "提交完毕!";

            }

            if ($_POST["textData"] != $userText){
                if ($_POST["textData"] != ""){
                    fileOverwrite("data/userText.html", $_POST["textData"]);
                    $userText = $_POST["textData"];
                    $tip4 = "提交完成!";
                } else{
                    $tip4 = "请填写内容";
                }
            }

            //联系方式获取
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

            //为空判断
            if ($userText == "NULL"){
                $userText = "<h3 style='font-size: 25px;color: #000000'>Ta什么都没有写</h3>";
            }
            if ($relName == ""){
                $relName = $autoSingUpUser;
            }
            if ($email != ""){
                $emailN = "我的邮箱:".$email."<br/>";
            }
            if ($qq != ""){
                $qqN = "我的qq:".$qq."<br/>";
            }
            if ($weChat != ""){
                $weChatN = "我的微信:".$weChat."<br/>";
            }
            if ($address != ""){
                $addressN = "我的住址:".$address."<br/>";
            }
            if ($phoneNum != ""){
                $phoneNumN = "我的手机号码:".$phoneNum."<br/>";
            }
            if ($email == "" &
                $qq == "" &
                $weChat == "" &
                $address == "" &
                $phoneNum == ""){
                $userInformation = "Ta什么都没有留下";
            } else{
                $userInformation = $emailN. $qqN. $weChatN. $addressN. $phoneNumN;
            }


            $web = strtr($web, array("{username}" => $relName,
                "{userId}" => $userId,
                "{ownPhoto}" => $ownPhoto,
                "{headPortrait}" => $headPortrait,
                "{background}" => $background,
                "{userInformation}" => $userInformation,
                "{userText}" => $userText,
                "{relName}" => $relName,
                "{email}" => $email,
                "{qq}" => $qq,
                "{weiChat}" => $weChat,
                "{address}" => $address,
                "{phoneNum}" => $phoneNum,
                "{tip1}" => $tip1,
                "{tip2}" => $tip2,
                "{tip3}" => $tip3,
                "{tip4}" => $tip4,
                "{tip5}" => $tip5));

            return $web;
        }
    } else{
        return "您还没登录，请<a href='/data/php/userControl/signIn.php'>登录!</a>";
    }

}
echo main();
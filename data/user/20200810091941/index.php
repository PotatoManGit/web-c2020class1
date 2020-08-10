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
        if($userId == "20200810091941"){
            $editCheck = "<br/><br/><br/><a href=\"/data/user/$userId/userSetting.php\">
                          <button type=\"submit\" class=\"buttonStyle_02\">编辑空间</button>
                          </a>";
        } else{
            $userId = "20200810091941";
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
            $email = "我的邮箱:".$email."<br/>";
        }
        if ($qq != ""){
            $qq = "我的qq:".$qq."<br/>";
        }
        if ($weChat != ""){
            $weChat = "我的微信:".$weChat."<br/>";
        }
        if ($address != ""){
            $address = "我的住址:".$address."<br/>";
        }
        if ($phoneNum != ""){
            $phoneNum = "我的手机号码:".$phoneNum."<br/>";
        }
        if ($email == "" &
            $qq == "" &
            $weChat == "" &
            $address == "" &
            $phoneNum == ""){
            $userInformation = "Ta什么都没有留下";
        } else{
            $userInformation = $email. $qq. $weChat. $address. $phoneNum;
        }

        $userAll = "";

        //检索其他用户
        $otherUserId = inquireTableMany($pdo, "user_basic_data", "userId");
        echo $otherUserId[0];
        for ($i = 0; $i <= count($otherUserId); $i++){
            $otherUsername = inquireTable($pdo, "user_basic_data", $otherUserId[$i],
                "userId", "userName");
            $otherRelName = inquireTable($pdo, "user_communication_data", $otherUserId[$i],
                "userId", "relName");
            $otherOwnPhoto = inquireTable($pdo, "user_img_data", $otherUserId[$i],
                "userId", "ownPhoto");

            if ($otherRelName != ""){
                $otherUsername = $otherRelName;
            }
            if ($otherUsername != "" & $otherUserId != ""){
                $userAll = "<div><a href='/data/user/$otherUserId[$i]/'>
                            <img src='/data/user/$otherUserId[$i]/data/imgMain/$otherOwnPhoto' width='10%'>
                            <h3 style='color: white'>$otherUsername</h3>
                        </a></div>".$userAll;
            }
        }


        $web = strtr($web, array("{username}" => $relName,
            "{userId}" => $userId,
            "{ownPhoto}" => $ownPhoto,
            "{headPortrait}" => $headPortrait,
            "{background}" => $background,
            "{userInformation}" => $userInformation,
            "{userText}" => $userText,
            "{editCheck}" => $editCheck,
            "{otherUser}" => $userAll));

        return $web;
    } else{
        return "您还没登录，请<a href='/data/php/userControl/signIn.php'>登录!</a>";
    }

}
echo main();
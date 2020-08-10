<?php
include 'data/php/function/MysqlControl.php';
include 'data/php/function/FileControl.php';
include 'data/php/function/PasswordMd5.php';

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

        $web = fileRead("memoryArea.html");

        $i = 1;
        $photoAll = "";
//        while (true){
//            $photo = inquireTable($pdo, "memory_img", $i, "id", "imgUrl");
//            if ($photo == ""){
//                break;
//            } else{
//                $photoAll = "<img src='$photo' width='20%'>".$photoAll;
//            }
//            $i++;
//        }

        $photo = fileReadContent("data/photoList.txt");
        for ($i = 0; $i <= count($photo); $i++){
            if ($photo != ""){
                $photoAll = "<a href='$photo[$i]'><img src='$photo[$i]' width='20%'></a>&nbsp&nbsp".$photoAll;
            }
        }
        $web = strtr($web, array("{photoAll}" => $photoAll));
        return $web;
    } else{
        return "您还没登录，请<a href='/data/php/userControl/signIn.php'>登录!</a>";
    }
}
echo main();
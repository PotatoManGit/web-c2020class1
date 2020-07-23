<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <title>初2020届一班留念</title>
    <link rel="stylesheet" href="/data/web/data/css/mainStyle.css">
    <link rel="stylesheet" href="/wangEditor-master/release/mainStyle.css">
</head>
<body class="indexBodySetting">
<div id="editor" style="background: #ffffff">
    <p>输入些什么吧</p>
</div><br/>
<form action="test.php">
    <center><button class="buttonStyle_01" id="check" type="submit">提交</button></center>
</form>


<script type="text/javascript" src="/wangEditor-master/release/wangEditor.min.js"></script>
<script type="text/javascript">
    import $ from "./wangEditor-master/src/js/util/dom-core";

    var E = window.wangEditor
    var editor = new E('#editor')
    // editor.customConfig.uploadImgShowBase64 = true //使用Base64
    // editor.customConfig.uploadImgServer = 'http://c2020class1.potatost.xyz/'
    editor.create()

    document.getElementById('check').addEventListener('click', function () {
        // 读取 html
        var XHR = new XMLHttpRequest();
        var FD  = new FormData();

        // var writeData = document.getElenmentById("username").editor.txt.html();
        // // alert(writeData);
        // winodw.open('test.php?username=' + writeData)

    }, false)

</script>
</body>
</html>
<?php

$keyword="<script>document.writeln(writeData);</script>";//php获取js的变量！！

echo "$keyword";

?>
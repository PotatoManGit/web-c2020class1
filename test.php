<?php
echo $_POST["textData"];
?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <title>初2020届一班留念</title>
    <link rel="stylesheet" href="/data/web/data/css/mainStyle.css">
    <link rel="stylesheet" href="/wangEditor-master/release/mainStyle.css">
</head>
<body class="indexBodySetting">
<div style="background: white" id="div1">
    <p>输入些什么呢？</p>
</div><br/>
<form action="test.php" method="post">
    <label for="text"></label><input hidden type="text" name="textData" id="text">//转发js text内容于php
    <button id="btn1" class="buttonStyle_01">获取html</button>
</form>


<script type="text/javascript" src="wangEditor-master/release/wangEditor.min.js"></script>
<script type="text/javascript">
    var E = window.wangEditor
    var editor = new E('#div1')
    editor.create()

    document.getElementById('btn1').addEventListener('click', function () {
        // 读取 html
        // alert(editor.txt.html())
        document.getElementById("text").value = editor.txt.html();
    }, false)
    
</script>
</body>
</html>

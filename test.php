<?php
?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <title>初2020届一班留念</title>
    <link rel="stylesheet" href="/data/web/data/css/mainStyle.css">
    <link rel="stylesheet" href="/wangEditor-master/src/css/mainStyle.css">
</head>
<body class="indexBodySetting">
<div id="editor" style="background: #fff9fb">
    <p>欢迎使用 <b>wangEditor</b> 富文本编辑器</p>
</div><br/>
<center><button class="buttonStyle_01" id="check">提交</button></center>

<script type="text/javascript" src="/wangEditor-master/release/wangEditor.min.js"></script>
<script type="text/javascript">
    var E = window.wangEditor
    var editor = new E('#editor')
    // 或者 var editor = new E( document.getElementById('editor') )
    editor.create()

    document.getElementById('check').addEventListener('click', function () {
        // 读取 html
        alert(editor.txt.html())
    }, false)

</script>
</body>
</html>
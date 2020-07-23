<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <title>初2020届一班留念</title>
    <link rel="stylesheet" href="/data/web/data/css/mainStyle.css">
    <link rel="stylesheet" href="/wangEditor-master/release/mainStyle.css">
</head>
<body class="indexBodySetting">
<div id="div1">
    <p>欢迎使用 wangEditor 编辑器</p>
</div>
<button id="btn1">获取html</button>
<button id="btn2">获取text</button>

<script type="text/javascript" src="wangEditor-master/release/wangEditor.min.js"></script>
<script type="text/javascript">
    var E = window.wangEditor
    var editor = new E('#div1')
    editor.create()

    document.getElementById('btn1').addEventListener('click', function () {
        // 读取 html
        alert(editor.txt.html())
    }, false)

    document.getElementById('btn2').addEventListener('click', function () {
        // 读取 text
        alert(editor.txt.text())
    }, false)

</script>
</body>
</html>

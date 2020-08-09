<?php
include 'data/php/function/FileControl.php';
echo photoUpload("upload/", "123")[1];
echo photoUpload("upload/", "234")[1];
?>
<html>
<head>
<meta charset="utf-8">
<title>---</title>
</head>
<body>

<form action="test2.php" method="post" enctype="multipart/form-data">
    <label for="file">文件名：</label>
    <input type="file" name="123" id="file"><br>
    <input type="submit" name="submit" value="提交">
</form>
<form action="test2.php" method="post" enctype="multipart/form-data">
    <label for="file">文件名：</label>
    <input type="file" name="234" id="file"><br>
    <input type="submit" name="submit" value="提交">
</form>

</body>
</html>
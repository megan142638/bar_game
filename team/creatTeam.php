<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>創立隊伍</title>
<link rel="stylesheet" type="text/css" href="main.css">
</head>

<body>

<p>創建隊伍</p>
<hr />
<form method="post" action="insert.php">
<table width="400" border="1" class="">
  <tr>
    <td>隊伍名稱</td><td><input type="text" name="title" required/></td></tr>
  <tr>
    <td>選擇角色</td><td>
    <input type="radio" name="role" value="retailer" checked/> 零售商
    <input type="radio" name="role" value="wholesaler" /> 批發商
    <input type="radio" name="role" value="distributor" /> 大盤商
    <input type="radio" name="role" value="factory" /> 工廠
    </td></tr>
    <tr><td colspan="2" style="text-align:center">
    <input type="submit" /> <input type="reset" /></td></tr>
</table></form>
<form method="post">
<input type="submit" name="back" value="返回隊伍列表" />
</form>
<?php
if (isset($_POST['back']))
    header("Location: teamlist.php");
?>
</body>
</html>
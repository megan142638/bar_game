<?php
require("userModel.php");
require("orderControl.php");

$id= getCurrentID();
$RoomNo=(int)$_GET['roomNo'];
$result = getcontent();
$rank = 0;
function getcontent()
{
    global $db, $RoomNo;
    $sql = "select * from rank order by score";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return $result;
}
function score()
{
    global $db, $RoomNo;
    $sql = "select score from rank where roomNo = ".$RoomNo;
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $rs = mysqli_fetch_assoc($result);
    return $rs['score'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link rel="stylesheet" type="text/css" href="https://bootswatch.com/4/sandstone/bootstrap.min.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>遊戲結算</title>
<h1>遊戲結束 房號:<?php echo $RoomNo;?> 總成本:<?php echo score();?></h1>
</head>
<body>
<h2>Rank</h2>
<table width="400" border="1" class="table table-hover">
<th bgcolor="honeydew">排名</th><th bgcolor="honeydew">房號</th><th bgcolor="honeydew">
房間名稱</th><th bgcolor="honeydew">隊長</th><th bgcolor="honeydew">總成本</th>
<?php
while ($rs = mysqli_fetch_assoc($result)){
    $rank++;
    echo "<tr><td>" ,$rank,"</td><td>", $rs['roomNo'],
         "</td><td>", $rs['name'],"</td><td>", $rs['leaderID'],
         "</td><td>", $rs['score'],"</td></tr>";
}
?>
</table>
<form method="post">
<input type="submit" name="back" value="返回隊伍列表" class="btn btn-primary"/>
</form>
<?php
if (isset($_POST['back']))
    header("Location: teamlist.php");
?>
</body>
</html>
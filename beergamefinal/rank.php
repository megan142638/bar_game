<?php
require("userModel.php");
function getcontent()
{
    global $db, $RoomNo;
    $sql = "select * from rank order by score";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return $result;
}
$result = getcontent();
$rank = 0;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<title>排行榜</title>
<h1>Rank</h1>
</head>
<body>

<hr/>
<table width="400" border="1" class="w3-table-all w3-hoverable">
<th>排名</th><th>房號</th><th>房間名稱</th><th>隊長</th><th>總成本</th>
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
<input type="submit" name="back" value="返回隊伍列表" class="btn btn-secondary"/>
</form>
<?php
if (isset($_POST['back']))
    header("Location: teamlist.php");
?>
</body>
</html>
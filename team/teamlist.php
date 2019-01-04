<?php
require("dbconfig.php");
function getTeamList() 
{
    global $db;
    $sql = "select * from list";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_execute($stmt); //執行SQL
    $result = mysqli_stmt_get_result($stmt); 
    return $result;
}
$result=getTeamList();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>隊伍列表</title>
<meta http-equiv="refresh" content="3" />
</head>

<body>

<p>Team List !!</p>
<hr />
<table width="600" border="1" class="">
  <tr>
    <td>id</td>
    <td>隊伍名稱</td>
    <td>隊長</td>
    <td>人數</td>
<td>選項</td>
  </tr>
<?php
while ($rs = mysqli_fetch_assoc($result)) {
	echo "<tr><td>" , $rs['roomNo'] ,
	"</td><td>" , $rs['name'],
	"</td><td>" , $rs['leaderID'],
	"</td><td>" , $rs['count'],"</td>";
echo '<td><a href="add2Team.php?roomNo=', $rs['roomNo'],'">加入</a></td></tr>';
}
?>
</table>
<?php
echo "<a href='creatTeam.php'>創建隊伍</a><br/>";
echo "<a href='logout.php'>登出</a>";
?>
</body>
</html>
<?php
require("userModel.php");

$id= getCurrentID();
$RoomNo=(int)$_GET['roomNo'];
function getRoomName() 
{
    global $db, $RoomNo;
    $sql = "select name from list where roomNo = ?";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "i", $RoomNo);
    mysqli_stmt_execute($stmt); //執行SQL
    $result = mysqli_stmt_get_result($stmt);
    $rs = mysqli_fetch_assoc($result);
    return $rs['name'];
}
$RoomName = getRoomName();

function getPlayer() 
{
    global $db, $RoomNo;
    $sql = "select player from content where roomNo = ?";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "i", $RoomNo);
    mysqli_stmt_execute($stmt); //執行SQL
    $result = mysqli_stmt_get_result($stmt); 
    $rs = mysqli_fetch_assoc($result);
    return $rs['player'];
}
$player = getPlayer();

function getCount() 
{
    global $db, $RoomNo;
    $sql = "select COUNT(player) from content where roomNo = ?";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "i", $RoomNo);
    mysqli_stmt_execute($stmt); //執行SQL
    $result = mysqli_stmt_get_result($stmt); 
    $rs = mysqli_fetch_assoc($result);
    return $rs['COUNT(player)'];
}
$count = getCount();

function getLeader() 
{
    global $db, $RoomNo;
    $sql = "select leaderID from list where roomNo = ?";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "i", $RoomNo);
    mysqli_stmt_execute($stmt); //執行SQL
    $result = mysqli_stmt_get_result($stmt); 
    $rs = mysqli_fetch_assoc($result);
    return $rs['leaderID'];
}
$leader = getLeader();

function insert($roomNo){
    $id= getCurrentID();
    $role=$_POST['role'];
    
    $sql = "insert into content (player, role) values (?, ?)";
	$stmt = mysqli_prepare($db, $sql); 
	mysqli_stmt_bind_param($stmt, "ss", $id, $role);
	mysqli_stmt_execute($stmt);
}

function check(){
    global $db, $RoomNo;
    $sql = "select player from list where roomNo = ?";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "i", $RoomNo);
    mysqli_stmt_execute($stmt); //執行SQL
    $result = mysqli_stmt_get_result($stmt); 
    return $result;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>房間</title>
<link rel="stylesheet" type="text/css" href="main.css">
</head>

<body>

<h1>房間號碼:<?php echo $RoomNo; ?> 房間名稱:<?php echo $RoomName; ?></h1>
<hr />
<table width="400" border="1" class="">
  <tr><td>玩家</td>
<?php 
for($i = 0; $i < $count; $i++)
    echo "<td>", $player, "</td>";

?>
  </tr>
  <tr>
    <td>角色</td>
<?php
if ($id = $leader){
    global $db;
    $sql = "select role from content where player = ?";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "s", $leader);
    mysqli_stmt_execute($stmt); //執行SQL
    $result = mysqli_stmt_get_result($stmt); 
    $rs = mysqli_fetch_assoc($result);
    echo "<td>",$rs['role'],"</td>";
} //else if ($id){*/
?>
<form method="post" action="<?php insert()?>">
<td>
<input type="radio" name="role" value="零售商" checked/> 零售商
<input type="radio" name="role" value="批發商" /> 批發商
<input type="radio" name="role" value="大盤商" /> 大盤商
<input type="radio" name="role" value="工廠" /> 工廠
</br>
<td colspan="2" style="text-align:center">
<input type="submit" /> <input type="reset" /></td><?php //} ?></tr>
</table>
<a href='teamlist.php'>返回隊伍列表</a>
</body>
</html>
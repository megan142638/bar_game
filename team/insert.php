<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>創立隊伍</title>
</head>

<body>

<p>創建隊伍</p>
<hr />
<?php
require("userModel.php");

$name=$_POST['title'];
$id= getCurrentID();
$role=$_POST['role'];

if ($name) {
    $sql = "insert into list (name, leaderID, count) values (?, ?, 1)";
	$stmt = mysqli_prepare($db, $sql); //prepare sql statement
	mysqli_stmt_bind_param($stmt, "ss", $name, $id); //bind parameters with variables
	mysqli_stmt_execute($stmt);  //執行SQL
    
    $sql = "select roomNo from list where leaderID = ?";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt); //執行SQL
    $result = mysqli_stmt_get_result($stmt);
    $rs = mysqli_fetch_assoc($result);
    $No = $rs['roomNo'];
    
	$sql = "insert into content (roomNo, player, role) values (?, ?, ?)";
	$stmt = mysqli_prepare($db, $sql); //prepare sql statement
	mysqli_stmt_bind_param($stmt, "iss", $No, $id, $role); //bind parameters with variables
	mysqli_stmt_execute($stmt);  //執行SQL
    
	header("Location: Room.php?roomNo=$No");
} else {
	echo "error";
    echo "<a href='creatTeam.php'>回上一頁</a>";
    echo "<a href='teamlist.php'>回隊伍列表</a>";
}
?>
</body>
</html>

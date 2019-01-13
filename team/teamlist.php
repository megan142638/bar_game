<?php
require("userModel.php");
function getTeamList() 
{
    global $db;
    $sql = "select * from list";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_execute($stmt); //執行SQL
    $result = mysqli_stmt_get_result($stmt); 
    return $result;
}
function checkRole($RoomNo)
{
    global $db;
    $sql = "select COUNT(role) c from content where role is not null and roomNo = ?";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "i", $RoomNo);
    mysqli_stmt_execute($stmt); //執行SQL
    $result = mysqli_stmt_get_result($stmt);
    $rs = mysqli_fetch_assoc($result);
    if ($rs['c'] == 4)
        return 1;
    else
        return 0;
}
function startgame($RoomNo){
    global $db;
    $sql = "UPDATE list SET status = 1 where roomNo =  ?";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "i", $RoomNo);
    mysqli_stmt_execute($stmt);
    
    $sql = "INSERT INTO `period`(`week`) VALUES (1)";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_execute($stmt);
    
    $arr = array("retailer","wholesaler","distributor","factory");
    for ($i = 0; $i < 4; $i++){
        $sql = "INSERT INTO ".$arr[$i]."(week,store,debt,cost,Allcost) VALUES (1,15,0,15,15)";
        $stmt = mysqli_prepare($db, $sql);
        mysqli_stmt_execute($stmt);
    }
}
function checkstatus($RoomNo){
    global $db;
    $sql = "select status from list where roomNo =  ?";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "i", $RoomNo);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $rs = mysqli_fetch_assoc($result);
    return $rs['status'];
}
$result=getTeamList();
$id=getCurrentID();
$per=getPermission();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>隊伍列表</title>
<meta http-equiv="refresh" content="3" />
</head>

<body>

<h1>Team List !!</h1>
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
    if (checkstatus($rs['roomNo']) != 2){
        echo "<tr><td>" , $rs['roomNo'] ,
        "</td><td>" , $rs['name'],
        "</td><td>" , $rs['leaderID'],
        "</td><td>" , $rs['count'],"</td>";
        if ($rs['count'] < 4 && $per != 1)
            echo '<td><a href="add2Team.php?roomNo=', $rs['roomNo'],'">加入</a></td></tr>';
        else {
            if (isset($_POST['butt']))
                startgame($rs['roomNo']);
            else if ($per == 1 && checkRole($rs['roomNo']) == 1 && checkstatus($rs['roomNo']) == 0) {
                echo '<form method="post">';
                echo '<td><input type="submit" name="butt" value="開始遊戲" /></td></form>';
            }
            else if (checkstatus($rs['roomNo']) == 1)
                echo "<td>遊戲中</td>";
            else if ($per != 1)
                echo "<td>人數已滿</td>";
        }
    }
	
}
echo "</table>";
if ($per == 1){
    echo '<form method="post">';
    echo '<input type="submit" name="set" value="設定需求" /><br/></form>';
    if (isset($_POST['set']))
        header("Location: set.php");
}
else{
    echo '<form method="post">';
    echo '<input type="submit" name="create" value="創建隊伍" /><br/></form>';
}

echo '<form method="post" >';
echo '<input type="submit" name="logout" value="登出" /></form>';

echo '<form method="post" >';
echo '<input type="submit" name="rank" value="排行榜" /></form>';

if (isset($_POST['create']))
    header("Location: creatTeam.php");
if (isset($_POST['logout']))
    header("Location: logout.php");
if (isset($_POST['rank']))
    header("Location: rank.php");
?>
</body>
</html>
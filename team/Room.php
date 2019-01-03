<?php
require("userModel.php");
require("roomControl.php");

$id= getCurrentID();
$RoomNo=(int)$_GET['roomNo'];

$RoomName = getRoomName();

$player = getPlayer();

$count = getCount();

$leader = getLeader();

$role = getRole();

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
</head>

<body>

<h1>房間號碼:<?php echo $RoomNo; ?> 房間名稱:<?php echo $RoomName; ?></h1>
<hr />
<table width="400" border="1" class="">
  <tr><th>玩家</th><th>角色</th></tr>
<?php 
for($i = 0; $i < $count; $i++){
    echo "<tr><td>", $player[$i], "</td>";
    if($role[$i])
        echo "<td>", $role[$i], "</td></tr>";
    else {?>
        <!--echo '<form method="post" action="insert()">',
        '<td><input type="radio" name="role" value="零售商" checked/> 零售商',
        '<input type="radio" name="role" value="批發商" /> 批發商</br>',
        '<input type="radio" name="role" value="大盤商" /> 大盤商',
        '<input type="radio" name="role" value="工廠" /> 工廠</br>',
        '<input type="submit" /> <input type="reset" /></td>';-->

<form method="post" action="insert()">
<td><input type="radio" name="role" value="零售商" checked/> 零售商
<input type="radio" name="role" value="批發商" /> 批發商</br>
<input type="radio" name="role" value="大盤商" /> 大盤商
<input type="radio" name="role" value="工廠" /> 工廠</br>
<input type="submit" /> <input type="reset" /></td>
<?php
    }
}
?>
<!--  </tr>
  <tr>
    <td>角色</td>-->
<?php
/*if ($id = $leader){
    echo "<td>",$role[0],"</td>";
} else if ($id != $leader){
echo "1";
echo '<form method="post" action="roomControl.php">';
echo '<td><input type="radio" name="role" value="零售商" checked/> 零售商</br>';
echo '<input type="radio" name="role" value="批發商" /> 批發商</br>';
echo '<input type="radio" name="role" value="大盤商" /> 大盤商</br>';
echo '<input type="radio" name="role" value="工廠" /> 工廠</br>';
echo '<input type="submit" /> <input type="reset" /></td>'; }*/ ?><!--</tr>-->
</table>
<a href='teamlist.php'>返回隊伍列表</a>
</body>
</html>
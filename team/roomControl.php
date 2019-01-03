<?php
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
function getPlayer() 
{
    global $db, $RoomNo;
    $sql = "select player from content where roomNo = ?";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "i", $RoomNo);
    mysqli_stmt_execute($stmt); //執行SQL
    $result = mysqli_stmt_get_result($stmt); 
    $arr = array();
    while($rs = mysqli_fetch_assoc($result))
        array_push($arr,$rs['player']);
    return $arr;
}
function getCount() 
{
    global $db, $RoomNo;
    $sql = "select count from list where roomNo = ?";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "i", $RoomNo);
    mysqli_stmt_execute($stmt); //執行SQL
    $result = mysqli_stmt_get_result($stmt); 
    $rs = mysqli_fetch_assoc($result);
    return $rs['count'];
}
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
function getRole()
{
    global $db, $RoomNo;
    $sql = "select role from content where roomNo = ?";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "i", $RoomNo);
    mysqli_stmt_execute($stmt); //執行SQL
    $result = mysqli_stmt_get_result($stmt); 
    $arr = array();
    while($rs = mysqli_fetch_assoc($result))
        array_push($arr,$rs['role']);
    return $arr;
}
function insert(){
    global $db;
    $id= getCurrentID();
    $role=$_POST['role'];
    
    $sql = "insert into content (player, role) values (?, ?)";
	$stmt = mysqli_prepare($db, $sql); 
	mysqli_stmt_bind_param($stmt, "ss", $id, $role);
	mysqli_stmt_execute($stmt);
    header("Location: Room.php?roomNo=$RoomNo");
}
?>
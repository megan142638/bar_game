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
function update(){
    global $db;
    $id= getCurrentID();
    $role=$_POST['role'];
    
    $sql = "UPDATE content SET role= ? where player = ?";
	$stmt = mysqli_prepare($db, $sql); 
	mysqli_stmt_bind_param($stmt, "ss", $role, $id);
	mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt); 
    
    echo "<td>", $role, "</td></tr>";
}
function check(){
    global $db;
    $id= getCurrentID();
    $sql = "select role from content where player = ?";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt); //執行SQL
    $result = mysqli_stmt_get_result($stmt); 
    $rs = mysqli_fetch_assoc($result);
    if ($rs['role'])
        return 0;
    else
        return 1;
}
function del(){
    global $db, $RoomNo;
    $id = getCurrentID();
    if ($id == getLeader()){
        $sql = "DELETE FROM content WHERE roomNo = ?";
        $stmt = mysqli_prepare($db, $sql);
        mysqli_stmt_bind_param($stmt, "s", $RoomNo);
        mysqli_stmt_execute($stmt);
        
        $sql = "DELETE FROM list WHERE roomNo = ?";
        $stmt = mysqli_prepare($db, $sql);
        mysqli_stmt_bind_param($stmt, "s", $RoomNo);
        mysqli_stmt_execute($stmt);
        header("Location: teamlist.php");
    } else {
        $sql = "DELETE FROM content WHERE player = ?";
        $stmt = mysqli_prepare($db, $sql);
        mysqli_stmt_bind_param($stmt, "s", $id);
        mysqli_stmt_execute($stmt);
        
        $sql = "UPDATE list SET count = count-1 where roomNo = ?";
        $stmt = mysqli_prepare($db, $sql); 
        mysqli_stmt_bind_param($stmt, "s", $RoomNo);
        mysqli_stmt_execute($stmt);
        header("Location: teamlist.php");
    }
}
?>
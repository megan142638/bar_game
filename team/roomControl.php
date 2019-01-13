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
    $sql = "select loginID from content where roomNo = ?";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "i", $RoomNo);
    mysqli_stmt_execute($stmt); //執行SQL
    $result = mysqli_stmt_get_result($stmt); 
    $arr = array();
    while($rs = mysqli_fetch_assoc($result))
        array_push($arr,$rs['loginID']);
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
function getAllRole()
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
function update()
{
    $check = 0;
    global $db;
    $id= getCurrentID();
    $role=$_POST['role'];
    for ($i = 0; $i < getCount(); $i++){
        if (getAllRole()[$i] == $role){
            $check = 0;
            break;
        }
        else
            $check = 1;
    }
    if ($check == 1){
        $sql = "UPDATE content SET role= ? where loginID = ?";
        $stmt = mysqli_prepare($db, $sql); 
        mysqli_stmt_bind_param($stmt, "ss", $role, $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt); 
        echo "<td>", $role, "</td></tr>";
    } else if ($check == 0)
        echo "<td>請重新選擇</td></tr>";
}
function check()
{
    global $db;
    $id= getCurrentID();
    $sql = "select role from content where loginID = ?";
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
function del()
{
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
        $sql = "DELETE FROM content WHERE loginID = ?";
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
function checkStatus()
{
    global $db, $RoomNo;
    $sql = "select status from list where roomNo = ?";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "i", $RoomNo);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $rs = mysqli_fetch_assoc($result);
    return $rs['status'];
}
?>
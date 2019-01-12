<?php
require_once("dbconfig.php");
function login($id, $pwd) 
{
    global $db;
    $_SESSION['ID'] = '';
    $_SESSION['per'] = '';
    if ($id> " ") {
        $sql = "select * from user where loginID=? and password=?";
        $stmt = mysqli_prepare($db, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $id, $pwd);
        mysqli_stmt_execute($stmt); //執行SQL
        $result = mysqli_stmt_get_result($stmt); 
        $r = mysqli_fetch_assoc($result);
        if($r) {
            $_SESSION['ID'] = $id;
            $_SESSION['per'] = $r['Permission'];
            return 1;
        } else {
            return 0;
        }
    }
    return 0;
}

function getCurrentID()
{
    return $_SESSION['ID'];
}
function getPermission()
{
    return $_SESSION['per'];
}
?>
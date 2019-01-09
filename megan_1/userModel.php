<?php
require_once("dbconfig.php");//require_once,連結,once表不重複
function login($id, $pwd) 
{
    global $db;
    $_SESSION['loginID'] = " ";
    if ($id> " ") {
        $sql = "select * from user where loginID=? and password=?";
        $stmt = mysqli_prepare($db, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $id, $pwd);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt); 
        $r=mysqli_fetch_assoc($result);
        if($r) {
			$_SESSION['loginID'] = $r['loginID'];
            return 1;
        } else {
            return 0;
        } 
    } 
    return 0;
}

function getCurrentUser() 
{
    return $_SESSION['loginID'];
}
?>

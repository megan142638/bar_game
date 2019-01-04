<?php
require_once("dbconfig.php");
function showorder($uID)
{
    global $db;
    if ($uID> 0) {
        $sql = "select gameorder.*, product.name, product.price from cartitem, product where cartitem.prdID=product.prdID and cartitem.uID=?";
        $stmt = mysqli_prepare($db, $sql);
        mysqli_stmt_bind_param($stmt, "i", $uID);
        mysqli_stmt_execute($stmt); //執行SQL
        $result = mysqli_stmt_get_result($stmt);
        return $result;
    } 
    return NULL;
}

function addorder($ordernum, $uID){//新增選取商品資料
    global $db;
    $sql = "insert into gameorder (temp) values (?)";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $ordernum,$uID);
    mysqli_stmt_execute($stmt); //執行SQL
    return;
}

// function removeCartItem($ID) 
// {
//     global $db;
//     $sql = "delete from cartitem where serno=?";
//     $stmt = mysqli_prepare($db, $sql);
//     mysqli_stmt_bind_param($stmt, "i", $ID);
//     mysqli_stmt_execute($stmt); //執行SQL
//     return;
// }

// function removeAllItems($uID)
// {
//     global $db;
//     $sql = "delete from cartitem where uID=?";
//     $stmt = mysqli_prepare($db, $sql);
//     mysqli_stmt_bind_param($stmt, "i", $uID);
//     mysqli_stmt_execute($stmt); //執行SQL
//     return;
// }
?>

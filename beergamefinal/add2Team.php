<?php
require("userModel.php");

$id= getCurrentID();
$RoomNo=(int)$_GET['roomNo'];

if($id){
    $sql = "insert into content (roomNo, loginID) values (?, ?)";
	$stmt = mysqli_prepare($db, $sql); //prepare sql statement
	mysqli_stmt_bind_param($stmt, "is", $RoomNo, $id); //bind parameters with variables
	mysqli_stmt_execute($stmt);  //執行SQL
    
    $sql = "UPDATE list SET count = count+1 WHERE roomNo = ?";
    $stmt = mysqli_prepare($db, $sql); 
	mysqli_stmt_bind_param($stmt, "i", $RoomNo);
	mysqli_stmt_execute($stmt);
}
header("Location: Room.php?roomNo=$RoomNo");
?>
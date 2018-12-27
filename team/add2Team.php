<?php
require("userModel.php");

$id= getCurrentID();
$RoomNo=(int)$_GET['roomNo'];

if($id){
    $sql = "insert into content (roomNo, player) values (?, ?)";
	$stmt = mysqli_prepare($db, $sql); //prepare sql statement
	mysqli_stmt_bind_param($stmt, "iss", $RoomNo, $id); //bind parameters with variables
	mysqli_stmt_execute($stmt);  //執行SQL
    
    
}
?>
<?php
require('dbconfig.php');

$temp=$_POST['temp'];

$store = 15; //庫存
$week = 1;
if($temp){
	$sql = "insert into order (role, temp1,temp2,temp3,temp4) values (1, ?,0,0,0)";
	$stmt = mysqli_prepare($db, $sql);
	mysqli_stmt_bind_param($stmt, "i",$temp );
	mysqli_stmt_execute($stmt);
	echo "已下單";
	$week++;
}else{
	echo "error";
}
for($week = 2; $week<50; $week++){
	if($week%4 == 1){
	    $sql = "update order set temp1 where role = 1";
		$stmt = mysqli_prepare($db, $sql);
		mysqli_stmt_bind_param($stmt, "i", $temp);
		mysqli_stmt_execute($stmt); //執行SQL
	    echo "已下單";
	    $week++;

	}
	else if($week%4 == 2){
	    $sql = "update order set temp2 where role = 1";
		$stmt = mysqli_prepare($db, $sql);
		mysqli_stmt_bind_param($stmt, "i", $temp);
		mysqli_stmt_execute($stmt); //執行SQL
	    echo "已下單";
	    $week++;

	}
	else if($week%4 == 3){
	    $sql = "update order set temp3 where role = 1";
		$stmt = mysqli_prepare($db, $sql);
		mysqli_stmt_bind_param($stmt, "i", $temp);
		mysqli_stmt_execute($stmt); //執行SQL
	    echo "已下單";
		$week++;

	}
	else if($week%4 == 0){
	    $sql = "update order set temp4 where role = 1";
		$stmt = mysqli_prepare($db, $sql);
		mysqli_stmt_bind_param($stmt, "i", $temp);
		mysqli_stmt_execute($stmt); //執行SQL
	    echo "已下單";
		$week++;
	}
}
?>




<?php
require("dbconfig.php");

$loginID = $_POST['uid'];
$password = $_POST['pwd'];

if ($loginID) {
	$sql = "insert into user (loginID, password) values ('$loginID','$password')";
	$stmt = mysqli_prepare($db, $sql);
	mysqli_stmt_bind_param($stmt, "ss", $loginID, $password);
	mysqli_stmt_execute($stmt);
	echo "已註冊!!";
}

?>

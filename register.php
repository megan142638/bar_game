<?php
require("dbconfig.php");

$loginID = $_POST['uid'];
$password = $_POST['pwd'];

if ($loginID) {
	$sql = "insert into user (loginID, password) values (?,?)";
	$stmt = mysqli_prepare($db, $sql);
	mysqli_stmt_bind_param($stmt, "ss", $loginID, $password);
	mysqli_stmt_execute($stmt);
	echo "已註冊!!";

	echo "<script>alert('警告：註冊成功!將在確認之後跳回登入頁面'); location.href = 'http://localhost/beer_game-master/login.html';</script>";
}


?>

<?php
require("dbconfig.php");
$loginID = $_POST['uid'];
$password = $_POST['pwd'];
$sql1 = "select * from user where loginID = '$loginID'";
$stmt1 = mysqli_prepare($db,$sql1);
$search = mysqli_num_rows($stmt1);

if ($search == 0) {
        $sql = "insert into user (loginID, password) values (?,?)";
        $stmt = mysqli_prepare($db, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $loginID, $password);
        mysqli_stmt_execute($stmt);
        echo "<script>alert('註冊成功!將在確認之後跳回登入頁面'); location.href = 'http://localhost/beer_game-master/login.html';</script>";
} else {
        echo "<script>alert('loginID已存在'); location.href = 'http://localhost/beer_game-master/register.html';</script>";
}
?>
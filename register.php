<?php
require("dbconfig.php");
$loginID = $_POST['uid'];
$password = $_POST['pwd'];
$sqlloginID = "SELECT loginID FROM user where loginID = '".$loginID."'";
if ($result = mysqli_query($db,$sqlloginID)) {
        if ($row=mysqli_fetch_array($result)) {
                echo "<script>alert('ID已存在!將在確認之後跳回註冊頁面'); location.href = 'http://localhost/beer_game-master/register.html';</script>";
        } else {
                $sql = "insert into user (loginID, password) values (?,?)";
                $stmt = mysqli_prepare($db, $sql);
                mysqli_stmt_bind_param($stmt, "ss", $loginID, $password);
                mysqli_stmt_execute($stmt);
                echo "<script>alert('註冊成功!將在確認之後跳回登入頁面'); location.href = 'http://localhost/beer_game-master/login.html';</script>";
        }
}
?>

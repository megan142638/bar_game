<?php
require("userModel.php");

$userName = $_POST['id'];//從login表單抓取使用者輸入的帳密連結db資訊
$passWord = $_POST['pwd'];
if (login($userName, $passWord)==1) {
    if(getRole()==Admin){
        header("Location: 01.php" );//管理者
    }
} else{
    header("Location: login.html");
}
?>
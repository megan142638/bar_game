<?php
require("userModel.php");

$userName = $_POST['id'];
$passWord = $_POST['pwd'];
if (login($userName, $passWord)==1) {
    header("Location: orderView.php" );//管理者
} else{
    header("Location: indexView.php");
}
?>
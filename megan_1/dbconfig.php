<?php
session_start();

$host = 'localhost';
$user = 'root';
$pass = '';
$dbName = 'beer_game';
$db = mysqli_connect($host, $user, $pass, $dbName) or die('Error with MySQL connection'); //跟MyMSQL連線並登入
mysqli_query($db,"SET NAMES utf8"); //選擇編碼

function checkLogin() {
    //echo $_SESSION["uID"];
	if ( ! isset($_SESSION["loginID"]) or $_SESSION["loginID"] <= 0) {
            header("Location: indexView.php");
	}
    exit(0);
}
?>
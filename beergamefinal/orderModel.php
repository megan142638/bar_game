<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
</head>

<body>

<p>已送出訂單</p>
<hr />
<?php
require("dbconfig.php");
require("userModel.php");

//變數
$temp=$_POST['temp'];
$loginID = getCurrentID();

//判斷使用者是誰
if ($temp && $loginID) {
	$sql = "INSERT INTO gameorder (loginID,temp1) values(?,?) ";
    $stmt = mysqli_prepare($db, $sql); //prepare sql statement
    if ( !$stmt ) {
        die('mysqli error: '.mysqli_error($db));
      }
	mysqli_stmt_bind_param($stmt, "si",$loginID,$temp); //bind parameters with variables
    if ( !mysqli_execute($stmt) ) {
        die( 'stmt error: '.mysqli_stmt_error($stmt) );
      }
    //mysqli_stmt_execute($stmt);  //執行SQL
	echo "message added.";
} else {
	echo "empty title, cannot insert.";
}

?>
<a href="orderView.php">回首頁</a>
</body>
</html>
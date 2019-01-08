<?php
require('dbconfig.php');
@$temp=$_POST['temp'];
$store = 15; //庫存
$sql = "select `week` from `gameorder` where `role`=1";
$stmt = mysqli_prepare($db, $sql);

if ( !$stmt ) {
    die('mysqli error: '.mysqli_error($db));
}
mysqli_stmt_execute($stmt); //執行SQL
$week = mysqli_stmt_get_result($stmt);
$rs = mysqli_fetch_assoc($week);
if($rs['week']==16){
	$sql = "UPDATE `gameorder` SET `temp1` = '0', `temp2` = '0', `temp3` = '0', `temp4` = '0', `week` = '1' where `role`=1";
	$stmt = mysqli_prepare($db, $sql);
	//mysqli_stmt_bind_param($stmt, "i",$rs['week'] );
	mysqli_stmt_execute($stmt);
	echo "本期結束	<br>";
	echo "<a href='game.php'>回上頁</a>";
}
if($temp){
	if(!$rs['week']){
	$sql = "INSERT INTO gameorder (role, temp1,temp2,temp3,temp4,week) VALUES (1, ?,0,0,0,1)";
	$stmt = mysqli_prepare($db, $sql);
	if ( !$stmt ) {
        die('mysqli error: '.mysqli_error($db));
    }
	mysqli_stmt_bind_param($stmt, "i",$temp );
	mysqli_stmt_execute($stmt);
	@$rs['week']++;
	$sql = "update gameorder set week=? where role = 1";
	$stmt = mysqli_prepare($db, $sql);
	mysqli_stmt_bind_param($stmt, "i",$rs['week'] );
	mysqli_stmt_execute($stmt);
	}
}
if($temp){
if($rs['week']%4 == 1){
    $sql = "update gameorder set temp1=? where role = 1";
	$stmt = mysqli_prepare($db, $sql);
	if ( !$stmt ) {
        die('mysqli error: '.mysqli_error($db));
    }
	mysqli_stmt_bind_param($stmt, "i", $temp);
	mysqli_stmt_execute($stmt); //執行SQL
	echo "已下單 <br>";
	$rs['week']++;
	//echo "week", $rs['week'],"<br>";
	$sql = "update gameorder set week=? where role = 1";
	$stmt = mysqli_prepare($db, $sql);
	mysqli_stmt_bind_param($stmt, "i",$rs['week'] );
	mysqli_stmt_execute($stmt);
	echo "<a href='game.php'>回上頁</a>";
}else if($rs['week']%4 == 2){
    $sql = "update gameorder set temp2=? where role = 1";
	$stmt = mysqli_prepare($db, $sql);
	if ( !$stmt ) {
        die('mysqli error: '.mysqli_error($db));
    }
	mysqli_stmt_bind_param($stmt, "i", $temp);
	mysqli_stmt_execute($stmt); //執行SQL
    echo "已下單";
    $rs['week']++;
	//echo "week", $rs['week'],"<br>";
    $sql = "update gameorder set week=? where role = 1";
	$stmt = mysqli_prepare($db, $sql);
	mysqli_stmt_bind_param($stmt, "i",$rs['week'] );
	mysqli_stmt_execute($stmt);
	echo "<a href='game.php'>回上頁</a>";
}else if($rs['week']%4 == 3){
    $sql = "update gameorder set temp3=? where role = 1";
	$stmt = mysqli_prepare($db, $sql);
	if ( !$stmt ) {
        die('mysqli error: '.mysqli_error($db));
    }
	mysqli_stmt_bind_param($stmt, "i", $temp);
	mysqli_stmt_execute($stmt); //執行SQL
	echo "已下單 <br>";
	$rs['week']++;
	//echo "week", $rs['week'],"<br>";
    $sql = "update gameorder set week=? where role = 1";
	$stmt = mysqli_prepare($db, $sql);
	mysqli_stmt_bind_param($stmt, "i",$rs['week'] );
	mysqli_stmt_execute($stmt);
	echo "<a href='game.php'>回上頁</a>";
}else if($rs['week']%4 == 0){
    $sql = "update gameorder set temp4=? where role = 1";
	$stmt = mysqli_prepare($db, $sql);
	if ( !$stmt ) {
        die('mysqli error: '.mysqli_error($db));
    }
	mysqli_stmt_bind_param($stmt, "i", $temp);
	mysqli_stmt_execute($stmt); //執行SQL
    echo "已下單 <br>";
    $rs['week']++;
	//echo "week", $rs['week'],"<br>";
    $sql = "update gameorder set week=? where role = 1";
	$stmt = mysqli_prepare($db, $sql);
	mysqli_stmt_bind_param($stmt, "i",$rs['week'] );
	mysqli_stmt_execute($stmt);
	echo "<a href='game.php'>回上頁</a>";
}
}


?>








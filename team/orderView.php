<?php
require("userModel.php");
require("orderControl.php");
$id= getCurrentID();
$RoomNo=(int)$_GET['roomNo'];

$role=getRole();
$result=getrolecontent();
$week=getWeek();
$ord=getOrd($role, $week);
$Allcost = getAllCost($role);
$store = getStore();
$debt = getDebt();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Beer Game</title>
<meta http-equiv="refresh" content="5" />

</head>
<body>
<h1>訂單  角色: <?php echo $role; ?></h1>
<hr />

<table width="100" border="1">
<th>下訂單</th>
<tr><td>
<?php
if (isset($_POST['sub'])){
    $num = $_POST['order'];
    updateord($num);
    echo '<input type="number" disabled="disabled" value="',$num,'"/>';
    echo '<input type="submit" disabled="disabled" /><input type="reset" disabled="disabled"/>';
} else if (isset($ord)){
    echo '<input type="text" disabled="disabled" value="等待其他玩家輸入"/>';
    echo '<input type="submit" disabled="disabled" /><input type="reset" disabled="disabled"/>';
} else {
    echo '<form method="post">';
    echo '<input type="number" name="order" min="0" required/>';
    echo '<input type="submit" name="sub" /><input type="reset" /></form>';
}
if (checknext() == 1){
    Counting();
    nextweek();
}
?>
</td></tr>
</table>

<table width="400" border="1">
<th>周次</th><th>訂貨數量</th><th>庫存</th><th>欠貨</th><th>當期成本</th><th>累計成本</th>
<?php
while ($rs = mysqli_fetch_assoc($result)){
    echo "<tr><td>" , $rs['week'],"</td><td>", $rs['ord'],
         "</td><td>", $rs['store'],"</td><td>", $rs['debt'],
         "</td><td>", $rs['cost'],"</td><td>", $rs['Allcost'],"</td></tr>";
}


?>
</table>
</body>
</html>
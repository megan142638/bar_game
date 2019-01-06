<?php
require("addorder.php");
//require("ordermodel.php");
//require("add2order.php");

require_once('dbconfig.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>input form</title>
</head>
<body>
<p>訂單 </p>
<hr />

<?php 
global $db;
if($week){
$sql = "select `week` from `gameorder` where `role`=1";
$stmt = mysqli_prepare($db, $sql);
if ( !$stmt ) {
    die('mysqli error: '.mysqli_error($db));
}
mysqli_stmt_execute($stmt); //執行SQL
$week = mysqli_stmt_get_result($stmt);
$rs = mysqli_fetch_assoc($week);

}
echo "week", $rs['week'],"<br>";
/*echo "role $role<br>";
echo "當期成本 $cost<br>";*/
//echo "<td><a href='05.like.php?id=$id'>送出($likes)</a>";
?>
   
<table width="200" border="1">
  <tr>
    <td>下單數量</td>

  </tr>
  <tr><form method="post" action="addorder.php">
    <td><label>
      <input name="temp" type="text" id="temp" />
      <input type="submit" name="Submit" value="送出" />
    </label></td>
	</form>
  </tr>
</table>
</body>
</html>

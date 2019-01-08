<?php
require_once("cartModel.php");
require_once("userModel.php");
// require("dbconfig.php");
// $result=getOrderList();
//checkLogin();
$result=showCart(getCurrentUser());//先判斷使用者後再帶入他的購物車
// $result=getOrderList();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
<link rel="stylesheet" type="text/css" href="main.css">
</head>

<body>

<p>my orders !!</p>
<hr />
<table width="200" border="1" class="">
  <tr>
    <td>數量</td>
  </tr>
  
<?php
$tot=0;
$i=0;
while (	$rs = mysqli_fetch_assoc($result)) {
  if($rs['prdID']){
    
  }
	echo "<tr><td>" , $rs['prdID'] ,
	"</td><td>" , $rs['name'],
	"</td><td>" , $rs['price'],
	"</td><td>" , $rs['amount'],
	"</td><td>" , $rs['price'] * $rs['amount'];
    $tot += $rs['price'] * $rs['amount'];
    if($tot>1000){
      $i=$tot%1000;
      $tot = $tot - 100*i;
    }
    $id=$rs['serno'];
    //echo '<td><a href="03.delete.php?id=', $rs['id'], '">刪</a> </td></tr>';
    echo "<td><a href='removeFromCart.php?id=$id'>刪</a>";
}
echo "<tr><td>Total: $tot</td><td><a href='checkout.php'>結帳</a></td>";
echo "<td><a href='prdView.php'>keep shopping</a></td></tr>";
?>
</table>
</body>
</html>

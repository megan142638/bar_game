<?php
require("ordermodel.php");
//require("userModel.php");
//checkLogin();
//$result=getOrderList();
$result = addOrder();
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

<?php echo 'week $week<br>';
      echo 'role $role<br>';
	  echo '當期成本 $cost<br>';

?>
   
<table width="200" border="1">
  <tr>
    <td>下單數量</td>

  </tr>
  <tr><form method="post" action="ordermodel.php">
    <td><label>
      <input name="number" type="text" id="number" />
      <input type="submit" name="Submit" value="送出" />
    </label></td>
	</form>
  </tr>
</table>
</body>
</html>

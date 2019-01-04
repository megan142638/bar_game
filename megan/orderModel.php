<?php
require_once("order.php");
require_once("userModel.php");

$ordernum = (int)$_POST['ordernum'];
addorder($ordernum, getCurrentUser());//add2Cart在cartModel,getCurrentUser()取得使用者資訊
header("Location: showCart.php");
?>
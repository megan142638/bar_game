<?php
require("userModel.php");
$loginID = $_POST['id'];
$pwd = $_POST['pwd'];
if (login($loginID, $pwd)==1) {
    header("Location: teamlist.php");
} else {
    header("Location: login.html");
}
?>
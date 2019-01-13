<?php
require("dbconfig.php");

session_destroy();

header("Location: loginView.php");
?>

<?php
require("dbconfig.php");
/*$dem = 0;
for ($i = 0; $i < 50; $i++){
    global $db;
    $sql = "INSERT INTO `admset`(`demand`) VALUES (0)";
    $stmt = mysqli_prepare($db, $sql);
    //mysqli_stmt_bind_param($stmt, "i", $dem);
	mysqli_stmt_execute($stmt); 
}*/
function update()
{
    global $db;
    $de = $_POST['dem'];
    for ($i = 1; $i <= 50; $i++){
        $sql = "UPDATE admset SET demand= ? WHERE week = ?";
        $stmt = mysqli_prepare($db, $sql);
        mysqli_stmt_bind_param($stmt, "ii", $de[$i-1], $i);
        mysqli_stmt_execute($stmt); 
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>設定需求</title>
<script type="text/javascript">
function random() {
    var a = document.getElementsByTagName('input');
    for(i = 0 ; i < 50 ; i++) {
        a[i].value=randomInput(1, 30);
    }
    function randomInput(min, max) {
        return parseInt(Math.random() * (max-min+1) + min);
    }
}
</script>
</head>
<body>
<form method="post">
<table width="600" border="1">
<?php
for ($i = 0; $i < 5; $i++){
    echo "<tr>";
    for ($j = 1; $j <= 10; $j++)
        echo '<td>第', $i*10+$j, '期</td>';
    echo "</tr><tr>";
    for ($j = 0; $j < 10; $j++)
        echo '<td><input type="number" name="dem[]" min="0" max="100" value="0"/></td>';
    echo "</tr>";
}
?>
<tr><td colspan="10" style="text-align:center">
<input type="submit" name="sub" /> 
<input type="button" value="全部隨機" onClick='random()'/> 
<input type="reset" /></td></tr>
</table></form>
<?php
if (isset($_POST['sub'])){
    update();
    header("Location: teamlist.php");
}
?>
</body>
</html>
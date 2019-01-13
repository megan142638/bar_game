<?php
require("dbconfig.php");
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
<!DOCTYPE html>
<html>
<title>設定需求</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<body>

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
<table width="600" border="1" class="w3-table-all w3-card-4">
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
<input type="submit" name="sub" class="btn btn-secondary"/> 
<input type="button" value="全部隨機" onClick='random()' class="btn btn-secondary"/> 
<input type="reset" class="btn btn-secondary"/></td></tr>
</table></form>
<?php
if (isset($_POST['sub'])){
    update();
    header("Location: teamlist.php");
}
?>
</body>
</html>
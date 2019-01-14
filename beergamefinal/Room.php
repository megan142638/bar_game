<?php
require("userModel.php");
require("roomControl.php");

$id= getCurrentID();
$RoomNo=(int)$_GET['roomNo'];

$RoomName = getRoomName();
$player = getPlayer();
$count = getCount();
$leader = getLeader();
$role = getAllRole();
$status = checkStatus();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link rel="stylesheet" type="text/css" href="https://bootswatch.com/4/sandstone/bootstrap.min.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>房間</title>
<meta http-equiv="refresh" content="3" />
</head>

<body>

<h1>房間號碼:<?php echo $RoomNo; ?> 房間名稱:<?php echo $RoomName; ?></h1>
<h2>隊長:<?php echo $leader; ?> 你是:<?php echo $id; ?></h2>
<hr />
<table width="600" border="1" class="table table-hover">
  <tr class="table-warning"><th>大頭貼</th><th>玩家</th><th>角色</th>
<?php 
$set = 0;
if ($id != $leader && check() && $set == 0)
    echo "<th>選擇角色</th></tr>";
for($i = 0; $i < $count; $i++){
    echo '<tr><td><img src="icon/', $player[$i], '.png" /></td>';
    echo "<td>", $player[$i], "</td>";
    if($role[$i])
        echo "<td>", $role[$i], "</td></tr>";
    else if (check() && $set == 0){
        echo "<td></td>";
        if (isset($_POST['role']))
            update();
        else {
            $arr = array("retailer","wholesaler","distributor","factory");
            for ($j = 0; $j < $count; $j++)
                if($role[$j])
                    for ($k = 0; $k < count($arr); $k++)
                        if ($role[$j] == $arr[$k])
                            array_splice($arr,$k,1);
            echo "<form method=\"post\"><td rowspan =", $count,">";
            for ($l = 0; $l < count($arr); $l++)
                echo '<input type="radio" name="role" value="',$arr[$l],'"/>', $arr[$l] ,'</br>';
            echo '<input type="submit" /></td></form></tr>';
            $set = 1;
        }
    }
}
?>
</table>
<form method="post" action="">
<input type="submit" name="Button" value="退出房間" class="btn btn-warning" />
</form>
<?php
if ($status == 1)
    header("Location: orderView.php?roomNo=$RoomNo");

if (isset($_POST['Button']))
    del();
else if (!$leader)
    header("Location: teamlist.php");

?>
</body>
</html>
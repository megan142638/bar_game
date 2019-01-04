<?php
require("userModel.php");
require("roomControl.php");

$id= getCurrentID();
$RoomNo=(int)$_GET['roomNo'];

$RoomName = getRoomName();
$player = getPlayer();
$count = getCount();
$leader = getLeader();
$role = getRole();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>房間</title>
<meta http-equiv="refresh" content="3" />
</head>

<body>

<h1>房間號碼:<?php echo $RoomNo; ?> 房間名稱:<?php echo $RoomName; ?></h1>
<hr />
<table width="400" border="1" class="">
  <tr><th>玩家</th><th>角色</th></tr>
<?php 
for($i = 0; $i < $count; $i++){
    echo "<tr><td>", $player[$i], "</td>";
    if($role[$i])
        echo "<td>", $role[$i], "</td></tr>";
    else if (check()){
        if (isset($_POST['role']))
            update();
        else {
            $arr = array("零售商","批發商","大盤商","工廠");
            for ($j = 0; $j < $count; $j++)
                if($role[$j])
                    for ($k = 0; $k < count($arr); $k++)
                        if ($role[$j] == $arr[$k])
                            array_splice($arr,$k,1);
            echo "<form method=\"post\" action=\"\"><td>";
            for ($l = 0; $l < count($arr); $l++)
                echo '<input type="radio" name="role" value="',$arr[$l],'"/>', $arr[$l] ,'</br>';
            echo '<input type="submit" /></td></form></tr>';
        }
    }
}
?>
</table>
<form method="post" action="">
<input type="submit" name="Button" value="退出房間" />
</form>
<?php
if (isset($_POST['Button']))
    del();
else if (!$leader)
    header("Location: teamlist.php");
?>
</body>
</html>
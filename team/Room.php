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
$ready = checkRole();
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
<h2>隊長:<?php echo $leader; ?> 你是:<?php echo $id; ?></h2>
<hr />
<table width="600" border="1" class="">
  <tr><th>大頭貼</th><th>玩家</th><th>角色</th>
<?php 
$set = 0;
if ($id != $leader && check() && $set == 0)
    echo "<th>選擇角色</th></tr>";
for($i = 0; $i < $count; $i++){
    echo '<tr><td><img src="../../icon/', $player[$i], '.png" /></td>';
    echo "<td>", $player[$i], "</td>";
    if($role[$i])
        echo "<td>", $role[$i], "</td></tr>";
    else if (check() && $set == 0){
        echo "<td></td>";
        if (isset($_POST['role']))
            update();
        else {
            $arr = array("零售商","批發商","大盤商","工廠");
            for ($j = 0; $j < $count; $j++)
                if($role[$j])
                    for ($k = 0; $k < count($arr); $k++)
                        if ($role[$j] == $arr[$k])
                            array_splice($arr,$k,1);
            echo "<form method=\"post\" action=\"\"><td rowspan =", $count,">";
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
<input type="submit" name="Button" value="退出房間" />
</form>
<?php
if (isset($_POST['Button']))
    del();
else if (!$leader)
    header("Location: teamlist.php");

if (isset($_POST['start'])){
    startgame();
    header("Location: orderView.php");
} else if ($id == $leader && $ready){
    echo '<form method="post" action="">';
    echo '<input type="submit" name="start" value="開始遊戲" /></form>';
} else if (startgame() == 1)
    header("Location: orderView.php");
?>
</body>
</html>
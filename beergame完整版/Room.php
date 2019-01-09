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
<link rel="Shortcut Icon" type="image/x-icon" href="http://localhost/beergame完整版/beer.png" />
<title>房間</title>
<meta http-equiv="refresh" content="3" />
<style type="text/css">
    @import url(https://fonts.googleapis.com/earlyaccess/notosanstc.css);
            body{ 
                font-family: 'Noto Sans TC';
                font-size: 20px;
                background:url(http://localhost/beergame完整版/wood.jpg);
                -moz-background-size:cover;
                -webkit-background-size:cover;
                -o-background-size:cover;
                background-size:cover;
                color: white;
                text-align: center;
            }  


        </style>
</style>
</head>

<body>

<h1>房間號碼:<?php echo $RoomNo; ?> 房間名稱:<?php echo $RoomName; ?></h1>
<h2>隊長:<?php echo $leader; ?> 你是:<?php echo $id; ?></h2>
<hr />
<center>
    <table width="600" border="1" class="" style="color:white" >
  <tr><th>大頭貼</th><th>玩家</th><th>角色</th>
<?php 
$set = 0;
if ($id != $leader && check() && $set == 0)
    echo "<th>選擇角色</th></tr>";
for($i = 0; $i < $count; $i++){
    echo '<tr><td width=100><img src="http://localhost/beergame完整版/icon/', $player[$i], '.png" width=100 height=75 /></td>';
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
</center>

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
    header("Location: teamlist.php");
} else if ($id == $leader && $ready){
    echo '<form method="post" action="">';
    echo '<input type="submit" name="start" value="開始遊戲" /></form>';
} else if (startgame() == 1)
    header("Location: teamlist.php");
?>
</body>
</html>
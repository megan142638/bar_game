<?php
require("dbconfig.php");
function getTeamList() 
{
    global $db;
    $sql = "select * from list";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_execute($stmt); //執行SQL
    $result = mysqli_stmt_get_result($stmt); 
    return $result;
}
$result=getTeamList();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="UTF-8" />  
        <meta name="keywords" content=" " />
        <meta name="description" content=" " />	    
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="Shortcut Icon" type="image/x-icon" href="http://localhost/beer_game-master/beer.png" />
        <title>隊伍列表</title>
        <center><h1>隊伍列表</h1></center>
        <meta http-equiv="refresh" content="3" />
        <style type="text/css">
		 @import url(https://fonts.googleapis.com/earlyaccess/notosanstc.css);
            body{ 
			font-family: 'Noto Sans TC';
                font-size: 20px;
                background:url(http://localhost/beer_game-master/wood.jpg);
                -moz-background-size:cover;
                -webkit-background-size:cover;
                -o-background-size:cover;
                background-size:cover;
            }   

        </style>
    </head>

    <body style="color:white">
        <center>
        <table width="600" border="1" >
            <tr>
                <td>房號:</td>
                <td>隊伍名稱:</td>
                <td>隊長:</td>
                <td>人數:</td>
                <td>選項:</td>
            </tr>
            <tr>    
                <?php
                    while ($rs = mysqli_fetch_assoc($result)) {
                        echo "<tr><td>" , $rs['roomNo'] ,
                        "</td><td>" , $rs['name'],
                        "</td><td>" , $rs['leaderID'],
                        "</td><td>" , $rs['count'],"</td>";
                    if ($rs['count'] < 4)
                        echo '<td><a href="add2Team.php?roomNo=', $rs['roomNo'],'">加入</a></td></tr>';
                    else 
                        echo "<td>人數已滿</td>";
                    }
                ?>                
            </tr>
            <tr>
                <td colspan="5">
                    <center>
                       
						<input type="button" value="創建隊伍" onclick="location.href='creatTeam.php'">
						<input type="button" value="登出" onclick="location.href='logout.php'">
                    </center>
                </td>
            </tr>
        </table>
        </center>
    </body>
</html>

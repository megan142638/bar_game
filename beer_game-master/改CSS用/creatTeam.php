<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>創立隊伍</title>
        <link rel="stylesheet" type="text/css" href="main.css">
        <style type="text/css">
            body{ 
                font-size: 30px;
                background:url(wood.jpeg);
                -moz-background-size:cover;
                -webkit-background-size:cover;
                -o-background-size:cover;
                background-size:cover;
            }
            table {
              
            }   
            .choice {
              text-align: center;
            }

        </style>
    </head>

    <body>

        <h1 align="center" style="color:white">創建隊伍</h1>
        <hr />
        <center>
            <form method="post" action="insert.php">
            <table width="650" border="1" style="background-color:#90EE90;" >
                <tr>
                    <td>隊伍名稱</td>
                    <td>
                        <input type="text" name="title" maxlength="10" required/>
                        <a style="color:yellow" font size="20">請輸入10位元以內</a>
                    </td>
                </tr>
                <tr>
                    <td>選擇角色</td>
                    <td id = "choice">
                        <input type="radio" name="role" value="零售商" checked/> 零售商
                        <input type="radio" name="role" value="批發商" /> 批發商
                        <input type="radio" name="role" value="大盤商" /> 大盤商
                        <input type="radio" name="role" value="工廠" /> 工廠
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:center">
                      <input type="submit" value="創建"/>
                      <input type="reset" />
                    </td>
                </tr>
            </table>
        </center>
        <br>
        <center>
            <input type="button" value="返回隊伍列表" onclick="location.href='teamlist.php'">
        </center>
      </body>
</html>

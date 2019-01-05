<?php
require("dbconfig.php");
$loginID = $_POST['uid'];
$password = $_POST['pwd'];
$sqlloginID = "SELECT loginID FROM user where loginID = '".$loginID."'";
$filename=$_FILES['img']['name'];
$tmpname=$_FILES['img']['tmp_name'];
$filetype=$_FILES['img']['type'];
$filesize=$_FILES['img']['size'];
$fileContents;

if ($_FILES["img"]["size"] > 0 ) {
         //開啟圖片檔
         $file = fopen($_FILES["img"]["tmp_name"], "rb");
         // 讀入圖片檔資料
         $fileContents = fread($file, filesize($_FILES["img"]["tmp_name"])); 
         //關閉圖片檔
         fclose($file);
         // 圖片檔案資料編碼
         $fileContents = base64_encode($fileContents);
}
if ($result = mysqli_query($db,$sqlloginID)) {
        if ($row=mysqli_fetch_array($result)) {
                echo "<script>alert('ID已存在!將在確認之後跳回註冊頁面'); location.href = 'http://localhost/beer_game-master/register.html';</script>";
        } else {
                $sql = "insert into user (loginID, password) values (?,?)";
                $stmt = mysqli_prepare($db, $sql);
                mysqli_stmt_bind_param($stmt, "ss", $loginID, $password);
                mysqli_stmt_execute($stmt);
                echo "<script>alert('註冊成功!將在確認之後跳回登入頁面'); location.href = 'http://localhost/beer_game-master/login.html';</script>";
        }
}
?>

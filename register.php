<?php
require("dbconfig.php");
$loginID = $_POST['uid'];
$password = $_POST['pwd'];
$sqlloginID = "SELECT loginID FROM user where loginID = '".$loginID."'";

if ($result = mysqli_query($db,$sqlloginID)) {
        if ($row=mysqli_fetch_array($result)) {
                echo "<script>alert('ID已存在!將在確認之後跳回註冊頁面'); location.href = 'http://localhost/beer_game-master/register.html';</script>";
        } else {
                $sql = "INSERT into user (loginID, password) values (?,?)";
                $stmt = mysqli_prepare($db, $sql);
                mysqli_stmt_bind_param($stmt, "ss", $loginID, $password);
                mysqli_stmt_execute($stmt);
                print_r($stmt);
<<<<<<< HEAD
                echo "<script>alert('註冊成功!將在確認之後跳回登入頁面'); location.href = 'http://localhost/beer_game-master/login.php';</script>";
=======
                echo "<script>alert('註冊成功!將在確認之後跳回登入頁面'); location.href = 'http://localhost/beer_game-master/login.html';</script>";
>>>>>>> 5199a0325b8d21d4024344640ecc8eddcd2e523c
        }
}

$arrTypes =array ("image/gif", "image/png", "image/jpeg", "image/pjpeg");
if ($_FILES['pic']['error']==0) { // Error?
   if (in_array($_FILES['pic']['type'], $arrTypes)) { // image type checking 
      echo "Upload: " . $_FILES["pic"]["name"] . "<br />";
      echo "Type: " . $_FILES["pic"]["type"] . "<br />";
      echo "Size: " . round(($_FILES["pic"]["size"] / 1024),2) . " Kb<br />";
      echo "Stored in: " . $_FILES["pic"]["tmp_name"]. "<br/>";
      $target_path ="icon/";
      $target_path .= $loginID.".png";
      if (file_exists("icon/" . $loginID.".png")) {
           return $loginID;
      } else {
         move_uploaded_file($_FILES["pic"]["tmp_name"],iconv("UTF-8","big5",$target_path));
         echo "Image file Uploaded!";
      }
   } else { 
   echo "Invalid File Format<br />";
   }
} else {
   echo "Error: " . $_FILES["pic"]["error"] . "<br />";
}


?>

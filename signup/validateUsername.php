<?php
  include '../database/dbConfig.php';
  $myusername  = $_GET["username"];
  $sql = "SELECT username FROM user WHERE username = '$myusername'";
  $result = mysqli_query($db, $sql);
  $count = mysqli_num_rows($result);
  if($count >0) {
          echo 1;
       } else {
          echo 0;
       }
  $db->close();
?>
<?php
  include '../database/dbConfig.php';
  $email = $_GET["email"];
  $sql = "SELECT email FROM user WHERE email = '$email'";
  $result = mysqli_query($db, $sql);
  $count = mysqli_num_rows($result);
  if($count >0) {
    echo 1;
  } else {
    echo 0;
  }
  $db->close();
?>
<?php
include '../database/dbConfig.php';

  if(isset($_POST['username']) && isset($_POST['passwd'])) {
       // username and password sent from form       
       $myusername = $_POST['username'];
       $mypassword = $_POST['passwd']; 
       
       $sql = "SELECT ID FROM user WHERE username = '$myusername' and password = '$mypassword' LIMIT 1";
       $result = mysqli_query($db, $sql);
       $row = mysqli_fetch_array($result, MYSQLI_NUM);
       $count = mysqli_num_rows($result);
       // If result matched $myusername and $mypassword, table row must be 1 row
     
       if($count == 1) {
          $id_active = (int) $row[0];
          $db->close();
          header("Location: ../order/pickdest.php?id_active=" . (string) $id_active);
       } else {
          header("Location: login.php");
       }
  }
?>

<html>
  <head>  
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="login.css">
  </head>
  <body>
    <form name="login" id="login" onsubmit="return validasiForm()" method="post">
      <div class="imgcontainer">
        <img class="logo1" src="loginLogo.png" alt="Avatar" class="avatar">
      </div>
      <div class="container">
        <label><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="username">
        <br>
        <label><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="passwd">
        <button type="submit" value = "submit">GO!</button>
        <div class="text1">
          <p>
            <a href="../signup/signup.php"> don't have an account? 
          </p>
        </div>
      </div>
    </form>

    <script>
    function validasiForm() {
      if (!validate()) {
        return false;
      }
    }

    function validate() {
      if (document.forms["login"]["passwd"].value == '' || document.forms["login"]["username"].value == ''){
        alert("tidak ada field yang boleh kosong");
        return(false);
      } else {
        return(true);
      }
    }
    </script>
  </body>
</html>

<?php $db->close(); ?>
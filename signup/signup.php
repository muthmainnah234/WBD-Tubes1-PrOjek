<html>
  <head>  
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="signup.css">
    <script src="validasi.js"></script>
  </head>
  <body>
    <form name="signup" action="../signup/insert.php" onsubmit="return validasiForm()" method="POST">
      <div class="imgcontainer">
        <img class="logo1" src="signupLogo.png" alt="Avatar" class="logo">
      </div>
      <div class="container">
        <label><b>Your Name</b></label>
        <input type="text" placeholder="Enter Your Name" name="name">
        <br>
        <label><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="username" id="username" onkeyup="usernameValidation(this.value)">
        <img id="checkmark1" class="checkmark1" src="" alt="">
        <br>
        <label><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" id="email" onkeyup="emailValidation(this.value)">
        <img id="checkmark2" class="checkmark2" src="" alt="">
        <br>
        <label><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="passwd1">
        <br>
        <label><b>Confirm Password</b></label>
        <input type="password" placeholder="Enter Password" name="passwd2">
        <br>
        <label><b>Phone Number</b></label>
        <input type="text" pattern="[0-9]*" placeholder="Enter Phone Number" name="phoneNumber">
        <br>
        <br>
        <input type="checkbox" name="isDriver" value="isdriver"> Also sign me up as a driver!
        <br>
        <button type="submit" id="button" >Register</button>
        <input type="hidden" id="validemail" name="validemail" value = "1">
        <input type="hidden" id="validname" name="validname" value = "1">


        <div class="text1">
          <p>
          <a href="../login/login.php"> Already have an account? 
          </p>
        </div>
      </div>
    </form>
  </body>
</html>
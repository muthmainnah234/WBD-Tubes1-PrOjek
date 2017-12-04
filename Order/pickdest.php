<html>
<head>
    <?php 
      include '../database/dbConfig.php';
      $id_active = $_GET['id_active'];
      $data = $db->query("SELECT * FROM user WHERE ID=$id_active");
      $data_user = $data->fetch_assoc();
    ?>
    <title>Make A Order</title>
    <link rel="stylesheet" type="text/css" href="makeorder.css">
</head>
<body>
<div class = "header">
  <div class="title">
     <div class="bigfont"> 
        <label class= "headcolor1">PR</label><label>-</label><label class="headcolor2">OJEK</label>
     </div>
     <div>
        <label class = "wushwush">wushh...wushh...ngeeeng</label>
     </div>
  </div>
  <div class="logininfo">
      <label class = "floatright"> Hi, <b><?php echo $data_user['username'] ?>!</b> </label>
      <br>
     <a class="floatright" href="../login/login.php">logout</a>
  </div>
</div>

<div class="tab">
  <button class="tablinks active" onclick="window.location.href='pickdest.php?id_active=<?php echo $id_active?>'">ORDER</button>
  <button class="tablinks" onclick="window.location.href='../history/history.php?id_active=<?php echo $id_active?>'">HISTORY</button>
  <button class="tablinks" onclick="window.location.href='../profile/myprofile.php?id_active=<?php echo $id_active?>'">MY PROFILE</button>
</div>

<div>

  <div class="makeorder">MAKE AN ORDER</div>

      <div class="steplabeltab">
        <div class = "steplabelopen">
          <div class= "steplabelnumber">
              <label >1</label>
          </div>
          <div class = "steplabeltext">
             <label >Select Destination</label>
          </div>
        </div>
        <div class = "steplabel">
          <div class= "steplabelnumber">
              <label >2</label>
          </div>
          <div class = "steplabeltext">
             <label >Select a Driver</label>
          </div>
        </div>
        <div class = "steplabel">
          <div class= "steplabelnumber">
              <label >3</label>
          </div>
          <div class = "steplabeltext">
             <label >Complete your order</label>
          </div>
        </div>

      </div>

      <form name="pickdest" action="showdriver.php?id_active=<?php echo $id_active?>" onsubmit="return validateForm()" method="post" class="pickdestform">
        <label class = "formlabel">Picking Point</label>
        <input type="text"  name="pickpoint" >
        <br>
        <label class = "formlabel">Destination</label>
        <input type="text" name="dest" >
      <br>
        <label class = "formlabel">Preffered Driver</label>
        <input type="text" placeholder="(optional)" name="prefdriver">
      <br>
        <button class = "submit" type="submit">NEXT</button>
      </form>
</div>


<script>
function validateForm() {
    var x = document.forms["pickdest"]["pickpoint"].value;
    var y = document.forms["pickdest"]["dest"].value;

    if (x == "") {
        alert("Picking Point must be filled out");
        return false;
    } else
    if (y == "") {
        alert("Destination must be filled out");
        return false;
    }
}
</script>
      <?php $db->close(); ?>
</body>
</html> 

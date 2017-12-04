<?php
//Include DB configuration file
include '../database/dbConfig.php';
$picking_point = $_POST['pickpoint'];
$destination_point = $_POST['dest'];
$preffered_driver = $_POST['prefdriver'];
      $id_active = $_GET['id_active'];
      $data = $db->query("SELECT * FROM user WHERE ID=$id_active");
      $data_user = $data->fetch_assoc();
?>
<html>
<head>
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
        <div class = "steplabel">
          <div class= "steplabelnumber">
              <label >1</label>
          </div>
          <div class = "steplabeltext">
             <label >Select Destination</label>
          </div>
        </div>
        <div class = "steplabelopen">
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

      <div class="container">
          <div class = "box">
              <label class="boxlabel">PREFERRED DRIVERS:</label>
              <?php
                  //Fetch products from the database
                  $results = $db->query("SELECT distinct user.ID, name, rating, username, totalvote, imagepath FROM (user join pref_loc) join userimage where user.ID != '$id_active' and isdriver = 1 and user.ID = pref_loc.IDDriver and user.ID = userimage.ID and name = '$preffered_driver' and (Location = '$picking_point' or Location = '$destination_point')");
                  $num = 0;
                  while($row = $results->fetch_assoc()){
              ?>
              <div class = "clearfix">
                  <img class="profile_picture" src="<?php echo $row['imagepath']; ?>" alt="DP Supir"">
                  <label class="drivername"><?php echo $row['name']; ?></label>
                  <div class="driverinfo">
                    <label class="rating">*<?php echo $row['rating']; ?></label>
                    <label> (<?php echo $row['totalvote']; ?> votes) </label>
                  </div>
                  <form action="completeorder.php?id_active=<?php echo $id_active?>" method="post" class="choosedriver" >
                         <input type="hidden" name="id_driver" value="<?php echo $row['ID']; ?>">
                         <input type="hidden" name="name" value="<?php echo $row['name']; ?>">
                         <input type="hidden" name="username" value="<?php echo $row['username']; ?>">
                         <input type="hidden" name="picking_point" value="<?php echo $picking_point; ?>">
                         <input type="hidden" name="destination_point" value="<?php echo $destination_point; ?>">

                      <button class = "submit" type="submit">I CHOOSE YOU!!</button>
                   </form>

              </div>
              <?php 
                    $num += 1;
                  } 
                  if($num == 0){
              ?>

              <div class = "emptybox">
                <label>Nothing To Display :(</label>
              </div>
              <?php 
                  }
              ?>

          </div>

          <div class = "box">
              <label class="boxlabel">OTHER DRIVERS:</label>
               <?php
                  //Fetch products from the database
                  $results = $db->query("SELECT distinct user.ID, name, rating, username, totalvote, imagepath FROM (user join pref_loc) join userimage where user.ID != '$id_active' and isdriver = 1 and name != '$preffered_driver' and user.ID = pref_loc.IDDriver  and user.ID = userimage.ID and (Location = '$picking_point' or Location = '$destination_point')");
                  $num = 0;
                  while($row = $results->fetch_assoc()){
              ?>
              <div class = "clearfix">
                  <img class="profile_picture" src="<?php echo $row['imagepath']; ?>" alt="DP Supir"">
                  <label class="drivername"><?php echo $row['name']; ?></label>
                  <div class="driverinfo">
                    <label class="rating">*<?php echo $row['rating']; ?></label>
                    <label> (<?php echo $row['totalvote']; ?> votes) </label>
                  </div>
                  <form action="completeorder.php?id_active=<?php echo $id_active?>" method="post" class="choosedriver">
                         <input type="hidden" name="id_driver" value="<?php echo $row['ID']; ?>">
                         <input type="hidden" name="name" value="<?php echo $row['name']; ?>">
                         <input type="hidden" name="username" value="<?php echo $row['username']; ?>">
                         <input type="hidden" name="picking_point" value="<?php echo $picking_point; ?>">
                         <input type="hidden" name="destination_point" value="<?php echo $destination_point; ?>">
                      <button class = "submit" type="submit">I CHOOSE YOU!!</button>
                   </form>

              </div>
              <?php 
                    $num += 1;
                  } 
                  if($num == 0){
              ?>

              <div class = "emptybox">
                <label>Nothing To Display :(</label>
              </div>
              <?php 
                  }
              ?>

          </div>
      </div>
</div>


     
</body>
</html> 
<?php $db->close(); ?>
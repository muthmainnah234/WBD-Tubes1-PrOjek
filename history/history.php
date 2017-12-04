<?php
//Include DB configuration file
include '../database/dbConfig.php';
$id = $_GET['id_active'];
$initurl = "hide.php?id_active=" . $id;
 // header("Location: validation.php");
 // username and password sent from form        
 
 $sql = "SELECT username FROM user WHERE ID = '$id' LIMIT 1";
 $result = mysqli_query($db, $sql);
 $row = mysqli_fetch_array($result, MYSQLI_NUM);
 $count = mysqli_num_rows($result);
 // If result matched $myusername and $mypassword, table row must be 1 row
 
  if($count == 1) {
     $name = $row[0];
  } else {
     $name = "noName";
  }
?>

<html>
<head>
    <title>Make A Order</title>
    <link rel="stylesheet" type="text/css" href="history.css">
    <script src="history.js"></script>
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
      <label class = "floatright"> Hi, <b> <?php echo $name; ?>! </b> </label>
      <br>
     <label class = "floatright"> <a href="../login/login.php"><u> logout </u></a> </label>
  </div>
</div>

<div class="tab">
  <button class="tablinks" onclick="sambung('../Order/pickdest.php', '<?php echo $id; ?>')">ORDER</button>
  <button class="tablinks active" onclick="sambung('history.php', '<?php echo $id; ?>')">HISTORY</button>
  <button class="tablinks" onclick="sambung('../profile/myprofile.php', '<?php echo $id; ?>')">MY PROFILE</button>
</div>

<div>
  <div class="makeorder">TRANSACTION HISTORY</div>

      <div class="tab2">
        <button class="tablinks active" onclick="sambung('history.php', '<?php echo $id; ?>')">MY PREVIOUS ORDER</button>
        <button class="tablinks" onclick="sambung('history2.php', '<?php echo $id; ?>')">DRIVER HISTORY</button>
      </div>
      
    <form action="<?php echo $initurl ?>" method="post">
      <div class="container">
          <div class = "box">
              <?php
                  //Fetch products from the database
                  $results = $db->query("SELECT distinct IDTransaksi,IsHide,name, LokasiAwal, LokasiTujuan, transaction.Rating, comment, DatePosted, imagepath FROM ((user join transaction) join userimage) where user.ID = transaction.IDDriver and IDPenumpang = $id and userimage.ID = user.ID");
                  $num = 0;
                  // $date = "Friday, September 22nd 2017";
                  while($row = $results->fetch_assoc()){
                    if ($row['IsHide'] == 0){
                      $idTransaksi = $row['IDTransaksi'];
                      $result1 = $db->query("SELECT DATE_FORMAT((select DatePosted from transaction where IDTransaksi=$idTransaksi limit 1), '%W, %M %D %Y') as tanggal");
                      $row1 = $result1->fetch_assoc();
                      $date = $row1['tanggal'];

              ?>
              <div class = "clearfix">
                  <button type="submit" value="<?php echo $idTransaksi ?>" name="Submit">HIDE</button>
                  <img class="profile_picture" src="<?php echo $row['imagepath']?>" alt="DP Supir">
                  <div class="driverinfo">
                    <label class="date"><?php echo $date; ?></label>
                    <br>
                    <label class="drivername"><?php echo $row['name']; ?></label>
                    <br>
                    <label class="city"> <?php echo $row['LokasiAwal']; ?> &#8594 <?php echo $row['LokasiTujuan']; ?></label>
                    <br>
                    <label class="rating" id="rating"> you rated: </label>
                      <?php
                        $i = 1;
                        while ($i <= $row['Rating']) {
                          $i++;
                          ?>
                            &#9734;<?php  
                        } ?>
                    <br>
                    <label class="comment">you commented : <br>
                      <?php echo $row['comment']; ?>
                    </label>
                    <br>
                    <br>
                  </div>
              <?php 
                    }
                  } 
              ?>
          </div>
      </div>
    </form>   
  </div>
</div>



</body>
</html>
<?php $db->close(); ?>
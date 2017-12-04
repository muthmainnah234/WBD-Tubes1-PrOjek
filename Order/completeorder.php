<!DOCTYPE html>
<?php
    $name = $_POST['name'];
    $username = $_POST['username'];
    $id_driver = $_POST['id_driver'];
    $picking_point = $_POST['picking_point'];
    $destination_point = $_POST['destination_point'];
    include '../database/dbConfig.php';
    $id_active = $_GET['id_active'];
    $data = $db->query("SELECT * FROM user WHERE ID=$id_active");
    $data_user = $data->fetch_assoc();
    $img = $db->query("SELECT * FROM userimage WHERE ID=$id_driver");
    $img_data = $img->fetch_assoc();
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

<div class="content">

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
        <div class = "steplabel">
          <div class= "steplabelnumber">
              <label >2</label>
          </div>
          <div class = "steplabeltext">
             <label >Select a Driver</label>
          </div>
        </div>
        <div class = "steplabelopen">
          <div class= "steplabelnumber">
              <label >3</label>
          </div>
          <div class = "steplabeltext">
             <label >Complete your order</label>
          </div>
        </div>

      </div>

      <div>
        <label class="howwasit">HOW WAS IT?</label>
        <div class="center">
         <img class="circle_picture " src="<?php echo $img_data['imagepath'] ?>" alt="DP Supir"">
        </div>
        <div class="uname">
         <label >@<?php  echo $username; ?></label>
        </div>
        <div class="fullname">
         <label ><?php  echo $name; ?></label> 
        </div>
      </div> 

      <!--rating star-->
      <div id="r1" class="rate_widget">
          <star-rating value="0" number="5" id="starrating">
            <img id="star_0" class= "ratings_stars" src="StarEmpty.png">
            <img id="star_1" class= "ratings_stars" src="StarEmpty.png">
            <img id="star_2" class= "ratings_stars" src="StarEmpty.png">
            <img id="star_3" class= "ratings_stars" src="StarEmpty.png">
            <img id="star_4" class= "ratings_stars" src="StarEmpty.png">
          </star-rating>


      </div>

      <!--form comment-->
      <form name="commentform" action="puttransaction.php?id_active=<?php echo $id_active?>" onsubmit="return validateForm()" method="post" class="commentform" id=commentform>
        <input type="hidden" id="ratingbox" name="rating" value="0">
          <script src="StarRating.js"></script>
          <script>
             starrating.addEventListener('rate',() =>{
             ratingbox.value = document.getElementById("starrating").value;
            })
          </script>
        <input type="hidden" name="id_driver" value="<?php echo $id_driver; ?>">
        <input type="hidden" name="id_active" value="<?php echo $id_active; ?>">
        <input type="hidden" name="name" value="<?php echo $name; ?>">
        <input type="hidden" name="username" value="<?php echo $username; ?>">
        <input type="hidden" name="picking_point" value="<?php echo $picking_point; ?>">
         <input type="hidden" name="destination_point" value="<?php echo $destination_point; ?>">
        <textarea id = "commentbox" form="commentform" maxlength="140" placeholder="Your comment..." name="comment" rows="2"></textarea>
        <button class = "submit" type="submit">COMPLETE<br>ORDER</button>
      </form>

</div>

<script>
function validateForm() {
    var x = document.forms["commentform"]["rating"].value;
    var y = document.getElementById("commentbox").value;

    if (x == "0") {
        alert("Please fill rating");
        return false;
    } else
    if (y == "") {
        alert("Please fill comment");
        return false;
    }

}
</script>
     
</body>
</html> 
<?php $db->close(); ?>
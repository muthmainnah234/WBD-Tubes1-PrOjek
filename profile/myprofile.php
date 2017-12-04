<?php include '../database/dbConfig.php';
?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="myprofile.css">
</head>
<body>
	<?php 
		$id_active = $_GET['id_active'];
		$data = $db->query("SELECT * FROM user WHERE ID=$id_active");
		$img = $db->query("SELECT * FROM userimage WHERE ID=$id_active");
		$data_user = $data->fetch_assoc();
		$img_data = $img->fetch_assoc();
	?>
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
	     <a class="floatright" href="../login/login.php">Logout</a>
	  </div>
	</div>

	<div class="tab">
	  <button class="tablinks" onclick="window.location.href='../order/pickdest.php?id_active=<?php echo $id_active?>'">ORDER</button>
	  <button class="tablinks" onclick="window.location.href='../history/history.php?id_active=<?php echo $id_active?>'">HISTORY</button>
	  <button class="tablinks active" onclick="window.location.href='../profile/myprofile.php?id_active=<?php echo $id_active?>'">MY PROFILE</button>
	</div>

	<div class="tabcontent">
		<div class="myprofile"><a href="editprofile.php?id_active=<?php echo $id_active?>"><img class="pencil" src="pencil.png"></a>MY PROFILE</div>
		<div class="displaypic"><img src="<?php echo $img_data['imagepath'] ?>"></div>
		<div class="profileinfo">
		  	<span>@<?php echo $data_user['username'] ?></span><br>
		  	<span><?php echo $data_user['name'] ?></span><br>
		  	<?php
		  		$isDriver = $data_user['isdriver'];
		  		if ($isDriver == 1) {
		  			$status = "Driver";
		  		}
		  		else {
		  			$status = "Non-Driver";
		  		}
		  	?>
		  	<span><?php echo $status ?></span>
		  	<?php if ($status == "Driver") { ?>
		  	<span> | </span><span style="color:#fd9927">&#9734; <?php echo $data_user['rating']?></span><span> (<?php echo $data_user['totalvote']?> votes)</span>
		  	<?php } ?>
		  	<br><span>&#9993; <?php echo $data_user['email'] ?><br>
		  	&#9743; <?php echo $data_user['phone'] ?></span>
		</div>
		<?php if ($status == "Driver") { ?>
		<div id="tabdriver">
			<div class="prefloc"><a href="editloc.php?id_active=<?php echo $id_active?>"><img class="pencil" src="pencil.png"></a>PREFERRED LOCATIONS</div>
			<div class="locations">
				<?php 
					$locs = $db->query("SELECT Location FROM pref_loc WHERE IDDriver=$id_active");
					$item = 0;
					while ($loc = $locs->fetch_assoc()) {
						$item += 1;
						echo "<ul>";
						echo "<li>";
						echo $loc['Location'];
					}
					while ($item > 0) {
						echo "</li>";
						echo "</ul>";
						$item--;
					}
				?>
			</div>
		</div>
		<?php } ?>
	</div>

	<?php $db->close(); ?>

</body>
</html>
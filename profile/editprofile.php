<?php include '../database/dbConfig.php';
	$id_active = $_GET['id_active'];
	$data = $db->query("SELECT * FROM user WHERE ID=$id_active");
	$data_user = $data->fetch_assoc();
	$img = $db->query("SELECT * FROM userimage WHERE ID=$id_active");
	$img_data = $img->fetch_assoc();
?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="editprofile.css">
</head>
<body>

	<form action="" method="post" onsubmit="return validateForm()" enctype="multipart/form-data">
		<div class="title">EDIT PROFILE INFORMATION</div>
			<div class="editdp">
				<div class="showpic"><img src="<?php echo $img_data['imagepath'] ?>"></div>
				<div class="uploadpic">
					<label>Update profile picture</label><br>
					<input type="text" name="displaypic" id="displaypic" readonly>					
					<label for="imageToUpload" class="inputfile" id="displaypic">Browse...</label>
  					<input  type="file" class = "invisible" id="imageToUpload" name="imageToUpload" accept="image/*" onchange="getFilePath(this.value)">
				</div>
			</div>
		<div class="edit">
			<div class="fieldname">Your Name</div>
			<div class="field"><input id="fieldname" type="text" name="username" value="<?php echo $data_user['name'] ?>"></div>
		</div>
		<div class="edit">
			<div class="fieldname">Phone</div>
			<div class="field"><input id="fieldphone" type="text" pattern="[0-9]*" name="phonenumb" value="<?php echo $data_user['phone'] ?>"></div>
		</div>
		<div class="edit">
			<div class="fieldname">Status Driver</div>
			<div class="field">
				<label class="switch">
				  <input id="toggle" type="checkbox" name="isdriver">
				  <span class="slider"></span>
				</label>
			</div>
		</div>
		<div class="submit">
			<input class="back" type="button" name="Cancel" value="BACK" onclick="openProfile()">
			<input class="save" type="submit" name="Submit" value="SAVE">
		</div>
	</form>
	<script type="text/javascript">
		function getFilePath(input){
			var array = input.split('\\')
			document.getElementById("displaypic").value = array[array.length - 1];
		}
	</script>
<?php
			if (isset($_POST['Submit'])) {
			if (isset($_POST['isdriver']) && !(empty($_POST['isdriver']))) {
				$isdriver = 1;
			}
			else {
				$isdriver = 0;
			}
			//upload processing
			$target_dir = "\..\uploads\\";
			$path = basename($_FILES["imageToUpload"]["name"]);
			$ext = pathinfo($path, PATHINFO_EXTENSION);
			$target_file = $target_dir . $id_active . ".". $ext;
			$uploadOk = 1;
			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
			    $check = getimagesize($_FILES["imageToUpload"]["tmp_name"]);
			    if($check !== false) {
			        $uploadOk = 1;
			    } else {
			        $uploadOk = 0;
			    }
			}
			// Check file size
			if ($_FILES["imageToUpload"]["size"] > 2500000) {
			    echo "<script>alert(Sorry, your file is too large.)</script>";
			    $uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
			    echo "<script>alert(Sorry, your file was not uploaded.)</script>";
			// if everything is ok, try to upload file
			} else {
				$root = getcwd();
			    if (move_uploaded_file($_FILES["imageToUpload"]["tmp_name"], $root.$target_file)) {
			    } else {
			        echo "<script>alert(Sorry, there was an error uploading your file.)</script>";
			    }
			}
			


			$name = $_POST['username'];
			$phone = $_POST['phonenumb'];
			$uploadedpic = 1;
			if(basename($_FILES["imageToUpload"]["name"]) != ""){
				$imgpath = "../uploads/". $id_active. ".".$ext;
				$idimage ="UPDATE userimage SET imagepath='$imgpath' WHERE ID = '$id_active'";
			} else {
				$uploadedpic = 0;
			}
			$sql = "UPDATE user SET name='$name', phone='$phone', isdriver='$isdriver' WHERE ID='$id_active'";

			if ($db->query($sql) === TRUE) {
				if($uploadedpic == 1) {
					if ($db->query($idimage) === TRUE) {?>
						<script type="text/javascript">
							window.location = 'myprofile.php?id_active=<?php echo $id_active?>';
						</script>
			<?php }
				} else {
					?>
						<script type="text/javascript">
							window.location = 'myprofile.php?id_active=<?php echo $id_active?>';
						</script>
					<?php
				}
			}
		}
	?>

	<script type="text/javascript">
		function openProfile() {
			window.location = 'myprofile.php?id_active=<?php echo $id_active?>';
		}

		function validateForm() {
		    var x = document.getElementById("fieldname").value;
		    var y = document.getElementById("fieldphone").value;

		    if (x.length <1 || x.length >20) {
		        alert("Name must be 1-20 character");
		        return false;
		    } else
		    if (y.length < 9 || y.length >12) {
		        alert("Phone number must be 9-12 character");
		        return false;
		    }
		}

		x = <?php echo $data_user['isdriver'] ?>;
		if (x == '1') {
			document.getElementById('toggle').defaultChecked = true;
		}
	</script>

	<?php $db->close(); ?>
</body>
</html>
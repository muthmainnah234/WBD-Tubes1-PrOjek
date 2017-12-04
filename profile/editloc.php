<?php include '../database/dbConfig.php';
	$id_active = $_GET['id_active'];
	$data = $db->query("SELECT * FROM pref_loc WHERE IDDriver=$id_active");
?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="editloc.css">
</head>
<body>
	<div class="title">EDIT PREFERRED LOCATIONS</div>
	<form name="list_loc" method="post">
	<table id="loc_table">
		<tr>
			<th id="no">No</th>
			<th id="loc">Location</th>
			<th id="act">Actions</th>
		</tr>
		<?php 
			$seq = 0;
			while ($data_user = $data->fetch_assoc()) { 
			$seq++;
		?>
		<tr>
			<td id="number"><?php echo $seq; ?></td>
			<td id="data"><input type="text" name="locname" value="<?php echo $data_user['Location']; ?>" readOnly="true" id="loc-edit<?php echo $data_user['Location']; ?>" class="loc-edit" required></td>
			<td><input type="image" name="edit" src="pencil.png" id="edit<?php echo $data_user['Location']; ?>" value="<?php echo $data_user['Location']; ?>" class="edit-save">
			<?php
				if (isset($_POST['edit'])) { ?>
					<script type="text/javascript">
						document.getElementById('edit<?php echo $_POST['edit'] ?>').src = "save.png";
						document.getElementById('loc-edit<?php echo $_POST['edit'] ?>').readOnly = false;
						document.getElementById('edit<?php echo $_POST['edit'] ?>').setAttribute("name","save");
						document.getElementById('edit<?php echo $_POST['edit'] ?>').setAttribute("id","save<?php echo $_POST['edit'] ?>");
					</script>
				<?php 
				}
				else if (isset($_POST['save'])) { 
					$locbefore = $_POST['save'];
					$locafter = $_POST['locname'];
				?>
					<script type="text/javascript">
						document.getElementById('save<?php echo $_POST['save'] ?>').setAttribute("value","<?php echo $_POST['locname'] ?>");
						document.getElementById('save<?php echo $_POST['save'] ?>').src = "pencil.png";
						document.getElementById('loc-edit<?php echo $_POST['save'] ?>').readOnly = true;
						document.getElementById('save<?php echo $_POST['save'] ?>').setAttribute("name","edit");
						document.getElementById('save<?php echo $_POST['save'] ?>').setAttribute("id","edit<?php echo $_POST['save'] ?>");
					</script>
				<?php 
					$sql3 = "UPDATE pref_loc SET Location='$locafter' WHERE Location='$locbefore'"; 
					if ($db->query($sql3) === TRUE) {
						header("Refresh:0");
					}
					else {
						echo "gagal";
					}
				}
			?>
				<input type="image" name="delete" src="delete.gif" id="delete" value="<?php echo $data_user['Location']; ?>" onclick="return confirm('Are you sure ?')"></td>
		</tr>
		<?php } 
			if (isset($_POST['delete'])) {
				$x = $_POST['delete'];
				$sql2 = "DELETE FROM pref_loc WHERE IDDriver=$id_active and Location='$x';";
				if ($db->query($sql2) === TRUE) {
					header("Refresh:0");
				}
			}
		?>
	</table>
	</form>
	<div class="head">ADD NEW LOCATION:</div>
	<form action="" method="post" name="add_loc" onsubmit="return validateForm()">
	<div class="inputbox"><input id="inputloc" type="text" name="inputloc"></div>
	<input class="add" type="submit" name="Add" value="ADD">
	</form>

	<?php 
		if (isset($_POST['Add'])) {
			$newloc = $_POST['inputloc'];
			$sql = "INSERT INTO pref_loc VALUES('$id_active','$newloc')";
			if ($db->query($sql) === TRUE) {
				header("Refresh:0");
			}
		}
	?>

	<div class="backbutton">
		<input class="back" type="button" name="Cancel" value="BACK" onclick="window.location='myprofile.php?id_active=<?php echo $id_active?>'">
	</div>

	<script type="text/javascript">
		function validateForm() {
		    var x = document.forms["add_loc"]["inputloc"].value;
		    if (x == "") {
		        alert("Location name can't be empty");
		        return false;
		    }
		    else if (x.length > 30) {
		    	alert("Location name can't be more than of 30 characters");
		    	return false;
		    }
		}

	</script>
	<?php $db->close(); ?>
</body>
</html>
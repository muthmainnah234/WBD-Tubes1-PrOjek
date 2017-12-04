      <?php
          include '../database/dbConfig.php';
          $insert = $db->prepare("INSERT INTO transaction (IDTransaksi, IDDriver,IDPenumpang,LokasiAwal,LokasiTujuan,Rating,Comment,IsHide, DatePosted) VALUES (?,?,?,?,?,?,?,?,?)");
          $insert->bind_param("sssssisis", $ID, $id_driver, $id_active, $picking_location, $dest_location, $rating, $comment, $ishide, $date);
          $id_driver= $_POST['id_driver'];
          $id_active = $_GET['id_active'];
          $picking_location =  $_POST["picking_point"]; 
          $dest_location =  $_POST["destination_point"]; 
          $rating =  $_POST["rating"]; 
          $comment =  $_POST["comment"];
          $ishide = 0;
          $ID = 0;
          $date = date('Y-m-d');
          $results = $db->query("SELECT * FROM transaction");
          while($row = $results->fetch_assoc()){
            if($row['IDTransaksi'] > $ID){
              $ID = $row['IDTransaksi'];

            }
          }
          $ID += 1;
          $insert->execute();
          $result = $db->query("SELECT IDTransaksi from transaction where IDDriver = '$id_driver'");
          $totalvote = mysqli_num_rows($result);
          $totalrating = $db->query("SELECT sum(rating) from transaction where IDDriver = '$id_driver' group by IDDriver");
          $totalratingvalue = $totalrating->fetch_assoc();
          $totalratingget = $totalratingvalue['sum(rating)'];
          $driver_rating = $totalratingget / $totalvote;
          $query = "UPDATE user SET   rating='$driver_rating', totalvote='$totalvote' WHERE ID='$id_driver'";
          $db->query($query);
          $db->close(); 
          header("Location: pickdest.php?id_active=".$id_active);
      ?>
<?php
    include '../database/dbConfig.php';
    $idtrans = $_POST['Submit'];
    $id = $_GET['id_active'];
    $sql = "UPDATE transaction SET IsHide='1' WHERE IDPenumpang='$id' and IDTransaksi='$idtrans'";
  
    $ALAMAT = "Location: history.php?id_active=" . (string) $id;
    if($db->query($sql) === TRUE) {
      header($ALAMAT);
    } else {
      header($ALAMAT);
    }
    $db->close(); 
?>
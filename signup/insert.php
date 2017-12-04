      <?php
      include '../database/dbConfig.php';

          $insert = $db->prepare("INSERT INTO user (ID,name,username,email,password,phone,isdriver,rating,totalvote) VALUES (?,?,?,?,?,?,?,?,?)");
          $insert->bind_param("ssssssidi", $ID, $name, $username, $email, $password, $phone, $isdriver, $rating, $totalvote);
          $name =  $_POST['name'];
          $username =  $_POST["username"]; 
          $email =  $_POST["email"]; 
          $password =  $_POST["passwd1"]; 
          $phone =  $_POST["phoneNumber"];
          if(isset($_POST["isDriver"]))
          {
            $isdriver = 1;
          } else{
            $isdriver = 0;
          }
          $rating = 0;
          $totalvote = 0;
          $ID = 0;
          $results = $db->query("SELECT * FROM user");
          while($row = $results->fetch_assoc()){
            if($row['ID'] > $ID){
              $ID = $row['ID'];

            }
          }
           $ID += 1;
          $insert->execute();
          
          $insert1 = $db->prepare("INSERT INTO userimage (ID,imagepath) VALUES (?,?)");
          $insert1->bind_param("ss", $ID, $url);
          $url = "../uploads/default.jpeg";
          
          $insert1->execute();
          
          $db->close(); 
          header("Location: ../login/login.php");
      ?>
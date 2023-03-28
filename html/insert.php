<?php
$username1 = $_POST['username1'];
$username2 = $_POST['username2'];
$age=$_POST['age'];
$city=$_POST['city'];
$password=$_POST['password'];
$gender=$_POST['gender'];

if(!empty($username1)||!empty($username2)||!empty($age)||!empty($city)||!empty($password)||!empty($gender)){
   $host = "localhost";
   $dbusername = "root";
   $dbpassword = "root";
   $dbname = "youtube";

   $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
    
   if(mysqli_connect_error())  {
       die('connect error('. mysqli_connect-errno().')'. mysqli_connect_error());
} else {
     $SELECT = "SELECT email from register where email = ? limit 1";
     $INSERT = "INSERT into register (username1,username2, age, city, password, gender) values(?,?, ?, ?, ?, ?)";

     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;
     
     if ($rnum==0) {
         $stmt->closes();
       
         $stmt = $conn->prepare($INSERT);
         $stmt->bind_param("sssssi", $username1,$username2, $age, $city,  $password, $gender);
         $stmt->execute();
         echo "New record inserted successfully";
      } else {
          echo "Someone already register using this email";
      }
      $stmt->close();
      $conn->close();
    
    }
} else { 
    echo "All field are required";
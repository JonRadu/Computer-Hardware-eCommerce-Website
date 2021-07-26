<?php
include("db_connect.php");

if(isset($_POST['username'])){
  $username = mysqli_real_escape_string($db, $_POST['username']);

$query = "select count(*) as cntUser from user where username='".$username."'";

   $result = mysqli_query($db,$query);
   $response = "<span class='response' style='color: green;'>Disponibil.</span>";
   if(mysqli_num_rows($result)){
      $row = mysqli_fetch_array($result);

      $count = $row['cntUser'];
    
      if($count > 0){
          $response = "<span class='response' id='response' style='color: red;'>Indisponibil.</span>";
          
      }
   
   }

   echo $response;
   die;
 

}
if(isset($_POST['email'])){
  $email = mysqli_real_escape_string($db, $_POST['email']);

$query_email = "select count(*) as cntEmail from user where email='".$email."'";

   $result_email = mysqli_query($db,$query_email);
   $response_email = "<span class='responseE' style='color: green;'>Disponibil.</span>";
   if(mysqli_num_rows($result_email)){
      $row = mysqli_fetch_array($result_email);

      $count = $row['cntEmail'];
    
      if($count > 0){
          $response_email = "<span class='responseE' id='responseE' style='color: red;'>Indisponibil.</span>";
          
      }
   
   }

   echo $response_email;
   die;
 

}


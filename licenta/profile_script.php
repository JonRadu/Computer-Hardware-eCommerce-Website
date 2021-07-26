<?php
include("db_connect.php");

if(isset($_POST['username'])){
  $username = mysqli_real_escape_string($db, $_POST['username']);

$query_p = "select count(*) as cntUser from user where username='".$username."'";

   $result_p = mysqli_query($db,$query_p);
   $response_p = "<span class='response_p' style='color: green;'>Disponibil.</span>";
   if(mysqli_num_rows($result_p)){
      $row_p = mysqli_fetch_array($result_p);

      $count_p = $row_p['cntUser'];
    
      if($count_p > 0){
          $response_p = "<span class='response_p' id='response_p' style='color: red;'>Indisponibil.</span>";
          
      }
   
   }

   echo $response_p;
   die;
 }
if(isset($_POST['email'])){
$email = mysqli_real_escape_string($db, $_POST['email']);

$query_p = "select count(*) as cntUser from user where email='".$email."'";

   $result_p = mysqli_query($db,$query_p);
   $response_e = "<span class='response_e' style='color: green;'>Disponibil.</span>";
   if(mysqli_num_rows($result_p)){
      $row_p = mysqli_fetch_array($result_p);

      $count_p = $row_p['cntUser'];
    
      if($count_p > 0){
          $response_e = "<span class='response_e' id='response_e' style='color: red;'>Indisponibil.</span>";
          
      }
   
   }

   echo $response_e;
   die;
 }
?>
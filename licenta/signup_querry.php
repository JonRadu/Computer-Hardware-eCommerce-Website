<?php
include("db_connect.php");
	if (isset($_POST['reg_user'])) {
  $name = $_POST['fname'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['pass'];
  $cpassword = $_POST['cpass'];


    $passwordC = md5($password);

    $query_user = "INSERT INTO user (name, username, email, password) 
          VALUES('$name', '$username', '$email', '$passwordC')";
    mysqli_query($db, $query_user);
}
?>
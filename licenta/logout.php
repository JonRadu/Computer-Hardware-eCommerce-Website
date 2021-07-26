<?php
   session_start();
   unset($_SESSION["user_login"]);
   unset($_SESSION["pass_login"]);
   unset($_SESSION["user_level"]);
   unset($_SESSION['user_id']);
   
   header("Location:index.php");
?>
<?php
   include("db_connect.php");
   if(isset($_POST['login_user'])) {
      $username=$_POST["user"];
      $password=md5($_POST["pass"]);
      $sql = "SELECT user_id, level FROM user WHERE username = '$username' and password = '$password'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      
      $count = mysqli_num_rows($result);
      if($count == 1) {
         $_SESSION["user_id"]=$row["user_id"];
         $_SESSION["user_login"]="$username";
         $_SESSION["pass_login"]="$password";
         $_SESSION["user_level"]=$row["level"];
         echo "<script type='text/javascript'>
   swal({
  title: 'Succes!',
  text: 'Autentificare reusită',
  icon: 'success'
});
</script>";
      }
      else {
            $_SESSION["user_login"]="";
   $_SESSION["pass_login"]="";
   $_SESSION["user_level"]="";
   echo "<script type='text/javascript'>
   swal({
  title: 'Eroare!',
  text: 'Autentificare nereusită',
  icon: 'error'
});
</script>";
      }
   }
?>
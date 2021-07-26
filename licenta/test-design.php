<!DOCTYPE html>
<html>
<head>
  
  <script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
   <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="script_butoane.js"></script> 
<link rel="stylesheet" type="text/css" href="style.css">
	<title>TEST</title>
</head>
<body>
  <?php
  session_start();
  include("login.php");
  include("signup.php");
    ?>

   <button class="openbtn" onclick="openNav('sidepanel')"><img src="user.png" style="width:17px;margin-bottom: 3px">☰</button> 
  <div id="sidepanel" class="sidepanel">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav('sidepanel')"><img src="user.png" style="width:17px;margin-bottom: 3px">☰</a>
    <?php
    if($_SESSION['user_login']!=""){
      echo "<button class='open-button-profile' onclick=\"openForm('login_form'),openForm('exit1'),closeNav(sidepanel)\">".$_SESSION['user_login']."</button>
      <button class='open-button-logout' onclick=\"closeNav(sidepanel),location.href='logout.php'\">Logout</button>
      <button class='open-button-admin' onclick=\"href='admin-page.php'\">Admin Page</button>";
    }
    else{
      
      echo "<button class='open-button-login' onclick=\"openForm('login_form'),openForm('exit1'),closeNav(sidepanel)\">Login</button>
    <button class='open-button-signup' onclick=\"openForm('signup_form'),openForm('exit1'),closeNav(sidepanel)\">Signup</button>";
    }

   ?>
    
</div>

<div id="exit1" href="javascript:void(0)" onclick="closeForm('exit1'),closeForm('login_form'),closeForm('signup_form'),closeList('popup'),closeList('popup1'),closeList('popup2'),closeList('popup3'),closeList('popup4'),closeList('popup5')"></div>

	<div class="buttons">
    <button class="btn1 button-text" onclick="openList('popup'),openForm('exit1')">CPU</button>
    <button class="btn2 button-text" onclick="openList('popup1'),openForm('exit1')">GPU</button>
    <button class="btn3 button-text" onclick="openList('popup2'),openForm('exit1')">RAM</button>
    <button class="btn4 button-text" onclick="openList('popup3'),openForm('exit1')">MEMORY</button>
    <button class="btn5 button-text" onclick="openList('popup4'),openForm('exit1')">SOURCE</button>
    <button class="btn6 button-text" onclick="openList('popup5'),openForm('exit1')">CASE</button>
	</div>

<div id="popup" class="popup" >
    
      <ul class="list-group list-group-flush">
       <?php
       include("db_connect.php");
  $products = "SELECT product_id,product_name,price FROM product WHERE category_id='1'";
       include ('product-list.php');
  ?>
  </ul>
    </div>
	<div id="popup1" class="popup">
      <ul class="list-group list-group-flush">
       <?php
       include("db_connect.php");
  $products = "SELECT product_id,product_name,price FROM product WHERE category_id='2'";
       include ('product-list.php');
  ?>
  </ul>
    </div>
<div id="popup2" class="popup">
      <ul class="list-group list-group-flush">
       <?php
       include("db_connect.php");
  $products = "SELECT product_id,product_name,price FROM product WHERE category_id='3'";
       include ('product-list.php');
  ?>
  </ul>
    </div>
<div id="popup3" class="popup">
      <ul class="list-group list-group-flush">
       <?php
       include("db_connect.php");
  $products = "SELECT product_id,product_name,price FROM product WHERE category_id='4'";
       include ('product-list.php');
  ?>
  </ul>
    </div>
<div id="popup4" class="popup">
      <ul class="list-group list-group-flush">
       <?php
       include("db_connect.php");
  $products = "SELECT product_id,product_name,price FROM product WHERE category_id='5'";
       include ('product-list.php');
  ?>
  </ul>
    </div>
<div id="popup5" class="popup">
      <ul class="list-group list-group-flush">
       <?php
       include("db_connect.php");
  $products = "SELECT product_id,product_name,price FROM product WHERE category_id='6'";
       include ('product-list.php');
  ?>
  </ul>
    </div>
  



   </body>
</html>
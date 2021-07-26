<?php 
include("db_connect.php");
include("orders.php");
$sql_profile = ' SELECT * FROM user WHERE user_id="'.$_SESSION["user_id"].'"';
$result_profile = mysqli_query($db, $sql_profile);
$row_profile=mysqli_fetch_array($result_profile);
$name = $row_profile["name"];
$username = $row_profile["username"];
$email = $row_profile["email"];
$phone = $row_profile["phone_number"];
$adress = $row_profile["adress"];
$date = $row_profile["date_created"];
?>
<div class="form-popup animate" id="profile">
	<div class="profile-container"> 
		<div class="up-profile">
		<div class="profile-image-container"><img src="profile.svg" class="profile-image"></div>
		</div>
		<div class="bottom-profile">
		<div class="p-name"><?php echo $name ?> (<?php echo $username ?>)</div>
		<label>Email</label>
		<div class="p-details"> <?php echo $email ?> </div>
		<label>Telefon</label>
		<div class="p-details"> <?php if($phone!=""){echo $phone;$_SESSION['phone']=$phone;} else {echo "Not set";$_SESSION['phone']="";}?> </div>
		<label>Adresă</label>
		<div class="p-details"> <?php if($adress!=""){echo $adress;$_SESSION['adress']=$adress;} else {echo "Not set";$_SESSION['adress']="";} ?> </div>
		<label>Dată creare</label>
		<div class="p-details"> <?php echo $date ?> </div>
		<div class="p-info"><button type="button" class="btn btn-primary" href="#" onclick="closeForm('profile'),openForm('profile_form')">Modifică datele</button></div>
		<div class="p-orders"><button type="button" class="btn btn-primary" href="#" onclick="closeForm('profile'),openForm('orders'),load_orders()">Istoric comenzi</button></div>
		</div>
	</div>
</div>

<div class="form-popup animate" id="profile_form">
  <form action="index.php" class="form-container-signup" autocomplete="off" method="POST">
    <input type="text" placeholder="Full Name" name="fname" value="<?php echo $name ?>" required>
    <input type="text" placeholder="Username" id="txt_user_p" name="username" value="<?php echo $username ?>" required>
    <input type="email" placeholder="Email" name="email" id="txt_email" value="<?php echo $email ?>" required>
    <input type="text" placeholder="Phone" name="phone" id="txtPhone" value="<?php echo $phone ?>">
    <input type="text" placeholder="Adress" name="adress" id="txtAdress" value="<?php echo $adress ?>">
    <button type="submit" class="btnS btn-success" name="update_user" id="btnUpdate">Actualizează</button>
    <button type="button" class="btnS btn-danger" onclick="closeForm('profile_form'),openForm('profile')" >Profil</button>
  </form>
  <div id="profile_response" ></div>
  <div id="profile_responseE" ></div>
</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){

   $("#txt_user_p").keyup(function(){

      var username = $(this).val().trim();

      if(username != ''){

         $.ajax({
            url: 'profile_script.php',
            type: 'post',
            data: {username: username},
            success: function(response_p){

                $('#profile_response').html(response_p);

             }
         });
      }else{
         $("#profile_response").html("");
      }

    });

 });

    $(document).ready(function(){

   $("#txt_email").keyup(function(){

      var email = $(this).val().trim();

      if(email != ''){

         $.ajax({
            url: 'profile_script.php',
            type: 'post',
            data: {email: email},
            success: function(response_e){

                $('#profile_responseE').html(response_e);

             }
         });
      }else{
         $("#profile_responseE").html("");
      }

    });

 });
    $(function () {
        $("#btnUpdate").click(function () {
    var span_Text = document.getElementById("profile_response").innerText;
    var span_TextE = document.getElementById("profile_responseE").innerText;
    if (span_Text=="Not Available.") {
    	swal("Check Username");
                return false;    	
    }
    else if (span_TextE=="Not Available.") {
    	swal("Check Email");
                return false;    	
    }
    else if (password != confirmPassword) {
                swal("Passwords don't match");
                return false;
            }
    else{
    	return true;
    }


return true;
        });
    });
    
</script>
<?php 

	if (isset($_POST['update_user'])) {
		$name = $_POST['fname'];
		$username = $_POST['username'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$adress = $_POST['adress'];
		$sql= "UPDATE user SET name='$name',username='$username',email='$email',phone_number='$phone',adress='$adress' WHERE user_id=".$_SESSION["user_id"]."";
		mysqli_query($db,$sql);
		$_SESSION["user_login"]=$username;
		
	}

?>
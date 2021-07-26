<?php 

	include("signup_query.php");

?>
<div class="form-popup animate" id="signup_form">
  <form action="index.php" class="form-container-signup" autocomplete="off" method="POST">
    <input type="text" placeholder="Nume Complet" name="fname" required>
    <input type="text" placeholder="Nume Utilizator" id="txt_username" name="username" id="txtUser" required>
    <input type="email" placeholder="Email" name="email" id="txtEmail" required>
    <input type="password" placeholder="Parolă" name="pass" id="txtPassword" required>
    <i class="far fa-eye eyep" id="togglePassword"></i>
    <input type="password" placeholder="Confirmare parolă" name="cpass" id="txtConfirmPassword" required>
	<i class="far fa-eye eyepc" id="togglePasswordC"></i>
    <button type="submit" class="btnS btn-success" name="reg_user" id="btnSubmit">Înregistrare</button>
    <button type="button" class="btnS btn-danger" onclick="closeForm('signup_form'),openForm('login_form')" >Autentificare</button>
  </form>
  <div id="uname_response" ></div>
  <div id="uname_responseE" ></div>
</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){

   $("#txt_username").keyup(function(){

      var username = $(this).val().trim();

      if(username != ''){

         $.ajax({
            url: 'signup_script.php',
            type: 'post',
            data: {username: username},
            success: function(response){

                $('#uname_response').html(response);

             }
         });
      }else{
         $("#uname_response").html("");
      }

    });

 });
     $(document).ready(function(){

   $("#txtEmail").keyup(function(){

      var email = $(this).val().trim();

      if(email != ''){

         $.ajax({
            url: 'signup_script.php',
            type: 'post',
            data: {email: email},
            success: function(responseE){

                $('#uname_responseE').html(responseE);

             }
         });
      }else{
         $("#uname_responseE").html("");
      }

    });

 });
    $(function () {
        $("#btnSubmit").click(function () {
    var password = $("#txtPassword").val();
    var confirmPassword = $("#txtConfirmPassword").val();
    var span_Text = document.getElementById("uname_response").innerText;
    var span_TextE = document.getElementById("uname_responseE").innerText;
    if (span_Text=="Not Available.") {
    	swal("Verifică numele de utilizator");
                return false;    	
    }
    else if (span_TextE=="Not Available.") {
    	swal("Verifică emailul");
                return false;    	
    }
    else if (password != confirmPassword) {
                swal("Parolele nu se potrivesc");
                return false;
            }
    else{
    	return true;
    }


return true;
        });
    });
const togglePassword = document.querySelector('#togglePassword');
const password = document.querySelector('#txtPassword');
togglePassword.addEventListener('click', function (e) {
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    this.classList.toggle('fa-eye-slash');
});
const togglePasswordC = document.querySelector('#togglePasswordC');
const passwordC = document.querySelector('#txtConfirmPassword');
togglePasswordC.addEventListener('click', function (e) {
    const type = passwordC.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordC.setAttribute('type', type);
    this.classList.toggle('fa-eye-slash');
});
</script>
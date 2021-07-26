<?php 
  include("login_query.php");

?>
<div class="form-popup animate" id="login_form">
  <form action="index.php" class="form-container-login" method="POST">
    <input type="text" placeholder="Nume utilizator" name="user" id="txtUser" required>

    <input type="password" placeholder="Parolă" name="pass" id="txtPass" required>

    <button type="submit" class="btnL btn-success" id="btnLogin" name="login_user">Autentificare</button>
    <button type="button" class="btnL btn-danger" onclick="closeForm('login_form'),openForm('signup_form')">Înregistrare</button>
  </form>
</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">

</script>
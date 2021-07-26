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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="script_butoane.js"></script> 
  <script src="cart-js.js" async></script> 
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>
	<title>Licenta</title>
</head>
<body>
  
  <?php
  session_start();
  error_reporting(0);
  include('db_connect.php');
  include("login.php");
  include("signup.php");
  include("profile.php");
  include("cart.php");
    ?>

   <a class="openbtn" id="open_panel" onclick="openBtn(),closeForm('open_panel'),openForm('close_panel')"><i class="fas fa-arrow-circle-left"></i></a>
   <a class="openbtn" id="close_panel" style="display: none;" onclick="closeBtn(),closeForm('close_panel'),openForm('open_panel')"><i class="fas fa-arrow-circle-right"></i></a> 
  <div id="sidepanel" class="sidepanel">
 
    <?php
    if($_SESSION['user_login']!=""){
      echo "<button class='open-button-profile' name='meniu_btn' onclick=\"openForm('profile'),openForm('exit1'),closeBtn(),closeForm('close_panel'),openForm('open_panel')\" ><i class='fas fa-user fa-lg'></i></button>
      <button class='open-button-cart' name='meniu_btn' onclick=\"openForm('cart'),openForm('exit1'),closeBtn(),closeForm('close_panel'),openForm('open_panel'),load_item(),setTimeout(updateTotal, 300),setTimeout(load_button, 100)\"><i class='fas fa-shopping-cart fa-lg'></i></button>
      <button class='open-button-logout' name='meniu_btn' onclick=\"closeNav(sidepanel),location.href='logout.php'\"><i class='fas fa-sign-out-alt fa-lg'></i></button>";
      
    }
    else{
      
      echo "<button class='open-button-login' name='meniu_btn' onclick=\"openForm('login_form'),openForm('exit1'),closeBtn(),closeForm('close_panel'),openForm('open_panel')\"><i class='fas fa-sign-in-alt fa-lg'></i></button>
    <button class='open-button-signup' name='meniu_btn' onclick=\"openForm('signup_form'),openForm('exit1'),closeBtn(),closeForm('close_panel'),openForm('open_panel')\"><i class='fas fa-user-plus fa-lg'></i></button>";
    }

    if ($_SESSION['user_login']!="" && $_SESSION['user_level']>0) {
      echo "<button class='open-button-admin' name='meniu_btn' onclick=\"location.href='admin-page.php'\"><i class='fas fa-user-cog fa-lg'></i></button>";
    }
   ?>
    
</div>

<div id="exit1" href="javascript:void(0)" onclick="closeForm('exit1'),closeForm('login_form'),closeForm('signup_form'),closeForm('profile'),closeList('popup'),closeList('popup1'),closeList('popup2'),closeList('popup3'),closeList('popup4'),closeList('popup5'),closeList('popup6'),closeList('popup7'),closeForm('profile_form'),closeForm('cart'),closeForm('orders')"></div>

	<div class="buttons">
    <button class="btn1" onclick="openList('popup'),openForm('exit1'),closeBtn(),closeForm('close_panel'),openForm('open_panel')"><div class="button-text">CPU</div></button>
    <button class="btn2" onclick="openList('popup1'),openForm('exit1'),closeBtn(),closeForm('close_panel'),openForm('open_panel')"><div class="button-text">GPU</div></button>
    <button class="btn7" onclick="openList('popup6'),openForm('exit1'),closeBtn(),closeForm('close_panel'),openForm('open_panel')"><div class="button-text">Plăci de bază</div></button>
    <button class="btn3" onclick="openList('popup2'),openForm('exit1'),closeBtn(),closeForm('close_panel'),openForm('open_panel')"><div class="button-text">RAM</div></button>
    <button class="btn4" onclick="openList('popup3'),openForm('exit1'),closeBtn(),closeForm('close_panel'),openForm('open_panel')"><div class="button-text">Stocare</div></button>
    <button class="btn5" onclick="openList('popup4'),openForm('exit1'),closeBtn(),closeForm('close_panel'),openForm('open_panel')"><div class="button-text">Surse</div></button>
    <button class="btn6" onclick="openList('popup5'),openForm('exit1'),closeBtn(),closeForm('close_panel'),openForm('open_panel')"><div class="button-text">Carcase</div></button>
    <button class="btn8" onclick="openList('popup7'),openForm('exit1'),closeBtn(),closeForm('close_panel'),openForm('open_panel')"><div class="button-text">Accesorii</div></button>
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
<div id="popup6" class="popup">
      <ul class="list-group list-group-flush">
       <?php
       include("db_connect.php");
  $products = "SELECT product_id,product_name,price FROM product WHERE category_id='7'";
       include ('product-list.php');
  ?>
  </ul>
    </div>
<div id="popup7" class="popup">
      <ul class="list-group list-group-flush">
       <?php
       include("db_connect.php");
  $products = "SELECT product_id,product_name,price FROM product WHERE category_id='8'";
       include ('product-list.php');
  ?>
  </ul>
    </div>
  

<div class="form-popup animate" id="cart">
  <div class="cart-container"> 
    <div id="message_remove"></div>
    <div class="cart-left">
      <div id="cart-item"></div>


      
    </div>
    <div class="cart-right">
      <div class="cart-summary">
        Sumar comandă
      </div>
      <div class="cart-summary-container">
      <div class="cart-summary-items">
        
      </div>

      <div class="cart-summary-price">
        
      </div>
      </div>
      <div class="cart-total-container">
        <div class="cart-total-text">TOTAL</div>
        <div class="cart-total-price" id="cart-total-price"></div>
      </div>
      <div class="checkout-button" id="checkout-button">

    </div>
    </div>
  </div>
</div>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>
  <script type="text/javascript">
        var ratedIndex = -1 ;
        var star = $(this).find(".fa-star");
        var pid_star = 0;
        $(document).ready(function () {
            resetStarColors();

            $('.fa-star').on('click', function () {
              resetStarColors();
               ratedIndex = parseInt($(this).data('index'));
               pid_star = $( event.target ).closest('.product-rating').find(".pid_prod_star").val();
               rating_div = $( event.target ).closest('.product-rating').find(".rating-avg");
               saveToTheDB();
               setTimeout(load_rating,500,pid_star,rating_div);

            });

            $('.fa-star').mouseover(function () {
                resetStarColors();
                var currentIndex = parseInt($(this).data('index'));
                var self = $(this);
                var index = self.index();
                 for (var i=0; i <= currentIndex; i++)
                $( event.target ).closest('.product-rating').children(self).eq(i).css('color', 'yellow');
            });

            $('.fa-star').mouseleave(function () {
                resetStarColors();
            });
        });

        function saveToTheDB() {
            $.ajax({
               url: "rating.php",
               method: "POST",
               data: {
                   ratedIndex: ratedIndex,
                   pid_star:pid_star}, 
               success: function (response) {
                $("#message").html(response);
               }
            });
        }

        function resetStarColors() {
            $('.fa-star').css('color', 'white');
        }


    $(document).ready(function(){

   $(".AddItem").click(function(e){
    e.preventDefault();
    var $form = $(this).closest(".add_cart");
    var pid = $form.find(".pid").val();
    var prod_price = $form.find(".prod_price").val();

    $.ajax({
        url: 'cart-query.php',
        method: 'post',
        data: { pid:pid,
                prod_price:prod_price},
        success:function(response){
          $("#message").html(response);

        }

    });
console.log(prod_price)
  });
  });
    
  
  
function checkout(){
    var total_price = $('.cart-total-price').text()
    total_price = total_price.replace('RON', '');

    $.ajax({
        url: 'checkout.php',
        method: 'post',
        data: { total_price:total_price},
        success:function(response){
          $("#message_remove").html(response);
          
        }

    });
}
  
    function load_item(){
      var cart_item = document.getElementById('cart-item');
    $.ajax({
        url: 'cart-script.php',
        type: "POST",
  success:function(data){
    $(cart_item).html(data);
}
    });
}

    function load_orders(){
      var order_item = document.getElementById('orders-item');
    $.ajax({
        url: 'orders-script.php',
        type: "POST",
  success:function(data){
    $(order_item).html(data);
}
    });
}
    function load_rating(pid,rating_div){
      var prod_id = pid;
      var rating_item = rating_div;
    $.ajax({
        url: 'rating-avg.php',
        type: "POST",
        data: {prod_id:prod_id},
  success:function(data){
    $(rating_item).html(data);
}
    });
}    

function load_button(){
      var checkout_button = document.getElementById('checkout-button');
    $.ajax({
        url: 'checkout-button.php',
        type: "POST",
  success:function(data){
    $(checkout_button).html(data);
}
    });
}

    
 
</script>
   </body>
</html>
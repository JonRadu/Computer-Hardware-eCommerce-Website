<?php
include("db_connect.php");
session_start();
$row = 0;
$sql_cart = 'SELECT C.product_id,P.product_name,P.price, C.quantity_cart, C.user_id FROM cart AS C INNER JOIN product AS P ON C.product_id=P.product_id WHERE C.user_id="'.$_SESSION["user_id"].'"';
$result_cart = mysqli_query($db, $sql_cart);
$count=mysqli_num_rows($result_cart);
$_SESSION['count_cart'] = $count;
if ($count==0) {
	$item="
	<div class='empty-text'>Coșul este gol, adaugă produse</div>
	<div class='cart-img'>
	</div>";
	echo $item;
}
else {
	echo '<table class="cart-header"> <tr>
  <td style="padding-left: 0px;text-align: center;padding-bottom: 22px;border-bottom: 1px solid white;width: 45px;">Produs</td>
  <td style="border-bottom: 1px solid white;padding-bottom: 22px;width: 20px;">Cantitate</td>
  <td style="border-bottom: 1px solid white;padding-bottom: 22px;width: 20px;">Preț</td>
  <td style="border-bottom: 1px solid white;padding-bottom: 22px;">Total</td></tr></table>
	<ul class="cart-list">';
while($row_prod=mysqli_fetch_array($result_cart)){
	$prod_id = $row_prod["product_id"];
	$prod_name = $row_prod["product_name"];
  $prod_price = $row_prod["price"];
	$qty = $row_prod["quantity_cart"];
	$sql_img = "SELECT image_link FROM product_image WHERE product_id = '$prod_id' LIMIT 1";
	$result_img = mysqli_query($db, $sql_img);
	$row_img=mysqli_fetch_array($result_img);
	$img=$row_img["image_link"];
  $sql_total = "SELECT total_product_price FROM cart WHERE product_id = '$prod_id'";
  $result_total = mysqli_query($db, $sql_total);
  $row_total=mysqli_fetch_array($result_total);
  $total_prod=$row_total["total_product_price"];
	$item= "<li class='cart-prod'>
	<div class='prod_row' id='prod_row'>
	<input type='hidden' class='prod_total' id='prod_total' value=''>
			<div class='prod-cart-img'><img src='$img' class='prod-img'></div>
			<div class='cart-prod-name'>$prod_name</div>
			<form action='' class='update_qty'>
			<div class='cart-prod-qty'>
			<div class='input-group'>
			<input type='hidden' class='cart_qty_pid' name='cart_qty_pid' value='$prod_id'>
  <input type='button' value='-' class='button-minus' data-field='quantity' id='qty_button' onclick=\"setTimeout(updateProdTotalMinus,100,$row)\">
  <input type='number' step='1' min='1' value='$qty' name='quantity' class='quantity-field' readonly='readonly'>
  <input type='button' value='+' class='button-plus' data-field='quantity' id='qty_button' onclick=\"setTimeout(updateProdTotalMinus,100,$row)\">
</div></div></form>
		  <div class='cart-price' id='cart-price'>$prod_price RON</div>
		  <div class='cart-prod-price' id='cart-prod-price'>$total_prod RON
		  </div>
		  <div class='cart-remove'>
		  <form action='' class='remove_cart'>
      <input type='hidden' class='cart_pid' value='$prod_id'>
		  	<button type='button' class='remove-button' aria-label='Close' onclick=\"setTimeout(updateTotal, 2000),setTimeout(load_button, 200)\">
		  	</form>
  				&times;
				</button>
			</div>
			</div>
		  </li>
		  ";
		  $row++;
echo $item;
}
echo "</ul>";
}


			 ?>
<script type="text/javascript">





    $(document).ready(function(){

   $(".remove-button").click(function(e){
    e.preventDefault();
    var $form_remove = $(this).closest(".remove_cart");
    var cart_pid = $form_remove.find(".cart_pid").val();

    $.ajax({
        url: 'cart-product-remove.php',
        method: 'post',
        data: { cart_pid:cart_pid},
        success:function(response){
        	$("#message_remove").html(response);
        	load_item();
        }

    });

  });
  });
	$(document).ready(function(){
 

   $(".button-plus").click(function(e){
    e.preventDefault()
    
    var $form_update = $(this).closest(".update_qty")
    var cart_qty_pid = $form_update.find(".cart_qty_pid").val()
    var qty = $form_update.find(".quantity-field").val()
    $.ajax({
        url: 'cart-qty-update.php',
        method: 'post',
        data: { 
        				cart_qty_pid:cart_qty_pid,
        				qty:qty
        			},
        success:function(response){
        	$("#message_remove").html(response);
        }

    });
   });
  });

	$(document).ready(function(){
 

   $(".button-minus").click(function(e){
    e.preventDefault()
    
    var $form_update = $(this).closest(".update_qty")
    var cart_qty_pid_minus = $form_update.find(".cart_qty_pid").val()
    var qty_minus = $form_update.find(".quantity-field").val()
    $.ajax({
        url: 'cart-qty-update-minus.php',
        method: 'post',
        data: { 
        				cart_qty_pid_minus:cart_qty_pid_minus,
        				qty_minus:qty_minus
        			},
        success:function(response){
        	$("#message_remove").html(response);
        }

    });
   });
  });




	function incrementValue(e) {
  e.preventDefault();
  var fieldName = $(e.target).data('field');
  var parent = $(e.target).closest('div');
  var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);

  if (!isNaN(currentVal)) {
    parent.find('input[name=' + fieldName + ']').val(currentVal + 1);
  } else {
    parent.find('input[name=' + fieldName + ']').val(0);
  }
}

function decrementValue(e) {
  e.preventDefault();
  var fieldName = $(e.target).data('field');
  var parent = $(e.target).closest('div');
  var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);

  if (!isNaN(currentVal) && currentVal > 1) {
    parent.find('input[name=' + fieldName + ']').val(currentVal - 1);
  } else {
    parent.find('input[name=' + fieldName + ']').val(0);
  }
}

$('.input-group').on('click', '.button-plus', function(e) {
  incrementValue(e);
});

$('.input-group').on('click', '.button-minus', function(e) {
  decrementValue(e);
});
</script>
<?php
include("db_connect.php");
$sql_cart = 'SELECT C.product_id,P.product_name,P.price, C.quantity_cart, C.user_id FROM cart AS C INNER JOIN product AS P ON C.product_id=P.product_id WHERE C.user_id="'.$_SESSION["user_id"].'"';
$result_cart = mysqli_query($db, $sql_cart);
while($row_prod=mysqli_fetch_array($result_cart)){
	$prod_name = $row_prod["product_name"];
	$prod_price = $row_prod["price"];
	$qty = $row_prod["quantity_cart"];


	echo "Product: $prod_name <br>";
	echo "Price: $prod_price <br>";
	echo "Quantity: $qty <br>";
			  
}
			 ?>
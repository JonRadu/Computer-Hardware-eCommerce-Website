<?php
include("db_connect.php");
session_start();
$sql_orders = 'SELECT order_id, total_cost, date FROM orders WHERE user_id="'.$_SESSION["user_id"].'"';
$result_orders = mysqli_query($db, $sql_orders);
echo '<center><h1 style="margin-bottom: 20px;">Istoric comenzi</h1></center>
	<ul class="cart-list">';
	
while($row_orders=mysqli_fetch_array($result_orders)){
	$count_prod = 1;
	$order_id = $row_orders["order_id"];
	$total = $row_orders["total_cost"];
  	$date = $row_orders["date"];
  	$item = "<li class='cart-prod' style='border-bottom: 2px solid;'>
  	<div class='order_id'>Comanda numărul: #$order_id</div>
  	<div>Data: $date</div>
  	<ul class='cart-lis'></li></ul>";
  	$sql_orders_prod = "SELECT op.order_id, p.product_name,c.category_name, op.quantity_cart, op.order_product_price FROM order_product AS op JOIN product AS p ON op.product_id=p.product_id JOIN category AS c on p.category_id=c.category_id WHERE op.order_id= '$order_id' ";
	$result_orders_prod = mysqli_query($db, $sql_orders_prod);
echo "<ul class='order-prod-list'><table class='prod_table' style='width: 100%;margin-bottom: 20px;margin-left: 50px;margin-top: 20px;' cellspacing='0'><th>Nume produs</th><th>Categorie</th><th>Cantitate</th><th>Preț</th>";
$count = 1;
	while($row_orders_prod=mysqli_fetch_array($result_orders_prod)){
			
	$product_name = $row_orders_prod["product_name"];
	$category = $row_orders_prod["category_name"];
  	$qty = $row_orders_prod["quantity_cart"];
  	$price = $row_orders_prod["order_product_price"];
	$item_prod = "
  	<tr><td style=''>$count_prod. $product_name</td>
  	<td>$category</td>
  	<td>$qty</td>
  	<td>$price RON</td></tr>";
if($count==1){echo $item;}
$count = 0;
$count_prod ++;
echo $item_prod;
	}
	echo "<tr><td style='width: 70%;'></td>
  	<td></td>
  	<td></td>
  	<td>Total: $total RON</td></tr>
  	</table></ul>";
  	  	
  	
  	  	
}
echo "</ul>";
?>
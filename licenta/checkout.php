<?php 
include("db_connect.php");
session_start();
$user_id = $_SESSION['user_id'];
$total_cost = $_POST['total_price'];
$sql_cart_select = "SELECT product_id, quantity_cart, total_product_price FROM cart WHERE user_id = '$user_id'";
$result_cart_select = mysqli_query($db, $sql_cart_select);
$sql_order = "INSERT INTO orders (user_id) VALUES ('$user_id')";
$result_order = mysqli_query($db, $sql_order);
$order_id = mysqli_insert_id($db);
while($prod_cart = mysqli_fetch_assoc($result_cart_select)) {
		$product_id = $prod_cart['product_id'];
		$quantity = $prod_cart['quantity_cart'];
		$total_product_price = $prod_cart['total_product_price'];
		$sql_order_prod = "INSERT INTO order_product (order_id, product_id, quantity_cart,order_product_price) VALUES ('$order_id','$product_id','$quantity','$total_product_price')";	
		$result_order_prod = mysqli_query($db, $sql_order_prod);
}
$sql_total_order_calc = "SELECT order_product_price FROM order_product WHERE order_id='$order_id'";
$result_total_order = mysqli_query($db, $sql_total_order_calc);
$total = 0;
while($prod_total_price = mysqli_fetch_assoc($result_total_order)) {
		$prod_price = $prod_total_price['order_product_price'];
		$total = $total + $prod_price;
$sql_total = "UPDATE orders SET total_cost = '$total' WHERE order_id='$order_id'";
$result_total = mysqli_query($db, $sql_total);
}
if($result_total){
	$sql_detele_cart = "DELETE FROM cart WHERE user_id='$user_id'";
	mysqli_query($db, $sql_detele_cart);
	echo "<script type='text/javascript'>
	swal({
  title: 'Mulțumim pentru comandă!',
  icon: 'success'
}).then(function () {
    load_item();
    setTimeout(updateTotal,100);
});
</script>";
}

?>
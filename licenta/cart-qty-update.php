<?php 
session_start();
$user_id = $_SESSION['user_id'];
include("db_connect.php");
$cart_qty_pid = $_POST['cart_qty_pid'];
$qty_default = $_POST['qty'];
$qty=$qty_default+1;
$sql_update = "UPDATE cart SET quantity_cart = $qty WHERE product_id = '$cart_qty_pid' AND user_id = '$user_id'";
mysqli_query($db,$sql_update);

$sql_update_price = "UPDATE cart SET total_product_price=quantity_cart*cart_price WHERE product_id='$cart_qty_pid'";
mysqli_query($db,$sql_update_price);
?>
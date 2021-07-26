<?php 
session_start();
$user_id = $_SESSION['user_id'];
include("db_connect.php");
$cart_qty_pid_minus = $_POST['cart_qty_pid_minus'];
$qty_default_minus = $_POST['qty_minus'];
$qty_minus=$qty_default_minus-1;
$sql_update = "UPDATE cart SET quantity_cart = $qty_minus WHERE product_id = '$cart_qty_pid_minus' AND user_id = '$user_id'";
mysqli_query($db,$sql_update);

$sql_update_price = "UPDATE cart SET total_product_price=quantity_cart*cart_price WHERE product_id='$cart_qty_pid_minus'";
mysqli_query($db,$sql_update_price);
?>
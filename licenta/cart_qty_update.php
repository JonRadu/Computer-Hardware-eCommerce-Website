<?php 
session_start();
$user_id = $_SESSION['user_id'];
include("db_connect.php");
$cart_pid = $_POST['cart_qty_pid'];
$qty = $_POST['quantity'];
$sql_update = "UPDATE cart SET quantity_cart = $qty WHERE product_id = '$cart_qty_pid' AND user_id = '$user_id'";
mysqli_query($db,$sql_update);

    mysql_error();


?>
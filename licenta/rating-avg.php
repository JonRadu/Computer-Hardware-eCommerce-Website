<?php 
include("db_connect.php");
$prod_id = $_POST['prod_id'];
$sql_select_row = "SELECT review_id FROM product_review WHERE product_id='$prod_id'";
$result_select_row = mysqli_query($db, $sql_select_row);
$count_rating = mysqli_num_rows($result_select_row);
$sql_select_sum = "SELECT SUM(rating) AS total FROM product_review WHERE product_id='$prod_id'";
$result_select_row = mysqli_query($db, $sql_select_sum);
$sum = mysqli_fetch_assoc($result_select_row);
$total = $sum['total'];
$avg = $total / $count_rating; 
$round_avg = number_format((float)$avg, 1, '.', '');
echo "($round_avg)";

?>
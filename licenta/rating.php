<?php 
include("db_connect.php");
session_start();
error_reporting(0);
$user_id = $_SESSION['user_id'];
$ratedIndex = ($_POST['ratedIndex']);
$pid_star = ($_POST['pid_star']);
$ratedIndex++;
if ($user_id !="") {
  

$sql_rating = "INSERT INTO product_review(product_id, user_id, rating) SELECT * FROM (SELECT '$pid_star' p,'$user_id','$ratedIndex') AS tmp WHERE NOT EXISTS (SELECT product_id FROM product_review WHERE product_id = '$pid_star' and user_id = '$user_id') LIMIT 1;";
if (mysqli_query($db, $sql_rating)) 
  {
  	$sql_rating_update = "UPDATE product_review SET rating='$ratedIndex' WHERE product_id = '$pid_star' and user_id = '$user_id'";
  	mysqli_query($db, $sql_rating_update);
echo "<script type='text/javascript'>
	swal({
  title: 'Operație completă!',
  text: 'Recenzie adaugată cu succes!',
  icon: 'success',
  buttons: false,
  timer: 1200,
});
</script>";

}
}
else{
  echo "<script type='text/javascript'>
  swal({
  title: 'Operație incompletă!',
  text: 'Contul este necesar pentru aceasta acțiune!',
  icon: 'error',
  buttons: false,
  timer: 1200,
});
</script>";
}
?>
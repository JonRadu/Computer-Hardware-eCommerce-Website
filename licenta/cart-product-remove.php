
<?php 
include("db_connect.php");
$cart_pid = $_POST['cart_pid'];
$sql_remove = "DELETE FROM cart WHERE product_id='$cart_pid'";
if(mysqli_query($db,$sql_remove)){
	  	 echo "<script type='text/javascript'>
	swal({
  title: 'Operație completă!',
  text: 'Produsul a fost șters din coș!',
  icon: 'success',
  buttons: false,
  timer: 1200,
});
</script>";
}
?>
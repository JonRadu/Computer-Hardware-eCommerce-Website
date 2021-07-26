<?php 
session_start();
$user_id = $_SESSION['user_id'];
include('db_connect.php');
if (isset($_POST['pid'])) {
$pid = $_POST['pid'];
$prod_price = $_POST['prod_price'];
$sql_cart = "INSERT INTO cart(product_id, user_id, cart_price, total_product_price) SELECT * FROM (SELECT '$pid','$user_id','$prod_price' a,'$prod_price' b) AS tmp WHERE NOT EXISTS (SELECT product_id FROM cart WHERE product_id = '$pid' and user_id = '$user_id') LIMIT 1;";
  

  if (mysqli_query($db, $sql_cart)) 
  { 
    $insert_id = mysqli_insert_id($db);  
      if($insert_id != '')  
      {  
  	 echo "<script type='text/javascript'>
	swal({
  title: 'Operație completă!',
  text: 'Produsul a fost adăugat în coș!',
  icon: 'success',
  buttons: false,
  timer: 1200,
});
</script>";
  }
  else{
         echo "<script type='text/javascript'>
  swal({
  title: 'Operație incompletă!',
  text: 'Produsul se află deja în coș!',
  icon: 'error',
  buttons: false,
  timer: 1200,
});
</script>";
  }

  
}
echo mysqli_error($db);

}

  
?>
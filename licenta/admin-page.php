<?php 
session_start();
include("db_connect.php");
$user_level = $_SESSION["user_level"];
if ($user_level < 1) {
    header("location: error.php");
    exit;
}
	

?>
<!DOCTYPE html>
<html>
<head>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="https://kit.fontawesome.com/e9bf807cbf.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="admin-page.css">
	<title>Pagină administrare</title>
</head>
<body>

<header>
	<div class="admin-title"> 
		Administrare
	</div>

	<a href="#" class="admin-name"><?php echo $_SESSION['user_login']?></a>
	<a href="admin-page.php?ac=raport" class="admin-raport">Rapoarte management</a>
	<a href="index.php" class="index">Magazin</a>
	<a href="logout.php" class="admin-logout">Deconectare</a>




</header>
<div class="admin-wrapper">
	<div class="left-panel">
		<p>Administrare produse</p>
		<ul>
			<li><a href="admin-page.php?ac=prodlist&sort=product_id&order=desc">Listă produse</a> </li></br>
			<li><a href="admin-page.php?ac=addprod">Adăugare produse</a> </li> </br>
			<li><a href="admin-page.php?ac=prod_rating&sort=review_id&order=desc">Recenzii produse</a> </li>
		</ul>
		<p>Administrare utilizatori</p>
		<ul>
			<li><a href="admin-page.php?ac=add_admin">Adăugare administrator</a> </li></br>
			<li><a href="admin-page.php?ac=userlist&sort=user_id&order=desc">Listă utilizatori</a> </li>

		</ul>
		<p>Administrare comenzi și coș cumpărături</p>
		<ul>
			<li><a href="admin-page.php?ac=orders&sort=order_id&order=desc">Listă comenzi</a> </li></br>

		</ul>
	</div>
	<div class="admin-content">
		<?php
	if(isset($_GET["ac"]))
		$action = $_GET["ac"];
	else if(isset($_POST["ac"]))
		$action = $_POST["ac"];
	else $action = "";
SWITCH($action)
{
	case "addprod" : addprod();
						break;
	case "insertprod" : insertprod($_POST["name"],$_POST["image1"],$_POST["image2"],$_POST["image3"],$_POST["code"],$_POST["pdf"],$_POST["price"],$_POST["categ"],$_POST["stock"]);								
						break;
	case "updateprod" : updateprod($_POST["prodid"],$_POST["name"],$_POST["code"],$_POST["pdf"],$_POST["price"],$_POST["categ"],$_POST["stock"],$_POST["image1"],$_POST["image2"],$_POST["image3"]);
						break;
	case "prodlist" : prodlist();
						break;
	case "addadmin" : addadmin();					
						break;
	case "userlist" : userlist();
						break;
	case "deleteuser" : deleteuser($_GET["uid"]);
						break;
	case "modifyprod" : modifyprod($_GET["prodid"]);
						break;
	case "deleteprod" : deleteprod($_GET["prodid"],$_GET["prodname"]);
						break;
	case "add_admin": add_admin();
						break;
	case "insertadmin": insertadmin($_POST["username"]);
						break;
	case "orders": orders();
						break;
	case "order_det": order_det($_GET['order_id']);
						break;
	case "prod_rating": prod_rating();
						break;
	case "raport": raport();
						break;
	case "raport-top-product": raport_top_product();
						break;
	case "raport-product-cat": raport_product_cat();
						break;
	case "result-raport-product-cat": result_raport_product_cat($_POST["categ"],$_POST["start_date"],$_POST["finish_date"]);
						break;
	case "raport-procent-cat": raport_procent_cat();
						break;
	case "raport-rating": raport_rating();
						break;
	case "raport-users": raport_users();
						break;
	case "result-raport-users": result_raport_users($_POST["start_date"],$_POST["finish_date"]);
						break;
	case "users-order-number": users_order_number();
						break;
	case "orders-interval": orders_interval();
						break;
	case "orders-interval-result": orders_interval_result($_POST["start_date"],$_POST["finish_date"]);
						break;
}

function addprod(){
	echo '<center><h1 style="color:white;">Adăugare produse</h1></center>
		<form action="admin-page.php" method="POST" class="product-add-form">
	<label>Nume produs</label><br> <input type="text" name="name" id="name"> <br><br>
	<label>Cod produs</label><br> <input type="text" name="code" id="code"> <br><br>
	<label>Imagine produs 1</label><br> <input type="text" name="image1" id="image"> <br><br>
	<label>Imagine produs 2</label><br> <input type="text" name="image2" id="image"> <br><br>
	<label>Imagine produs 3</label><br> <input type="text" name="image3" id="image"> <br><br>
	<label>Pdf produs</label><br> <input type="text" name="pdf" id="pdf"> <br><br>
	<label>Categorie</label><br> <select name="categ" id="category">';
	
		global $db;
		$sql = "SELECT category_id, category_name FROM category";
			$result = mysqli_query($db,$sql);
			while($row = mysqli_fetch_array($result))
			{
				$CategId = $row["category_id"];
				$Name = $row["category_name"];
				echo "<option value=\"$CategId\"> $Name </option> ";
			}
			echo '
			  </select> <br> <br>

	<label>Preț</label><br> <input type="number" name="price" id="price" min="1" step="any"> <br><br>
	<label>Stoc</label><br> <input type="number" name="stock" id="stock" min="0"> <br><br>
	<input type="hidden" name="ac" value="insertprod">
	<input type="submit" name="submit" value="Adaugă" id="addbutton">

		</form>';
}

function insertprod($name,$image1,$image2,$image3,$code,$pdf,$price,$categ,$stock)
{
	global $db;
	$sql_prod = "INSERT INTO product(product_id, product_name, product_code, category_id, price, stock) VALUES (NULL, 
	'$name', '$code', '$categ', '$price', '$stock');";
	$result_prod = mysqli_query($db,$sql_prod);
	$last_id = mysqli_insert_id($db);
	$sql_img1 = "INSERT INTO product_image(image_id, product_id, image_link) VALUES (NULL, '$last_id','$image1');";
	$result_img1 = mysqli_query($db,$sql_img1);

	$sql_img2 = "INSERT INTO product_image(image_id, product_id, image_link) VALUES (NULL, '$last_id','$image2');";
	$result_img2 = mysqli_query($db,$sql_img2);

	$sql_img3 = "INSERT INTO product_image(image_id, product_id, image_link) VALUES (NULL, '$last_id','$image3');";
	$result_img3 = mysqli_query($db,$sql_img3);

	$sql_pdf = "INSERT INTO product_pdf(id_pdf, product_id, pdf_link) VALUES (NULL, '$last_id', '$pdf');";
	$result_pdf = mysqli_query($db,$sql_pdf);
	
		echo mysqli_error($db);
	if ($result_prod && $result_img1 && $result_img2 && $result_img3 && $result_pdf) {
		echo "<script type='text/javascript'>
	swal({
  title: 'Operație completă!',
  text: 'Produs adăugat cu succes',
  icon: 'success',
}).then(function() {
    window.location = 'admin-page.php?ac=addprod';
});
</script>";
	}
	else{
		echo "<script type='text/javascript'>
	swal({
  title: 'Operație incompletă!',
  text: 'Produsul nu a fost adăugat',
  icon: 'error',
}).then(function() {
    window.location = 'admin-page.php?ac=addprod';
});
</script>";
	}
	
	
}
function prodlist(){

	echo '<center><h1 style="color:white;">Produse</h1></center>
	<a href="admin-page.php?ac=prodlist&sort=product_id&order=desc" class="category-list">Toate produsele</a>';
	

		global $db;
		$sql = "SELECT category_id, category_name FROM category";
			$result = mysqli_query($db,$sql);
			while($row = mysqli_fetch_array($result))
			{
				$CategId = $row["category_id"];
				$Name = $row["category_name"];
				echo '<a href="admin-page.php?ac=prodlist&categ='.$CategId.'&sort=product_id&order=desc" class="category-list">'.$Name.'</a>';
			}

			if(!isset($_GET['categ'])){


			$field = $_GET['sort'];
            if($field == ''){
               $field = 'created_date'; 
            } 

            $ordertype = ($_GET['order'] == 'desc')? 'asc' : 'desc';
            if($_GET['order'] == 'asc'){
                $sort_arrow =  '<i class="fas fa-sort-down"></i>';
            }
            else if($_GET['order'] == 'desc'){
                $sort_arrow =  '<i class="fas fa-sort-up"></i>';
            }
            else{
                $sort_arrow =  '<i class="fas fa-sort-down"></i>';
            }
            $products = "SELECT p.product_id,product_name,product_code,price,stock,p.category_id, category_name FROM product as p JOIN category as c on p.category_id=c.category_id ORDER BY $field $ordertype";
			$result_products = mysqli_query($db, $products);
			echo '<table>';
                echo '<tr>';
                echo '<th><a href="admin-page.php?ac=prodlist&sort=product_id&order='.$ordertype.'" class="order-button">ID ';
                if($field == 'product_id') { echo $sort_arrow; }      
                echo '</a></th>'; 
                echo '<th><a href="admin-page.php?ac=prodlist&sort=product_name&order='.$ordertype.'" class="order-button">Nume  ';
                if($field == 'product_name') { echo $sort_arrow; } 
                echo '</a></th>'; 
                echo '<th>Categorie</th>';
                echo '<th>Cod</th>';   
                echo '<th><a href="admin-page.php?ac=prodlist&sort=stock&order='.$ordertype.'" class="order-button">Stoc';
                if($field == 'stock') { echo $sort_arrow; }
				echo '</a></th>';   
                echo '<th><a href="admin-page.php?ac=prodlist&sort=price&order='.$ordertype.'" class="order-button">Preț';
                if($field == 'price') { echo $sort_arrow; }
				echo '</a></th>'; 
                echo '<th>Modifică</th>'; 
  while($prod = mysqli_fetch_assoc($result_products)) {
  	$prod_id = $prod["product_id"];
  	$prod_name = $prod["product_name"];
  	$prod_code = $prod["product_code"];
  	$prod_stock = $prod["stock"];
  	$prod_price = $prod["price"];
  	$categ = $prod["category_name"];
  	$modify = "<a href=\"admin-page.php?ac=modifyprod&prodid=$prod_id\" class='modify-button'> Modifică </a> ";
		$delete = "<a href=\"admin-page.php?ac=deleteprod&prodid=$prod_id&prodname=$prod_name\"class='delete-button'> Șterge </a> ";
    	echo '<tr>
					<td>'.$prod_id.'</td>
					<td>'.$prod_name.'</td>
					<td>'.$categ.'</td>
					<td>'.$prod_code.'</td>
					<td>'.$prod_stock.'</td>
					<td>'.$prod_price.' RON</td>
					<td>'.$modify.'</td>
			</tr>';
}
echo "</table>";
echo mysqli_error($db);
}
else{
				$field = $_GET['sort'];
            if($field == ''){
               $field = 'created_date'; 
            } 

            $ordertype = ($_GET['order'] == 'desc')? 'asc' : 'desc';
            if($_GET['order'] == 'asc'){
                $sort_arrow =  '<i class="fas fa-sort-down"></i>';
            }
            else if($_GET['order'] == 'desc'){
                $sort_arrow =  '<i class="fas fa-sort-up"></i>';
            }
            else{
                $sort_arrow =  '<i class="fas fa-sort-down"></i>';
            }
	$category = $_GET['categ'];
	$products = "SELECT product_id,product_name,product_code,price,stock FROM product WHERE category_id='$category' ORDER BY $field $ordertype";
			$result_products = mysqli_query($db, $products);
			echo '<table>';
                echo '<tr>';
                echo '<th><a href="admin-page.php?ac=prodlist&categ='.$category.'&sort=product_id&order='.$ordertype.'" class="order-button">ID ';
                if($field == 'product_id') { echo $sort_arrow; }      
                echo '</a></th>'; 
                echo '<th><a href="admin-page.php?ac=prodlist&categ='.$category.'&sort=product_name&order='.$ordertype.'" class="order-button">Nume  ';
                if($field == 'product_name') { echo $sort_arrow; } 
                echo '</a></th>'; 
                echo '<th>Cod</th>'; 
                echo '<th>Stoc</th>';  
                echo '<th><a href="admin-page.php?ac=prodlist&categ='.$category.'&sort=price&order='.$ordertype.'" class="order-button">Preț';
                if($field == 'price') { echo $sort_arrow; }
				echo '</a></th>'; 
                echo '<th>Modifică</th>'; 

  while($prod = mysqli_fetch_assoc($result_products)) {
  	$prod_id = $prod["product_id"];
  	$prod_name = $prod["product_name"];
  	$prod_code = $prod["product_code"];
  	$prod_stock = $prod["stock"];
  	$prod_price = $prod["price"];
  	$modify = "<a href=\"admin-page.php?ac=modifyprod&prodid=$prod_id\" class='modify-button'> Modifică </a> ";
		$delete = "<a href=\"admin-page.php?ac=deleteprod&prodid=$prod_id&prodname=$prod_name\"class='delete-button'> Șterge </a> ";
    	echo '<tr>
					<td>'.$prod_id.'</td>
					<td>'.$prod_name.'</td>
					<td>'.$prod_code.'</td>
					<td>'.$prod_stock.'</td>
					<td>'.$prod_price.' RON</td>
					<td>'.$modify.'</td>
			</tr>';
}
echo "</table>";
}
}
function add_admin(){
	$user_level = $_SESSION["user_level"];
if ($user_level == 2) {
	echo '<center><h1 style="color:white;">Adăugare administrator</h1></center>
	<form action="admin-page.php" method="POST" class="product-add-form">
	<label>Nume utilizator</label><br> <input type="text" name="username" id="username"> <br><br>
	<input type="hidden" name="ac" value="insertadmin">
	<input type="submit" name="submit" value="Adaugă" id="addbutton">
	</form>';
}
else{
	echo "<center><h1 style='color:white;'>Nu ai acces aici!</h1></center>";
}
}
function insertadmin($username){
	global $db;
	$sql_admin = "UPDATE user SET level=1 WHERE username='$username'";
	$result_admin = mysqli_query($db, $sql_admin);
	if ($result_admin) {
		
	echo "<script type='text/javascript'>
	swal({
  title: 'Operație completă!',
  text: 'Administrator adăugat',
  icon: 'success',
}).then(function() {
    window.location = 'admin-page.php?ac=add_admin';
});
</script>";
	}
	else{
		echo "<script type='text/javascript'>
	swal({
  title: 'Operație incompletă!',
  text: 'Administratorul nu a fost adăugat',
  icon: 'error',
}).then(function() {
    window.location = 'admin-page.php?ac=add_admin';
});
</script>";
echo mysqli_error($db);
	}

}
function userlist(){
	echo '<center><h1 style="color:white;">Listă utilizatori</h1></center>';
	global $db;

	  			$field = $_GET['sort'];
            if($field == ''){
               $field = 'created_date'; 
            } 

            $ordertype = ($_GET['order'] == 'desc')? 'asc' : 'desc';
            if($_GET['order'] == 'asc'){
                $sort_arrow =  '<i class="fas fa-sort-down"></i>';
            }
            else if($_GET['order'] == 'desc'){
                $sort_arrow =  '<i class="fas fa-sort-up"></i>';
            }
            else{
                $sort_arrow =  '<i class="fas fa-sort-down"></i>';
            }
            $sql_user = "SELECT user_id, name, username, email, phone_number, adress, password, date_created,level FROM user ORDER BY $field $ordertype";
	$result_user = mysqli_query($db,$sql_user);

			echo '<table>';
                echo '<tr>';
                echo '<th style="width: 50px;"><a href="admin-page.php?ac=userlist&sort=user_id&order='.$ordertype.'" class="order-button">ID ';
                if($field == 'user_id') { echo $sort_arrow; }      
                echo '</a></th>'; 
                echo '<th><a href="admin-page.php?ac=userlist&sort=name&order='.$ordertype.'" class="order-button">Nume  ';
                if($field == 'name') { echo $sort_arrow; } 
                echo '</a></th>'; 
                echo '<th style="width: 150px;"><a href="admin-page.php?ac=userlist&sort=username&order='.$ordertype.'" class="order-button">Nume utilizator  ';
                if($field == 'username') { echo $sort_arrow; } 
                echo '</a></th>'; 
                echo '<th>Email</th>'; 
                echo '<th>Telefon</th>'; 
                echo '<th>Adresă</th>'; 
                echo '<th>Parolă</th>';  
                echo '<th><a href="admin-page.php?ac=userlist&sort=date_created&order='.$ordertype.'" class="order-button">Dată creare';
                if($field == 'date_created') { echo $sort_arrow; }
                echo '</a></th>';                 
                echo '<th>Nivel admin</th>'; 
                echo '<th>Șterge</th>';
	while ($rowu = mysqli_fetch_array($result_user)) 
		{
			
			$user_id = $rowu["user_id"];
			$name = $rowu["name"];
			$username = $rowu["username"];
			$user_email = $rowu["email"];
			$user_phone = $rowu["phone_number"];
			$user_adress = $rowu["adress"];
			$user_pass = $rowu["password"];
			$user_dateC = $rowu["date_created"];
			$user_level = $rowu["level"];
			$delete_user = "<a href=\"admin-page.php?ac=deleteuser&uid=$user_id\"class='delete-button'> Șterge </a> ";
			echo '<tr>
					<td>'.$user_id.'</td>
					<td>'.$name.'</td>
					<td>'.$username.'</td>
					<td>'.$user_email.'</td>
					<td>'.$user_phone.'</td>
					<td>'.$user_adress.'</td>
					<td>'.$user_pass.'</td>
					<td>'.$user_dateC.'</td>
					<td>'.$user_level.'</td>
					<td>'.$delete_user.'</td>
				</tr>';
		}
		echo "</table>";
}
function deleteuser($uid){
	global $db;
	$sqluser = "DELETE FROM user WHERE user_id = $uid;";
	
	if (mysqli_query($db,$sqluser)) {
		
	echo "<script type='text/javascript'>
	swal({
  title: 'Operație completă!',
  text: 'Utilizator șters',
  icon: 'success',
}).then(function() {
    window.location = 'admin-page.php?ac=userlist&sort=user_id&order=desc';
});
</script>";
	}
	else{
		echo "<script type='text/javascript'>
	swal({
  title: 'Operație incompletă!',
  text: 'Utilizatorul nu a fost șters',
  icon: 'error',
}).then(function() {
    window.location = 'admin-page.php?ac=userlist&sort=user_id&order=desc';
});
</script>";
echo mysqli_error($db);
	}
}
function modifyprod($prodid){
	echo '<center><h1 style="color:white;">Modificare produs</h1></center>';
	global $db;
	$sql_prod = "SELECT product_id, product_name, product_code, category_id, price, stock FROM product WHERE product_id=$prodid";
	$result_prod = mysqli_query($db,$sql_prod);
	while ($rowp = mysqli_fetch_array($result_prod)) 
		{
			$product_id_modif = $rowp["product_id"];
			$prod_name_modif = $rowp["product_name"];
			$prod_code_modif = $rowp["product_code"];
			$prod_cat_modif = $rowp["category_id"];
			$prod_price_modif = $rowp["price"];
			$prod_stock_modif = $rowp["stock"];
		
	echo '<form action="admin-page.php" method="POST" class="product-add-form">
	<label>Nume produs</label><br> <input type="text" name="name" id="name" value="'.$prod_name_modif.'"> <br><br>
	<label>Cod produs</label><br> <input type="text" name="code" id="code" value="'.$prod_code_modif.'"> <br><br>';
	global $db;
	$sql_img = "SELECT product_id, image_link FROM product_image WHERE product_id=$prodid";
	$result_img = mysqli_query($db,$sql_img);
	$count = 1;
	if (mysqli_num_rows($result_img)==0) 
	{
			echo "<a href=\"admin-page.php\" class='add-image-button'> Add Images </a> <br><br>";
	}
	else{
		while($rowi = mysqli_fetch_array($result_img))
			{
					$img_link = $rowi["image_link"];
				echo '<label>Imagine produs '.$count.'</label><br> <input type="text" name="image'.$count.'" id="image" value="'.$img_link.'"> <br><br>';
				$count++;
			}
		}
		global $db;
		$sql_pdf = "SELECT pdf_link FROM product_pdf WHERE product_id=$prodid";
			$result_pdf = mysqli_query($db,$sql_pdf);
			$rowpdf = mysqli_fetch_array($result_pdf);
			
	echo'<label>Pdf produs</label><br> <input type="text" name="pdf" id="pdf" value="'.$rowpdf["pdf_link"].'"> <br><br>
	<label>Categorie</label><br> <select name="categ" id="category">';
	
		global $db;
		$sql_cat = "SELECT category_id, category_name FROM category";
			$result_cat = mysqli_query($db,$sql_cat);
			while($rowc = mysqli_fetch_array($result_cat))
			{
				$CategId = $rowc["category_id"];
				$Name = $rowc["category_name"];
				$sel = "";
				if($prod_cat_modif == $CategId) $sel = "SELECTED";
				echo "<option value=\"$CategId\" $sel> $Name </option> ";
			}
			echo '
			  </select> <br> <br>

	<label>Preț</label><br> <input type="number" name="price" id="price" min="1" value="'.$prod_price_modif.'" step="any"> <br><br>
	<label>Stoc</label><br> <input type="number" name="stock" id="stock" min="0" value="'.$prod_stock_modif.'"> <br><br>
	<input type="hidden" name="prodid" value="'.$product_id_modif.'">
	<input type="hidden" name="ac" value="updateprod">
	<input type="submit" name="submit" value="Modifică" id="addbutton">

		</form>';
	}
}
function updateprod($prodid,$name,$code,$pdf,$price,$categ,$stock,$img1,$img2,$img3)
{
	global $db;
	$sql = "UPDATE product SET product_name = '$name', product_code = '$code', price = '$price', category_id = '$categ', stock = '$stock' WHERE product_id = '$prodid'";
	$result = mysqli_query($db,$sql);
	$sql_del_img = "DELETE FROM product_image WHERE product_id= '$prodid'";
	$result_del_img = mysqli_query($db,$sql_del_img);
	$sql_img1 = "INSERT INTO product_image(image_id, product_id, image_link) VALUES (NULL, '$prodid','$img1');";
	$result_img1 = mysqli_query($db,$sql_img1);

	$sql_img2 = "INSERT INTO product_image(image_id, product_id, image_link) VALUES (NULL, '$prodid','$img2');";
	$result_img2 = mysqli_query($db,$sql_img2);

	$sql_img3 = "INSERT INTO product_image(image_id, product_id, image_link) VALUES (NULL, '$prodid','$img3');";
	$result_img3 = mysqli_query($db,$sql_img3);

	$sql_pdf = "UPDATE product_pdf SET pdf_link = '$pdf' WHERE product_id = '$prodid'";
	$result_pdf = mysqli_query($db,$sql_pdf);

	if ($result) {
		echo "<script type='text/javascript'>
	swal({
  title: 'Operație completă!',
  text: 'Produs modificat',
  icon: 'success',
}).then(function() {
    window.location = 'admin-page.php?ac=prodlist&sort=product_id&order=desc';
});
</script>";
	}
	else{
		echo "<script type='text/javascript'>
	swal({
  title: 'Operație incompletă!',
  text: 'Produsul nu a fost adăugat',
  icon: 'error',
}).then(function() {
    window.location = 'admin-page.php?ac=prodlist&sort=product_id&order=desc';
});
</script>";
	}
}
function deleteprod($prodid,$prodname)
{
	global $db;
	$sqlimg = "DELETE FROM `product_image` WHERE `product_image`.`product_id`= $prodid;";
	
	$sqlpdf = "DELETE FROM `product_pdf` WHERE `product_pdf`.`product_id` = $prodid;";
	
	$sqlprod = "DELETE FROM `product` WHERE `product`.`product_id` = $prodid;";
	
	if (mysqli_query($db,$sqlimg) && mysqli_query($db,$sqlpdf) && mysqli_query($db,$sqlprod)) {
		
	echo "<script type='text/javascript'>
	swal({
  title: 'Operație completă!',
  text: 'Produsul a fost șters',
  icon: 'success',
}).then(function() {
    window.location = 'admin-page.php?ac=prodlist&sort=product_id&order=desc';
});
</script>";
	}
	else{
		echo "<script type='text/javascript'>
	swal({
  title: 'Operație incompletă!',
  text: 'Produsul nu a fost șters',
  icon: 'error',
}).then(function() {
    window.location = 'admin-page.php?ac=prodlist&sort=product_id&order=desc';
});
</script>";
	}
}
function orders(){
echo '<center><h1 style="color:white;">Listă comenzi</h1></center>';
	global $db;

	  			$field = $_GET['sort'];
            if($field == ''){
               $field = 'created_date'; 
            } 

            $ordertype = ($_GET['order'] == 'desc')? 'asc' : 'desc';
            if($_GET['order'] == 'asc'){
                $sort_arrow =  '<i class="fas fa-sort-down"></i>';
            }
            else if($_GET['order'] == 'desc'){
                $sort_arrow =  '<i class="fas fa-sort-up"></i>';
            }
            else{
                $sort_arrow =  '<i class="fas fa-sort-down"></i>';
            }
            $sql_order = "SELECT o.user_id, name, order_id , total_cost, `date` FROM orders AS o JOIN user AS u ON u.user_id = o.user_id ORDER BY $field $ordertype";
	$result_order = mysqli_query($db,$sql_order);

			echo '<table>';
                echo '<tr>';
                echo '<th><a href="admin-page.php?ac=orders&sort=order_id&order='.$ordertype.'" class="order-button">ID ';
                if($field == 'oder_id') { echo $sort_arrow; }      
                echo '</a></th>'; 
                echo '<th><a href="admin-page.php?ac=orders&sort=name&order='.$ordertype.'" class="order-button">Nume  ';
                if($field == 'name') { echo $sort_arrow; } 
                echo '</a></th>'; 
                echo '<th><a href="admin-page.php?ac=orders&sort=total_cost&order='.$ordertype.'" class="order-button">Total  ';
                if($field == 'total_cost') { echo $sort_arrow; } 
                echo '</a></th>'; 
                echo '<th><a href="admin-page.php?ac=orders&sort=date&order='.$ordertype.'" class="order-button">Dată  ';
                if($field == 'date') { echo $sort_arrow; } 
                echo '</a></th>'; 
                echo '<th>Detalii</th>';
	while ($rowu = mysqli_fetch_array($result_order)) 
		{
			
			$order_id = $rowu["order_id"];
			$name = $rowu["name"];
			$total = $rowu["total_cost"];
			$date = $rowu["date"];
			$details = "<a href='admin-page.php?ac=order_det&order_id=".$order_id."'class='modify-button'> Detalii </a> ";
			echo '<tr>
					<td>#'.$order_id.'</td>
					<td>'.$name.'</td>
					<td>'.$total.'</td>
					<td>'.$date.'</td>
					<td>'.$details.'</td>
				</tr>';
		}
		echo "</table>";
}
function order_det($order_id){
	global $db;
	echo "<center><h1 style='color:white;'>Comanda: #$order_id</h1></center>";
	$sql_det = "SELECT op.product_id, product_name, product_code, price, quantity_cart, order_product_price FROM order_product AS op JOIN product AS p ON p.product_id = op.product_id WHERE order_id=$order_id";
	$result_det = mysqli_query($db,$sql_det);
	echo '<table><tr><th>No.</th>
		  <th>Nume</th>
		  <th>Cod</th>
		  <th>Cantitate</th>
		  <th>Preț</th>
		  <th>Cantitate*Preț</th></tr>';
		  $total =0;
		  $count=1;
		  while ($rowd = mysqli_fetch_array($result_det)) 
		{
			$name = $rowd["product_name"];
			$code = $rowd["product_code"];
			$qty = $rowd["quantity_cart"];
			$price = $rowd["price"];
			$qp = $rowd["order_product_price"];
			$total = $total+$qp;
			echo '<tr>
					<td>'.$count.'</td>
					<td>'.$name.'</td>
					<td>'.$code.'</td>
					<td>'.$qty.'</td>
					<td>'.$price.'</td>
					<td>'.$qp.'</td>
				</tr>';
				$count++;
		}
		echo "</table>";
		echo "<center style='color:white;font-size:30px'>TOTAL: $total RON</center>";
}
function prod_rating(){
			echo "<center><h1 style='color:white;'>Recenzii</h1></center>";
			global $db;
			  			$field = $_GET['sort'];
            if($field == ''){
               $field = 'created_date'; 
            } 

            $ordertype = ($_GET['order'] == 'desc')? 'asc' : 'desc';
            if($_GET['order'] == 'asc'){
                $sort_arrow =  '<i class="fas fa-sort-down"></i>';
            }
            else if($_GET['order'] == 'desc'){
                $sort_arrow =  '<i class="fas fa-sort-up"></i>';
            }
            else{
                $sort_arrow =  '<i class="fas fa-sort-down"></i>';
            }
			$sql_rating = "SELECT review_id, pr.product_id, product_name, product_code, pr.user_id, name, rating FROM product_review AS pr JOIN product AS p ON p.product_id = pr.product_id JOIN user AS u ON u.user_id=pr.user_id ORDER BY $field $ordertype"; 
				$result_rating = mysqli_query($db,$sql_rating);
				echo '<table>';
                echo '<tr>';
                echo '<th><a href="admin-page.php?ac=prod_rating&sort=review_id&order='.$ordertype.'" class="order-button">ID  ';
                if($field == 'review_id') { echo $sort_arrow; } 
                echo '</a></th>';
                echo '<th><a href="admin-page.php?ac=prod_rating&sort=product_name&order='.$ordertype.'" class="order-button">Nume produs  ';
                if($field == 'product_name') { echo $sort_arrow; } 
                echo '</a></th>';  
                echo '<th>Cod</th>';
                echo '<th><a href="admin-page.php?ac=prod_rating&sort=name&order='.$ordertype.'" class="order-button">Nume utilizator  ';
                if($field == 'name') { echo $sort_arrow; } 
                echo '</a></th>'; 
                echo '<th><a href="admin-page.php?ac=prod_rating&sort=rating&order='.$ordertype.'" class="order-button">Recenzie  ';
                if($field == 'rating') { echo $sort_arrow; } 
                echo '</a></th>'; 
     while ($rowR = mysqli_fetch_array($result_rating)) 
		{
			$review_id = $rowR["review_id"];
			$prod_name = $rowR["product_name"];
			$code = $rowR["product_code"];
			$name = $rowR["name"];
			$rating = $rowR["rating"];
			echo '<tr>
					<td>'.$review_id.'</td>
					<td>'.$prod_name.'</td>
					<td>'.$code.'</td>
					<td>'.$name.'</td>
					<td>'.$rating.'</td>
				</tr>';
		}
		echo "</table>";
		}
function raport(){
	$user_level = $_SESSION["user_level"];
if ($user_level == 2) {
	include("butoane-raport.php");
}
else{
	echo "<center><h1 style='color:white;'>Nu ai acces aici!</h1></center>";
}
		



}
function raport_top_product(){
	include("butoane-raport.php");
	global $db;
	echo "<center><h1 style='color:white;'> Top 10 produse vândute </h1> </center>";
	$sql = "SELECT product_name, product_code,cat.category_name, op.product_id, SUM(quantity_cart) AS qtyS FROM order_product AS op JOIN product AS pr ON op.product_id=pr.product_id JOIN category AS cat ON pr.category_id=cat.category_id GROUP BY product_id ORDER BY qtyS DESC LIMIT 10";
	$result=mysqli_query($db, $sql);
	echo '<table><tr><th>No.</th>
		  <th>Nume produs</th>
		  <th>Cod</th>
		  <th>Categorie</th>
		  <th>Cantitate totală</th></tr>';
		  $count=1;
		  while ($row = mysqli_fetch_array($result)) 
		{
			$prod_name = $row["product_name"];
			$code = $row["product_code"];
			$qty = $row["qtyS"];
			$cat = $row["category_name"];
			echo '<tr>
					<td>'.$count.'</td>
					<td>'.$prod_name.'</td>
					<td>'.$code.'</td>
					<td>'.$cat.'</td>
					<td>'.$qty.'</td>
				</tr>';
			$count++;
}
			echo "</table>";
}
function raport_product_cat(){
	include("butoane-raport.php");
	echo "<center><h1 style='color:white;'> Top 3 produse pe categorii și interval de timp </h1></center>";
	echo "<br><br><br><br>";
	global $db;
	echo "<form method='post' action='admin-page.php' ><label style='font-size:25px;margin-left: 50px;color:white;'>Categorie</label><select style='margin-left: 20px;' name='categ' id='category'>';";
$sql = "SELECT category_id, category_name FROM category";
			$result = mysqli_query($db,$sql);
			while($row = mysqli_fetch_array($result))
			{
				$CategId = $row["category_id"];
				$Name = $row["category_name"];
				echo "<option value=\"$CategId\"> $Name </option> ";
			}
			
			  echo "</select>";


	echo "<label style='font-size:25px;margin-left: 50px;color:white;'>Dată început</label><input style='margin-left: 20px;background-color:#555455; font-size:25px;border:1px solid #333b3b;border-radius:10px;color:white;' type='date' name='start_date'>
		<label style='font-size:25px;margin-left:50px;color:white;'>Dată sfârșit</label>
		<input style='margin-left:20px;background-color:#555455;font-size:25px;border:1px solid #333b3b;border-radius:10px;color:white;' type='date' name='finish_date'></br></br></br>
		<input type='hidden' name='ac' value='result-raport-product-cat'>
		<center><input type='submit' name='submit' value='Generează raport' id='addbutton' style='border: 2px solid #2F3838;border-radius: 5px;color:white;font-size:20px;'></center>
			
			</form";
}
function result_raport_product_cat($categ,$startd,$finishd){
	include("butoane-raport.php");
	global $db;
	$sql_categ = "SELECT category_name FROM category WHERE category_id='$categ'";
	$result_categ = mysqli_query($db, $sql_categ);
	$rowC = mysqli_fetch_array($result_categ);
	$category = $rowC['category_name'];
	echo "<center><h1 style='color:white;'> Top 3 produse din categoria: $category în intervalul de timp $startd | $finishd</h1></center>";
	$dates = date('Y-m-d', strtotime($startd));
	$datef = date('Y-m-d', strtotime($finishd));
	$sql = "SELECT p.product_name, op.order_id,o.date,c.category_name, SUM(quantity_cart) as qty from order_product as op join product as p on p.product_id=op.product_id JOIN orders as o on o.order_id=op.order_id join category as c on c.category_id=p.category_id where date(o.date) BETWEEN '$startd' and '$finishd' and c.category_id='$categ' group by op.product_id order by qty desc limit 3";
	$result = mysqli_query($db, $sql);
	mysqli_error($db);
	echo '<table><tr><th>No.</th>
		  <th>Nume produs</th>
		  <th>Categorie</th>
		  <th>Cantitate</th>
		  <th>Dată</th></tr>';
		  $count=1;
	while($row = mysqli_fetch_array($result))
		{
			$prod_name = $row["product_name"];
			$category = $row["category_name"];
			$qty = $row["qty"];
			$date = $row["date"];
			echo '<tr>
					<td>'.$count.'</td>
					<td>'.$prod_name.'</td>
					<td>'.$category.'</td>
					<td>'.$qty.'</td>
					<td>'.$date.'</td>
				</tr>';
			$count++;
}
			echo "</table>";
}
function raport_procent_cat(){
	include("butoane-raport.php");
	echo "<center><h1 style='color:white;'> Procentaj categorii din total vanzari </h1></center>";
	global $db;
	$sql = "SELECT cat.category_name, op.product_id, SUM(quantity_cart) AS qtyS FROM order_product AS op JOIN product AS pr ON op.product_id=pr.product_id JOIN category AS cat ON pr.category_id=cat.category_id GROUP BY category_name ORDER BY qtyS DESC";
	$result = mysqli_query($db, $sql);
	$sql_total = "SELECT SUM(quantity_cart) AS qtyT FROM order_product";
	$result_total = mysqli_query($db, $sql_total);
	$rowt = mysqli_fetch_array($result_total);
	$qty_total = $rowt['qtyT'];
		echo '<table><tr><th>No.</th>
		  <th>Categorie</th>
		  <th>Cantitate</th>
		  <th>Cantitate totală</th>
		  <th>Procent vanzari</th></tr>';
			  $count=1;
	while($row = mysqli_fetch_array($result))
		{
			$category = $row["category_name"];
			$qty = $row["qtyS"];
			$procent = ($qty / $qty_total) * 100;
			$round_procent = number_format((float)$procent, 2, '.', '');	
			echo '<tr>
					<td>'.$count.'</td>
					<td>'.$category.'</td>
					<td>'.$qty.'</td>
					<td>'.$qty_total.'</td>
					<td>'.$round_procent.' %</td>
				</tr>';
			$count++;			

		}
			echo "</table>";

}
function raport_rating() {
	include("butoane-raport.php");
	global $db;
	echo "<center><h1 style='color:white;'> Top 5 produse cu cele mai multe recezii pozitive </h1> </center>";
	$sql = "SELECT product_name, product_code,cat.category_name, r.product_id, COUNT(rating) AS CRA, CAST(AVG(rating) AS DECIMAL(10,2)) AS CR FROM product_review AS r JOIN product AS pr ON r.product_id=pr.product_id JOIN category AS cat ON pr.category_id=cat.category_id GROUP BY product_id ORDER BY CR DESC LIMIT 5";
	$result=mysqli_query($db, $sql);
	echo '<table><tr><th>No.</th>
		  <th>Nume produs</th>
		  <th>Cod</th>
		  <th>Categorie</th>
		  <th>Număr recenzii</th>
		  <th>Medie recenzii</th></tr>';
		  $count=1;
		  while ($row = mysqli_fetch_array($result)) 
		{
			$prod_name = $row["product_name"];
			$code = $row["product_code"];
			$countR = $row["CRA"];
			$cat = $row["category_name"];
			$avg = $row["CR"];
			echo '<tr>
					<td>'.$count.'</td>
					<td>'.$prod_name.'</td>
					<td>'.$code.'</td>
					<td>'.$cat.'</td>
					<td>'.$countR.'</td>
					<td>'.$avg.'</td>
				</tr>';
			$count++;
}
			echo "</table>";
}

function raport_users(){
		include("butoane-raport.php");
	echo "<center><h1 style='color:white;'> Utilizatori intregistrati pe perioada de timp </h1></center>";
	echo "<br><br><br><br>";
	global $db;
	echo "<form method='post' action='admin-page.php' >
		<center><label style='font-size:25px;margin-left: 50px;color:white;'>Dată început</label><input style='margin-left: 20px;background-color:#555455; font-size:25px;border:1px solid #333b3b;border-radius:10px;color:white;' type='date' name='start_date'>
		<label style='font-size:25px;margin-left:50px;color:white;'>Dată sfârșit</label>
		<input style='margin-left:20px;background-color:#555455;font-size:25px;border:1px solid #333b3b;border-radius:10px;color:white;' type='date' name='finish_date'></center></br></br></br>
		<input type='hidden' name='ac' value='result-raport-users'>
		<center><input type='submit' name='submit' value='Generează raport' id='addbutton' style='border: 2px solid #2F3838;border-radius: 5px;color:white;font-size:20px;'></center>
			
			</form";
}
function result_raport_users($startd,$finishd){
			include("butoane-raport.php");
	global $db;
	echo "<center><h1 style='color:white;'> Numar utilizatori înregistrați în perioada $startd | $finishd </h1> </center>";
	$sql = "SELECT COUNT(user_id) as countU FROM `user` WHERE date(date_created) BETWEEN '$startd' and '$finishd'";
	$result=mysqli_query($db, $sql);
	$sqlC = "SELECT COUNT(user_id) as countT FROM `user`";
	$resultC=mysqli_query($db, $sqlC);
	echo '<table><tr>
		  <th>Numar utilizatori înregistrați în perioada aleasă</th>
		  <th>Total utilizatori înregistrați</th>
		  <th>Procent utilizatori înregistrați în perioada aleasă</th>';
	$row = mysqli_fetch_array($result);
	$rowC = mysqli_fetch_array($resultC);
	$users = $row['countU'];
	$usersT = $rowC['countT'];
	$procent = ($users / $usersT) * 100;
	$round_procent = number_format((float)$procent, 2, '.', '');
		echo '<tr>
					<td>'.$users.'</td>
					<td>'.$usersT.'</td>
					<td>'.$round_procent.' %</td>
				</tr>';

}
function users_order_number(){ 
			include("butoane-raport.php");
	global $db;
	echo "<center><h1 style='color:white;'> Utilizatori care au cel puțin o comandă efectuată </h1> </center>";
	$sql = "SELECT COUNT(DISTINCT user_id) as countU FROM `orders`";
	$result=mysqli_query($db, $sql);
	$sqlC = "SELECT COUNT(user_id) as countT FROM `user`";
	$resultC=mysqli_query($db, $sqlC);
	echo '<table><tr>
		  <th>Numar utilizatori cu cel puțin o comandă efectuată</th>
		  <th>Total utilizatori înregistrați</th>
		  <th>Procent utilizatori care au efectuat cel puțin o comandă</th>';
	$row = mysqli_fetch_array($result);
	$rowC = mysqli_fetch_array($resultC);
	$users = $row['countU'];
	$usersT = $rowC['countT'];
	$procent = ($users / $usersT) * 100;
	$round_procent = number_format((float)$procent, 2, '.', '');
		echo '<tr>
					<td>'.$users.'</td>
					<td>'.$usersT.'</td>
					<td>'.$round_procent.' %</td>
				</tr>';
}

function orders_interval(){
			include("butoane-raport.php");
	echo "<center><h1 style='color:white;'> Comenzi plasate pe interval de timp </h1></center>";
	echo "<br><br><br><br>";
	global $db;
	echo "<form method='post' action='admin-page.php' >
		<center><label style='font-size:25px;margin-left: 50px;color:white;'>Dată început</label><input style='margin-left: 20px;background-color:#555455; font-size:25px;border:1px solid #333b3b;border-radius:10px;color:white;' type='date' name='start_date'>
		<label style='font-size:25px;margin-left:50px;color:white;'>Dată sfârșit</label>
		<input style='margin-left:20px;background-color:#555455;font-size:25px;border:1px solid #333b3b;border-radius:10px;color:white;' type='date' name='finish_date'></center></br></br></br>
		<input type='hidden' name='ac' value='orders-interval-result'>
		<center><input type='submit' name='submit' value='Generează raport' id='addbutton' style='border: 2px solid #2F3838;border-radius: 5px;color:white;font-size:20px;'></center>
			
			</form";
}
function orders_interval_result($startd,$finishd){
			include("butoane-raport.php");
	global $db;
	echo "<center><h1 style='color:white;'> Comenzi plasate în perioada $startd | $finishd </h1> </center>";
	$dates = date('Y-m-d', strtotime($startd));
	$datef = date('Y-m-d', strtotime($finishd));
	$sql = "SELECT o.order_id, o.user_id,u.name, o.total_cost, o.date FROM orders AS o JOIN user AS u ON o.user_id=u.user_id WHERE date(o.date) BETWEEN '$dates' AND '$datef'";
	$result = mysqli_query($db, $sql);
	mysqli_error($db);
	echo '<table><tr><th>Număr comandă</th>
		  <th>Nume client</th>
		  <th>Total comandă</th>
		  <th>Dată</th></tr>';
	while($row = mysqli_fetch_array($result))
		{
			$order_id = $row["order_id"];
			$user_name = $row["name"];
			$total = $row["total_cost"];
			$date = $row["date"];
			echo '<tr>
					<td>#'.$order_id.'</td>
					<td>'.$user_name.'</td>
					<td>'.$total.'</td>
					<td>'.$date.'</td>
				</tr>';
}
			echo "</table>";
}
?>

	</div>
</div>
</body>
</html>
<?php 


?>
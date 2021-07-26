      <?php
      session_start();
      include("db_connect.php");
      $sql_cart_b = 'SELECT C.product_id,P.product_name,P.price, C.quantity_cart, C.user_id FROM cart AS C INNER JOIN product AS P ON C.product_id=P.product_id WHERE C.user_id="'.$_SESSION["user_id"].'"';
$result_cart_b = mysqli_query($db, $sql_cart_b);
$count_b=mysqli_num_rows($result_cart_b);
$_SESSION['count_cart'] = $count_b;
      if($_SESSION['count_cart'] == 0){
            $btn = '<button class="btn btn-primary checkout" disabled>Comandă</button>';
        }     
      else if($_SESSION['phone'] != "" && $_SESSION['adress'] != ""){
 
            $btn = '<button class="btn btn-primary checkout" onclick="checkout()">Comandă</button>';
        }
        else{
           $btn = "<button class='btn btn-primary checkout' disabled>Comandă</button></br></br>
                  Completeaza profilul pentru a continua!";
        }
echo $btn;
      ?>
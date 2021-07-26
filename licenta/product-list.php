<div id="message"></div>
<?php
$result_products = mysqli_query($db, $products);
  $count=0;

  while($prod = mysqli_fetch_assoc($result_products)) {

      echo '
<li class="list-group-item">
      <div id="myCarousel'.$prod["product_id"].'" class="carousel"  style="width:180px;" data-ride="carousel" data-interval="0">
    

    <div class="carousel-inner" style="margin-left:20px;">';
  $images = ' SELECT product_id,image_link FROM product_image WHERE
  product_id="'.$prod["product_id"].'"';
  $result_images = mysqli_query($db, $images);
$active="active";
    while ($img = mysqli_fetch_assoc($result_images)) {
      echo '
      <div class="carousel-item '.$active.'">
        <img src="'.$img["image_link"].'" style="width:100%;">
      </div>';
$active="";
  

}
      echo '
    </div>
    <a class="carousel-control-prev" href="#myCarousel'.$prod["product_id"].'" data-slide="prev" style="background-image: none;" >
      <span class="carousel-control-prev-icon"></span>
    </a>
    <a class="carousel-control-next" href="#myCarousel'.$prod["product_id"].'" data-slide="next" style="background-image: none;"" >
      <span class="carousel-control-next-icon"></span>
    </a>
  </div>
      <div class="product-name">'. $prod["product_name"].'</div>
      <div class="product-rating">
        <i class="fa fa-star" data-index="0"></i>
        <i class="fa fa-star" data-index="1"></i>
        <i class="fa fa-star" data-index="2"></i>
        <i class="fa fa-star" data-index="3"></i>
        <i class="fa fa-star" data-index="4"></i>
        <input type="hidden" class="pid_prod_star" value="'. $prod["product_id"].'">';
        $sql_select_row = 'SELECT review_id FROM product_review WHERE product_id="'.$prod["product_id"].'"';
        $result_select_row = mysqli_query($db, $sql_select_row);
        $count_rating = mysqli_num_rows($result_select_row);
        $sql_select_sum = 'SELECT SUM(rating) AS total FROM product_review WHERE product_id="'.$prod["product_id"].'"';
        $result_select_row = mysqli_query($db, $sql_select_sum);
        $sum = mysqli_fetch_assoc($result_select_row);
        $total = $sum['total'];
        $avg = $total / $count_rating;
        $round_avg = number_format((float)$avg, 1, '.', '');
        echo'<div class="rating-avg" id="rating-item">('.$round_avg.')</div>
        </div>

        
        
      <div class="list-button">
      <form action="" class="add_cart">
      <input type="hidden" class="pid" value="'. $prod["product_id"].'">
      <input type="hidden" class="prod_price" value="'. $prod["price"].'">';
      if ($_SESSION['user_login']!="") {
        echo '<button class="btn btn-primary AddItem" >Adaugă în coș</button>';
      }
      else{
        echo '<center><button class="btn btn-primary AddItem" disabled >Adaugă în coș</button></center></br>
              <center>Autentificare necesara!</center>';

      }
      echo '</form>
      </div>
      <div class="product-review">

      </div>';
  $pdfs = ' SELECT product_id,pdf_link FROM product_pdf WHERE
  product_id="'.$prod["product_id"].'"';
  $result_pdfs = mysqli_query($db, $pdfs);
    while ($pdf = mysqli_fetch_assoc($result_pdfs)) {
      echo '<div class="product-details">
      <a href="'.$pdf["pdf_link"].'" class="btn btn-outline-dark text-light" role="button" target="blank">Detalii</a>
      
      </div>';
  

}
      echo '
      
      <div class="product-price">
        Preț: '.$prod["price"].' RON
      </div>
    </li>';

$count++;

}
  ?>

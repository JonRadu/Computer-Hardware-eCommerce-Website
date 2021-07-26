      <?php
      echo '
       <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="0">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="cutiecpu.png" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="procesor.jpg" alt="Second slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
  <div id="exit2" href="#" onclick="hide(\'carouselExampleIndicators\'),hide(\'exit2\'),hide(\'carousel-background\')">EXIT</div>
  </div>

  <div id="carousel-background" href="#"></div>'
?>
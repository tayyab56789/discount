<?php  
	include('header.php');
  include ('api/ConnectDB.php');

include ('api/QuieriesDB.php');

include ('api/ShopOwner.php');

include ('api/Shop.php');

include ('api/Products.php');

include ('api/Discount.php');

include ('api/config.php');
/*-------- class instances ---------*/
$connectDB = new ConnectDB();
/*------ connection variable ------*/
$conn = $connectDB::connectionWithDB($servername, $username, $password, $dbname);
$products = new Products();
$discount = new Discount();
$result = json_decode($products::selectAllProductsCustomSelect($conn));
//echo "<pre>";
//print_r($result);
//echo (count($result->result));
//echo "</pre>";
?>
<div class="carousel fade-carousel slide" data-ride="carousel" data-interval="4000" id="bs-carousel">
  <!-- Overlay -->
  <div class="overlay"></div>

  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#bs-carousel" data-slide-to="0" class="active"></li>
    <li data-target="#bs-carousel" data-slide-to="1"></li>
    <li data-target="#bs-carousel" data-slide-to="2"></li>
  </ol>
  
  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item slides active">
      <div class="slide-1"></div>
      <div class="hero">
        <hgroup>
            <h1>RO'S TORV</h1>        
            <h3>Offer's Website</h3>
        </hgroup>
      </div>
    </div>
    <div class="item slides">
      <div class="slide-2"></div>
      <div class="hero">        
        <hgroup>
            <h1>RO'S TORV</h1>        
            <h3>Keep yourself update</h3>
        </hgroup>
      </div>
    </div>
    <div class="item slides">
      <div class="slide-3"></div>
      <div class="hero">        
        <hgroup>
            <h1>RO'S TORV</h1>        
            <h3>See what's new</h3>
        </hgroup>
      </div>
    </div>
  </div> 
</div>
<div class="container">
  <div class="row" id="slider-text">
    <div class="col-md-6" >
      <h2>CATEGORIES</h2>
    </div>
  </div>
</div>
<div class="container-fluid">
<div class="row">
  <div class="col-sm-3 col-md-3 categories">
    <div class="thumbnail">
    <br> <a href="category.php?param=clothing">
      <img src="assets/images/clothing.png" width="50%" alt="">
      <div class="caption">
        <p class="text-center"><h3 class="text-center">Clothing</h3></p>
      </div>
      </a>
    </div>
  </div>
  <div class="col-sm-3 col-md-3 categories">
    <div class="thumbnail">
    <br><a href="category.php?param=electronics">
      <img src="assets/images/mobi.png" width="50%" alt="">
      <div class="caption">
        <p class="text-center"><h3 class="text-center">Electronics</h3></p>
      </div>
      </a>
    </div>
  </div>
  <div class="col-sm-3 col-md-3 categories">
    <div class="thumbnail">
    <br><a href="category.php?param=restourant">
      <img src="assets/images/food.png" width="50%" alt="">
      <div class="caption">
        <p class="text-center"><h3 class="text-center">Restourant</h3></p>
      </div></a>
    </div>
  </div>
  
  <div class="col-sm-3 col-md-3 categories">
    <div class="thumbnail">
    <br><a href="category.php?param=entertainment">
      <img src="assets/images/movie.png" width="50%" alt="">
      <div class="caption">
        <p class="text-center"><h3 class="text-center">Entertainment</h3></p>
      </div>
      </a>
    </div>
  </div>
</div>
</div>



<div class="">
 <!--Item slider text-->
<div class="container">
  <div class="row" id="slider-text">
    <div class="col-md-6" >
      <h2>LATEST OFFERS</h2>
    </div>
  </div>
</div>

<!-- Item slider-->
<div class="container-fluid">

  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="carousel carousel-showmanymoveone slide" id="itemslider">
        <div class="carousel-inner">


<?php 
if(isset($result->result))
for ($i=0; $i<count($result->result); $i++) {
?>
          <div class="item <?php if($i==0) {echo "active";} ?>">
            <div class="col-xs-12 col-sm-6 col-md-2">
              <a href="detail.php?id=<?php echo $result->result[$i]->p_id; ?>"><img src="<?php echo $result->result[$i]->p_image_id; ?>" class="img-responsive center-block"></a>
              <h4 class="text-center"><?php echo $result->result[$i]->p_name; ?></h4>
              <h4 class="text-center" style="font-size:16px; font-weight: bold">$<?php echo $result->result[$i]->after_price; ?> <span style="text-decoration: line-through;font-size:14px; font-weight: normal">$<?php echo $result->result[0]->p_price; ?></span ></h4>

            </div>
          </div>
<?php 
}
?>

        </div>

        <div id="slider-control">
        <a class="left carousel-control" href="#itemslider" data-slide="prev"><img src="https://s12.postimg.org/uj3ffq90d/arrow_left.png" alt="Left" class="img-responsive"></a>
        <a class="right carousel-control" href="#itemslider" data-slide="next"><img src="https://s12.postimg.org/djuh0gxst/arrow_right.png" alt="Right" class="img-responsive"></a>
      </div>
      </div>
    </div>
  </div>
</div>

</div>

<?php 
	include('footer.php');
?>
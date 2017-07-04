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
    if(trim($_GET["id"]) != '') {
    $category_name["p_id"] = $_GET["id"];
$result = json_decode($products::selectProductsByCategoryCustomSelectByid($conn, $category_name));

//echo "<pre>";
//print_r($result);
//echo "</pre>";

}
?>
<div class="jumbotron ">
<div class="container">
  <p></p>
  </div>
</div>
<?php  if(isset($result->result)){ ?>
<div class="container">
<ol class="breadcrumb">
  <li><a href="index.php">Home</a></li>
  <li><a href="category.php?param=<?php echo $result->result[0]->p_category; ?>"><?php if(isset($result->result)){
	echo $result->result[0]->p_category;
}  ?></a></li>
  <li class="active"><?php  if(isset($result->result)){
	echo $result->result[0]->p_name;
}   ?></li>
</ol>
</div>

<div class="container" id="product-section">
  <div class="row">
   <div class="col-md-5">
	 	<img
	  	src="<?php echo $result->result[0]->p_image_id; ?>"
	  	alt="<?php echo $result->result[0]->p_name; ?>"
	 	 class="img-responsive"
	 	/>
	</div>
   <div class="col-md-7">
	 <div class="row">
	  <div class="col-md-12">
	   <h1><?php echo $result->result[0]->p_name; ?></h1>
	 </div>
	</div><!-- end row-->
	<div class="row">
	 <div class="col-md-12">
	  <span class="label label-primary"><?php echo $result->result[0]->p_category; ?></span> <b>Seller :</b> <?php echo " ".$result->result[0]->shop_name; ?>
	 </div>
	</div><!-- end row -->
	
	<div class="row">
 <div class="col-md-12 bottom-rule">
  <h2 class="product-price">$<?php echo $result->result[0]->after_price; ?><span>$<?php echo $result->result[0]->p_price; ?></span></h2> 
 </div>
</div><!-- end row -->

<div class="row add-to-cart">
 <div class="col-md-5 product-qty">
 Offer valid till: 
  <p id="demo"></p>
  <script type="text/javascript">
	// Set the date we're counting down to
var countDownDate = new Date("<?php echo date('M d, Y H:i:s', strtotime($result->result[0]->date_to)); ?>").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

    // Get todays date and time
    var now = new Date().getTime();
    
    // Find the distance between now an the count down date
    var distance = countDownDate - now;
    
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
    // Output the result in an element with id="demo"
    document.getElementById("demo").innerHTML = days + "d " + hours + "h "
    + minutes + "m " + seconds + "s ";
    
    // If the count down is over, write some text 
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("demo").innerHTML = "EXPIRED";
        document.getElementById("buy_now_outer").innerHTML = "OFFER ENDED";
    }
}, 1000);

</script>
 </div>
 <div class="col-md-4" id="buy_now_outer">
  <button class="btn btn-lg btn-brand btn-full-width btn-info " >
   Buy now
  </button>
 </div>
</div><!-- end row -->
<br><br>


<!-- Tab panes -->
<div class="tab-content">
 <div role="tabpanel" class="tab-pane active" id="description">
 <h3>Description</h3>
 <p class="top-10">
  <?php echo $result->result[0]->p_description; ?>
 </p>
 
</div>
 <div role="tabpanel" class="tab-pane top-10" id="features">
  ...
 </div>
 <div role="tabpanel" class="tab-pane" id="notes">
  ...
 </div>
 <div role="tabpanel" class="tab-pane" id="reviews">
  ...
 </div>
</div>
  </div><!-- end col -->
 </div><!-- end container -->
</div>
<?php } else{ ?>
<div class="container">
 <h1>No data found.</h1>
</div>
<?php } ?>
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
$result = json_decode($products::selectAllProductsCustomSelect($conn));
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
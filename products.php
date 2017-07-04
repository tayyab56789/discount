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
    if(trim($_GET["search"]) != '') {
    $category_name["search"] = $_GET["search"];
$result = json_decode($products::selectProductsBySearch($conn, $category_name));
//echo "<pre>";
//print_r($result);
//echo (count($result->result));
//echo "</pre>";

}

?>

<div class="jumbotron ">
<div class="container">
  <p></p>
  </div>
</div>
<div class="container">
<ol class="breadcrumb">
  <li><a href="index.php">Home</a></li>
  <li class="active" style="text-transform: capitalize;"><?php echo $_GET["search"]; ?></li>
  
</ol>
</div>
<div class="container">
  <div class="row" id="slider-text">
    <div class="col-md-6" >
      <h2 style="text-transform: uppercase;"><?php echo $_GET["search"]; ?></h2>
    </div>
  </div>
</div>
<div class="container">
        <?php 
if(isset($result->result))
for ($i=0; $i<count($result->result); $i++) {
?>
        <div class="col-sm-3">
            <article class="col-item">
                <div class="photo">
                    <div class="options-cart-round">
                        <a class="btn btn-default" title="View Product" href="detail.php?id=<?php echo $result->result[$i]->p_id; ?>">
                            <span class="fa fa-shopping-cart"></span>
                        </a>
                    </div>
                    <a href="detail.php?id=<?php echo $result->result[$i]->p_id; ?>"> <img src="<?php echo $result->result[$i]->p_image_id; ?>" /> </a>
                </div>
                <div class="info">
                    <div class="row">
                        <div class="price-details col-md-6">
                            <p class="details">
                                <?php echo $result->result[$i]->p_name; ?>
                            </p>
                            <h1 id="clock_<?php echo $i; ?>" style="color: red"></h1>
                            
                            <script type="text/javascript">


                                    // Set the date we're counting down to
                                var countDownDate_<?php echo $i; ?> = new Date("<?php echo date('M d, Y H:i:s', strtotime($result->result[$i]->date_to)); ?>").getTime();

                                // Update the count down every 1 second
                                var x = setInterval(function() {

                                    // Get todays date and time
                                    var now_<?php echo $i; ?> = new Date().getTime();
                                    
                                    // Find the distance between now an the count down date
                                    var distance_<?php echo $i; ?> = countDownDate_<?php echo $i; ?> - now_<?php echo $i; ?>;
                                    
                                    // Time calculations for days, hours, minutes and seconds
                                    var days_<?php echo $i; ?> = Math.floor(distance_<?php echo $i; ?> / (1000 * 60 * 60 * 24));
                                    var hours_<?php echo $i; ?> = Math.floor((distance_<?php echo $i; ?> % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                    var minutes_<?php echo $i; ?> = Math.floor((distance_<?php echo $i; ?> % (1000 * 60 * 60)) / (1000 * 60));
                                    var seconds_<?php echo $i; ?> = Math.floor((distance_<?php echo $i; ?> % (1000 * 60)) / 1000);
                                    
                                    document.getElementById("clock_<?php echo $i; ?>").innerHTML = days_<?php echo $i; ?> + "d " + hours_<?php echo $i; ?> + "h "
                                    + minutes_<?php echo $i; ?> + "m " + seconds_<?php echo $i; ?> + "s ";

                                    if (distance_<?php echo $i; ?> < 0) {
                                        //clearInterval(x);
                                        document.getElementById("clock_<?php echo $i; ?>").innerHTML = "EXPIRED";
                                    }
                                }, 1000);

                                </script>
                            <span class="price-new">$<?php echo $result->result[$i]->after_price; ?></span>
                        </div>
                    </div>
                </div>
            </article>
        </div>

<?php 
}
?>
</div>
<?php 
    include('footer.php');
?>
<?php  
    include('header.php');


?>
<div class="jumbotron ">
<div class="container">
  <p></p>
  </div>
</div>
<div class="container">
<ol class="breadcrumb">
  <li><a href="index.php">Home</a></li>
  <li class="active">Contact us</li>
</ol>
</div>

<div class="container">
	<div class="row-fluid">
        <div class="col-lg-10" id="map">
        	
    	</div>
    	
      	<div class="col-lg-2">
    		<h2>Ro's Torv</h2>
    		<address>
    			<strong>Ro's Torv 1</strong><br>
    			4000 Roskilde<br>
    			Denmark<br>
    			<a href="tel:+4546380680"> <abbr title="Phone"><i class="fa fa-phone-square" aria-hidden="true"></i></abbr> +45 46 38 06 80</a>
    		</address>
    	</div>
    </div>
</div>
<script>
          function initMap() {
            var uluru = {lat: 55.6416698, lng: 12.0990801};
            var map = new google.maps.Map(document.getElementById('map'), {
              zoom: 19,
              center: uluru
            });
            var marker = new google.maps.Marker({
              position: uluru,
              map: map
            });
          }
        </script>
        <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyACrHIITekJhL5B09ww8-3um0dFh-UcgUQ&callback=initMap">
        </script>
<?php 
    include('footer.php');



?>

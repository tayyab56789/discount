<?php 
    session_start();
    if(!isset($_SESSION["user_id"])) { 
        header('Location: index.php'); 
    }
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
    //$result = json_decode($products::selectAllProductsCustomSelect($conn));

?>

<!DOCTYPE html>
<html>

<head>
    <title></title>
    <?php include('library.php');  ?>
</head>

<body>

<nav class="navbar navbar-default nav-transparent navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><img src="assets/images/logo-black.png" width="70%"></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <!--<li class=""><a href="index.php">Home </a></li>-->
                    <li class=""><a href="about-us.php">About us </a></li>
                    <li><a href="contact-us.php">Contact us</a></li>
                    <?php if(!isset($_SESSION["user_id"])) { ?>
                    <li><a href="javascript:void(0);" data-toggle="modal" data-target="#loginModal">Login</a></li>
                    <?php } else{?>
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="logout.php">logout</a></li>

                    <?php } ?>
                </ul>
                
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
<br>
    <br>
    <br>
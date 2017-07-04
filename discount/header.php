<?php session_start(); ?>

<!DOCTYPE html>
<html>

<head>
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Open+Sans:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.structure.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.theme.css" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="assets/css/jquery.countdownTimer.css" />

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
                <ul class="nav navbar-nav navbar-right">

                    <li>
                        <form action="products.php" class="navbar-form navbar-left">
                            <div class="input-group">
                                <span class="input-group-btn">
							        <button class="btn btn-info" type="button" id="search-button"><i class="fa fa-search" aria-hidden="true"></i></button>
							      </span>
                                <input type="text" id="search" name="search" class="form-control" placeholder="Search" title="Search here...">
                            </div>
                            <!-- /input-group -->
                        </form>
                    </li>

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Modal -->
    <div class="modal fade" id="loginModal" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <form method="POST" action="">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <div class="text-center">
                            <img src="assets/images/logo-black.png">
                        </div>
                        <br>
                        <div class="input-group">
                            <span class="input-group-addon" id="sizing-addon2"><i class="fa fa-user" aria-hidden="true"></i></span>
                            <input type="text" name="login_username" id="login_username" class="form-control" placeholder="Username" aria-describedby="sizing-addon2">
                        </div>
                        <br>
                        <div class="input-group">
                            <span class="input-group-addon" id="sizing-addon2"><i class="fa fa-key" aria-hidden="true"></i></span>
                            <input type="password" name="login_password" id="login_password" class="form-control" placeholder="Password" aria-describedby="sizing-addon2">
                        </div>
                        <br>
                        <div class="text-center">
                            <input type="submit" value="Login" class="btn btn-info" name="button-login" id="button-login">
                            <button type="button" class="btn btn-default" data-dismiss="modal">cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

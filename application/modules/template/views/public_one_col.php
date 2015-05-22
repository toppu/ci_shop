<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="<?php echo base_url("favicon.ico"); ?>">
  <title>Jumbotron Template for Bootstrap</title>

  <!-- Bootstrap core CSS -->
  <link href="<?php echo base_url("/css/bootstrap.min.css"); ?>" rel="stylesheet">
  <link href="<?php echo base_url("/css/stylesheet.css"); ?>" rel="stylesheet">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body>


<div id="header">

  <div id="logo"> <img src="<?php echo base_url("/images/logo.png");?>"> <br>
    goldhammer
  </div>
  <div id="cart_summary">
    4 items, &euro;125 <button type="button" class="btn btn-primary">
      <span class="glyphicon glyphicon-shopping-cart"></span> View Basket</button>
    <br>
    <a href="#"> Crate New Account </a> |  <a href="#"> Sign In To Your Account </a>
  </div>
  <div id="search">
    <form class="navbar-form navbar-left" role="search">
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Search...">
      </div>
      <button type="submit" class="btn btn-default">Go!</button>
    </form>
  </div>

</div><!-- id /header-->

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">New Arrivals</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Jewelry <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Bracelets</a></li>
            <li><a href="#">Brooches</a></li>
            <li><a href="#">Charms</a></li>
            <li><a href="#">Chokers</a></li>
            <li><a href="#">Earrings</a></li>
            <li><a href="#">Rings</a></li>
            <li><a href="#">Kids & Baby</a></li>
            <li><a href="#">Man</a></li>
          </ul>
        </li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Watches <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
          </ul>
        </li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Handbags <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
          </ul>
        </li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Accessories <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
          </ul>
        </li>
        <li><a href="#">Sale</a></li>

      </ul>

    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>



<!-- Main jumbotron for a primary marketing message or call to action -->

<div class="container">
  <!-- Example row of columns -->
  <div class="row">
    <div class="col-md-12">

  <?php
  if (!isset($module)) {
    $module = $this->uri->segment(1);
  }

  if (!isset($view_file)) {
    $view_file = $this->uri->segment(2);
  }

  if(($module!="") && ($view_file!="")) {
    $path = $module."/".$view_file;
    $this->load->view($path);
  }
  ?>
    </div>
  </div>
</div>


<div class="container">
  <div class="row">
    <div class="col-md-12">
      <img src="<?php echo base_url('/images/recently_viewed.png'); ?>">
    </div>
  </div>
</div>
<br>

<div class="container">
  <!-- Example row of columns -->
  <div class="row">
    <div class="col-md-4">
      <ol class="list-unstyled">
      <h4>FIND US</h4>
      <li><a href="#">About Us</a></li>
      <li><a href="#">Special Pieces of Jewelry</a></li>
      </ol>
    </div>
    <div class="col-md-4">
      <ol class="list-unstyled">
        <h4>CONTACT US</h4>
        <li><a href="#">Store Location</a></li>
        <li><a href="#">Careers</a></li>
      </ol>
    </div>
    <div class="col-md-4">
      <ol class="list-unstyled">
        <h4>ONLINE SHOPPING GUIDE</h4>
        <li><a href="#">Customer Service</a></li>
        <li><a href="#">Shipping Information</a></li>
        <li><a href="#">Returns and Cancellations</a></li>
        <li><a href="#">Terms and Conditions</a></li>
        <li><a href="#">Privacy Policy</a></li>
      </ol>
    </div>
  </div>

  <hr>

  <footer>
    <p>&copy; goldhammer 2015</p>
  </footer>
</div> <!-- /container -->



<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="<?php echo base_url("/js/bootstrap.min.js"); ?>"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="<?php echo base_url("/js/ie10-viewport-bug-workaround.js"); ?>"></script>
</body>
</html>

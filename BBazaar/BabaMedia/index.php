<?php
session_start();
include('functions.php');
//get custom object
$customFun= new customFunctions();
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <!-- Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <title>Baba Media</title>
    <!-- Swiper's CSS -->
    <link rel="stylesheet" href="assets/vendors/swiper/css/swiper.css">
    <!--Custom CSS-->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/swiper.css">
    <!-- Sumo Select CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.sumoselect/3.0.2/sumoselect.min.css">
    <!-- SmartWizard CSS -->
    <link href="assets/vendors/smart-wizard/css/smart_wizard.css" rel="stylesheet" type="text/css" />
     <link href="assets/vendors/smart-wizard/css/smart_wizard_theme_arrows.css" rel="stylesheet" type="text/css" />
  </head>
  <body>
  <!-- NavBar -->
  <nav class="navbar navbar-expand-lg" style="background-color: #563d7c">
  <div class="container">
   <a class="navbar-brand" href="#">
    <img src="assets/images/logo.jpg" width="60" height="60" alt="Logo">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse customNav" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">About Us</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Our Clients</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Contact Us</a>
      </li>
    </ul>
  </div>
  </div>
  </nav>
  <!-- NavBar Ends -->
  <main class="" role="main">
  <!-- Header Section -->
  <section class="headerSectionClass" id="headerSectionID">
  	<div class="container">
  	<div class="row">
	  	<div class="col-sm-6 offset-sm-3 selectMediaClass">
	  	<p class="font-weight-normal text-center">Select Media You want to advertise In</p>
	  	<select class="custom-select" id="mediaSelect">
		  <option selected>Open this select menu</option>
      <?php
      $jsonMediaData = $customFun->getActiveMedia();
      $mediaData = json_decode($jsonMediaData, true);
      if($mediaData['rc'] == 1)
      {
      foreach ($mediaData['rd'] as $key => $value)
      {
      ?>

      <option value="<?php echo $value['ts_media_id'];?>"><?php echo $value['media'];?></option>

      <?php
      }

      }
      ?>
		</select>
		</div>
	</div>
	</div>
  </section>
  <!-- Header Section Ends-->
  <!-- Second Section -->
  <section class="secondSectionClass" id="secondSectionID">

    <div class="container py-5" id="smartWizardSection">

        <!-- Dynamic SmartWizard  html -->


    </div>
  
  </section>

  <!-- Second Section Ends-->
  <!-- Our Top Categories Section -->
  <section class="topCategorySectionClass jumbotron jumbotron-fluid text-center" id="topCategorySectionID">

      <div class="container">
      <h1 class="display-4 sectionTitle mb-5">Top Categories</h1>
        <div class="row justify-content-center">
            <div class="col-sm-4">
              <img src="assets/images/top-categories/business.png" alt="Our Top Categories" class="img-fluid border border-secondary">
            </div>
            <div class="col-sm-4 my-3 my-sm-0">
              <img src="assets/images/top-categories/education.png" alt="Our Top Categories" class="img-fluid border border-secondary">
            </div>
            <div class="col-sm-4">
              <img src="assets/images/top-categories/matrimonial.png" alt="Our Top Categories" class="img-fluid border border-secondary">
            </div>
        </div>
        <div class="row justify-content-center mt-sm-5">
            <div class="col-sm-4 my-3 my-sm-0">
              <img src="assets/images/top-categories/motor-vehicle.png" alt="Our Top Categories" class="img-fluid border border-secondary">
            </div>
            <div class="col-sm-4">
              <img src="assets/images/top-categories/recruitment.png" alt="Our Top Categories" class="img-fluid border border-secondary">
            </div>
            <div class="col-sm-4 mt-3 mt-sm-0">
              <img src="assets/images/top-categories/travel.png" alt="Our Top Categories" class="img-fluid border border-secondary">
            </div>
        </div>
        <div class="text-center lead mt-5">
          <a href="#" class="btn btn-outline-primary mb-3 mb-md-0 mr-md-3">All Categories</a>
        </div>
    </div>

  </section>
  <!-- Our Top Categories Section Ends-->
  <!-- About Us Section -->
  <section class="aboutUsSectionClass jumbotron jumbotron-fluid text-center" id="aboutUsSectionID">

    <div class="container">
      <div class="row align-items-center">
      <div class="col-6 mx-auto col-md-6 order-md-2">
        <img class="img-fluid mb-3 mb-md-0" src="assets/images/about-us-logo.png" alt="" width="1024" height="860">
      </div>
      <div class="col-md-6 order-md-1 text-center text-md-left pr-md-5">
        <h1 class="mb-3 bd-text-purple-bright">About Us</h1>
        <p class="lead">
          We are India's Online Advertisement Booking Service. You can book Classifies or Display Ads for all types of Media in India.
        </p>
        <p class="lead mb-4">
          Now you dont have to physically travel to the newspaper/representative office to release an ad. Nor you have to manually write ad messages on forms. You can do all this and more from the comforts of your home,office, or even while you are travelling. What's more, you can choose from a number of media options that suits your targeted audience profile, select the category that suits your ad. Go ahead, experience the easy, effortless way to publish an ad, now!
        </p>
        <div class="d-flex flex-column flex-md-row lead mb-3">
          <a href="#" class="btn btn-outline-primary mb-3 mb-md-0 mr-md-3">Read More</a>
        </div>
      </div>
      </div>
    </div>

  </section>
  <!-- About Us Section Ends-->

  <!-- Contact Us Section -->
  <section class="contactUsSectionClass jumbotron jumbotron-fluid text-center" id="contactUsSectionID">

    <div class="container">
      <i class="fa fa-phone text-center mx-auto d-block" aria-hidden="true"></i>
      <h3 class="text-center">Looking For Good Qality Work ?</h3>
      <p class="text-center lead text-muted">Talk To us Now - 0834-984-9883</p>
    </div>

  </section>
  <!-- Contact Us Section Ends-->

  <!-- Our Client Section -->
  <section class="ourClientSectionClass jumbotron jumbotron-fluid text-center" id="ourClientSectionID">
      
      <div class="container">
        <h1 class="display-4 sectionTitle">Clients</h1>
          <p class="lead">Here is the list of our Clients we work with. Our Clients are spread across all the geographies. And are happy with our portfolio and precise solution.</p>
        <div class="row justify-content-center">
            <div class="col-sm-3">
              <img src="assets/images/our-clients/client-1.png" alt="Our Client Logo" class="img-fluid">
            </div>
            <div class="col-sm-3 my-3 my-sm-0">
              <img src="assets/images/our-clients/client-2.png" alt="Our Client Logo" class="img-fluid">
            </div>
            <div class="col-sm-3">
              <img src="assets/images/our-clients/client-3.png" alt="Our Client Logo" class="img-fluid">
            </div>
            <div class="col-sm-3 my-3 my-sm-0">
              <img src="assets/images/our-clients/client-4.png" alt="Our Client Logo" class="img-fluid">
            </div>
        </div>
        <div class="row justify-content-center mt-sm-5">
            <div class="col-sm-3">
              <img src="assets/images/our-clients/client-5.png" alt="Our Client Logo" class="img-fluid">
            </div>
            <div class="col-sm-3 my-3 my-sm-0">
              <img src="assets/images/our-clients/client-6.png" alt="Our Client Logo" class="img-fluid">
            </div>
            <div class="col-sm-3">
              <img src="assets/images/our-clients/client-6.png" alt="Our Client Logo" class="img-fluid">
            </div>
            <div class="col-sm-3 mt-3 mt-sm-0">
              <img src="assets/images/our-clients/client-6.png" alt="Our Client Logo" class="img-fluid">
            </div>
        </div>
        <div class="text-center lead mt-5">
          <a href="#" class="btn btn-outline-primary mb-3 mb-md-0 mr-md-3">All Clients</a>
        </div>
      </div>

  </section>
  <!-- Our Client Section Ends-->

  </main>
<!-- Footer Section -->
  <footer>
      <div class="footercont" >
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 text-left">
                        <ul>
                            <li>Banglore Banglore</li>
                            <li><span> |</span></li>
                            <li><a href="Phone:+9191919199191">Phone:+9191919199191</a></li>
                            <li><span> |</span></li>
                            <li><a href="#">info@babamedia.com</a></li>
                        </ul>

                    </div>
                    <div class="col-lg-4 text-right">
                      <ul class="social-icon">
                          <li><a href="#" class="facebook"></a></li>
                          <li><a href="#" class="twitter"></a></li>
                          <li><a href="#" class="linkedin"></a></li>
                          <li><a href="#" class="googleplus"></a></li>
                          <li><a href="#" class="youtube"></a></li>
                        </ul>
                    </div>
              </div>
            </div>
       </div>
       <div class="footercopyright">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <ul>
                            <li>© 2019 Baba Media. All Rights Reserved.</li>
                            <li><span> |</span></li>
                            <li><a href="#">Terms of Use</a></li>
                            <li><span> |</span></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><span> |</span></li>
                            <li><a href="#">Sitemap</a></li>
                        </ul>
                    </div>
              </div>
            </div>
       </div>
</footer>
<!-- Footer Section Ends-->

    <!-- Libraries -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <!-- Swiper JS -->
    <script src="assets/vendors/swiper/js/swiper.js"></script>
    <!-- Sumo Select JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.sumoselect/3.0.2/jquery.sumoselect.min.js"></script>
    <!--JQuery Validate -->
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <!-- SmartWizard JS -->
    <script type="text/javascript" src="assets/vendors/smart-wizard/js/jquery.smartWizard.js"></script>
    <!-- Libraries Ends-->
    <!-- Some script here-->
    <script>
    $(document).ready(function(){
    //Hide second Div
    $('#secondSectionID').css('display','none');

      });
    </script>
  <!--Custom App Js-->
  <script src="assets/js/app.js"></script>
  </body>
</html>

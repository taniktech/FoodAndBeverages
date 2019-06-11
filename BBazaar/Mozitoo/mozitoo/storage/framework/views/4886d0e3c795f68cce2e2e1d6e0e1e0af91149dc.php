<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mozitoo</title>
    <!--Bootstrap and Other Vendors-->
    <link rel="stylesheet" href="<?php echo e(URL::to('src/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(URL::to('src/css/bootstrap-theme.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(URL::to('src/css/font-awesome.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(URL::to('src/vendors/bootstrap-select/css/bootstrap-select.min.css')); ?>" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(URL::to('src/vendors/bootstrap-fileinput/css/fileinput.min.css')); ?>" media="screen" />
    <!--jQuery Sumoselect CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(URL::to('src/vendors/jquery-sumoselect/css/sumoselect.css')); ?>"/>
    <!--Mechanic Styles-->
    <link rel="stylesheet" href="<?php echo e(URL::to('src/css/style.css')); ?>">

    <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
	<!-- Style Switch -->
   	<link rel="alternate stylesheet" type="text/css" href="<?php echo e(URL::to('src/css/skins/skin1.css')); ?>" title="skin1" media="screen" />
   	<link rel="alternate stylesheet" type="text/css" href="<?php echo e(URL::to('src/css/skins/skin2.css')); ?>" title="skin2" media="screen" />
   	<link rel="alternate stylesheet" type="text/css" href="<?php echo e(URL::to('src/css/skins/skin3.css')); ?>" title="skin3" media="screen" />
   	<link rel="alternate stylesheet" type="text/css" href="<?php echo e(URL::to('src/css/skins/skin4.css')); ?>" title="skin4" media="screen" />
   	<link rel="alternate stylesheet" type="text/css" href="<?php echo e(URL::to('src/css/skins/skin5.css')); ?>" title="skin5" media="screen" />
   	<link rel="alternate stylesheet" type="text/css" href="<?php echo e(URL::to('src/css/skins/skin6.css')); ?>" title="skin6" media="screen" />
   	<link rel="alternate stylesheet" type="text/css" href="<?php echo e(URL::to('src/css/skins/skin7.css')); ?>" title="skin7" media="screen" />

    <!--Light Skin-->
    <link rel="stylesheet" href="<?php echo e(URL::to('src/css/skins/style-light.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(URL::to('src/css/headers/header1.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(URL::to('src/css/headers/header2.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(URL::to('src/css/headers/header3.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(URL::to('src/css/headers/header4.css')); ?>">

    <!--Responsive Style-->
    <link rel="stylesheet" href="<?php echo e(URL::to('src/css/responsive.css')); ?>">
</head>
<body class="default">
    <!-- ================================================== -->



  <?php echo $__env->make('includes.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->yieldContent('submitnew'); ?>
  <?php echo $__env->make('includes.submitfooter', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>







    <!-- ================================================== -->
    <!--jQuery, Bootstrap and other vendor JS-->
<!--jQuery-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!--Bootstrap JS-->
<script src="<?php echo e(URL::to('src/js/bootstrap.min.js')); ?>"></script>

<!--Bootstrap Select-->
<script src="<?php echo e(URL::to('src/vendors/bootstrap-select/js/bootstrap-select.min.js')); ?>"></script>
<!--Bootstrap File Input-->
<script src="<?php echo e(URL::to('src/vendors/bootstrap-fileinput/js/fileinput.min.js')); ?>"></script>
<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
<!--Contact-->
<script src="<?php echo e(URL::to('src/js/jquery.form.js')); ?>"></script>
<script src="<?php echo e(URL::to('src/vendors/flexslider/jquery.flexslider-min.js')); ?>"></script>
<!--jQuery Steps-->
<script src="<?php echo e(URL::to('src/vendors/jquery-steps/jquery.steps.min.js')); ?>"></script>
<!--jQuery Sumoselect JS-->
<script src="<?php echo e(URL::to('src/vendors/jquery-sumoselect/js/jquery.sumoselect.js')); ?>"></script>
<!--Strella JS-->
<script src="<?php echo e(URL::to('src/js/estate-pro.js')); ?>"></script>
<script src="<?php echo e(URL::to('src/js/steps.js')); ?>"></script>
<script src="<?php echo e(URL::to('src/js/app.js')); ?>"></script>
<script>
  // This example displays an address form, using the autocomplete feature
  // of the Google Places API to help users fill in the information.

  // This example requires the Places library. Include the libraries=places
  // parameter when you first load the API. For example:
  // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

  var placeSearch, autocomplete;
  var componentForm = {
    street_number: 'short_name',
    route: 'long_name',
    locality: 'long_name',
    administrative_area_level_1: 'short_name',
    country: 'long_name',
    postal_code: 'short_name'
  };

  function initAutocomplete() {
    // Create the autocomplete object, restricting the search to geographical
    // location types.
    autocomplete = new google.maps.places.Autocomplete(
        /** @type  {!HTMLInputElement} */(document.getElementById('propertyLocality')),
        {types: ['geocode']});

    // When the user selects an address from the dropdown, populate the address
    // fields in the form.
    autocomplete.addListener('place_changed', fillInAddress);
  }

  function fillInAddress() {
    // Get the place details from the autocomplete object.
    var place = autocomplete.getPlace();
    var lat = place.geometry.location.lat(),
    lng = place.geometry.location.lng();
    // Then do whatever you want with them
      document.getElementById('inputLat').value = lat;
      document.getElementById('inputLng').value = lng;
  }

  // Bias the autocomplete object to the user's geographical location,
  // as supplied by the browser's 'navigator.geolocation' object.
  function geolocate() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
        var geolocation = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };
        var circle = new google.maps.Circle({
          center: geolocation,
          radius: position.coords.accuracy
        });
        autocomplete.setBounds(circle.getBounds());
      });
    }
  }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAt7SQhfY0th76s-6n_TQwN1KY1c3hnqa8&libraries=places&callback=initAutocomplete"
    async defer></script>
</body>
</html>

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
    <link rel="stylesheet" type="text/css" href="<?php echo e(URL::to('src/vendors/range-slider/css/bootstrap-slider.min.css')); ?>"/>

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
    <link rel="stylesheet" href="<?php echo e(URL::to('src/css/responsive5steps.css')); ?>">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="<?php echo e(URL::to('src/css/rentmgmtcard.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(URL::to('src/css/rentmgmtcard.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(URL::to('src/css/rentmgmt.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(URL::to('src/css/range-search.css')); ?>">
</head>
<body class="default">
    <!-- ================================================== -->



  <?php echo $__env->make('includes.header1', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <?php echo $__env->yieldContent('searchpage'); ?>







    <!-- ================================================== -->
    <!--jQuery, Bootstrap and other vendor JS-->
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!--Bootstrap JS-->
<script src="<?php echo e(URL::to('src/js/bootstrap.min.js')); ?>"></script>

<!--Bootstrap Select-->
<script src="<?php echo e(URL::to('src/vendors/bootstrap-select/js/bootstrap-select.min.js')); ?>"></script>
<script src="<?php echo e(URL::to('src/vendors/range-slider/js/bootstrap-slider.min.js')); ?>"></script>
<!--Strella JS-->
<script src="<?php echo e(URL::to('src/js/estate-pro.js')); ?>"></script>
<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
<script src="<?php echo e(URL::to('src/js/app.js')); ?>"></script>
<script src="<?php echo e(URL::to('src/js/sliderCustom.js')); ?>"></script>
<script src="<?php echo e(URL::to('src/js/search.js')); ?>"></script>
</body>
</html>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Mozitoo | Admin Dashboard</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="<?php echo e(URL::to('src/adminassets/css/bootstrap.min.css')); ?>" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="<?php echo e(URL::to('src/adminassets/css/animate.min.css')); ?>" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="<?php echo e(URL::to('src/adminassets/css/light-bootstrap-dashboard.css?v=1.4.0')); ?>" rel="stylesheet"/>
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="<?php echo e(URL::to('src/adminassets/css/demo.css')); ?>" rel="stylesheet" />
	<link href="<?php echo e(URL::to('src/adminassets/css/newcss.css')); ?>" rel="stylesheet" />

	<link rel="stylesheet" type="text/css" href="<?php echo e(URL::to('src/vendors/bootstrap-select/css/bootstrap-select.min.css')); ?>" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(URL::to('src/vendors/bootstrap-fileinput/css/fileinput.min.css')); ?>" media="screen" />
	<link rel="stylesheet" href="<?php echo e(URL::to('src/vendors/bootstrap-datepicker/css/bootstrap-datepicker.min.css')); ?>">
    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="<?php echo e(URL::to('src/adminassets/css/pe-icon-7-stroke.css')); ?>" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
</head>
<body>
<div class="wrapper">
    <?php echo $__env->yieldContent('admin'); ?>
		<?php echo $__env->yieldContent('requests'); ?>
		<?php echo $__env->yieldContent('pendingone'); ?>
		<?php echo $__env->yieldContent('adminproperties'); ?>
		<?php echo $__env->yieldContent('adminsubmitform'); ?>
		<?php echo $__env->yieldContent('servicerequests'); ?>
		<?php echo $__env->yieldContent('pendingoneservicerequest'); ?>
		<?php echo $__env->yieldContent('editedrequests'); ?>
		<?php echo $__env->yieldContent('alltenadmin'); ?>
		<?php echo $__env->yieldContent('adminpwd'); ?>
		<?php echo $__env->yieldContent('editedpendingone'); ?>
		<?php echo $__env->yieldContent('allagentadmin'); ?>
		<?php echo $__env->yieldContent('admin_prop_invnt'); ?>
		<?php echo $__env->yieldContent('admin_all_invnt'); ?>
		<?php echo $__env->yieldContent('admin_occ_invnt'); ?>
		<?php echo $__env->yieldContent('admin_unocc_invnt'); ?>
		<?php echo $__env->yieldContent('admin_one_invnt_details'); ?>
		<?php echo $__env->yieldContent('invoice_main_view'); ?>
		<?php echo $__env->yieldContent('bulk_invoice_generate'); ?>
		<?php echo $__env->yieldContent('admin_one_invoice_details'); ?>
		<?php echo $__env->yieldContent('admin_drafted_invoice'); ?>
		<?php echo $__env->yieldContent('custom_invoice_view'); ?>
</div>
  <!--   Core JS Files   -->
<script src="<?php echo e(URL::to('src/adminassets/js/jquery.3.2.1.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(URL::to('src/adminassets/js/bootstrap.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(URL::to('src/js/jquery.form.js')); ?>"></script>
<!--  Charts Plugin -->
<script src="<?php echo e(URL::to('src/adminassets/js/chartist.min.js')); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.js"></script>
<!--  Notifications Plugin    -->
<script src="<?php echo e(URL::to('src/adminassets/js/bootstrap-notify.js')); ?>"></script>
<script src="<?php echo e(URL::to('src/vendors/jquery-steps/jquery.steps.min.js')); ?>"></script>
<!--Bootstrap Select-->
<script src="<?php echo e(URL::to('src/vendors/bootstrap-select/js/bootstrap-select.min.js')); ?>"></script>
<!--Numeric Input Only-->
<script src="<?php echo e(URL::to('src/vendors/jquery-numeric/js/jquery.numeric.js')); ?>"></script>
<!--Bootstrap File Input-->
<script src="<?php echo e(URL::to('src/vendors/bootstrap-fileinput/js/fileinput.min.js')); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="<?php echo e(URL::to('src/adminassets/js/light-bootstrap-dashboard.js?v=1.4.0')); ?>"></script>
<script src="<?php echo e(URL::to('src/vendors/bootstrap-datepicker/js/bootstrap-datepicker.min.js')); ?>"></script>
<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
<script src="<?php echo e(URL::to('src/adminassets/js/demo.js')); ?>"></script>
<script src="<?php echo e(URL::to('src/adminassets/js/admin-pro.js')); ?>"></script>
<script src="<?php echo e(URL::to('src/adminassets/js/app.js')); ?>"></script>
<script src="<?php echo e(URL::to('src/adminassets/js/adminsteps.js')); ?>"></script>

</html>

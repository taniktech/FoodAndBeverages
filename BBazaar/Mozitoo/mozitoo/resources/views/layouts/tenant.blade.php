<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Mozitoo | Tenant Dashboard</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!-- Bootstrap core CSS     -->
    <link href="{{ URL::to('src/adminassets/css/bootstrap.min.css') }}" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="{{ URL::to('src/adminassets/css/animate.min.css') }}" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="{{ URL::to('src/adminassets/css/light-bootstrap-dashboard.css?v=1.4.0') }}" rel="stylesheet"/>
		<link rel="stylesheet" type="text/css" href="{{ URL::to('src/vendors/bootstrap-select/css/bootstrap-select.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ URL::to('src/vendors/bootstrap-fileinput/css/fileinput.min.css') }}" />
    <link rel="stylesheet" href="{{ URL::to('src/vendors/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="{{ URL::to('src/adminassets/css/pe-icon-7-stroke.css') }}" rel="stylesheet" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link href="{{ URL::to('src/adminassets/css/demo.css') }}" rel="stylesheet" />
    <link href="{{ URL::to('src/adminassets/css/newcss.css') }}" rel="stylesheet" />
    <!--jQuery Sumoselect CSS-->
	<link rel="stylesheet" type="text/css" href="{{ URL::to('src/vendors/jquery-sumoselect/css/sumoselect.css') }}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
</head>
<body>
<div class="wrapper">
		@yield('tenant')
		@yield('tenantproperties')
		@yield('pendingone')
		@yield('tenantserreqform')
		@yield('tenantpwd')
    @yield('tenantservicerequests')
    @yield('tenant_profile')
    @yield('ten_submit_prop')
    @yield('tenant_all_invoices')
    @yield('tenant_one_invnt_details')
    @yield('payment_options')
</div>
  <!--   Core JS Files   -->
<script src="{{ URL::to('src/adminassets/js/jquery.3.2.1.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::to('src/adminassets/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::to('src/js/jquery.form.js') }}"></script>
<!--  Charts Plugin -->
<script src="{{ URL::to('src/adminassets/js/chartist.min.js') }}"></script>
<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
<!--  Notifications Plugin    -->
<script src="{{ URL::to('src/adminassets/js/bootstrap-notify.js') }}"></script>
<script src="{{ URL::to('src/vendors/jquery-steps/jquery.steps.min.js') }}"></script>
<!--Bootstrap Select-->
<script src="{{ URL::to('src/vendors/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
<!--Bootstrap File Input-->
<script src="{{ URL::to('src/vendors/bootstrap-fileinput/js/fileinput.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="{{ URL::to('src/adminassets/js/light-bootstrap-dashboard.js?v=1.4.0') }}"></script>
<script src="{{ URL::to('src/vendors/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<!--jQuery Sumoselect JS-->
<script src="{{ URL::to('src/vendors/jquery-sumoselect/js/jquery.sumoselect.js') }}"></script>
<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
<script src="{{ URL::to('src/adminassets/js/demo.js') }}"></script>
<script src="{{ URL::to('src/adminassets/js/admin-pro.js') }}"></script>
<script src="{{ URL::to('src/adminassets/js/app.js') }}"></script>
<script src="{{ URL::to('src/adminassets/js/tenantsteps.js') }}"></script>

</html>

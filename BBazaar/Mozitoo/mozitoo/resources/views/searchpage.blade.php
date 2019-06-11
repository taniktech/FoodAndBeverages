@extends('layouts.search')
@section('searchpage')
<!--Content Area Begin-->

@if($propertyCount == true)
<div class="container">
<div class="row">
<div class="col-sm-12 col-md-3 col-md-offset-1 bod" id="fix">
	<h3 class="heading"> F<u>ilte</u>r</h3>
	<form name='myform'>
	<div class="row pad">
	<input type='reset'  class="rset" value='Reset' name='reset' id="set">
	</div>
	<div class="row pad colours">
		<label class="lab"> Apartment Type: </label><br>
		<span class="pad"><input type="checkbox" class="flsearch" name="at" data-value="1" data-type="at" value="1"> 1BHK</input></span>
		<span class="pad"><input type="checkbox" class="flsearch" name="at" data-value="2" data-type="at" value="2"> 2BHK</input></span>
		<span class="pad"><input type="checkbox" class="flsearch" name="at" data-value="3" data-type="at" value="3"> 3BHK</input></span><br>
	</div>
	<!-- <div class="row pad">
	<span class="pad"><label class="lab">Rent Range(per month)</label></span>
	<input id="ex6" type="text" data-slider-min="0" data-slider-max="20000" data-slider-step="1" data-slider-value="0"/><br>
	<span id="ex6CurrentSliderValLabel">Price range: ₹ <span id="ex6SliderVal">0</span></span>
	</div> -->
  <div class="row pad colours">
	  <label class="lab"> Preferred Tenants: </label><br>
	  <span class="pad"><input type="checkbox" class="flsearch1" name="pt" data-value="1" data-type="pt" value="1"> Family</input></span>
	  <span class="pad"><input type="checkbox" class="flsearch1" name="pt" data-value="2" data-type="pt" value="2"> Bachelor's</input></span>
	  <span class="pad"><input type="checkbox" class="flsearch1" name="pt" data-value="4" data-type="pt" value="4"> Any</input></span><br>
	</div>
	<div class="row pad">
	  <label class="lab"> Furnishing: </label><br>
	  <span class="pad"><input type="checkbox" class="flsearch2" name="ft" data-value="3" data-type="ft"> Full</input></span>
	  <span class="pad"><input type="checkbox" class="flsearch2" name="ft" data-value="2" data-type="ft"> Semi</input></span>
	  <span class="pad"><input type="checkbox" class="flsearch2" name="ft" data-value="1" data-type="ft"> No</input></span><br>
	</div>
  </form>
</div>
<div class="col-sm-12 col-md-6 col-md-offset-5 listing_list">
			<div id="mainSearch">
				<div id="defaultSearch">
			@foreach($tsSubmittedProperties as $tsSubmittedProperty)
    	<div class="info_content row">
        <div class="col-sm-6 p0 imageRow">
					@if (Storage::disk('public_uploads')->has($tsSubmittedProperty->prop_id.'.jpg'))
						<img src="{{ route('prop.image', ['filename' => $tsSubmittedProperty->prop_id.'.jpg']) }}" alt="..." class="img-responsive"/>
					@else
					<img src="{{ route('prop.image', ['filename' => 'default.jpg']) }}" alt="" class="img-responsive">
					@endif
        </div>
        <div class="col-sm-6 p0 description">
            <div class="row m0 priceRow">
							 <div class="saleTag fleft">{{$tsSubmittedProperty->furnishFUn->prop_furnish_status}}</div>
                <div class="price fleft">Rs. {{$tsSubmittedProperty->prop_morp}}</div>
            </div>
						<a href="{{route('property_details',['prop_id'=>$tsSubmittedProperty->prop_id])}}" class="location_link"><h4 class="location">{{$tsSubmittedProperty->prop_locality}}</h4></a>
						<a href="{{route('property_details',['prop_id'=>$tsSubmittedProperty->prop_id])}}" class="specify_btn"><i class="fa fa-arrows-alt"></i>{{$tsSubmittedProperty->prop_area}} Sq Ft</a>
						<a href="{{route('property_details',['prop_id'=>$tsSubmittedProperty->prop_id])}}" class="specify_btn"><i class="fa fa-inbox"></i>{{$tsSubmittedProperty->prop_bed}} bedroom</a>
        </div>
    	</div>
			<br>
		@endforeach
    </div> <!--List Listing-->
</div>
</div>
</div>
</div>
	@else
	<div class="container" style="padding-bottom:50px;text-align:center">
 	<h3 class="section_title mozi" style="padding-bottom:20px">Alert</h3>
	<div class="item active">
		<p>“Apologies, we don't service in {{$location}} currently.”</P>
	</div>
	</div>
	@endif
<!--Content Area End-->
<script>
var UrlSearchCustom = '{{route('customsearch')}}';
var UrlSearchCustom1 = '{{route('customsearch1')}}';
var UrlSearchCustom2 = '{{route('customsearch2')}}';
</script>
<script>
var token = '{{Session::token()}}';
var urlSignIn = '{{route('dosignin')}}';
var urlSignUp = '{{route('dosignup')}}';
</script>
<!--jQuery-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>

$(document).ready(function() {
        $(window).on("scroll", function() {
            var wn = $(window).scrollTop();
            if (wn > 10) {
                $(".topHeader").hide();
                $(".navbar").addClass("navbar-fixed-top");
								$("#fix").css({'margin-top':'100px'});

            } else {
                $(".topHeader").show();
                $(".navbar").removeClass("navbar-fixed-top");
								$("#fix").css({'margin-top':'10px'});
            }

        });
				$("#myform")[0].reset();
    });
</script>
@endsection

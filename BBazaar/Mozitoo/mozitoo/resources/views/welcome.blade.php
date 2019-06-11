@extends('layouts.master')
@section('welcomepage')
<!--Content Area Begin-->
<section id="slider" class="row">
         <div id="banner" >
        <div class="banner-image img-responsive" data-speed="2" data-type="background" style="margin-top: -73px;z-index: -10">
		</div>
      <div class="container-fluid">
			<div class="center-search-bar" id="searchresp1">
        <form id="dektopPropSearch" class="js_apt_search horizontal-form right-border-fix" style="position:relative;">
					<div class="form-item field-location">
						<input class="form-control no-right-radius" name="req_location" id="LocationSelect" placeholder="&#xf041; Enter locality or landmark in Bangalore" style="font-family:Arial, FontAwesome">
            <label id="locationNotSelected" style="color:black;"></label>
          </div><!--.field-location-->
					<div class="form-item left-border-fix">
              <button id="SearchBtn" class="btn btn-submit" type="submit" style="color:white;">Search</button>
					</div>
          <div class="row" style="display:none">
            <div class="form-group col-md-4">
              <label for="inputLat">Lat</label>
              <input type="text" class="form-control" name="inputLat" id="inputLat">
            </div>
            <div class="form-group col-md-4">
              <label for="inputLng">Long</label>
              <input type="text" class="form-control" name="inputLng" id="inputLng">
            </div>
          </div>
				</form>
			</div>
			<div id="searchresp2">
      <form class="form-inline" id="mobilePropSearch">
      <div class="form-group mx-sm-3">
        <input type="text" class="form-control" id="LocationSelect1" placeholder="Enter Your Location">
        <label id="locationNotSelected1" style="color:black;"></label>
      </div>
      <div class="row" style="display:none">
        <div class="form-group col-md-4">
          <label for="inputLat1">Lat</label>
          <input type="text" class="form-control" name="inputLat1" id="inputLat1">
        </div>
        <div class="form-group col-md-4">
          <label for="inputLng1">Long</label>
          <input type="text" class="form-control" name="inputLng1" id="inputLng1">
        </div>
      </div>
      <button type="submit" class="btn btn-danger">Search</button>
      </form>
    </div>
</section> <!--Slider End-->
<section class="row pt70">
    <div class="container">
        <h2 class="section_title main">Mozitoo Services</h2>
        <div class="row text-center">
            <div class="col-sm-3 col-lg-offset-1 service_block mar">
                <div class="row m0 inner">
                    <div class="row m0 block_title">Property Management Service </div>
                    <div class="row m0 block_icon"><i class="fa fa-home"></i></div>
                    <a href="{{route('marketingrenting')}}" class="read_more">+ read more</a>
                </div>
            </div>
            <div class="col-sm-3 service_block">
                <div class="row m0 inner">
                    <div class="row m0 block_title">Free Rental price Analysis</div>
                    <div class="row m0 block_icon"><i class="fa fa-line-chart"></i></div>
                    <a href="{{route('freerentpriceanlys')}}" class="read_more">+ read more</a>
                </div>
            </div>
            <div class="col-sm-3 service_block">
                <div class="row m0 inner">
                    <div class="row m0 block_title">Rent management platform</div>
                    <div class="row m0 block_icon"><i class="fa fa-ticket"></i></div>
                    <a href="{{route('rentmanagement')}}" class="read_more">+ read more</a>
                </div>
            </div>
        </div>
    </div>
</section>

@if($propertyCount == true)
<section class="row pt70">
    <div class="container">
        <h2 class="section_title">Recent Listing</h2>
        <div class="row">
            @foreach($tsSubmittedProperties as $tsSubmittedProperty)
              <div class="col-sm-4 listing_grid">
                  <div class="info_content row">
                      <div class="row m0 imageRow">
                        @if (Storage::disk('public_uploads')->has($tsSubmittedProperty->prop_id.'.jpg'))
                          <img src="{{ route('prop.image', ['filename' => $tsSubmittedProperty->prop_id.'.jpg']) }}" alt="..." class="img-responsive"/>
                        @else
                        <img src="{{ route('prop.image', ['filename' => 'default.jpg']) }}" alt="" class="img-responsive">
                        @endif
                          <div class="saleTag"> {{$tsSubmittedProperty->furnishFUn->prop_furnish_status}}</div>
                      </div>
                      <div class="row m0 description">
                          <div class="row m0 priceRow">
                              <div class="price fleft">Rs. {{$tsSubmittedProperty->prop_morp}}</div>
                              <i class="fa fa-file-text-o"></i>
                          </div>
                          <a href="{{route('property_details',['prop_id'=>$tsSubmittedProperty->prop_id])}}" class="location_link"><h4 class="location">{{$tsSubmittedProperty->prop_locality}}</h4></a>
                          <a href="{{route('property_details',['prop_id'=>$tsSubmittedProperty->prop_id])}}" class="specify_btn"><i class="fa fa-arrows-alt"></i>{{$tsSubmittedProperty->prop_area}} Sq Ft</a>
                          <a href="{{route('property_details',['prop_id'=>$tsSubmittedProperty->prop_id])}}" class="specify_btn"><i class="fa fa-inbox"></i>{{$tsSubmittedProperty->prop_bed}} bedroom</a>
                      </div>
                  </div>
              </div> <!--Grid Listing-->
            @endforeach
          </div>
    </div>
</section> <!--Listing -->
    @endif
<!-- 5 steps -->
<section class="ease-section-wrap" id="sec7">
		<div class="process-head" style="position: relative;width:960px;margin:0 auto;min-height:600px">
		<h1 class="section_title" style="text-align:center">Start Renting out in 5 steps </h1>
			<div class="ease-wrap">
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="500" width="450" style="position: absolute;left: 240px;top: 0px;">
					<path d="M5, 0
							L5, 40
							A30,30 0 0,0 35,70
							L370, 70
							A30,30 0 0,1 400,100
							L400, 100
							 " stroke="#aaa" stroke-width="5" stroke-linecap="round" stroke-dasharray="1, 15" fill="none">
					</path>
					<path d="M400, 100
							L400, 150
							A30,30 0 0,1 360,180
							L40, 180
							A30,30 0 0,0 5,210
							L5, 260
							 " stroke="#aaa" stroke-width="5" stroke-linecap="round" stroke-dasharray="1, 15" fill="none">
					</path>
					<path d="M5, 260
							L5, 260
							A30,30 0 0,0 25,290
							L380, 290
							A30,30 0 0,1 410,320
							L410, 370
							 " stroke="#aaa" stroke-width="5" stroke-linecap="round" stroke-dasharray="1, 15" fill="none">
					</path>
					<path d="M410, 370
							L410, 370
							A30,30 0 0,1 370,400
							L40, 400
							A30,30 0 0,0 5,430
							L5, 460
							 " stroke="#aaa" stroke-width="5" stroke-linecap="round" stroke-dasharray="1, 15" fill="none">
					</path>
				</svg>
				<div class="ease-step-wrap" style="position: absolute;left: 240px;top: -10px;">
					<div class="img-circle send">
						<span class="orange-circle">1</span>
					</div>
					<div class="ease-step-text">
						<h4>STEP 1</h4>
						<p>Submit your property details.</p>
					</div>
				</div>
				<div class="ease-step-wrap right" style="position: absolute;right: 330px;top: 95px;">
					<div class="img-circle thumb">
						<span class="orange-circle">2</span>
					</div>
					<div class="ease-step-text">
						<h4>STEP 2</h4>
						<p>We will verify the property and document details.</p>
					</div>
				</div>
				<div class="ease-step-wrap" style="position: absolute;left: 240px;top: 190px;">
					<div class="img-circle pen">
						<span class="orange-circle">3</span>
					</div>
					<div class="ease-step-text">
						<h4>STEP 3</h4>
						<p>Agreement sign-up.</p>
					</div>
				</div>
				<div class="ease-step-wrap right" style="position: absolute;right: 330px;top: 320px;">
					<div class="img-circle rupee">
						<span class="orange-circle">4</span>
					</div>
					<div class="ease-step-text">
						<h4>STEP 4</h4>
						<p>We do furniture and appliance furnishing of your property.</p>
					</div>
				</div>
				<div class="ease-step-wrap" style="position: absolute;left: 240px;top: 420px;">
					<div class="img-circle home">
						<span class="orange-circle">5</span>
					</div>
					<div class="ease-step-text">
						<h4>STEP 5</h4>
						<p>First instalment of security deposit will be transferred.</p>
					</div>
				</div>
			</div>
		</div>

	</section>
	 <section class="ease-section-wrap" id="sec6">
		<div class="process-head" style="position: relative;margin:15px;min-height:665px">
		<h1 class="section_title" style="text-align:center">Start Renting out in 5 steps </h1>
			<div class="ease-wrap">
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="550" width="70%" style="position: absolute;left: 70px;top: 0px;">
					<path d="M5, 0
							L5, 460

							 " stroke="#aaa" stroke-width="5" stroke-linecap="round" stroke-dasharray="1, 15" fill="none">
					</path>
				</svg>
				<div class="ease-step-wrap" style="position: absolute;left: 55px;top: -10px;width:70%">
					<div class="img-circle send">
						<span class="orange-circle">1</span>
					</div>
					<div class="ease-step-text">
						<h4>STEP 1</h4>
						<p>Submit your property details.</p>
					</div>
				</div>
				<div class="ease-step-wrap" style="position: absolute;left: 55px;top: 95px;width:70%">
					<div class="img-circle thumb">
						<span class="orange-circle">2</span>
					</div>
					<div class="ease-step-text">
						<h4>STEP 2</h4>
						<p>We will verify the property <br> and document details.</p>
					</div>
				</div>
				<div class="ease-step-wrap" style="position: absolute;left: 55px;top: 200px;width:70%">
					<div class="img-circle pen">
						<span class="orange-circle">3</span>
					</div>
					<div class="ease-step-text">
						<h4>STEP 3</h4>
						<p>Agreement sign-up.</p>
					</div>
				</div>
				<div class="ease-step-wrap" style="position: absolute;left: 55px;top: 280px;width:70%">
					<div class="img-circle rupee">
						<span class="orange-circle">4</span>
					</div>
					<div class="ease-step-text">
						<h4>STEP 4</h4>
						<p>We do furniture and appliance <br>furnishing of your property.</p>
					</div>
				</div>
				<div class="ease-step-wrap" style="position: absolute;left: 55px;top: 420px;width:70%">
					<div class="img-circle home">
						<span class="orange-circle">5</span>
					</div>
					<div class="ease-step-text">
						<h4>STEP 5</h4>
						<p>First instalment of security <br> deposit will be transferred.</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	 <div class="container" style="padding-bottom:50px;text-align:center">
  <h3 class="section_title mozi" style="padding-bottom:20px">TESTIMONIALS</h3>
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators" >
      <li data-target="#myCarousel" data-slide-to="0" class="active" style="background-color:rgba(48, 59, 78,0.7);"></li>
      <li data-target="#myCarousel" data-slide-to="1" style="background-color:rgba(48, 59, 78,0.7);"></li>
      <li data-target="#myCarousel" data-slide-to="2" style="background-color:rgba(48, 59, 78,0.7);"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <div class="item active">
        <p>“I found my current Flat on Mozitoo with extraordinary help from them and totally satisfied with the choice I made. All I had to do was to tell what I was looking for and I got back property suggestions nearly exact to my imagination. Among those, I finally chose mine now then completed procedure at ease. Highly recommend Mozitoo for your search.”</P>
          <p>Nikhil Vats</p>
           <p> <i>Happy Client of January</i></P>
      </div>

      <div class="item">
        <p>“I found my current Flat on Mozitoo with extraordinary help from them and totally satisfied with the choice I made. All I had to do was to tell what I was looking for and I got back property suggestions nearly exact to my imagination. Among those, I finally chose mine now then completed procedure at ease. Highly recommend Mozitoo for your search.”</P>
		<p>Lalitha Valeti</p>
          <p><i>Happy Client of February</i></p>
      </div>

      <div class="item">
	  <p>“I found my current Flat on Mozitoo with extraordinary help from them and totally satisfied with the choice I made. All I had to do was to tell what I was looking for and I got back property suggestions nearly exact to my imagination. Among those, I finally chose mine now then completed procedure at ease. Highly recommend Mozitoo for your search.”</P>
		<p>Vibhakar Sharma</p>
          <p><i>Happy Client of March</i></p>
      </div>
    </div>
  </div>
</div>
  <!-- 5 steps ends-->
<!--Content Area End-->
<!--jQuery-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
        /** @type {!HTMLInputElement} */(document.getElementById('LocationSelect')),
        {types: ['geocode']});
    autocomplete1 = new google.maps.places.Autocomplete(
        /** @type {!HTMLInputElement} */(document.getElementById('LocationSelect1')),
        {types: ['geocode']});

    // When the user selects an address from the dropdown, populate the address
    // fields in the form.
    //For desktop call fillInAddress function
    autocomplete.addListener('place_changed', fillInAddress);
    //For mobile call fillInAddress1 function
    autocomplete1.addListener('place_changed', fillInAddress1);
  }
  //For desktop search form
  function fillInAddress() {
    // Get the place details from the autocomplete object.
      var place = autocomplete.getPlace();
      var lat = place.geometry.location.lat(),
      lng = place.geometry.location.lng();
      // Then do whatever you want with them
      document.getElementById('inputLat').value = lat;
      document.getElementById('inputLng').value = lng;

  }
  // For Mobile Search form
  function fillInAddress1() {
    // Get the place details from the autocomplete object.
      var place1 = autocomplete1.getPlace();
      var lat = place1.geometry.location.lat(),
      lng = place1.geometry.location.lng();
      // Then do whatever you want with them
      document.getElementById('inputLat1').value = lat;
      document.getElementById('inputLng1').value = lng;

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
        autocomplete1.setBounds(circle.getBounds());
      });
    }
  }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAt7SQhfY0th76s-6n_TQwN1KY1c3hnqa8&libraries=places&callback=initAutocomplete"
    async defer></script>
<script>
$(document).ready(function(){

  $("#dektopPropSearch")[0].reset();
  $("#mobilePropSearch")[0].reset();
});


</script>
@endsection

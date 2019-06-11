@extends('layouts.admin')
@section('adminsubmitform')
@section('active2')
    class="active"
@endsection
@include('includes.adminheader')
<div class="main-panel">
  @section('DashboardSiteMap')
      Admin Dashboard / Add new property
  @endsection
@include('includes.adminnav')
      <div class="content">
        <div class="container-fluid">
          <div class="row">
              <div class="col-md-12">
                  <div class="card">
                      <div class="header" style="padding-bottom:20px;">
                          <h4 class="title">Add new Properties</h4>
                          <p class="category">You can add property on behalf of agent/owner.</p>
                      </div>
                    </div>
                    </div>
          </div>
          <section class="row contentRow submit_property">
                  <form id="submit_property_form" class="row" enctype="multipart/form-data">
                    <h4 class="form_heading">Property Informations</h4>
                    <fieldset class="field1">
                      <div class="form-group">
                      <label for="inputTenant">Tenant Preferences</label>
                      <select name="inputTenant" id="inputTenant" class="form-control">
                      <optgroup label="Tenants">
                        <option class="ignore" value="">Select...</option>
                        <option value="1">Family</option>
                        <option value="2">Bachelors</option>
                        <option value="3">Both, Family & Bachelors</option>
                        <option value="4">No Choice</option>
                      </optgroup>
                      </select>
                      </div>
                        <div class="form-group property_title">
                            <label for="property_title">Property Title</label>
                            <input type="text" class="form-control" name="property_title" id="property_title" >
                        </div>
                        <div class="form-group property_desc">
                            <label for="property_desc">Property Description (* Please specify the vastu)</label>
                            <textarea name="property_desc" id="property_desc" class="form-control"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="property_type">Property Type</label>
                                    <select name="property_type" id="property_type" class="form-control">
                                      <optgroup label="Property Type">
                                      <option class="ignore" value="">Select...</option>
                                      <option value="1">Home</option>
                                      <option value="2">Restrurent</option>
                                      </optgroup>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group property_rent">
                                    <label for="property_rent">Expected Rent ( Incl. maintainace)</label>
                                    <input class="form-control" name="property_rent" id="property_rent" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group beds">
                                    <label for="property_beds">Total Beds</label>
                                    <input class="form-control" name="property_beds" id="property_beds" type="text">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group baths">
                                    <label for="property_baths">Bathrooms</label>
                                    <input class="form-control" name="property_baths" id="property_baths" type="text">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group area">
                                    <label for="property_area">Area ( In Sq.ft )</label>
                                    <input class="form-control" name="property_area" id="property_area" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-4">
                              <div class="form-group age">
                                  <label for="property_age">Age of property ( In Months )</label>
                                  <input type="text" name="property_age" id="property_age" class="form-control">
                              </div>
                          </div>

                            <div class="col-sm-4">
                              <div class="form-group furnishing">
                                  <label for="property_furnishing_status">Furnishing status</label>
                                  <select name="property_furnishing_status" id="property_furnishing_status" class="form-control">
                                    <optgroup label="Furnishing status">
                                    <option class="ignore" value="">Select...</option>
                                    <option value="1">Not furnished</option>
                                    <option value="2">Semi furnished</option>
                                    <option value="3">Fully furnished</option>
                                    </optgroup>
                                  </select>
                              </div>
                            </div>

                            <div class="col-sm-4" id="ageFurn">
                                <div class="form-group furnitureage">
                                    <label for="property_furnishing_age">Age of furniture</label>
                                    <input type="text" name="" id="property_furnishing_age" class="form-control">
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <h4 class="form_heading">Add Photo Gallery</h4>
                    <fieldset class="field2">
                    <input id="add_photo_gallery" name="add_photo_gallery" class="file" type="file" data-min-file-count="1" data-show-upload="false">
                    </fieldset>
                    <h4 class="form_heading">Property full address</h4>
                    <fieldset class="field3">
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group property_address_line1">
                                  <label for="addressline1">Address Line 1</label>
                                  <input type="text" class="form-control" name="addressline1" id="addressline1">
                              </div>
                              </div>
                          </div>
                              <div class="row">
                                  <div class="col-sm-6">
                                      <div class="form-group property_address_locality">
                                          <label for="inputLocality">Locality</label>
                                          <input type="text" name="inputLocality" id="inputLocality" class="form-control">
                                          <label id="locationNotSelected"></label>
                                      </div>
                                  </div>
                                  <div class="col-sm-6">
                                      <div class="form-group inputCity">
                                          <label for="inputCity">City/District/Town</label>
                                          <input type="text" name="inputCity" id="inputCity" class="form-control">
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-sm-6">
                                      <div class="form-group property_address_pincode">
                                          <label for="inputPincode">Pincode</label>
                                          <input type="text" name="inputPincode" id="inputPincode" class="form-control">
                                      </div>
                                  </div>
                                  <div class="col-sm-6">
                                      <div class="form-group property_address_state">
                                          <label >State</label>
                                          <input type="text" name="inputState" id="inputState" class="form-control">
                                      </div>
                                  </div>
                              </div>
                              <div class="row" style="display:none">
                                <div class="form-group col-md-4">
                                  <label for="inputLat">Lat</label>
                                  <input type="text" class="form-control" name="inputLat" id="inputLat" value="0">
                                </div>
                                <div class="form-group col-md-4">
                                  <label for="inputLng">Long</label>
                                  <input type="text" class="form-control" name="inputLng" id="inputLng" value="0">
                                </div>
                                </div>
                    </fieldset>
                    <h4 class="form_heading">Amenities</h4>
                    <fieldset class="field4">
                      @if($propertyAmenty==true)
                      @foreach($msPropertyAmenties as $msPropertyAmenty)
                        <div class="fleft checkbox_div">
                            <input type="checkbox" class="amenityBoxes" id="amenity{{$msPropertyAmenty->prop_amenty_id}}" value="{{$msPropertyAmenty->prop_amenty_id}}">
                            <label for="amenity{{$msPropertyAmenty->prop_amenty_id}}">{{$msPropertyAmenty->prop_amenty_name}}</label>
                        </div> <!--checkbox-->
                        @endforeach
                        @endif
                    </fieldset>
                      <h4 class="form_heading">Owner Info</h4>
                      <fieldset class="field5">
                          <div class="form-group user_type type_switch">
                              <input type="checkbox" name="user_type" id="user_type" value="0">
                              <label for="user_type" class="switch">
                                  <span class="new_user switch_left">New user</span>
                                  <span class="indicator"><span class="switch_dot"></span></span>
                                  <span class="existing_user switch_right">Existing user</span>
                              </label>
                          </div>
                          <div class="user_forms">
                              <div class="row m0 new_user_form show">
                                  <div class="form-group new_user_name">
                                      <label for="new_user_name">Full Name</label>
                                      <input type="text" class="form-control" name="new_user_name" id="new_user_name">
                                  </div>
                                  <div class="row">
                                      <div class="col-sm-6">
                                          <div class="form-group new_user_email">
                                              <label for="new_user_email">Email Address</label>
                                              <input type="email" name="new_user_email" id="new_user_email" class="form-control">
                                              <label for="new_user_email" id="new_user_email_err"></label>
                                          </div>
                                      </div>
                                      <div class="col-sm-6">
                                          <div class="form-group new_user_mobile">
                                              <label for="new_user_mobile">Phone Number</label>
                                              <input type="text" name="new_user_mobile" id="new_user_mobile" class="form-control">
                                              <label for="new_user_mobile" id="new_user_mobile_err"></label>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-sm-6">
                                          <div class="form-group new_user_pwd">
                                              <label for="new_user_pwd">Password</label>
                                              <input type="password" name="new_user_pwd" id="new_user_pwd" class="form-control">
                                          </div>
                                      </div>
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                        <label for="inputManager">Register as</label>
                                        <select class="selectpicker form-control" name="inputManager" id="inputManager">
                                        <optgroup label="Preference">
                                          <option value="">Select...</option>
                                          <option value="3">Owner</option>
                                          <option value="4">Agent</option>
                                        </optgroup>
                                        </select>
                                        </div>
                                      </div>
                                  </div>
                              </div> <!--New User Form-->
                              <div class="row m0 existing_user_form hide">
                                  <div class="row">
                                      <div class="col-sm-6">
                                          <div class="form-group user_email formerror">
                                              <label for="user_email">Email Address</label>
                                              <input type="email" class="form-control" name="user_email" id="user_email">
                                              <label for="user_email" id="user_email_err"></label>
                                          </div>
                                      </div>
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="inputManagerLogin">Login as</label>
                                    <select class="selectpicker form-control" name="inputManagerLogin" id="inputManagerLogin">
                                    <optgroup label="Preference">
                                      <option value="">Select...</option>
                                      <option value="3">Owner</option>
                                      <option value="4">Agent</option>
                                    </optgroup>
                                    </select>
                                    </div>
                                  </div>
                                  <!-- <div class="forgot_password row m0">
                                      <a href="#">Forgot Your Password?</a>
                                  </div> -->
                              </div> <!--Existing User Form-->
                          </div>
                          <input type="checkbox" name="user_type_val" id="user_type_val" value="1" hidden>
                      </fieldset>
                  </form>
          </section>
          <!--Content Area End-->
        </div>
    </div>
@include('includes.adminfooter')
    </div>
    <script>
    var token = '{{Session::token()}}';
    var adminsubmitnewform = '{{route('admin.submitnewform')}}';
    var adminsubmitnewformone = '{{route('admin.submitnewformone')}}';
    </script>
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
            /** @type {!HTMLInputElement} */(document.getElementById('inputLocality')),
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
@endsection

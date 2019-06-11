@extends('layouts.admin')
@section('pendingone')
@section('active')
    class="active"
@endsection
@include('includes.adminheader')
<div class="main-panel">
  @section('DashboardSiteMap')
  Admin Dashboard / Pending Requests / Review
  @endsection
@include('includes.adminnav')
<div class="content">
  <div class="container-fluid">
      <div class="row">
        <div class="col-md-4" id="mobile-top">
          <div class="card card-user">
            @if (Storage::disk('public_uploads')->has($one_prop->prop_id.'.jpg'))
            <img src="{{ route('prop.image', ['filename' => $one_prop->prop_id.'.jpg']) }}" alt="" class="img-responsive">
            <div class="property-image" style="margin-top:10px; margin-bottom:10px;">
              <p class="description text-center"> Property image Uploaded by User
              </p>
            </div>
            @else
            <img src="{{ route('prop.image', ['filename' => 'default.jpg']) }}" alt="" class="img-responsive">
            <div class="property-image" style="margin-top:10px; margin-bottom:10px;">
              <p class="description text-center"> Default image
              </p>
            </div>
            @endif
          </div>
          <!--Property Listed By-->
          <div class="card">
          <div class="header">
            @if($one_prop->userFun->userTypeFun->user_type_id == 4)
              <h4 class="title">Property Listed By (Manager)</h4>
            @elseif($one_prop->userFun->userTypeFun->user_type_id == 3)
            <h4 class="title">Property Listed By (Owner)</h4>
            @endif
              <p class="category">Details of Person</p>
          </div>
          <div class="content">
                <div class="table-responsive table-full-width">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                            <td class="text-left">Name</td>
                            <td class="text-left">:</td>
                            <td class="text-left">@if(isset($one_prop->userFun)){{ $one_prop->userFun->name }}@else N/A @endif</td> 
                            </tr>  
                            <tr>
                            <td class="text-left">Mobile</td>
                            <td class="text-left">:</td>
                            <td class="text-left">
                                @if(isset($one_prop->userFun))
                                @if($one_prop->userFun->mobile){{ $one_prop->userFun->mobile }}
                                @else N/A @endif
                                @if($one_prop->userFun->mobile && $one_prop->userFun->mobile_verified == 1) 
                                <i class="fa fa-check icon-success"></i>
                                @else <i class="fa fa-warning icon-danger"></i>@endif                   
                                @endif
                            </td> 
                            </tr> 
                            <tr>
                                <td class="text-left">Email</td>
                                <td class="text-left">:</td>
                                <td class="text-left">
                                    @if(isset($one_prop->userFun))
                                    @if($one_prop->userFun->email){{ $one_prop->userFun->email }}
                                    @else N/A @endif
                                    @if($one_prop->userFun->email && $one_prop->userFun->email_verified == 1) 
                                    <i class="fa fa-check icon-success"></i>
                                    @else <i class="fa fa-warning icon-danger"></i>@endif                   
                                    @endif
                                </td> 
                            </tr>   
                        </tbody>
                    </table>
                </div>
          </div>

          </div>

          <!--Property Listed By ends-->
        </div>
          <div class="col-md-8">
              <div class="card">
                  <div class="header">
                      <h4 class="title">Review Property</h4>
                  </div>
                  <hr/>
                  <div class="content">
                  <form id="pending-property-form">
                      <input type="text" hidden name="prop_id" id="prop-id" value="{!! $one_prop->prop_id !!}">
                      <h4 class="title">Property Information</h4>
                      <div class="row">
                          <div class="col-md-12">
                              <div class="form-group">
                                  <label for="property-title">Property Title</label>
                                  <input type="text" class="form-control" placeholder="Property Title" name="property_title" id="property-title" value="@if($one_prop->prop_title){!! $one_prop->prop_title !!}@else{!! $n_a !!}@endif">
                              </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-12">
                              <div class="form-group">
                                  <label for="property-desc">Property Description</label>
                                  <textarea rows="5" class="form-control" placeholder="Property Description" name="property_desc" id="property-desc">@if($one_prop->prop_desc){!! $one_prop->prop_desc !!}@else{!! $n_a !!}@endif</textarea>
                              </div>
                          </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                              <label for="inputTenant">Tenant Preferences</label>
                              <select class="selectpicker form-control" name="inputTenant" id="inputTenant">
                              <optgroup label="Tenants">
                                <option class="ignore" value="">Select...</option>
                                @if(count($msTenantPrefrences) > 0 && $one_prop->tenant_prefrences_id)
                                @foreach($msTenantPrefrences as $msTenantPrefrence)
                                    <option value="{{$msTenantPrefrence->tenant_prefrences_id}}" @if($one_prop->tenant_prefrences_id == $msTenantPrefrence->tenant_prefrences_id) selected @endif>{{$msTenantPrefrence->tenant_prefrences}}</option>
                                @endforeach
                                @endif
                              </optgroup>
                              </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                              <label for="property-type">Property Type</label>
                              <select name="property_type" id="property-type" class="selectpicker form-control">
                                <optgroup label="Property Type">
                                <option class="ignore" value="">Select...</option>
                                @if(count($msPropertyTypes) > 0 && $one_prop->prop_type_id)
                                @foreach($msPropertyTypes as $msPropertyType)
                                <option value="{{$msPropertyType->prop_type_id}}" @if($one_prop->prop_type_id == $msPropertyType->prop_type_id) selected @endif>{{$msPropertyType->prop_type}}</option>
                                @endforeach  
                                @endif                                  
                                </optgroup>
                              </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                              <label for="property-bhk">BHK Type</label>
                              <select name="property_bhk" id="property-bhk" class="selectpicker form-control">
                                <optgroup label="Property BHK">
                                <option class="ignore" value="">Select...</option>
                                @if(count($msPropBhkTypes) > 0 && $one_prop->prop_bhk_id)
                                @foreach($msPropBhkTypes as $msPropBhkType)
                                  <option value="{{$msPropBhkType->prop_bhk_id}}"  @if($one_prop->prop_bhk_id == $msPropBhkType->prop_bhk_id) selected @endif>{{$msPropBhkType->prop_bhk}}</option>
                                @endforeach
                                @endif 
                                </optgroup>
                              </select>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                          <div class="col-md-3">
                              <div class="form-group">
                                  <label for="property-age">Property Age</label>
                                  <input type="text" class="form-control" placeholder="Age Of Property" name="property_age" id="property-age" value="@if($one_prop->prop_age){!! $one_prop->prop_age!!}@else{!! $n_a !!}@endif">
                              </div>
                          </div>
                          <div class="col-md-3">
                              <div class="form-group">
                                  <label for="property-area">Area (in Sq. ft)</label>
                                  <input type="text" class="form-control" placeholder="Area" name="property_area" id="property-area" value="@if($one_prop->prop_area){!! $one_prop->prop_area!!}@else{!! $n_a !!}@endif">
                              </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label for="propertyFurnishingStatus">Furnishing status</label>
                              <select name="propertyFurnishingStatus" id="propertyFurnishingStatus" class="selectpicker form-control">
                                <optgroup label="Furnishing status">
                                <option class="ignore" value="">Select...</option>
                                @if(count($msPropertyFurnishStatuses) > 0 && $one_prop->prop_furnish_status_id)
                                @foreach($msPropertyFurnishStatuses as $msPropertyFurnishStatuse)
                                <option value="{{$msPropertyFurnishStatuse->prop_furnish_status_id}}" @if($one_prop->prop_furnish_status_id == $msPropertyFurnishStatuse->prop_furnish_status_id) selected @endif>{{$msPropertyFurnishStatuse->prop_furnish_status}}</option>
                                @endforeach
                                @endif 
                                </optgroup>
                              </select>
                            </div>
                        </div>
                          <div class="col-md-3" id="ageOfFurn">
                              <div class="form-group">
                                <label for="propertyFurnishingAge">Age of furniture</label>
                                <input type="text" name="" id="propertyFurnishingAge" class="form-control" value="@if($one_prop->prop_furniture_age){!! $one_prop->prop_furniture_age!!}@else{!! $n_a !!}@endif">
                              </div>
                          </div>
                      </div>
                      <hr/>
                      <div class="row">
                        <div class="col-md-12">
                        <h4 class="title">Amenities</h4>
                        <fieldset class="field4">
                          @if($msPropertyAmentyAllCheck==true)
                          @foreach($msPropertyAmenties as $msPropertyAmenty)
                          <div class="fleft checkbox_div">
                              <input type="checkbox" checked class="amenityBoxes" id="amenity{{$msPropertyAmenty->prop_amenty_id}}" value="{{$msPropertyAmenty->prop_amenty_id}}">
                              <label for="amenity{{$msPropertyAmenty->prop_amenty_id}}">{{$msPropertyAmenty->prop_amenty_name}}</label>
                          </div> <!--checkbox-->
                          @endforeach
                          @foreach($msPropertyAmentyAll as $msPropertyAmenty)
                            <div class="fleft checkbox_div">
                                <input type="checkbox" class="amenityBoxes" id="amenity{{$msPropertyAmenty->prop_amenty_id}}" value="{{$msPropertyAmenty->prop_amenty_id}}">
                                <label for="amenity{{$msPropertyAmenty->prop_amenty_id}}">{{$msPropertyAmenty->prop_amenty_name}}</label>
                            </div> <!--checkbox-->
                            @endforeach
                            @endif
                        </fieldset>
                        <hr/>
                        </div>
                    </div>
                    <h4 class="title">Property Address</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="propertyAddressLine1">Address Line 1</label>
                                <input type="text" class="form-control" placeholder="Address Line 1" name="propertyAddressLine1" id="propertyAddressLine1" value="@if($one_prop->prop_address_line1){!! $one_prop->prop_address_line1 !!}@else{!! $n_a !!}@endif">
                            </div>
                        </div>
                      </div>
                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="propertyLocation">Locality</label>
                                  <input type="text" class="form-control" placeholder="Property Location" name="propertyLocation" id="propertyLocality" value="@if($one_prop->prop_locality){!! $one_prop->prop_locality !!}@else{!! $n_a !!}@endif">
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="propertyCity">City/District/Town</label>
                                  <input type="text" class="form-control" placeholder="City" name="propertyCity" id="propertyCity" value="@if($one_prop->prop_city){!! $one_prop->prop_city !!}@else{!! $n_a !!}@endif">
                              </div>
                          </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="propertyPincode">Pincode</label>
                                    <input type="text" class="form-control" placeholder="Pincode" name="propertyPincode" id="propertyPincode" value="@if($one_prop->prop_pincode){!! $one_prop->prop_pincode !!}@else{!! $n_a !!}@endif">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="propertyState">State</label>
                                    <input type="text" class="form-control" placeholder="State" name="propertyState" id="propertyState" value="@if($one_prop->prop_state){!! $one_prop->prop_state !!}@else{!! $n_a !!}@endif">
                                </div>
                            </div>

                          </div>
                          <div class="row" style="display:none">
                            <div class="form-group col-md-4">
                              <label for="inputLat">Lat</label>
                              <input type="text" class="form-control" name="inputLat" id="inputLat" value="@if($one_prop->prop_lat){!! $one_prop->prop_lat !!}@else{!! 0 !!}@endif">
                            </div>
                            <div class="form-group col-md-4">
                              <label for="inputLng">Long</label>
                              <input type="text" class="form-control" name="inputLng" id="inputLng" value="@if($one_prop->prop_lng){!! $one_prop->prop_lng !!}@else{!! 0 !!}@endif">
                            </div>
                          </div>
                          <hr/>
                          <h4 class="title">Property Picture</h4>
                          <div class="row">
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="propertyPic">Property Picture</label>
                                      <input id="propertyPic" name="property_pic" class="file" type="file" data-show-upload="false">
                                  </div>
                              </div>
                          </div>
                            <hr/>
                        @if(count($ts_prop_invnt_levels) > 0)
                        @php
                        $i = 0;
                        @endphp
                          <h4 class="title">Rental Type</h4>
                          @foreach($ts_prop_invnt_levels as $ts_prop_invnt_level)
                          
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                <label for="prop-invnt-level[{{$i}}]">Category</label>
                                <input type="text" id="prop-invnt-level[{{$i}}]" class="form-control" value="@if($ts_prop_invnt_level->msPropLevelFun){{ $ts_prop_invnt_level->msPropLevelFun->prop_invnt_level }}@else{!! $n_a !!}@endif" disabled>
                                </div>
                            </div>    
                            <div class="" style="display:none">
                                <div class="form-group">
                                    <input type="text" name="ts_prop_invnt_level[{{$i}}]" class="form-control" value="@if($ts_prop_invnt_level->ts_prop_invnt_level_id){{ $ts_prop_invnt_level->ts_prop_invnt_level_id }}@else{!! $n_a !!}@endif">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="prop_invnt_level[{{$i}}]" class="form-control" value="@if($ts_prop_invnt_level->prop_invnt_level_id){{ $ts_prop_invnt_level->prop_invnt_level_id }}@else{!! $n_a !!}@endif">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                <label for="exp-rent{{$i}}">Expected Rent</label>
                               <input type="text" name="exp_rent[{{$i}}]" id="exp-rent{{$i}}" class="form-control" value="@if($ts_prop_invnt_level->exp_rent){{ $ts_prop_invnt_level->exp_rent }}@else{!! $n_a !!}@endif">
                                </div>
                            </div>                                
                            <div class="col-sm-3">
                                <div class="form-group">
                                <label for="exp-depo[{{$i}}]">Expected Deposit</label>
                                <input type="text" name="exp_depo[{{$i}}]" id="exp-depo[{{$i}}]" class="form-control" value="@if($ts_prop_invnt_level->exp_deposit){{ $ts_prop_invnt_level->exp_deposit}}@else{!! $n_a !!}@endif">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="property-morp[{{$i}}]">Add MORP</label>
                                    <input type="text" name="property_morp[{{$i}}]" id="property-morp[{{$i}}]" class="form-control" placeholder="MORP">
                                </div>
                            </div>
                        </div>
                        @php
                        $i++;
                        @endphp
                        @endforeach
                        @if($one_prop->msPropertyUserFun->user_type_id == 3)
                            <hr/>
                            <h4 class="title">Tag Property To Agent</h4>
                            <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="prop-mgr-id">Tag Property To</label>
                                    <input type="text" class="form-control" placeholder="Property Manager Email ID" name="prop_mgr_id" id="prop-mgr-id">
                                    <label for="prop-mgr-id" id="prop-mgr-id-err"></label>
                                </div>
                            </div>
                            </div>
                        @endif
                            <hr/>
                          <div class="text-right">
                          <button type="submit" class="btn btn-info btn-fill">Approve Property</button>
                          </div>
                          <div class="clearfix"></div>
                          @endif
                        </form>
          </div>
              </div>
          </div>
          <div class="col-md-4" id="desktop-top">
              <div class="card card-user">
                @if (Storage::disk('public_uploads')->has($one_prop->prop_id.'.jpg'))
                <img src="{{ route('prop.image', ['filename' => $one_prop->prop_id.'.jpg']) }}" alt="" class="img-responsive">
                <div class="property-image" style="margin-top:10px; margin-bottom:10px;">
                  <p class="description text-center"> Property image Uploaded by User
                  </p>
                </div>
                @else
                <img src="{{ route('prop.image', ['filename' => 'default.jpg']) }}" alt="" class="img-responsive">
                <div class="property-image" style="margin-top:10px; margin-bottom:10px;">
                  <p class="description text-center"> Default image
                  </p>
                </div>
                @endif
              </div>
              <!--Property Listed By-->
              <div class="card">
              <div class="header">
                @if($one_prop->userFun->userTypeFun->user_type_id == 4)
                  <h4 class="title">Property Listed By (Manager)</h4>
                @elseif($one_prop->userFun->userTypeFun->user_type_id == 3)
                <h4 class="title">Property Listed By (Owner)</h4>
                @endif
                  <p class="category">Details of Person</p>
              </div>
              <div class="content">
                    <div class="table-responsive table-full-width">
                        <table class="table table-striped">
                        <tbody>
                            <tr>
                            <td class="text-left">Name</td>
                            <td class="text-left">:</td>
                            <td class="text-left">@if(isset($one_prop->userFun)){{ $one_prop->userFun->name }}@else N/A @endif</td> 
                            </tr>  
                            <tr>
                            <td class="text-left">Mobile</td>
                            <td class="text-left">:</td>
                            <td class="text-left">
                                @if(isset($one_prop->userFun))
                                @if($one_prop->userFun->mobile){{ $one_prop->userFun->mobile }}
                                @else N/A @endif
                                @if($one_prop->userFun->mobile && $one_prop->userFun->mobile_verified == 1) 
                                <i class="fa fa-check icon-success"></i>
                                @else <i class="fa fa-warning icon-danger"></i>@endif                   
                                @endif
                            </td> 
                            </tr> 
                            <tr>
                                <td class="text-left">Email</td>
                                <td class="text-left">:</td>
                                <td class="text-left">
                                    @if(isset($one_prop->userFun))
                                    @if($one_prop->userFun->email){{ $one_prop->userFun->email }}
                                    @else N/A @endif
                                    @if($one_prop->userFun->email && $one_prop->userFun->email_verified == 1) 
                                    <i class="fa fa-check icon-success"></i>
                                    @else <i class="fa fa-warning icon-danger"></i>@endif                   
                                    @endif
                                </td> 
                            </tr>   
                        </tbody>
                        </table>
                    </div>
                </div>
              </div>
              <!--Property Listed By ends-->
          </div>
      </div>
  </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="success-review-modal" data-backdrop="false" aria-labelledby="myModalLabel" style="background-color:rgba(256,256,256, 0.9);">
  <div class="modal-dialog">
      <div class="modal-content">
          <div style="" class="modal-header">
              <h3 style="text-align:center" class="modal-title"> Successfully Reviewed</h3>
          </div>
          <div class="modal-body">
              <div class="text-center">
                 <i style="font-size: 40px;" class="pe-7s-check animated rotateIn"></i>
                  <p id="succ-msg"></p>
              </div>
          </div>
      <div style="text-align:center" class="modal-footer">
      <button style="" type="button" class="btn btn-primary" class="button button-block" id="reloadSucModal">
        Ok
      </button>
      </div>
    </div>
  </div>
</div><!-- /.modal -->
<!--Loading Div -->
<div id="divLoading"> 

</div>
<!--Loading Div ends -->
<!--jQuery-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
var token = '{{Session::token()}}';
var UrlUpdateProperty = '{{route('update.pending.property')}}';
</script>
<script>
$( document ).ready(function() {
  var fullFurnDefault = $('#propertyFurnishingStatus').val();
  if(fullFurnDefault == 3)
  {
    $('#ageOfFurn').show();
    $("#propertyFurnishingAge").attr('name', 'property_furnishing_age');
  }
  else {
      $('#ageOfFurn').hide();
  }

$("#propertyFurnishingStatus").change(function(){
var fullFurn = $('#propertyFurnishingStatus').val();
if(fullFurn == 3)
{
  $('#ageOfFurn').show();
  $("#propertyFurnishingAge").attr('name', 'property_furnishing_age');
}
else {
    $('#ageOfFurn').hide();
}
});
});
</script>
@include('includes.adminfooter')
    </div>
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
            /** @type {!HTMLInputElement} */(document.getElementById('propertyLocality')),
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

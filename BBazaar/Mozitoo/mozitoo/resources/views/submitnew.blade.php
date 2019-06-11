@extends('layouts.submitmaster')
@section('submitnew')
<!--Content Area Begin-->

<section class="row pageCover">
    <div class="container">
        <div class="row m0">
            <div class="fleft page_name">Submit your Property</div>
            <div class="fright page_dir">
                <ul class="list-inline">
                    <li><a href="index.html">home</a></li>
                    <li>submit your property</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="row contentRow submit_property">
    <div class="container">
        <h3 class="section_title">Submit your Property</h3>
        <form id="submit_property_form" class="row" enctype="multipart/form-data">
          
          <h4 class="form_heading">Property Informations</h4>
          <fieldset class="field1">
            @if($tenantPrefrence==true)
            <div class="form-group">
            <label for="inputTenant">Tenant Preferences</label>
            <select name="inputTenant" id="inputTenant" class="form-control selectpicker">
            <optgroup label="Tenants">
              <option class="ignore" value="">Select...</option>
                @foreach($msTenantPrefrences as $msTenantPrefrence)
                    <option value="{{$msTenantPrefrence->tenant_prefrences_id}}">{{$msTenantPrefrence->tenant_prefrences}}</option>
                @endforeach
            </optgroup>
            </select>
            </div>
            @endif
              <div class="form-group property_title">
                  <label for="property_title">Property Name</label>
                  <input type="text" class="form-control" name="property_title" id="property_title" >
              </div>
              <div class="form-group property_desc">
                  <label for="property_desc">Property Description (* Please specify the vastu)</label>
                  <textarea name="property_desc" id="property_desc" class="form-control"></textarea>
              </div>
              <div class="row">
                @if($propertyType==true)
                  <div class="col-sm-4">
                      <div class="form-group">
                          <label for="property_type">Property Type</label>
                          <select name="property_type" id="property_type" class="form-control selectpicker">
                            <optgroup label="Property Type">
                            <option class="ignore" value="">Select...</option>
                            @foreach($msPropertyTypes as $msPropertyType)
                            <option value="{{$msPropertyType->prop_type_id}}">{{$msPropertyType->prop_type}}</option>
                            @endforeach
                            </optgroup>
                          </select>
                      </div>
                  </div>
                  @endif
                  @if($propBhkType==true)
                  <div class="col-sm-4">
                    <div class="form-group">
                        <label for="property-bhk">BHK Type</label>
                        <select name="property_bhk" id="property-bhk" class="form-control selectpicker">
                          <optgroup label="Property BHK">
                          <option class="ignore" value="">Select...</option>
                          @foreach($msPropBhkTypes as $msPropBhkType)
                            <option value="{{$msPropBhkType->prop_bhk_id}}">{{$msPropBhkType->prop_bhk}}</option>
                          @endforeach
                          </optgroup>
                        </select>
                    </div>
                  </div>
                  @endif
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
                @if($propertyFurnishStatus==true)
                <div class="col-sm-4">
                <div class="form-group furnishing">
                    <label for="property_furnishing_status">Furnishing status</label>
                    <select name="property_furnishing_status" id="property_furnishing_status" class="form-control selectpicker">
                        <optgroup label="Furnishing status">
                        <option class="ignore" value="">Select...</option>
                        @foreach($msPropertyFurnishStatuses as $msPropertyFurnishStatuse)
                        <option value="{{$msPropertyFurnishStatuse->prop_furnish_status_id}}">{{$msPropertyFurnishStatuse->prop_furnish_status}}</option>
                         @endforeach
                        </optgroup>
                    </select>
                </div>
                </div>
                @endif
                  <div class="col-sm-4" id="ageFurn">
                      <div class="form-group furnitureage">
                          <label for="property_furnishing_age">Age of furniture</label>
                          <input type="text" name="" id="property_furnishing_age" class="form-control">
                      </div>
                  </div>
              </div>
          </fieldset>
          @if($propInvntLevel==true)
          <h4 class="form_heading">Rental Details</h4>
          <fieldset class="field2">
            <div class="form-group">
                <label for="rental-type">Rent As</label>
                <select multiple="multiple" name="rental_type[]" id="rental-type" class="form-control">
                    @foreach($msPropInvntLevels as $msPropInvntLevel)
                    <option value="{{$msPropInvntLevel->prop_invnt_level_id}}" data-invt="{{$msPropInvntLevel->prop_invnt_level_id}}">{{$msPropInvntLevel->prop_invnt_level}}</option>
                    @endforeach
                </select>
            </div>
            <!--Dynamic rent categories will be added -->
            <div id="rent-categories">
            </div>
          </fieldset>
          @endif
          <h4 class="form_heading">Add Photo Gallery</h4>
          <fieldset class="field3">
          <input id="add_photo_gallery" name="add_photo_gallery" class="file" type="file" data-min-file-count="1" data-show-upload="false">
          </fieldset>
          <h4 class="form_heading">Property full address</h4>
          <fieldset class="field4">
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
                                <label for="">Locality</label>
                                <input type="text" name="inputLocality" id="propertyLocality" class="form-control">
                            </div>
                        </div>
                        @if($ts_state)
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="inputState">State</label>
                                <select class="form-control selectpicker" data-live-search="true" data-size="10" name="inputState" id="inputState">
                                    <option value="" class="ignore">Select...</option> 
                                    @if(count($ts_states) > 0)
                                        @foreach ($ts_states as $ts_state)
                                            <option value="{{$ts_state->state_id}}" class="ignore">{{$ts_state->name}}</option>
                                        @endforeach       
                                    @endif                                  
                                </select>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="row">
                        @if($ts_state && count($ts_states) > 0)
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="inputCity">City/District/Town</label>
                                <select class="form-control selectpicker" data-live-search="true" data-size="10" name="inputCity" id="inputCity">
                                    <option value="" class="ignore">Select...</option>                                
                                </select>
                            </div>
                        </div>
                        @endif
                        <div class="col-sm-6">
                            <div class="form-group property_address_pincode">
                                <label for="inputPincode">Pincode</label>
                                <input type="text" name="inputPincode" id="inputPincode" class="form-control">
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
          <fieldset class="field5">
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
            <fieldset class="field6">
                <div class="form-group user_type type_switch">
                    <input type="checkbox" name="user_type" id="user_type" value="0">
                    <label for="user_type" class="switch">
                        <span class="new_user switch_left">New user</span>
                        <span class="indicator"><span class="switch_dot"></span></span>
                        <span class="existing_user switch_right">Existing user</span>
                    </label>
                </div>
                <div class="row m0 user_forms">
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
                        </div>
                    </div> <!--New User Form-->
                    <div class="row m0 existing_user_form hide">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group formerror">
                                    <label for="user_email">Email Address</label>
                                    <input type="email" class="form-control" name="user_email" id="user_email">
                                    <label for="user_email" id="email_err"></label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="user_password">Password</label>
                                    <input type="password" name="user_password" id="user_password" class="form-control">
                                    <label for="user_password" id="pwd_err"></label>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="forgot_password row m0">
                            <a href="#">Forgot Your Password?</a>
                        </div> -->
                    </div> <!--Existing User Form-->
                </div>
                <input type="text" name="user_type_val" id="user_type_val" value="1" hidden>
            </fieldset>
        </form>
    </div>
</section>
<div id="divLoading"> 
</div>
<!--Content Area End-->

<script>
var token = '{{Session::token()}}';
var submitnewform = '{{route('submitnewform')}}';
var url_owner_dashboard = '{{route('ownerdashboard')}}';
var url_get_respective_cities = '{{route('get.respective.cities')}}';
</script>
<!--jQuery-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
$(document).ready(function () {
    $('#rental-type').SumoSelect({selectAll:true});
});
</script>
@endsection

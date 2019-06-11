@extends('layouts.tenant')
@section('pendingone')
@section('active2')
    class="active"
@endsection
@include('includes.tenantheader')
<div class="main-panel">
  @section('DashboardSiteMap')
  Tenant Dashboard / My Home / Details
  @endsection
@include('includes.tenantnav')
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
                @if(count($prop_tenants) > 0)
                <!-- Check if tenants exists-->
                @php 
                $i = 0;
                @endphp
                @foreach ($prop_tenants as $one_tenant)   
                @php 
                $i++;
                @endphp
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header text-center">
                            <h4 class="title">Unit - {{$i}}  @if($one_tenant->invnt_status_id == 2 && $one_tenant->user_id != 0)<i class="pe-7s-check icon-success"></i>@else<i class="pe-7s-attention icon-danger"></i>@endif</h4> 
                            @php
                                $prop_id = $one_tenant->prop_id;
                                $invnt_id = $one_tenant->ts_prop_invnt_id;
                                $f_invnt_id = $one_tenant->fomatted_invnt_id;
                                $parameter= Crypt::encrypt($invnt_id);
                            @endphp    
                            <a href="{{route('onetenantproperty.check.oneinvnt',['prop_id'=>$prop_id,'invnt_id'=>$parameter,'check'=>$f_invnt_id])}}">See more</a>
                            <div class="content">
                            @if($one_tenant->invnt_status_id == 2 && $one_tenant->user_id != 0)
                                <h5>Tenant Name : @if($one_tenant->tenantFun)<span class="text-info">{{$one_tenant->tenantFun->name}}@else N/A @endif</span></h5>
                                <h5>Tenant Mobile : @if($one_tenant->tenantFun)<span class="text-info">{{$one_tenant->tenantFun->mobile}}@else N/A @endif</span></h5>
                                <h5 class="title">Monthly Rent :@if($one_tenant->rent)<strong class="text-warning"> Rs. {{$one_tenant->rent}}@else N/A @endif</strong></h5>
                                <h5 class="category">Maintenance Charge :@if($one_tenant->maint_charge)<strong class="text-warning"> Rs. {{$one_tenant->maint_charge}}@else N/A @endif</strong></h5>
                            @else
                            <div class="alert alert-danger text-center">
                                <span><b> Info - </b> Unoccupied Inventory</span>
                            </div>
                            @endif
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
              </div>
              <div class="col-md-8">
                      <div class="card">
                          <div class="header">
                              <h4 class="title">Review Property</h4>
                          </div>
                          <hr/>
                          <div class="content">
                            <form id="owner-pending-property-form">
                            <fieldset disabled="disabled">
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
                                            @if($one_prop->tenant_prefrences_id && $one_prop->msPropertyTenantFun)
                                                <option selected>{{$one_prop->msPropertyTenantFun->tenant_prefrences}}</option>
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
                                            @if($one_prop->prop_type_id && $one_prop->msPropTypeFun)
                                            <option selected>{{$one_prop->msPropTypeFun->prop_type}}</option>
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
                                            @if($one_prop->prop_bhk_id && $one_prop->msPropBhkFun)
                                              <option selected>{{$one_prop->msPropBhkFun->prop_bhk}}</option>
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
                                            @if($one_prop->prop_furnish_status_id && $one_prop->furnishFUn)
                                            <option selected>{{$one_prop->furnishFUn->prop_furnish_status}}</option>
                                            @endif 
                                            </optgroup>
                                          </select>
                                        </div>
                                    </div>
                                    @if($one_prop->prop_furniture_age)
                                      <div class="col-md-3" id="ageOfFurn">
                                          <div class="form-group">
                                            <label for="propertyFurnishingAge">Age of furniture</label>
                                            <input type="text" name="" id="propertyFurnishingAge" class="form-control" value="@if($one_prop->prop_furniture_age){!! $one_prop->prop_furniture_age!!}@else{!! $n_a !!}@endif">
                                          </div>
                                      </div>
                                    @endif 
                                  </div>
                                  <hr/>
                                  <div class="row">
                                    <div class="col-md-12">
                                    <h4 class="title">Amenities</h4>
                                    <fieldset class="field4">
                                      @if(count($ms_property_amenties) > 0)
                                      @foreach($ms_property_amenties as $msPropertyAmenty)
                                      <div class="fleft checkbox_div">
                                          <input type="checkbox" checked class="amenityBoxes" value="{{$msPropertyAmenty->prop_amenty_id}}">
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
                                </fieldset>
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
                          @if(count($prop_tenants) > 0)
                          <!-- Check if tenants exists-->
                          @php 
                          $i = 0;
                          @endphp
                          @foreach ($prop_tenants as $one_tenant)   
                          @php 
                          $i++;
                          @endphp
                          <div class="row">
                              <div class="col-md-12">
                                  <div class="card">
                                      <div class="header text-center">
                                      <h4 class="title">Unit - {{$i}}  @if($one_tenant->invnt_status_id == 2 && $one_tenant->user_id != 0)<i class="pe-7s-check icon-success"></i>@else<i class="pe-7s-attention icon-danger"></i>@endif</h4> 
                                    @php
                                        $prop_id = $one_tenant->prop_id;
                                        $invnt_id = $one_tenant->ts_prop_invnt_id;
                                        $f_invnt_id = $one_tenant->fomatted_invnt_id;
                                        $parameter= Crypt::encrypt($invnt_id);
                                    @endphp    
                                    <a href="{{route('onetenantproperty.check.oneinvnt',['prop_id'=>$prop_id,'invnt_id'=>$parameter,'check'=>$f_invnt_id])}}">See more</a>
                                      <div class="content">
                                      @if($one_tenant->invnt_status_id == 2 && $one_tenant->user_id != 0)
                                          <h5>Tenant Name : @if($one_tenant->tenantFun)<span class="text-info">{{$one_tenant->tenantFun->name}}@else N/A @endif</span></h5>
                                          <h5>Tenant Mobile : @if($one_tenant->tenantFun)<span class="text-info">{{$one_tenant->tenantFun->mobile}}@else N/A @endif</span></h5>
                                          <h5 class="title">Monthly Rent :@if($one_tenant->rent)<strong class="text-warning"> Rs. {{$one_tenant->rent}}@else N/A @endif</strong></h5>
                                          <h5 class="category">Maintenance Charge :@if($one_tenant->maint_charge)<strong class="text-warning"> Rs. {{$one_tenant->maint_charge}}@else N/A @endif</strong></h5>
                                      @else
                                      <div class="alert alert-danger text-center">
                                          <span><b> Info - </b> Unoccupied Inventory</span>
                                      </div>
                                      @endif
                                      </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          @endforeach
                          @endif
                </div>
            </div>
        </div>
      </div>


@include('includes.adminfooter')
    </div>
@endsection

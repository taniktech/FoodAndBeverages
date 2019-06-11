@extends('layouts.admin')
@section('admin')
@section('active4')
    class="active"
@endsection
@include('includes.adminheader')
<div class="main-panel">
  @section('DashboardSiteMap')
      Admin Dashboard / Modify Inventory
  @endsection
@include('includes.adminnav')
<div class="content">
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title" id="psummary-id" data-psid="{{ $active_prop->prop_id }}">Property Summary : {{ $active_prop->prop_title }}</h4>
                    <p class="category">Property Summary</p>
                </div>
                <div class="content">
                    @if($active_prop)
                     <!--Property details --> 
                    <div class="row">
                        <div class="col-md-4">
                            <p class="category">Property Listed By</p>
                            <div class="table-responsive table-full-width">
                                <table class="table table-striped">
                                <tbody>
                                    <tr>
                                    <td class="text-left">Name</td>
                                    <td class="text-left">:</td>
                                    <td class="text-left">@if(isset($active_prop->userFun)){{ $active_prop->msPropertyUserFun->name }}@else N/A @endif</td> 
                                    </tr>  
                                    <tr>
                                    <td class="text-left">Mobile</td>
                                    <td class="text-left">:</td>
                                    <td class="text-left">
                                        @if(isset($active_prop->userFun))
                                        @if($active_prop->msPropertyUserFun->mobile){{ $active_prop->msPropertyUserFun->mobile }}
                                        @else N/A @endif
                                        @if($active_prop->msPropertyUserFun->mobile && $active_prop->msPropertyUserFun->mobile_verified == 1) 
                                        <i class="fa fa-check icon-success"></i>
                                        @else <i class="fa fa-warning icon-danger"></i>@endif                   
                                        @endif
                                    </td> 
                                    </tr>  
                                </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-4" style="border-inline-start-style: solid;">
                                <p class="category">Property features</p>
                                <div class="table-responsive table-full-width">
                                    <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                        <td class="text-left">Type</td>
                                        <td class="text-left">:</td>
                                        <td class="text-left">{{$active_prop->msPropTypeFun->prop_type}} - {{$active_prop->msPropBhkFun->prop_bhk }}</td> 
                                        </tr>  
                                        <tr>
                                        <td class="text-left">Furnish</td>
                                        <td class="text-left">:</td>
                                        <td class="text-left">{{$active_prop->furnishFUn->prop_furnish_status}}</td> 
                                        </tr>  
                                    </tbody>
                                    </table>
                                </div>
                        </div>
                        <div class="col-md-4" style="border-inline-start-style: solid;">
                                <p class="category">Property location</p>
                                <div class="table-responsive table-full-width">
                                    <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                        <td class="text-left">Locality</td>
                                        <td class="text-left">:</td>
                                        <td class="text-left">{{$active_prop->prop_locality}}</td> 
                                        </tr>  
                                        <tr>
                                        <td class="text-left">City</td>
                                        <td class="text-left">:</td>
                                        <td class="text-left">{{$active_prop->prop_city}}</td> 
                                        </tr>  
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                    </div>  
                    @endif
                    <!--Property details ends-->  
                    <!--Inventory details --> 
                    <hr>   
                    @if($invnt_check)
                    <div class="row"> 
                        <div class="header">
                            <h4 class="title" id="invnt-summry-id" data-invntsid="{{ $invnt_check->ts_prop_invnt_id}}">Inventory ID : {{ $invnt_check->fomatted_invnt_id}}</h4>
                        </div> 
                    @if($invnt_check->invnt_status_id == 1 && $invnt_check->user_id == 0)
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="tenat-list">Select a Tenant for this Inventory</label>
                                    <select class="selectpicker form-control" data-live-search="true" data-size="5" name="tenat_list" data-dropupAuto="true" id="tenat-list">                                       
                                        @if(count($tenant_list) > 0)
                                        <optgroup label="All Tenants">
                                            <option value=" " class="ignore">Select...</option> 
                                            @foreach ($tenant_list as $tenant)
                                            <option value="{{$tenant->user_id}}" class="ignore">{{$tenant->name}}</option>
                                            @endforeach                                       
                                        </optgroup>    
                                        @else  
                                        <option value="" class="ignore">No Tenants Availble</option>                                                                      
                                        @endif
                                    </select>
                            </div>
                        </div>                     
                    @endif         
                    </div>
                    @if($invnt_check->invnt_status_id == 1 && $invnt_check->user_id == 0)
                    <form id="assign-ten-form">
                    <input type="hidden" name="p_t_id" value="{{ $active_prop->prop_id }}">
                    <input type="hidden" name="invnt_t_id" value="{{ $invnt_check->ts_prop_invnt_id}}">
                    <div id="tenant-dyn-preview"> 

                    </div>
                    </form>
                    @endif 
                    @if($invnt_check->invnt_status_id == 2 && $invnt_check->user_id != 0)
                    <div class="row" style="margin-top:2%;"> 
                       <form id="edit-rental-details-form">
                        <input type="hidden" name="e_p_t_id" value="{{ $active_prop->prop_id }}">
                        <input type="hidden" name="e_invnt_t_id" value="{{ $invnt_check->ts_prop_invnt_id}}">
                        <div class="col-md-6">                           
                            <h5 class="title">Tenant Details</h5>
                           <div class="table-responsive table-full-width">
                               <table class="table table-hover">
                               <tbody>
                                   <tr>
                                       <td class="text-left">Name</td>
                                       <td class="text-left">:</td>
                                       <td class="text-left">
                                           @if($invnt_check->user_id == 0)
                                           <p class="text-warning">N/A</p>
                                           @elseif($invnt_check->user_id != 0 && $invnt_check->invnt_status_id == 2)
                                           {{ $invnt_check->tenantFun->name }}
                                           @else
                                           <p class="text-warning">N/A</p>
                                           @endif
                                       </td> 
                                       </tr>  
                                       <tr>
                                       <td class="text-left">Mobile</td>
                                       <td class="text-left">:</td>
                                       <td class="text-left">
                                           @if($invnt_check->user_id == 0)
                                           <p class="text-warning">N/A</p>
                                           @elseif($invnt_check->user_id != 0 && $invnt_check->invnt_status_id == 2)
                                           @if(isset($invnt_check->tenantFun))
                                           @if($invnt_check->tenantFun->mobile){{ $invnt_check->tenantFun->mobile }}
                                           @else N/A @endif
                                           @if($invnt_check->tenantFun->mobile && $invnt_check->tenantFun->mobile_verified == 1) 
                                           <i class="fa fa-check icon-success"></i>
                                           @else <i class="fa fa-warning icon-danger"></i>@endif                   
                                           @endif
                                           @else
                                           <p class="text-warning">N/A</p>
                                           @endif
                                       </td> 
                                       </tr> 
                                       <tr>
                                       <td class="text-left">Email</td>
                                       <td class="text-left">:</td>
                                       <td class="text-left">
                                           @if($invnt_check->user_id == 0)
                                           <p class="text-warning">N/A</p>
                                           @elseif($invnt_check->user_id != 0 && $invnt_check->invnt_status_id == 2)
                                           @if(isset($invnt_check->tenantFun))
                                           @if($invnt_check->tenantFun->email){{ $invnt_check->tenantFun->email }}
                                           @else N/A @endif
                                           @if($invnt_check->tenantFun->email && $invnt_check->tenantFun->email_verified == 1) 
                                           <i class="fa fa-check icon-success"></i>
                                           @else <i class="fa fa-warning icon-danger"></i>@endif                   
                                           @endif
                                           @else
                                           <p class="text-warning">N/A</p>
                                           @endif
                                       </td> 
                                       </tr>  
                                       <tr>
                                        <td class="text-left">Tenant From</td>
                                        <td class="text-left">:</td>
                                        <td class="text-left">
                                            {{$invnt_check->taggedTenFun->start_date}}
                                        </td> 
                                        </tr>  
                               </tbody>
                               </table>
                           </div>
                       </div>
                           <div class="col-md-6" style="border-inline-start-style: solid;">
                               <h5 class="title">Rental Details</h5>
                               <div class="table-responsive table-full-width">
                                   <table class="table table-hover">
                                   <tbody>
                                       <tr>
                                       <td class="text-left" id="rent-for-user" data-rentfuid="{{$invnt_check->user_id}}">Rent(Per month)</td>
                                       <td class="text-left">:</td>
                                       <td class="">                             
                                           <input type="text" class="form-control rental-details" placeholder="Enter rent per month" name="edit_invnt_rent" id="edit-invnt-rent" value="{{ $invnt_check->rent }}" disabled>                                         
                                       </td> 
                                       </tr>  
                                       <tr>
                                       <td class="text-left">Maintenance Charge</td>
                                       <td class="text-left">:</td>
                                       <td class="">
                                           <input type="text" class="form-control rental-details" placeholder="Enter maintenance charge p/m" name="edit_maint_charge" id="edit-maint-charge" value="{{ $invnt_check->maint_charge }}" disabled>
                                       </td> 
                                       </tr> 
                                       <tr>
                                       <td class="text-left">Pay Date</td>
                                       <td class="text-left">:</td>
                                       <td class="">
                                        <select class="form-control rental-details" name="edi_rent_pay_date" id="edit-rent-pay-date" disabled>
                                            @php
                                            for ($i = 1; $i < 20; $i++) {
                                                if($invnt_check->rent_pay_date == $i)
                                                {
                                                echo '<option value="'.$i.'" selected>'.$i.'</option>';
                                                }
                                                else {
                                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                                }
                                            }
                                            @endphp
                                        </select>
                                       </td> 
                                       </tr>   
                                   </tbody>
                                   </table>
                               </div>
                               <div class="clearfix">
                                    <button type="button" class="btn btn-danger btn-fill" id="remo-ten-invnt-btn" style="float:left">Remove Tenant</button>
                                    <button type="button" class="btn btn-info btn-fill" style="float:right" id="remo-disabled-button-rent">Edit Rental Details</button>
                               </div>
                           </div>
                       </form>
                        </div>
                    @endif
                    @endif
                <!--Inventory details ends-->
                </div>
                </div>
            </div>
        </div>
    </div>
<div id="divLoading"> 
</div>
</div>
<!--Modaal-->
<div class="modal" tabindex="-1" role="dialog" id="success-invnt-review-modal" aria-hidden="true" data-backdrop="false" data-keyboard="false" aria-labelledby="myModalLabel" style="background-color:rgba(256,256,256, 0.9);">
    <div class="modal-dialog">
        <div class="modal-content">
          <div style="" class="modal-header">
              <h4 class="modal-title">Inventory List</h4>
          </div>
          <div class="modal-body" id="invnts-modal-body">
             <!--Inventories will be appended-->
          </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-info btn-fill" id="conf-prop-invnt">Confirm</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<!-- /.modal -->
@include('includes.adminfooter')
</div>
<script>
var token = '{{Session::token()}}';
var url_all_invnt = '{{route('admin.inventory.review.all')}}';
var url_get_one_tenant = '{{route('admin.tenant.one.info')}}';
var url_post_assign_tenant = '{{route('admin.tenant.assign')}}';
var url_update_tenant_rent = '{{route('admin.tenant.update.rent')}}';
var url_remove_ten_invnt = '{{route('admin.tenant.remove.invnt')}}';
</script>
@endsection

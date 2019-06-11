@extends('layouts.owner')
@section('owner')
@section('active2')
    class="active"
@endsection
@include('includes.ownerheader')
<div class="main-panel">
  @section('DashboardSiteMap')
      Owner Dashboard
  @endsection
@include('includes.ownernav')
<div class="content">
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
                <div class="card">
                        <div class="header">
                            <h4 class="title">Personal Information</h4>
                        </div>
                        <div class="content">
                            <ul class="list-unstyled team-members">
                                        <li>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    Name
                                                </div>
                                                <div class="col-md-6">
                                                    <form id="user-name-update">
                                                        <input type="text" class="form-control" disabled="disabled" placeholder="Your Name" name="user_name" id="user-name" value="{!! $owner->name !!}">
                                                    </form>
                                                </div>
                                                <div class="col-md-3" id="name-update-save-b" hidden>
                                                    <button type="button" onClick="submitNameUpForm();" class="btn btn-info btn-fill pull-left">Save</button>
                                                </div>
                                                <div class="col-md-3" id="name-check">
                                                    @if($owner->name)
                                                    <i class="fa fa-check icon-success"></i>
                                                    @endif
                                                </div>
                                                <div class="col-md-1 text-right">
                                                    <button type="button" onclick="dasNameUpdate();" id="user-name-u-b" class="btn btn-info btn-simple btn-md">
                                                        <i class="fa fa-edit"></i>
                                                    </button>  
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    Email
                                                </div>
                                                <div class="col-md-6">
                                                    <form id="user-email-update">
                                                        <input type="email" class="form-control" disabled="disabled" placeholder="Your Email" name="user_email" id="user-email" value="{!! $owner->email !!}">       
                                                    </form>
                                                    <form id="email-otp-verify">
                                                        <div id="dyn-email-veri">
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="col-md-3" id="gen-email-otp">
                                                        @if(($owner->email) && ($owner->email_verified == 0 ))
                                                        <a href="javascript:sendEmailOTP();"><i class="fa fa-warning icon-danger"></i> Click here to generate OTP</a>@endif 
                                                        @if(($owner->email) && ($owner->email_verified == 1))<i class="fa fa-check icon-success"></i>@endif
                                                </div>
                                                <div class="col-md-3" id="email-update-save-b" hidden>
                                                    <button type="button" onClick="submitEmailUpForm();" class="btn btn-info btn-fill pull-left">Save</button>
                                                </div>
                                                <div class="col-md-1 text-right">
                                                    <button type="button" onclick="dasEmailUpdate();" id="user-email-u-b" class="btn btn-info btn-simple btn-md">
                                                        <i class="fa fa-edit"></i>
                                                    </button> 
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    Mobile
                                                </div>
                                                <div class="col-md-6">
                                                    <form id="user-mobile-update">
                                                        <input type="text" class="form-control" disabled="disabled" placeholder="Your Email" name="user_mobile" id="user-mobile" value="{!! $owner->mobile !!}">       
                                                    </form>
                                                    <form id="mobile-otp-verify">
                                                        <div id="dyn-mobile-veri">
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="col-md-3" id="gen-mobile-otp">
                                                        @if(($owner->mobile) && ($owner->mobile_verified == 0 ))<a href="javascript:sendMobileOTP();"><i class="fa fa-warning icon-danger"></i> Click here to generate OTP</a>@endif 
                                                        @if(($owner->mobile) && ($owner->mobile_verified == 1))<i class="fa fa-check icon-success"></i>@endif
                                                </div>
                                                <div class="col-md-3" id="mobile-update-save-b" hidden>
                                                    <button type="button" onClick="submitMobileUpForm();" class="btn btn-info btn-fill pull-left">Save</button>
                                                </div>
                                                <div class="col-md-1 text-right">
                                                    <button type="button" onclick="dasMobileUpdate();" id="user-mobile-u-b" class="btn btn-info btn-simple btn-md">
                                                        <i class="fa fa-edit"></i>
                                                    </button>    
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                        </div>
                    </div>
             <div class="card">
                 <div class="header">
                     <h4 class="title">Address Information</h4>
                 </div>
                 <form method="POST" id="owner-address-form">
                 <div class="content">
                     <div class="row">
                         <div class="col-md-12">
                             <div class="form-group">
                                 <label for="add-line-1">Address Line 1</label>
                                 <input type="text" class="form-control" name="add_line_1" id="add-line-1" placeholder="Address Line 1" @if($other_data && $other_data->address_line_1) value="{{$other_data->address_line_1}}" disabled @endif>
                             </div>
                         </div>
                     </div>
                     <div class="row">
                         <div class="col-md-12">
                             <div class="form-group">
                                 <label for="add-line-2">Address Line 2</label>
                                 <input type="text" class="form-control" name="add_line_2" id="add-line-2" placeholder="Address Line 2" @if($other_data && $other_data->address_line_2) value="{{$other_data->address_line_2}}" disabled @endif>
                             </div>
                         </div>
                     </div>
                     <div class="row">  
                         <div class="col-md-4">
                             <div class="form-group">
                                <label for="input-state">State</label>
                                <select class="form-control selectpicker" @if($other_data && $other_data->state) disabled @endif data-live-search="true" data-size="10" name="input_state" id="input-state">
                                    <option value="" class="ignore">Select...</option> 
                                    @if(isset($ts_states) && count($ts_states) > 0)
                                        @foreach ($ts_states as $ts_state)
                                        <option value="{{$ts_state->state_id}}"  @if($other_data && $other_data->state && $other_data->state == $ts_state->state_id) selected @endif class="ignore">{{$ts_state->name}}</option>
                                        @endforeach       
                                    @endif                                  
                                </select>                             
                            </div>
                         </div>
                         <div class="col-md-4">
                                <div class="form-group">
                                    <label for="input-city">City/District/Town</label>
                                    <select class="form-control selectpicker" @if($other_data && $other_data->city) disabled @endif data-live-search="true" data-size="10" name="input_city" id="input-city">
                                        <option value="" class="ignore">Select...</option>
                                        @if($other_data && $other_data->city)
                                        @if(isset($ts_cities) && count($ts_cities) > 0)
                                        @foreach ($ts_cities as $ts_city)
                                        <option value="{{$ts_city->city_id}}"  @if($other_data && $other_data->city && $other_data->city == $ts_city->city_id) selected @endif class="ignore">{{$ts_city->name}}</option>
                                        @endforeach       
                                        @endif       
                                        @endif                             
                                    </select>
                                </div>
                            </div>
                         <div class="col-md-4">
                             <div class="form-group">
                                 <label for="pin">Pincode</label>
                                 <input type="text" class="form-control" name="pin" id="pin" placeholder="Pincode" @if($other_data && $other_data->pincode) value="{{$other_data->pincode}}" disabled @endif>
                             </div>
                         </div>
                     </div>
                     @if(!$other_data or !$other_data->state or !$other_data->address_line_1 or !$other_data->address_line_2)
                     <button type="submit" class="btn btn-info btn-fill pull-right">Save</button>
                     @endif
                     @if($other_data && $other_data->state && $other_data->address_line_1 && $other_data->address_line_2)
                     <div class="text-right">
                     <button type="button" class="btn btn-info btn-fill" id="action-owner-add-form" onclick="ownerAddEdit();">Edit</button>
                     <button type="button" class="btn btn-success btn-fill" id="action-up-owner-add-form" style="display:none;" onclick="ownerAddEditSubForm();">Update</button>
                     </div>
                     @endif
                     <div class="clearfix"></div>
                 </div>
                 </form>
             </div>
             <div class="card">
                 <div class="header">
                     <h4 class="title">About Me</h4>
                 </div>
                 <div class="content">
                    <form id="owner-about-form">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="about-me">About Me</label>
                                    <textarea rows="5" class="form-control" placeholder="Here can be your description" name="about_me" id="about-me" @if($other_data && $other_data->about_me) disabled @endif>@if($other_data && $other_data->about_me){{$other_data->about_me}}@endif</textarea>
                                </div>
                            </div>
                        </div>
                    @if(!$other_data or !$other_data->about_me)
                     <button type="submit" class="btn btn-info btn-fill pull-right">Save</button>
                     @endif
                     @if($other_data && $other_data->about_me)
                     <div class="text-right">
                        <button type="button" class="btn btn-info btn-fill" id="action-owner-about-form" onclick="ownerAboutEdit();">Edit</button>
                        <button type="button" class="btn btn-success btn-fill" id="action-up-about-form" style="display:none;" onclick="ownerAboutEditSubForm();">Update</button>
                        </div>
                    @endif
                     <div class="clearfix"></div>
                    </form>
                </div>
            </div>
            <div class="card">
                 <div class="header">
                     <h4 class="title">Bank Details</h4>
                 </div>
                 <form method="POST" id="owner-bank-form">
                 <div class="content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="pan-no">PAN no.</label>
                                    <input type="text" class="form-control" name="pan_no" id="pan-no" placeholder="PAN no." @if($other_data && $other_data->pan_no) value="{{$other_data->pan_no}}" disabled @endif>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="adhaar-no">Adhaar no.</label>
                                    <input type="text" class="form-control" name="adhaar_no" id="adhaar-no" placeholder="Adhaar no." @if($other_data && $other_data->adhaar_no) value="{{$other_data->adhaar_no}}" disabled @endif>
                                </div>
                            </div>
                        </div>
                     <div class="row">
                         <div class="col-md-12">
                             <div class="form-group">
                                 <label for="acc-holder-name">A/c holder name</label>
                                 <input type="text" class="form-control" name="acc_holder_name" id="acc-holder-name" placeholder="A/c holder name" @if($other_data && $other_data->acc_holder_name ) value="{{$other_data->acc_holder_name }}" disabled @endif>
                             </div>
                         </div>
                     </div>
                     <div class="row">
                         <div class="col-md-12">
                             <div class="form-group">
                                 <label for="acc-no">Account no.</label>
                                 <input type="text" class="form-control" name="acc_no" id="acc-no" placeholder="Account no." @if($other_data && $other_data->acc_no ) value="{{$other_data->acc_no }}" disabled @endif>
                             </div>
                         </div>
                     </div>
                     <div class="row">
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label for="bank-name">Bank name</label>
                                 <input type="text" class="form-control" name="bank_name" id="bank-name" placeholder="Bank name" @if($other_data && $other_data->bank_name ) value="{{$other_data->bank_name }}" disabled @endif>
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label for="branch-name">Branch name</label>
                                 <input type="text" class="form-control" name="branch_name" id="branch-name" placeholder="Branch name" @if($other_data && $other_data->branch_name ) value="{{$other_data->branch_name }}" disabled @endif>
                             </div>
                         </div>
                     </div>
                     <div class="row">
                             <div class="col-md-4">
                                 <div class="form-group">
                                     <label for="ifsc">IFSC code</label>
                                     <input type="text" class="form-control" name="ifsc" id="ifsc" placeholder="IFSC code" @if($other_data && $other_data->ifsc ) value="{{$other_data->ifsc }}" disabled @endif>
                                 </div>
                             </div>
                             <div class="col-md-4">
                                 <div class="form-group">
                                     <label for="type">Account Type</label>
                                     <input type="text" class="form-control" name="type" id="type" placeholder="Account Type" @if($other_data && $other_data->type ) value="{{$other_data->type }}" disabled @endif>
                                 </div>
                             </div>
                             <div class="col-md-4">
                                 <div class="form-group">
                                     <label for="micr">MICR code</label>
                                     <input type="text" class="form-control" name="micr" id="micr" placeholder="MICR code" @if($other_data && $other_data->micr ) value="{{$other_data->micr }}" disabled @endif>
                                 </div>
                             </div>
                         </div>
                     <div class="row">
                         <div class="col-md-12">
                         <div class="form-group">
                                 <label for="cheque">Attach cancelled cheque</label>
                                 <input id="check" name="cheque" class="file" type="file" data-show-upload="false">
                        </div>
                         </div>
                     </div>
                     @if(!$other_data or !$other_data->pan_no or !$other_data->adhaar_no or !$other_data->acc_no or !$other_data->bank_name or !$other_data->ifsc)
                     <button type="submit" class="btn btn-info btn-fill pull-right">Save</button>
                     @endif
                     @if($other_data && $other_data->pan_no && $other_data->adhaar_no && $other_data->acc_no && $other_data->bank_name && $other_data->ifsc)
                     <div class="text-right">
                     <button type="button" class="btn btn-info btn-fill" id="action-owner-bank-form" onclick="ownerBankEdit();">Edit</button>
                     <button type="button" class="btn btn-success btn-fill" id="action-up-owner-bank-form" style="display:none;" onclick="ownerBankEditSubForm();">Update</button>
                     </div>
                     @endif
                     <div class="clearfix"></div>
                 </div>
                 </form>
             </div>
        </div>
</div>
</div>
</div>
<div id="divLoading"> 

</div>

<script>
var token = '{{Session::token()}}';
var url_switch_owner_dash = '{{route('switch.toten.dashboard')}}';
var url_tenant_dashboard = '{{route('tenantaccount')}}';
var url_owner_dashboard = '{{route('ownerdashboard')}}';
var url_send_email_otp = '{{route('user.send.email.otp')}}';
var url_send_mobile_otp = '{{route('user.send.mobile.otp')}}';
var url_verify_otp = '{{route('user.verify.email.otp')}}';
var url_update_em = '{{route('user.update.email.mobile')}}';
var url_update_name = '{{route('user.update.name')}}';
var url_get_respective_cities = '{{route('get.respective.cities')}}';
var url_owner_post_address = '{{route('owner.save.address')}}';
var url_owner_post_bank_details = '{{route('owner.save.bank.details')}}';
var url_owner_post_about_me = '{{route('owner.save.about.me')}}';
</script>
@include('includes.adminfooter')
</div>
@endsection

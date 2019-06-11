@extends('layouts.owner')
@section('owner')
@section('active')
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
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-xs-3">
                            <div class="icon-big icon-warning text-center">
                                <i class="pe-7s-home"></i>
                            </div>
                        </div>
                        <div class="col-xs-9">
                            <div class="numbers">
                                <p>Total Verified Property</p>
                                @if(isset($ts_prop))
                                {{count($ts_prop)}}
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <hr />
                        <div class="stats">
                          @if(count($ts_prop) > 0)
                          <a href="{{route('owner.property.all')}}"><i class="pe-7s-angle-right-circle"></i> View </a>
                          @else
                          <a href="{{route('ownerdashboard')}}"><i class="pe-7s-angle-right-circle"></i> Refresh </a>
                          @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-xs-3">
                            <div class="icon-big icon-success text-center">
                                <i class="pe-7s-check"></i>
                            </div>
                        </div>
                        <div class="col-xs-9">
                            <div class="numbers">
                              <p>Total Rented Property</p>
                                @if(isset($ts_rented_prop))
                                {{count($ts_rented_prop)}}
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <hr />
                        <div class="stats">
                          @if(count($ts_rented_prop) > 0)
                          <a href="{{route('owner.property.all')}}"><i class="pe-7s-angle-right-circle"></i> View </a>
                          @else
                          <a href="{{route('ownerdashboard')}}"><i class="pe-7s-angle-right-circle"></i> Refresh </a>
                          @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-xs-3">
                            <div class="icon-big icon-danger text-center">
                                <i class="pe-7s-volume2"></i>
                            </div>
                        </div>
                        <div class="col-xs-9">
                            <div class="numbers">
                                <p>Raised Service Request</p>
                                @if(isset($ts_ser_reqs))
                                {{count($ts_ser_reqs)}}
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <hr />
                        <div class="stats">
                          @if(count($ts_ser_reqs) > 0)
                          <a href="{{route('owner.service.req.all')}}"><i class="pe-7s-angle-right-circle"></i> View </a>
                          @else
                          <a href="{{route('ownerdashboard')}}"><i class="pe-7s-angle-right-circle"></i> Refresh </a>
                          @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-xs-3">
                            <div class="icon-big icon-info text-center">
                                <i class="pe-7s-attention"></i>
                            </div>
                        </div>
                        <div class="col-xs-9">
                            <div class="numbers">
                                <p>Pending Property Approvals</p>
                                @if(isset($ts_pend_prop))
                                {{count($ts_pend_prop)}}
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <hr />
                        <div class="stats">
                          @if(count($ts_pend_prop) > 0)
                          <a href="{{route('owner.prop.requests')}}"><i class="pe-7s-angle-right-circle"></i> View </a>
                          @else
                          <a href="{{route('ownerdashboard')}}"><i class="pe-7s-angle-right-circle"></i> Refresh </a>
                          @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            @if($owner->email_verified == 0 or $owner->mobile_verified == 0)
            <!-- If email or mobile is not verified show -->
            <div class="card">
                <div class="header">
                    <h4 class="title">Verification Pending</h4>
                </div>
                <div class="content">
                    <ul class="list-unstyled team-members">              
                        @if($owner->email_verified == 0 )
                        <!-- If email is not verified show -->
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
                        @endif
                        @if($owner->mobile_verified == 0 )
                        <!-- If mobile is not verified show -->
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
                        @endif
                    </ul>
                </div>                      
            </div>
            @endif
        </div>
    </div>
</div>
</div>
<div id="divLoading"> 

</div>

<script>
var token = '{{Session::token()}}';
var url_owner_dashboard = '{{route('ownerdashboard')}}';
var url_send_email_otp = '{{route('user.send.email.otp')}}';
var url_send_mobile_otp = '{{route('user.send.mobile.otp')}}';
var url_verify_otp = '{{route('user.verify.email.otp')}}';
var url_update_em = '{{route('user.update.email.mobile')}}';
</script>
@include('includes.adminfooter')
</div>
@endsection

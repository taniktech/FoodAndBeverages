@extends('layouts.tenant')
@section('tenant')
@section('active')
    class="active"
@endsection
@include('includes.tenantheader')
<div class="main-panel">
  @section('DashboardSiteMap')
  Tenant Dashboard
  @endsection
@include('includes.tenantnav')
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
                                                    <p>Total Occupied <br/>Units</p>
                                                    @if(isset($assigned_invnt_check))
                                                    {{count($assigned_invnt_check)}}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="footer">
                                            <hr />
                                            <div class="stats">
                                              @if(isset($assigned_invnt_check) && count($assigned_invnt_check) > 0)
                                              <a href="{{route('tenant.property.all')}}"><i class="pe-7s-angle-right-circle"></i> View </a>
                                              @else
                                              <a href="{{route('tenantaccount')}}"><i class="pe-7s-angle-right-circle"></i> Refresh </a>
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
                                                  <p>Total Outstanding Invoices</p>
                                                    @if(isset($invoice_data))
                                                    {{count($invoice_data)}}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="footer">
                                            <hr />
                                            <div class="stats">
                                              @if(isset($invoice_data) && count($invoice_data) > 0)
                                              <a href="{{route('tenant.invoices.all')}}"><i class="pe-7s-angle-right-circle"></i> View </a>
                                              @else
                                              <a href="{{route('tenantaccount')}}"><i class="pe-7s-angle-right-circle"></i> Refresh </a>
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
                                              <a href="{{route('tenant.service.req.all')}}"><i class="pe-7s-angle-right-circle"></i> View </a>
                                              @else
                                              <a href="{{route('tenantaccount')}}"><i class="pe-7s-angle-right-circle"></i> Refresh </a>
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
                                                    <p>Pending Service Requests</p>
                                                    @if(isset($ts_p_ser_reqs))
                                                    {{count($ts_p_ser_reqs)}}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="footer">
                                            <hr />
                                            <div class="stats">
                                              @if(count($ts_p_ser_reqs) > 0)
                                              <a href="{{route('tenant.service.req.all')}}"><i class="pe-7s-angle-right-circle"></i> View </a>
                                              @else
                                              <a href="{{route('tenantaccount')}}"><i class="pe-7s-angle-right-circle"></i> Refresh </a>
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
            @if($tenant->email_verified == 0 or $tenant->mobile_verified == 0)
            <!-- If email or mobile is not verified show -->
            <div class="card">
                <div class="header">
                    <h4 class="title">Verification Pending</h4>
                </div>
                <div class="content">
                    <ul class="list-unstyled team-members">              
                        @if($tenant->email_verified == 0 )
                        <!-- If email is not verified show -->
                        <li>
                            <div class="row">
                                <div class="col-md-2">
                                    Email
                                </div>
                                <div class="col-md-6">
                                    <form id="user-email-update">
                                        <input type="email" class="form-control" disabled="disabled" placeholder="Your Email" name="user_email" id="user-email" value="{!! $tenant->email !!}">       
                                    </form>
                                    <form id="email-otp-verify">
                                        <div id="dyn-email-veri">
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-3" id="gen-email-otp">
                                        @if(($tenant->email) && ($tenant->email_verified == 0 ))
                                        <a href="javascript:sendEmailOTP();"><i class="fa fa-warning icon-danger"></i> Click here to generate OTP</a>@endif 
                                        @if(($tenant->email) && ($tenant->email_verified == 1))<i class="fa fa-check icon-success"></i>@endif
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
                        @if($tenant->mobile_verified == 0 )
                        <!-- If mobile is not verified show -->
                        <li>
                            <div class="row">
                                <div class="col-md-2">
                                    Mobile
                                </div>
                                <div class="col-md-6">
                                    <form id="user-mobile-update">
                                        <input type="text" class="form-control" disabled="disabled" placeholder="Your Email" name="user_mobile" id="user-mobile" value="{!! $tenant->mobile !!}">       
                                    </form>
                                    <form id="mobile-otp-verify">
                                        <div id="dyn-mobile-veri">
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-3" id="gen-mobile-otp">
                                        @if(($tenant->mobile) && ($tenant->mobile_verified == 0 ))<a href="javascript:sendMobileOTP();"><i class="fa fa-warning icon-danger"></i> Click here to generate OTP</a>@endif 
                                        @if(($tenant->mobile) && ($tenant->mobile_verified == 1))<i class="fa fa-check icon-success"></i>@endif
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
                   <div class="col-md-4">
                    @if(isset($invoice_flag) && $invoice_flag)
                    @if(isset($invoice_data) && !empty($invoice_data))
                    @foreach ($invoice_data as $item)    
                        <div class="row">
                                <div class="col-md-12">
                                <div class="card">
                                    <div class="header text-center">
                                        @php
                                        $f_d_date=date_create($item->due_date);
                                        $f_m=date_create($item->for_month);
                                        @endphp
                                        <h4 class="title">Outstanding Invoice</h4>
                                        <p class="category">For Month : <span class="text-info">{{ date_format($f_m,"M Y") }}</span></p><br/>
                                        <h5 class="title">Amount :<strong class="text-info"> {{$item->payable_amount}}</strong> ( Due Date <span class="text-warning">{{ date_format($f_d_date,"d-m-Y") }}</span>)</h5>
                                        @php
                                            $tmp_id_0 = Crypt::encrypt($item->ts_invoice_id);                         
                                            $tmp_id_1 = $item->for_month;
                                            $tmp_id_2 = $item->due_date;
                                        @endphp    
                                         <a href="{{route('tenant.invoices.get.one',['tmp_id_0'=>$tmp_id_0,'tmp_id_1'=>$tmp_id_1,'tmp_id_2'=>$tmp_id_2])}}" target="_blank"><p class="category">Check Invoice</p></a>
                                    </div>
                                    <div class="content">
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <a href="{{route('tenant.payment.options',['tmp_id_0'=>$tmp_id_0,'tmp_id_1'=>$tmp_id_1])}}"><button type="submit" class="btn btn-success btn-fill">Pay Now</button></a>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>                               
                                    </div>
                                </div>
                            </div>
                       </div>
                       @endforeach
                    @endif
                    @endif
                    <div class="row">
                            <div class="col-md-12">
                            <div class="card">
                                <div class="header text-center">
                                    <h4 class="title">Do You own any property ?</h4>
                                </div>
                                <div class="content">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <a href="{{route('tenantsubmitform')}}"><button type="submit" class="btn btn-info btn-fill">Rent Your Property</button></a>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>                               
                                </div>
                            </div>
                        </div>
                   </div>
                   <div class="row">
                        <div class="col-md-12">
                        <div class="card">
                            <div class="header text-center">
                                <h4 class="title">Relax at your new home</h4>
                            </div>
                            <div class="content">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-success btn-fill">Apply fro Rent Deposit Loan</button>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>                               
                            </div>
                        </div>
                    </div>
               </div>
               </div>
           </div>
          </div>
        </div>
        <div id="divLoading"> 

        </div>
        <!--Modal -->
        @if(isset($payment_flag) && $payment_flag && isset($payment_modal_data) && is_array($payment_modal_data) && !empty($payment_modal_data))
        <div class="modal show" id="payment-info-modal" tabindex="-1" role="dialog" aria-labelledby="payment-info-modal" aria-hidden="true" data-backdrop="static" data-keyboard="false" style="background-color: rgba(0, 0, 0, 0.5);">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div style="" class="modal-header">
                        <h4 class="modal-title">
                            @if(isset($payment_modal_data['info']))
                            {{$payment_modal_data['info']}}
                            @else 
                            N/A
                            @endif
                        </h4>
                    </div>
                    <div class="modal-body">
                        @if(isset($payment_modal_data['msg']))
                        <h5>
                            @if(isset($payment_modal_data['msg']))
                            {{$payment_modal_data['msg']}}
                            <i class="pe-7s-check icon-success"></i>
                            @else 
                            N/A 
                            @endif                      
                        </h5>
                        @endif
                        <p class="category">
                        Transaction ID : 
                        <strong>
                        @if(isset($payment_modal_data['transaction_id']))
                            {{$payment_modal_data['transaction_id']}}
                        @else 
                        N/A
                        @endif
                        </strong>
                        </p>
                        @if(isset($payment_modal_data['created_at']))
                        <p class="category">
                        Payment Date : 
                        <strong>
                        @if(isset($payment_modal_data['created_at']))
                            {{$payment_modal_data['created_at']}}
                        @else 
                        N/A
                        @endif
                        </strong>
                        </p>
                        @endif
                    </div>  
                    <div class="modal-footer">
                        @if(isset($payment_modal_data['created_at']))
                        <p class="category"> You can view your Invoice through <a href= "{{route('tenant.invoices.all')}}">My Invoice </a>page.
                        @else
                        <a href= "{{route('tenantaccount')}}"><button type="button" class="btn btn-success btn-fill">Go Back</button></a>
                        @endif
                    </div>
              </div>
            </div>
          </div><!-- /.modal -->
        @endif
<script>
var token = '{{Session::token()}}';
var url_send_email_otp = '{{route('user.send.email.otp')}}';
var url_send_mobile_otp = '{{route('user.send.mobile.otp')}}';
var url_verify_otp = '{{route('user.verify.email.otp')}}';
var url_update_em = '{{route('user.update.email.mobile')}}';
var url_update_name = '{{route('user.update.name')}}';
var url_tenant_dashboard = '{{route('tenantaccount')}}';
</script>
@include('includes.adminfooter')
</div>
@endsection

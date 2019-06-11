@extends('layouts.admin')
@section('pendingoneservicerequest')
@section('active')
    class="active"
@endsection
@include('includes.adminheader')
<div class="main-panel">
  @section('DashboardSiteMap')
  Admin Dashboard / All Service Requests / Review One
  @endsection
@include('includes.adminnav')
<div class="content">
  <div class="container-fluid">
      <div class="row">
        <div class="col-md-8" id="">
        @if($reqByData==true)
          <div class="card">
            <div class="header">
                <h4 class="title">Requested by</h4>
                <p class="category">{!! $requestBy->userTypeFun->user_type !!}</p>
            </div>
            <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="fromName">Name (disabled)</label>
                        <input type="text" class="form-control" disabled placeholder="Name" name="fromName" id="fromName" value="{!! $requestBy->name !!}">
                    </div>
                </div>
                </div>
                <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="fromEmail">Email address (disabled)</label>
                        <input type="email" class="form-control" disabled placeholder="Email" name="fromEmail" id="fromEmail" value="{!! $requestBy->email !!}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="fromMobile">Mobile (disabled)</label>
                        <input type="text" class="form-control" disabled placeholder="Mobile" name="fromMobile" id="fromMobile" value="{!! $requestBy->mobile !!}">
                    </div>
                </div>
                </div>

            </div>
          </div>
          @endif
        @if($reqToData==true)
          <div class="card">
            <div class="header">
                <h4 class="title">Requested To</h4>
                <p class="category">{!! $requestTo->userTypeFun->user_type !!}</p>
            </div>
            <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="toName">Name (disabled)</label>
                        <input type="text" class="form-control" disabled placeholder="Name" name="toName" id="toName" value="{!! $requestTo->name !!}">
                    </div>
                </div>
                </div>
                <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="toEmail">Email address (disabled)</label>
                        <input type="email" class="form-control" disabled placeholder="Email" name="toEmail" id="toEmail" value="{!! $requestTo->email !!}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="toMobile">Mobile (disabled)</label>
                        <input type="text" class="form-control" disabled placeholder="Mobile" name="toMobile" id="toMobile" value="{!! $requestTo->mobile !!}">
                    </div>
                </div>
                </div>

            </div>
          </div>
          @endif
        </div>
        @if($reqData==true)
        <div class="col-md-4">
            <div class="card card-user">
              <a href="{{route('oneproperty.check',['prop_id'=>$onePendingServiceRequest->prop_id])}}">
                <div class="image">
                  @if (Storage::disk('public_uploads')->has($onePendingServiceRequest->prop_id.'.jpg'))
                    <img src="{{ route('prop.image', ['filename' => $onePendingServiceRequest->prop_id.'.jpg']) }}" alt="..." class="img-responsive"/>
                    @else
                    <img src="{{ route('prop.image', ['filename' => 'default.jpg']) }}" alt="" class="img-responsive">
                    @endif
                </div>
                <div class="content">
                   <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <th class="text-left">Location</th>
                        <th class="text-right">Furnishing status</th>
                      </thead>
                        <tbody>
                          <tr>
                            <td class="text-left">{!! $onePendingServiceRequest->tsSubmittedPropertyFun->prop_city !!}</td>
                            <td class="text-right">{{$onePendingServiceRequest->tsSubmittedPropertyFun->furnishFUn->prop_furnish_status}}</td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                  <div class="table-responsive" style="margin-top:-10%; margin-bottom:-10%;">
                  <table class="table">
                  <thead>
                  <th class="text-left">Price</th>
                  <th class="text-right">Tenant Prefrence</th>
                  </thead>
                  <tbody>
                  <tr>
                  <td class="text-left">{!! $onePendingServiceRequest->tsSubmittedPropertyFun->prop_rent !!}</td>
                  <td class="text-right">{{$onePendingServiceRequest->tsSubmittedPropertyFun->msPropertyTenantFun->tenant_prefrences}}</td>
                  </tr>
                  </tbody>
                  </table>

                  </div>
                </div>
                <hr>
                <div class="text-center">
                    Listed By - {{$onePendingServiceRequest->tsSubmittedPropertyFun->msPropertyUserFun->name}}

                </div>
              </a>
            </div>

            <div class="card">
              <div class="content" id="serForm">
                <div class="text-center">
                  <form id="serviceReqVerifyForm">
                        <div class="form-group" hidden>
                            <label for="serviceReqID">Service Request ID</label>
                            <input type="text" disabled hidden class="form-control" disabled placeholder="Mobile" name="serviceReqID" id="serviceReqID" value="{{$onePendingServiceRequest->tag_prop_request_id}}">
                        </div>
                        <button type="submit" class="btn btn-info btn-fill">Verify request</button>
                  </form>
              </div>
            </div>
            </div>


        </div>
        @endif
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
                  <p>Request Verified</p>
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



<script>
var token = '{{Session::token()}}';
var UrlUpdateOneServiceReq = '{{route('update.one.service.req')}}';
</script>
@include('includes.adminfooter')
    </div>
@endsection

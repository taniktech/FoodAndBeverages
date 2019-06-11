@extends('layouts.tenant')
@section('tenantservicerequests')
@section('active5')
    class="active"
@endsection
@include('includes.tenantheader')
<div class="main-panel">
  @section('DashboardSiteMap')
      Tenant Dashboard / All Service Requests
  @endsection
@include('includes.tenantnav')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">All Service Requests</h4>
                        <p class="category">Details of all Service Requests</p>
                    </div>
                    <div class="content table-responsive table-full-width">
                    @if(isset($ts_ser_reqs) && count($ts_ser_reqs) > 0)
                        <table class="table table-hover table-striped">
                            <thead>
                              <th>Sl</th>
                              <th>Appartment Name</th>
                              <th>Service Type</th>
                              <th>Your Message</th>
                              <th>Status</th>
                              <th>Message from Manager</th>
                            </thead>
                            <tbody>
                              @php
                              $i = 0;
                              @endphp
                              @foreach($ts_ser_reqs as $one_req)
                              @php
                              $i++;
                              @endphp
                                <tr>
                                  <td>{{$i}}.</td>
                                  <td>
                                      @if($one_req->tsSubmittedPropertyFun && $one_req->tsSubmittedPropertyFun->prop_title)
                                      {!! $one_req->tsSubmittedPropertyFun->prop_title !!}
                                      @else
                                      N/A
                                      @endif
                                    </td>
                                  <td>
                                      @if($one_req->serviceTypeFUn)
                                      {!! $one_req->serviceTypeFUn->service_req_type !!}
                                      @else
                                      N/A
                                      @endif
                                    </td>
                                    <td>
                                        @if($one_req->message)
                                            {!! $one_req->message !!}
                                        @else
                                            No message
                                        @endif
                                    </td>
                                    <td>
                                      @if($one_req->serviceActionFUn)
                                    {!! $one_req->serviceActionFUn->service_req_action !!}
                                    @else
                                      N/A
                                    @endif
                                </td>
                                <td>
                                  @if($one_req->msg_from_mngr)
                                    {!! $one_req->msg_from_mngr !!}
                                  @else
                                     No message
                                  @endif
                                </td>
                                </tr>
                              @endforeach
                            </tbody>
                        </table>
                    @else
                    <div class="alert alert-danger text-center">
                        <span><b> Info - </b> There is no requests made yet</span>
                    </div>
                    @endif
                    </div>
                </div>
            </div>
          </div>
      </div>
  </div>
@include('includes.adminfooter')
    </div>
@endsection

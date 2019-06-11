@extends('layouts.admin')
@section('servicerequests')
@section('active3')
    class="active"
@endsection
@include('includes.adminheader')
<div class="main-panel">
  @section('DashboardSiteMap')
      Admin Dashboard / All Service Requests
  @endsection
@include('includes.adminnav')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Service Requests</h4>
                        <p class="category">Details of all requests</p>
                    </div>
                    <div class="content table-responsive table-full-width">
                    @if($data==true)
                        <table class="table table-hover table-striped">
                            <thead>
                              <th>Sl</th>
                              <th>Requested By</th>
                              <th>Message</th>
                              <th>Property</th>
                              <th>Service Req For</th>
                              <th>Status</th>
                              <th>Message from Mgr</th>
                            </thead>
                            <tbody>
                              @php
                              $i = 0;
                              @endphp
                              @foreach($tsServiceRequests as $oneServiceRequest)
                              @php
                              $i++;
                              @endphp
                              <tr>
                                <td>{{$i}}</td>
                                <td>{!! $oneServiceRequest->userFun->name !!} ( {!! $oneServiceRequest->userFun->userTypeFun->user_type !!})</td>
                                @if($oneServiceRequest->message)
                                  <td>{!! $oneServiceRequest->message !!}</td>
                                @else
                                    <td>No message from requesting person</td>
                                @endif
                                <td>{!! $oneServiceRequest->tsSubmittedPropertyFun->prop_title !!} <a href="{{route('oneproperty.check',['prop_id'=>$oneServiceRequest->prop_id])}}"><span style="color: green;font-size: 10px;"> Click to see details</span></a></td>
                                <td>{!! $oneServiceRequest->serviceTypeFUn->service_req_type !!}</td>
                                <td>{!! $oneServiceRequest->serviceActionFUn->service_req_action !!}</td>
                                @if($oneServiceRequest->msg_from_mngr)
                                  <td>{!! $oneServiceRequest->msg_from_mngr !!}</td>
                                @else
                                    <td>No message fro mgr</td>
                                @endif
                              </tr>
                              @endforeach
                            </tbody>
                        </table>
                    @else
                    <div class="alert alert-danger text-center">
                        <span><b> Info - </b> There is no new requests</span>
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

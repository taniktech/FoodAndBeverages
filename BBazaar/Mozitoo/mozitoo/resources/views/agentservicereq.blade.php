@extends('layouts.agent')
@section('servicerequests')
@section('active3')
    class="active"
@endsection
@include('includes.agentheader')
<div class="main-panel">
  @section('DashboardSiteMap')
      Property Manager Dashboard / All Service Requests
  @endsection
@include('includes.agentnav')
<div class="content">
@if($tsServiceRequestCheck==true)
  <div class="container-fluid">
    <div class="row">
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
                                <p>New Service Requests</p>
                                {{ $tsRequestNew }}
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <hr />
                        <div class="stats">
                          @if($tsRequestNew > 0)
                          <a href="{{route('agent.newservicerequests')}}"><i class="pe-7s-angle-right-circle"></i> View </a>
                          @else
                          <a href="{{route('agent.servicerequests')}}"><i class="pe-7s-angle-right-circle"></i> Refresh </a>
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
                            <div class="icon-big icon-warning text-center">
                                <i class="pe-7s-volume2"></i>
                            </div>
                        </div>
                        <div class="col-xs-9">
                            <div class="numbers">
                              <p>Ongoing Service Requests</p>
                              {{ $tsRequestIntiated }}
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <hr />
                        <div class="stats">
                          @if($tsRequestIntiated > 0)
                          <a href="{{route('agent.onservicerequests')}}"><i class="pe-7s-angle-right-circle"></i> View </a>
                          @else
                          <a href="{{route('agent.servicerequests')}}"><i class="pe-7s-angle-right-circle"></i> Refresh </a>
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
                                <p>Completed Service Request</p>
                                {{ $tsRequestComp }}
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <hr />
                        <div class="stats">
                          @if($tsRequestComp > 0)
                          <a href="{{route('agent.compservicerequests')}}"><i class="pe-7s-angle-right-circle"></i> View </a>
                          @else
                          <a href="{{route('agent.servicerequests')}}"><i class="pe-7s-angle-right-circle"></i> Refresh </a>
                          @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">All Service Requests</h4>
                        <p class="category">Details of all Service Requests</p>
                    </div>
                    <div class="content table-responsive table-full-width">
                    @if($tsServiceRequestCheck==true)
                        <table class="table table-hover table-striped">
                            <thead>
                              <th>Sl</th>
                              <th>Listed By</th>
                              <th>Property Title</th>
                              <th>Service Type</th>
                              <th>Message</th>
                              <th>Current Status</th>
                              <th>Update Status</th>
                            </thead>
                            <tbody>
                              @php
                              $i = 0;
                              @endphp
                              @foreach($allRequests as $oneRequest)
                              @php
                              $i++;
                              @endphp
                                <tr>
                                  <td>{{$i}}</td>
                                  <td>{!! $oneRequest->userFun->name !!}</td>
                                  <td>{!! $oneRequest->tsSubmittedPropertyFun->prop_title !!}<a href="{{route('oneagentproperty.check',['prop_id'=>$oneRequest->prop_id])}}"><span style="color: green;font-size: 10px;"> Click to see details</span></a></td>
                                  <td>{!! $oneRequest->serviceTypeFUn->service_req_type !!}</td>
                                  @if($oneRequest->message)
                                    <td>{!! $oneRequest->message !!}</td>
                                  @else
                                      <td>No message</td>
                                  @endif
                                    <td><input type="radio" name="status{!! $oneRequest->ts_service_req_id !!}" checked value="{!! $oneRequest->service_req_action_id!!}"> {!! $oneRequest->serviceActionFUn->service_req_action !!}</td>
                                    @if($oneRequest->service_req_action_id == 1)
                                    <td><input type="radio" name="status{!! $oneRequest->ts_service_req_id !!}" value="2"> Intiated</td>
                                    <td><input type="radio" name="status{!! $oneRequest->ts_service_req_id !!}" value="3"> Completed</td>
                                  @endif
                                    @if($oneRequest->service_req_action_id == 2)
                                    <td><input type="radio" name="status{!! $oneRequest->ts_service_req_id !!}" value="1"> Not Intiated</td>
                                    <td><input type="radio" name="status{!! $oneRequest->ts_service_req_id !!}" value="3"> Completed</td>
                                  @endif
                                  @if($oneRequest->service_req_action_id == 1 or $oneRequest->service_req_action_id == 2)
                                  <td><button type="button" class="btn btn-fill btn-success ok" data-prop="{!! $oneRequest->ts_service_req_id !!}">Ok</button></td>
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
<script>
var token = '{{Session::token()}}';
var urlUpdateStatusSerReq = '{{route('update.agent.one.service.request')}}';
</script>
</div>
@endsection

@extends('layouts.agent')
@section('onservicerequests')
@section('active3')
    class="active"
@endsection
@include('includes.agentheader')
<div class="main-panel">
  @section('DashboardSiteMap')
      Property Manager Dashboard / Ongoing Service Requests
  @endsection
@include('includes.agentnav')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Ongoing Service Requests</h4>
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

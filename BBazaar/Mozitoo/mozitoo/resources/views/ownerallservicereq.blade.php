@extends('layouts.owner')
@section('ownerservicerequests')
@section('active6')
    class="active"
@endsection
@include('includes.ownerheader')
<div class="main-panel">
  @section('DashboardSiteMap')
      Owner Dashboard / All Service Requests
  @endsection
@include('includes.ownernav')
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
                              <th>Raised By</th>
                              <th>Property Name</th>
                              <th>Service Type</th>
                              <th>Message</th>
                              <th>Status</th>
                              <th>Message from Manager</th>
                            </thead>
                            <tbody>
                              @php
                              $i = 0;
                              @endphp
                              @foreach($ts_ser_reqs as $one_ser_req)
                              @php
                              $i++;
                              @endphp
                                <tr>
                                  <td>{{$i}}</td>
                                  <td>
                                    @if($one_ser_req->userFun)
                                    @if($one_ser_req->user_id == $owner->user_id)
                                    You
                                    @elseif($one_ser_req->userFun->name)
                                    {{ucwords($one_ser_req->userFun->name)}} @if($one_ser_req->userFun->userTypeFun)({{$one_ser_req->userFun->userTypeFun->user_type}})@endif
                                    @else
                                    N/A
                                    @endif
                                    @endif
                                  </td>
                                  <td>
                                    @if($one_ser_req->tsSubmittedPropertyFun && $one_ser_req->tsSubmittedPropertyFun->prop_title)
                                      {!! $one_ser_req->tsSubmittedPropertyFun->prop_title !!}<a href="{{route('oneownerproperty.check',['prop_id'=>$one_ser_req->prop_id])}}"><span style="color: green;font-size: 10px;"> Click to see details</span></a></td>
                                      @else
                                      N/A
                                      @endif
                                    </td>
                                    <td>
                                    @if(isset($one_ser_req->serviceTypeFUn))
                                      {!! $one_ser_req->serviceTypeFUn->service_req_type !!}
                                      @else
                                      N/A
                                      @endif
                                    </td>
                                    <td>
                                    @if($one_ser_req->message)
                                    {!! $one_ser_req->message !!}
                                    @else
                                        N/A
                                    @endif
                                    </td>
                                  <td>
                                      @if(isset($one_ser_req->serviceActionFUn))
                                      {!! $one_ser_req->serviceActionFUn->service_req_action !!}
                                      @else
                                      N/A
                                      @endif
                                    </td>
                                    <td>
                                    @if($one_ser_req->msg_from_mngr)
                                    {!! $one_ser_req->msg_from_mngr !!}
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
                        <span><b> Info - </b> There is no requests !</span>
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

@extends('layouts.agent')
@section('agentassignedprop')
@section('active1')
    class="active"
@endsection
@include('includes.agentheader')
<div class="main-panel">
  @section('DashboardSiteMap')
      Property Manager Dashboard / All Properties Info
  @endsection
@include('includes.agentnav')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">All Managing Property</h4>
                        <p class="category">Details of all properties and respective owner</p>
                    </div>
                    <div class="content table-responsive table-full-width">
                      @if($tsPropertiesFlag==true)
                        <table class="table table-hover table-striped">
                            <thead>
                              <th>Sl</th>
                              <th>Property Title</th>
                              <th>Owner's Name</th>
                              <th>Owner's Mobile</th>
                              <th>Owner's Email</th>
                              <th>Listed On</th>
                            </thead>
                            <tbody>
                              @php
                              $i = 0;
                              @endphp
                              @foreach($tsProperties as $oneProperty)
                              @php
                              $i++;
                              @endphp
                                <tr>
                                  <td>{{$i}}</td>
                                  <td>{!! $oneProperty->prop_title !!}<a href="{{route('oneagentproperty.check',['prop_id'=>$oneProperty->prop_id])}}"><span style="color: green;font-size: 10px;"> Click to see details</span></a></td>
                                  <td>{!! $oneProperty->msPropertyUserFun->name !!}</td>
                                  <td>{!! $oneProperty->msPropertyUserFun->mobile !!}</td>
                                  <td>{!! $oneProperty->msPropertyUserFun->email !!}</td>
                                  <td>{!! $oneProperty->created_at !!}</td>
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

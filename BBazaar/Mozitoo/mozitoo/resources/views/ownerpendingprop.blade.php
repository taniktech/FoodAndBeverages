@extends('layouts.owner')
@section('ownerpendingprops')
@section('active1')
    class="active"
@endsection
@include('includes.ownerheader')
<div class="main-panel">
  @section('DashboardSiteMap')
  Owner Dashboard /Pending Properties For Approval
  @endsection
@include('includes.ownernav')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Pending Property For Approval</h4>
                        <p class="category">Details of all properties</p>
                    </div>
                    <div class="content table-responsive table-full-width">
                    @if(isset($pend_prop) && count($pend_prop) > 0)
                        <table class="table table-hover table-striped">
                            <thead>
                              <th>Sl</th>
                              <th>Property Name</th>
                              <th>Locality</th>
                              <th>Type</th>
                              <th>Posted On</th>
                              <th>Action</th>
                            </thead>
                            <tbody>
                              @php
                              $i = 0;
                              @endphp
                              @foreach($pend_prop as $one_prop)
                              @php
                              $i++;
                              @endphp
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>
                                        @if($one_prop->prop_title)
                                          {!! $one_prop->prop_title !!}
                                        @else 
                                            N/A 
                                        @endif 
                                    </td>                                                                 
                                    <td>
                                        @if($one_prop->prop_locality)
                                        {!! $one_prop->prop_locality !!}
                                        @else 
                                            N/A 
                                        @endif 
                                    </td>
                                    <td>
                                        @if($one_prop->msPropTypeFun && $one_prop->msPropBhkFun)
                                        {{$one_prop->msPropTypeFun->prop_type}} - {{$one_prop->msPropBhkFun->prop_bhk }}
                                        @else 
                                        N/A 
                                        @endif 
                                    </td>    
                                  <td>
                                        @if($one_prop->created_at)
                                        {!! $one_prop->created_at->format('d-M-Y') !!}
                                        @else 
                                            N/A 
                                        @endif 
                                  </td>
                                  <td><a href="{{route('pending.owner.property.edit',['prop_id'=>$one_prop->prop_id])}}"><button type="button" class="btn btn-fill btn-success">See details</button></a></td>
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

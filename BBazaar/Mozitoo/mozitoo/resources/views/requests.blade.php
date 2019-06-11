@extends('layouts.admin')
@section('requests')
@section('active')
    class="active"
@endsection
@include('includes.adminheader')
<div class="main-panel">
  @section('DashboardSiteMap')
      Admin Dashboard / Pending Requests
  @endsection
@include('includes.adminnav')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Pending Property Requests</h4>
                        <p class="category">Details of all properties</p>
                    </div>
                    <div class="content table-responsive table-full-width">
                    @if($data==true)
                        <table class="table table-hover table-striped">
                            <thead>
                              <th>Sl</th>
                              <th>Listed By</th>
                              <th>Property Title</th>
                              <th>Location</th>
                            </thead>
                            <tbody>
                              @php
                              $i = 0;
                              @endphp
                              @foreach($pendingProperties as $pendingProperty)
                              @php
                              $i++;
                              @endphp
                                <tr>
                                  <td>{{$i}}</td>
                                  <td>{!! $pendingProperty->msPropertyUserFun->name !!}</td>
                                  <td>{!! $pendingProperty->prop_title !!}</td>
                                  <td>{!! $pendingProperty->prop_city !!}</td>
                                  <td><a href="{{route('property.edit',['prop_id'=>$pendingProperty->prop_id])}}"><button type="button" class="btn btn-fill btn-success">See Details</button></a></td>
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

@extends('layouts.admin')
@section('editedrequests')
@section('active')
    class="active"
@endsection
@include('includes.adminheader')
<div class="main-panel">
  @section('DashboardSiteMap')
      Admin Dashboard / Edited Requests
  @endsection
@include('includes.adminnav')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Pending Edited Requests</h4>
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
                              <th>Price</th>
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
                                  <td>{!! $pendingProperty->prop_rent !!}</td>
                                  <td><a href="{{route('property.edited.requests',['prop_id'=>$pendingProperty->prop_id])}}"><button type="button" class="btn btn-fill btn-success">See Details</button></a></td>
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

@extends('layouts.admin')
@section('alltenadmin')
@section('active1')
    class="active"
@endsection
@include('includes.adminheader')
<div class="main-panel">
  @section('DashboardSiteMap')
      Admin Dashboard / Tenants Info
  @endsection
@include('includes.adminnav')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">All Tenants</h4>
                        <p class="category">Details of all properties and respective tenant</p>
                    </div>
                    <div class="content table-responsive table-full-width">
                      @if($tenantPropCountFlag==true)
                        <table class="table table-hover table-striped">
                            <thead>
                              <th>Sl</th>
                              <th>Property Title</th>
                              <th>Tenat's Name</th>
                              <th>Tenant's Mobile</th>
                              <th>Tenant's Email</th>
                              <th>Listed On</th>
                            </thead>
                            <tbody>
                              @php
                              $i = 0;
                              @endphp
                              @foreach($tenantTaggedId as $oneTenantTaggedId)
                              @php
                              $i++;
                              @endphp
                                <tr>
                                  <td>{{$i}}</td>
                                  <td>{{ $oneTenantTaggedId->tsSubmittedPropFun->prop_title }}<a href="{{route('oneproperty.check',['prop_id'=>$oneTenantTaggedId->prop_id])}}"><span style="color: green;font-size: 10px;"> Click to see details</span></a></td>
                                  <td>{{ $oneTenantTaggedId->userFun->name }}</td>
                                  <td>{{ $oneTenantTaggedId->userFun->mobile }}</td>
                                  <td>{{ $oneTenantTaggedId->userFun->email }}</td>
                                  <td>{{ $oneTenantTaggedId->created_at }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                    <div class="alert alert-danger text-center">
                        <span><b> Info - </b> There is no tenant</span>
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
</script>
</div>
@endsection

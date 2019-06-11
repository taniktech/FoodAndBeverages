@extends('layouts.admin')
@section('allagentadmin')
@section('active1')
    class="active"
@endsection
@include('includes.adminheader')
<div class="main-panel">
  @section('DashboardSiteMap')
      Admin Dashboard / Agents Info
  @endsection
@include('includes.adminnav')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">All Property Managers</h4>
                        <p class="category">Details of all Property Managers</p>
                    </div>
                    <div class="content table-responsive table-full-width">
                      @if($agentCountFlag==true)
                        <table class="table table-hover table-striped">
                            <thead>
                              <th>Sl</th>
                              <th>Manager's Name</th>
                              <th>Mobile</th>
                              <th>Email</th>
                              <th>Listed On</th>
                            </thead>
                            <tbody>
                              @php
                              $i = 0;
                              @endphp
                              @foreach($agentData as $oneAgent)
                              @php
                              $i++;
                              @endphp
                                <tr>
                                  <td>{{$i}}</td>
                                  <td>{{ $oneAgent->name }} </td>
                                  <td>{{ $oneAgent->mobile }} </td>
                                  <td>{{ $oneAgent->email }} </td>
                                  <td>{{ $oneAgent->created_at }} </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                    <div class="alert alert-danger text-center">
                        <span><b> Info - </b> There is no Manager</span>
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

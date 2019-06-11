@extends('layouts.admin')
@section('admin')
@section('active4')
    class="active"
@endsection
@include('includes.adminheader')
<div class="main-panel">
  @section('DashboardSiteMap')
      Admin Dashboard / Unoccupied Inventory
  @endsection
@include('includes.adminnav')
<div class="content">
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="content">
                        <div class="row">
                            <div class="col-xs-3">
                                <div class="icon-big icon-info text-center">
                                    <i class="pe-7s-user"></i>
                                </div>
                            </div>
                            <div class="col-xs-9">
                                <div class="numbers">
                                    <p>Active Property</p>
                                    {{ $active_prop_count }}
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <hr />
                            <div class="stats">
                                @if($active_prop_count )
                                <a href="{{route('admin.inventory.review.inactive')}}"><i class="pe-7s-angle-right-circle"></i> Refresh </a>
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
                                <i class="pe-7s-attention"></i>
                            </div>
                        </div>
                        <div class="col-xs-9">
                            <div class="numbers">
                                <p>All Inventory</p>
                                {{ $all_invnt_count }}
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <hr />
                        <div class="stats">
                            @if($all_invnt_count > 0)
                            <a href="{{route('admin.inventory.review.all')}}"><i class="pe-7s-angle-right-circle"></i> View </a>
                            @else
                            <a href="{{route('admin.inventory.review.inactive')}}"><i class="pe-7s-angle-right-circle"></i> Refresh </a>
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
                                <p>Occupied</p>
                                {{ $active_invnt_count }}
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <hr />
                        <div class="stats">
                            @if($active_invnt_count > 0)
                            <a href="{{route('admin.inventory.review.active')}}"><i class="pe-7s-angle-right-circle"></i> View </a>
                            @else
                            <a href="{{route('admin.inventory.review.inactive')}}"><i class="pe-7s-angle-right-circle"></i> Refresh </a>
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
                                <i class="pe-7s-refresh-2"></i>
                            </div>
                        </div>
                        <div class="col-xs-9">
                            <div class="numbers">
                                <p>Unoccupied</p>
                                {{ $inactive_invnt_count }}
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <hr />
                        <div class="stats">
                            @if($inactive_invnt_count > 0)
                            <a href="{{route('admin.inventory.review.inactive')}}"><i class="pe-7s-angle-right-circle"></i> View </a>
                            @else
                            <a href="{{route('admin.inventory.review.inactive')}}"><i class="pe-7s-angle-right-circle"></i> Refresh </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">Unoccupied Inventory List</h4>
                    <p class="category">Unoccupied Inventory List</p>
                </div>        
                <div class="content table-responsive table-full-width">
                    @if($inactive_invnt_count > 0)
                    <table class="table table-hover table-striped">
                        <thead>
                            <th>Sl.</th>
                            <th>Status</th>
                            <th>Listed By</th>
                            <th>City</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>BHK Type</th>
                            <th>Inventory ID</th>
                            <th>Tenant Name</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @php
                            $i = 0;
                            @endphp
                            @foreach($all_inactive_invnt as $one_invnt)
                            @php
                            $i++;
                            @endphp
                            <tr>
                                <td>{{ $i }}.</td>
                                <td>
                                @if($one_invnt->invnt_status_id == 1)
                                <p class="text-warning">{{$one_invnt->msInvntStatusFun->invnt_status}}</p>  
                                @elseif($one_invnt->invnt_status_id == 2 && $one_invnt->user_id != 0)
                                <p class="text-success">{{$one_invnt->msInvntStatusFun->invnt_status}}</p>
                                @endif
                                </td>
                                <td>{{ucwords($one_invnt->tsSubmittedPropFun->msPropertyUserFun->name)}}</td>
                                <td>{{$one_invnt->tsSubmittedPropFun->prop_city}}</td>
                                <td>{{$one_invnt->tsSubmittedPropFun->prop_title}}</td>
                                <td>{{$one_invnt->tsSubmittedPropFun->msPropTypeFun->prop_type}}</td>
                                <td>{{$one_invnt->tsSubmittedPropFun->msPropBhkFun->prop_bhk}}</td>
                                <td>{{ $one_invnt->fomatted_invnt_id }}</td>
                                <td>
                                    @if($one_invnt->user_id == 0 && $one_invnt->invnt_status_id == 1)
                                    <p class="text-warning">Not Assigned</p>
                                    @elseif($one_invnt->user_id != 0 && $one_invnt->invnt_status_id == 2)
                                    <p class="text-success">{{ ucwords($one_invnt->tenantFun->name) }}</p>
                                    @else
                                    <p class="text-warning">Not Assigned</p>
                                    @endif
                                </td>
                                <td>
                                @php
                                    $prop_id = $one_invnt->prop_id;
                                    $parameter= Crypt::encrypt($prop_id);
                                @endphp    
                                <a href="{{route('admin.inventory.info.one',['prop_id'=>$parameter,'invnt_id'=>$one_invnt->ts_prop_invnt_id])}}"><button type="button" class="btn btn-info btn-fill" id="conf-prop-invnt">Modify</button></a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                <div class="alert alert-danger text-center">
                    <span><b> Info - </b> There is no inventory</span>
                </div>
                @endif
                </div>
                
            </div>
        </div>
    </div>
</div>
<div id="divLoading"> 

</div>
</div>
<!--Modaal-->
<div class="modal" tabindex="-1" role="dialog" id="success-invnt-review-modal" aria-hidden="true" data-backdrop="false" data-keyboard="false" aria-labelledby="myModalLabel" style="background-color:rgba(256,256,256, 0.9);">
    <div class="modal-dialog">
        <div class="modal-content">
          <div style="" class="modal-header">
              <h4 class="modal-title">Inventory List</h4>
          </div>
          <div class="modal-body" id="invnts-modal-body">
             <!--Inventories will be appended-->
          </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-info btn-fill" id="conf-prop-invnt">Confirm</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<!-- /.modal -->
@include('includes.adminfooter')
</div>
<script>
var token = '{{Session::token()}}';
</script>
@endsection

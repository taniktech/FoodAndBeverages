@extends('layouts.agent')
@section('agentproperties')
@section('active1')
    class="active"
@endsection
@include('includes.agentheader')
<div class="main-panel">
  @section('DashboardSiteMap')
  Property Manager Dashboard / All Properties
  @endsection
@include('includes.agentnav')
      <div class="content">
        <div class="container-fluid">
        @if($data==true)
            <div class="row">
                @foreach($allProperties as $oneProperty)
                <div class="col-md-4">
                  <a href="{{route('oneagentproperty.check',['prop_id'=>$oneProperty->prop_id])}}">
                    <div class="card card-user">
                        <div class="image">
                          @if (Storage::disk('public_uploads')->has($oneProperty->prop_id.'.jpg'))
                            <img src="{{ route('prop.image', ['filename' => $oneProperty->prop_id.'.jpg']) }}" alt="..." class="img-responsive"/>
                            @else
                            <img src="{{ route('prop.image', ['filename' => 'default.jpg']) }}" alt="" class="img-responsive">
                            @endif
                        </div>
                        <div class="content">
                           <div class="table-responsive">
                            <table class="table">
                              <thead>
                                <th class="text-left">Location</th>
                                <th class="text-right">Furnishing status</th>
                              </thead>
                                <tbody>
                                  <tr>
                                    <td class="text-left">{!! $oneProperty->prop_locality !!}</td>
                                    <td class="text-right">{{$oneProperty->furnishFUn->prop_furnish_status}}</td>
                                    </tr>
                                </tbody>
                            </table>
                            </div>
                          <div class="table-responsive" style="margin-top:-10%; margin-bottom:-10%;">
                          <table class="table">
                          <thead>
                          <th class="text-left">Price</th>
                          <th class="text-right">Tenant Prefrence</th>
                          </thead>
                          <tbody>
                          <tr>
                          <td class="text-left">{!! $oneProperty->prop_rent !!}</td>
                          <td class="text-right">{{$oneProperty->msPropertyTenantFun->tenant_prefrences}}</td>
                          </tr>
                          </tbody>
                          </table>

                          </div>
                        </div>
                        <hr>
                        <div class="text-center">
                            Listed By - {{$oneProperty->msPropertyUserFun->name}} ( @if($oneProperty->user_id == $agent->user_id) You @else {{$oneProperty->msPropertyUserFun->userTypeFun->user_type}} @endif)
                        </div>
                    </div>
                    </a>
                </div>
                @endforeach
            </div>
            @else
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">All Properties</h4>
                            <p class="category">No active property</p>
                        </div>
                        <div class="content">
                        <div class="alert alert-danger text-center">
                            <span><b> Info - </b> There is no active property</span>
                        </div>
                          </div>
                      </div>
                      </div>
            </div>
            @endif
        </div>
    </div>
@include('includes.adminfooter')
    </div>
@endsection

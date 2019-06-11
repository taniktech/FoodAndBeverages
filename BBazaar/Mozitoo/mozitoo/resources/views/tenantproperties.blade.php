@extends('layouts.tenant')
@section('tenantproperties')
@section('active2')
    class="active"
@endsection
@include('includes.tenantheader')
<div class="main-panel">
  @section('DashboardSiteMap')
      Tenant Dashboard / My Home
  @endsection
@include('includes.tenantnav')
      <div class="content">
        <div class="container-fluid">
        @if($data==true)
            <div class="row">
                <div class="col-md-4">
                  <a href="{{route('onetenantproperty.check',['prop_id'=>$tenant_prop->prop_id])}}">
                    <div class="card card-user">
                        <div class="image">
                          @if (Storage::disk('public_uploads')->has($tenant_prop->prop_id.'.jpg'))
                            <img src="{{ route('prop.image', ['filename' => $tenant_prop->prop_id.'.jpg']) }}" alt="..." class="img-responsive"/>
                            @else
                            <img src="{{ route('prop.image', ['filename' => 'default.jpg']) }}" alt="" class="img-responsive">
                            @endif
                        </div>
                        <div class="content">
                            <div class="author">
                                <h4 class="title">
                                @if($tenant_prop->prop_title){!! $tenant_prop->prop_title !!}
                                @else 
                                N/A
                                @endif
                                </h4>
                            </div>    
                            <hr>
                            <div class="text-center">
                                <div class="row">
                                    <div class="col-md-6">
                                    <h5>Address Line 1<br />
                                        <small>
                                            @if($tenant_prop->prop_address_line1){!! $tenant_prop->prop_address_line1 !!}
                                            @else 
                                            N/A
                                            @endif
                                        </small>
                                    </h5>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Location<br />
                                            <small>
                                                @if($tenant_prop->prop_locality){!! $tenant_prop->prop_locality !!}
                                                @else 
                                                N/A
                                                @endif
                                            </small>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="text-center">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Property Type<br />
                                            <small>
                                                @if($tenant_prop->msPropTypeFun && $tenant_prop->msPropBhkFun)
                                                {{$tenant_prop->msPropTypeFun->prop_type}} - {{$tenant_prop->msPropBhkFun->prop_bhk }}
                                                @else 
                                                N/A
                                                @endif
                                            </small>
                                        </h5>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Tenant Preferance<br />
                                            <small>
                                                @if($tenant_prop->msPropertyTenantFun)
                                                {{$tenant_prop->msPropertyTenantFun->tenant_prefrences}}
                                                @else 
                                                N/A
                                                @endif
                                            </small>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="text-center">
                            Owner - {{ucwords($tenant_prop->msPropertyUserFun->name)}}
                        </div>
                    </div>
                    </a>
                </div>
            </div>
            @else
            <div class="row">
              <div class="col-md-12">
              <div class="card">
                  <div class="header">
                      <h4 class="title">Your Home</h4>
                      <p class="category">You are not a tenant with us yet</p>
                  </div>
                  <div class="content">
                  <div class="alert alert-danger text-center">
                      <span><b> Info - </b> You are not a tenant with us yet</span>
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

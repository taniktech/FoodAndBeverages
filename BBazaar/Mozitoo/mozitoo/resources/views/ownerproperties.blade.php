@extends('layouts.owner')
@section('ownerproperties')
@section('active1')
    class="active"
@endsection
@include('includes.ownerheader')
<div class="main-panel">
  @section('DashboardSiteMap')
      Owner Dashboard / All Properties
  @endsection
@include('includes.ownernav')
      <div class="content">
        <div class="container-fluid">
        @if(isset($ts_prop) && $ts_prop && count($ts_prop) > 0)
            <div class="row">
                @foreach($ts_prop as $one_property)
                <div class="col-md-4">
                  <a href="{{route('oneownerproperty.check',['prop_id'=>$one_property->prop_id])}}">
                    <div class="card card-user">
                        <div class="image">
                          @if (Storage::disk('public_uploads')->has($one_property->prop_id.'.jpg'))
                            <img src="{{ route('prop.image', ['filename' => $one_property->prop_id.'.jpg']) }}" alt="Property Image" class="img-responsive"/>
                            @else
                            <img src="{{ route('prop.image', ['filename' => 'default.jpg']) }}" alt="Property Image" class="img-responsive">
                            @endif
                        </div>
                        <div class="content">
                            <div class="author">
                                <h4 class="title">
                                @if($one_property->prop_title){!! $one_property->prop_title !!}
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
                                            @if($one_property->prop_address_line1){!! $one_property->prop_address_line1 !!}
                                            @else 
                                            N/A
                                            @endif
                                        </small>
                                    </h5>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Location<br />
                                            <small>
                                                @if($one_property->prop_locality){!! $one_property->prop_locality !!}
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
                                                @if($one_property->msPropTypeFun && $one_property->msPropBhkFun)
                                                {{$one_property->msPropTypeFun->prop_type}} - {{$one_property->msPropBhkFun->prop_bhk }}
                                                @else 
                                                N/A
                                                @endif
                                            </small>
                                        </h5>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Availble as<br />
                                            <small>
                                                @if($one_property->tsPropInvntLevelsFUn) 
                                                @php
                                                $resultstr = [];
                                                foreach($one_property->tsPropInvntLevelsFUn as $product)
                                                $resultstr[] = $product->msPropLevelFun->prop_invnt_level; 
                                                echo implode(" / ",$resultstr);   
                                                @endphp
                                                @else
                                                N/A
                                                @endif
                                                @if($one_property->msPropertyTenantFun)
                                                    ( For - {{$one_property->msPropertyTenantFun->tenant_prefrences}} )
                                                @endif
                                            </small>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="text-center">
                            Listed By - {{$one_property->msPropertyUserFun->name}} ( @if($one_property->user_id == $owner->user_id) You @endif)
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

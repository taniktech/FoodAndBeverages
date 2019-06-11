@extends('layouts.owner')
@section('ownerserreqform')
@section('active5')
    class="active"
@endsection
@include('includes.ownerheader')
<div class="main-panel">
  @section('DashboardSiteMap')
      Owner Dashboard / Raise Service Request
  @endsection
@include('includes.ownernav')
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Raise Service Request</h4>
                                <p class="category">Please select Your property and Service type</p>
                            </div>
                            <div class="content">
                                  <form id="owner-ser-req-form">
                                  <div class="row">
                                  <div class="col-md-12 ">
                                    <div class="form-group">
                                    <label for="owner-prop-id">My Property</label>
                                    <select class="selectpicker form-control" name="owner_prop_id" id="owner-prop-id">
                                    @if(isset($owner_prop) && count($owner_prop) > 0)
                                    <optgroup label="All Property">
                                    <option value="" class="ignore">Select...</option>
                                      @foreach($owner_prop as $one_prop)
                                      <option value="{{$one_prop->prop_id}}">{{$one_prop->prop_title}} @if($one_prop->prop_locality) Located in {{$one_prop->prop_locality}}@endif</option>
                                      @endforeach
                                    </optgroup>
                                    @else
                                    <optgroup label="No Property added yet">
                                      <option value="" class="ignore">Select...</option>
                                    </optgroup>
                                    @endif
                                    </select>
                                    </div>
                                  </div>
                                  </div>
                                  <div class="row">
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                    <label for="service-req-type">Service Type</label>
                                    <select class="selectpicker form-control" name="service_req_type" id="service-req-type">
                                    @if(isset($ms_ser_req_type) && count($ms_ser_req_type) > 0)
                                    <optgroup label="Type Preference">
                                      <option value="" class="ignore">Select...</option>
                                      @foreach($ms_ser_req_type as $one_type)
                                      <option value="{{$one_type->service_req_type_id}}">{{$one_type->service_req_type}}</option>
                                      @endforeach
                                    </optgroup>
                                    @else
                                    <optgroup label="No Property added yet">
                                      <option value="" class="ignore">Select...</option>
                                    </optgroup>
                                    @endif
                                    </select>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-sm-12">
                                  <div class="form-group">
                                  <label for="service-msg">Message: (Optionl)</label>
                                  <textarea name="service_msg" type="textarea" class="form-control" rows="3" id="service-msg" placeholder="Message"></textarea>
                                  </div>
                                  </div>
                                </div>
                                  <button type="submit" class="btn btn-info btn-fill">Send</button>
                              </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
        var token = '{{Session::token()}}';
        var url_owner_post_ser_req = '{{route('ownerservicerequest')}}';
        var url_owner_get_ser_reqs = '{{route('owner.service.req.all')}}';
        </script>
@include('includes.adminfooter')
    </div>
@endsection

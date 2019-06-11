@extends('layouts.admin')
@section('admin')
@section('active4')
    class="active"
@endsection
@include('includes.adminheader')
<div class="main-panel">
  @section('DashboardSiteMap')
      Admin Dashboard / Create Inventory
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
                            <a href="{{route('admin.inventory.review.createnew')}}"><i class="pe-7s-angle-right-circle"></i> Refresh </a>
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
                            <a href="{{route('admin.inventory.review.createnew')}}"><i class="pe-7s-angle-right-circle"></i> Refresh </a>
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
                            <a href="{{route('admin.inventory.review.createnew')}}"><i class="pe-7s-angle-right-circle"></i> Refresh </a>
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
                            <a href="{{route('admin.inventory.review.createnew')}}"><i class="pe-7s-angle-right-circle"></i> Refresh </a>
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
                    <h4 class="title">Create Inventory</h4>
                    <p class="category">Select the Property which has no Inventory</p>
                </div>
                <div class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="prop-with-no-invnt">Property List having no Inventory</label>
                                    <select class="selectpicker form-control" name="prop_with_no_invnt" id="prop-with-no-invnt">
                                        @if($count_flag == true && count($props_with_no_invnt) > 0)
                                        <optgroup label="Property list with no inventory">
                                            <option value="" class="ignore">Select...</option>                                      
                                            @foreach($props_with_no_invnt as $oneProperty)
                                            <option value="{{$oneProperty->prop_id}}">{{$oneProperty->prop_title}} Located in {{$oneProperty->prop_locality}}</option>
                                            @endforeach  
                                        </optgroup>                                     
                                        @else
                                        <optgroup label="No Property Availble">
                                          <option value="" class="ignore">Select...</option>
                                        </optgroup>
                                        @endif
                                    </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="divLoading"> 
</div>
<div class="container-fluid">
    <div id="pend-prop-dyn-summary">                       
   
    </div>

</div>
</div>
<!--Modaal-->
<div class="modal" tabindex="-1" role="dialog" id="success-invnt-review-modal" aria-hidden="true" data-backdrop="false" data-keyboard="false" aria-labelledby="success-invnt-review-modal" style="background-color:rgba(256,256,256, 0.9);">
    <div class="modal-dialog">
        <div class="modal-content">
        <form id="dyn-created-invnt-ids-form">
          <div style="" class="modal-header">
              <h4 class="modal-title">Inventory List</h4>
          </div>
          <div class="modal-body" id="invnts-modal-body">
             <!--Inventories will be appended-->
          </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-info btn-fill" id="conf-prop-invnt">Confirm</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        </form>
      </div>
    </div>
  </div>
<!-- /.modal -->
@include('includes.adminfooter')
</div>
<script>
var token = '{{Session::token()}}';
var url_get_pend_pro_invnt = '{{route('admin.inventory.createnew.verify')}}';
var url_get_invnt_level_valid = '{{route('admin.inventory.level.valid')}}';
var url_post_invnt_create = '{{route('admin.inventory.createnew')}}';
var url_all_invnt = '{{route('admin.inventory.review.all')}}';
</script>
@endsection

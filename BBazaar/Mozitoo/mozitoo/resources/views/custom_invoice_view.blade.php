@extends('layouts.admin')
@section('admin')
@section('active5')
    class="active"
@endsection
@include('includes.adminheader')
<div class="main-panel">
  @section('DashboardSiteMap')
      Admin Dashboard / Create Custom Invoice
  @endsection
@include('includes.adminnav')
<div class="content">
<form id="cust-inv-form" method="post">
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">Create Custom Invoice against tenant</h4>
                    <p class="category">Select the tenant from list</p>
                </div>
                <div class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ten-list-cust-inv">Tenant List</label>
                                    <select class="selectpicker form-control" name="ten_list_cust_inv" id="ten-list-cust-inv">
                                        @if(isset($tenant_list) && count($tenant_list) > 0)
                                            <option value="" class="ignore">Select...</option>                                      
                                            @foreach($tenant_list as $one_tenant)
                                            @if($one_tenant->user_id && $one_tenant->tenantFun)<option value="{{$one_tenant->user_id}}">{{ $one_tenant->tenantFun->name }}</option>@endif
                                            @endforeach                                   
                                        @else
                                        <optgroup label="No Tenants Availble">
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
<div class="container-fluid">
    <div id="cust-ten-invnt-prop-summ">                       
   
    </div>

</div>
<div class="container-fluid">
    <div id="cust-ten-invnt-details">                       
   
    </div>

</div>
<div class="container-fluid">
    <div id="cust-ten-head-details">                       
   
    </div>

</div>
<div id="divLoading"> 
</div>
</form>
</div>
@include('includes.adminfooter')
</div>
<script>
var token = '{{Session::token()}}';
var url_get_cust_inv_ten = '{{route('admin.custom.invoice.tenat.details')}}';
var url_get_cust_inv_invnt = '{{route('admin.custom.invoice.invnt.details')}}';
var url_gen_cust_inv = '{{route('admin.invoices.genrate.custom.invoice')}}';
var url_dr_invoices = '{{route('admin.invoices.get.draft')}}';
</script>
@endsection

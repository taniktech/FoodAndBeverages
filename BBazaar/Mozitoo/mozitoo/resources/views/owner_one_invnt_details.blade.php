@extends('layouts.owner')
@section('owner')
@section('active1')
    class="active"
@endsection
@include('includes.ownerheader')
<div class="main-panel">
  @section('DashboardSiteMap')
      Owner Dashboard / Inventory Details
  @endsection
@include('includes.ownernav')
<div class="content">
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">All Tenants</h4>
                    <p class="category">Details of tenants of this Inventory</p>
                </div>        
                <div class="content table-responsive table-full-width">
                    @if(isset($tenants) && count($tenants) > 0)
                    <table class="table table-hover table-striped" id="oat-invnt-ten-table">
                        <thead>
                            <th>Sl.</th>
                            <th>Status</th>                          
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Monthly Rent</th>
                            <th>Maint. Charge</th>
                            <th>Rent Pay Date</th>
                            <th>Rental Agreement</th>
                        </thead>
                        <tbody>
                            @php
                            $i = 0;
                            @endphp
                            @foreach($tenants as $one_tenant)
                                @php
                                $i++;
                                $ten = 0;
                                $id = 0;
                                @endphp
                            <tr>
                                <td>{{ $i }}.</td>
                                <td>
                                    @if(isset($one_tenant->statusFun))             
                                    @if($one_tenant->tagged_tenant_status_id == 1)
                                    <span class="text-success">{{$one_tenant->statusFun->tagged_tenant_status}}</span>
                                    @endif 
                                    @if($one_tenant->tagged_tenant_status_id == 2)
                                    <span class="text-warning">{{$one_tenant->statusFun->tagged_tenant_status}}</span>
                                    @endif        
                                    @else 
                                    N/A
                                    @endif
                                </td>
                                <td>
                                    @if(isset($one_tenant->tenantFun) && $one_tenant->tenantFun->name)
                                    @php
                                    $ten = $one_tenant->user_id;
                                    $id = $one_tenant->tagged_tenant_id;
                                    @endphp 
                                    {{ucwords($one_tenant->tenantFun->name)}}
                                    @else 
                                    N/A
                                    @endif
                                </td>
                                <td>
                                    @if(isset($one_tenant->tenantFun) && $one_tenant->tenantFun->email)
                                    {{$one_tenant->tenantFun->email}}
                                    @else 
                                    N/A
                                    @endif
                                </td>
                                <td>
                                    @if(isset($one_tenant->tenantFun) && $one_tenant->tenantFun->mobile)
                                    {{$one_tenant->tenantFun->mobile}}
                                    @else 
                                    N/A
                                    @endif
                                </td>
                                <td>
                                    @if(isset($one_tenant->start_date))
                                    @php
                                        $s_date=date_create($one_tenant->start_date);
                                    @endphp
                                    {{ date_format($s_date,"d-M-Y") }}
                                    @else 
                                    N/A
                                    @endif
                                </td>
                                @if($one_tenant->tagged_tenant_status_id == 1 && isset($one_tenant->invntFun))
                                <td>     
                                    Present
                                </td>
                                <td>     
                                @if(isset($one_tenant->invntFun->rent))
                                {{$one_tenant->invntFun->rent}}
                                @else 
                                    N/A
                                @endif
                                </td>
                                <td>
                                @if(isset($one_tenant->invntFun->maint_charge))
                                {{$one_tenant->invntFun->maint_charge}}
                                @else 
                                    N/A
                                @endif
                                </td>
                                <td>
                                    @if(isset($one_tenant->invntFun->rent_pay_date))
                                    {{$one_tenant->invntFun->rent_pay_date}}
                                    @else 
                                        N/A
                                    @endif
                                </td>
                                @endif
                                @if($one_tenant->tagged_tenant_status_id == 2)
                                <td>  
                                    @if(isset($one_tenant->end_date))   
                                    @php
                                    $e_date=date_create($one_tenant->end_date);
                                    @endphp
                                    {{ date_format($e_date,"d-M-Y") }}
                                    @else 
                                    N/A
                                    @endif
                                </td>
                                <td>     
                                @if(isset($one_tenant->rent))
                                {{$one_tenant->rent}}
                                @else 
                                    N/A
                                @endif
                                </td>
                                <td>
                                @if(isset($one_tenant->maint_charge))
                                {{$one_tenant->maint_charge}}
                                @else 
                                    N/A
                                @endif
                                </td>
                                <td>
                                    @if(isset($one_tenant->rent_pay_date))
                                    {{$one_tenant->rent_pay_date}}
                                    @else 
                                        N/A
                                    @endif
                                </td>
                                @endif
                                <td>
                                    @if(Storage::disk('rental_agrmnts')->has($id.'.pdf'))
                                    @php 
                                    $tmp_id_0 = Crypt::encrypt($id);
                                    @endphp
                                    <a href="{{route('owner.rental.agreement.get',['tmp_id_0'=>$ten,'tmp_id_1'=>$tmp_id_0, 'Agreement'=>'Agreement'])}}" target="_blank">View PDF</button>
                                    @else
                                    <button type="button" class="u-r-a-p btn btn-info" data-id="{{$ten}}" data-idd="{{$id}}">Upload</button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                <div class="alert alert-danger text-center">
                    <span><b> Info - </b> There is no history of tenants</span>
                </div>
                @endif
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
                            <h4 class="title">All Invoices</h4>
                            <p class="category">Details of invoices against this Inventory</p>
                        </div>        
                        <div class="content table-responsive table-full-width">
                            @if(isset($invoices) && count($invoices) > 0)
                            <table class="table table-hover table-striped">
                                <thead>
                                    <th>Sl.</th>
                                    <th>Status</th>                           
                                    <th>Tenant Name</th>
                                    <th>Tenant Email</th>
                                    <th>Tenant Mobile</th>
                                    <th>Total Amount</th>
                                    <th>Invoice Date</th>
                                    <th>For Month</th>
                                    <th>Due Date</th>
                                    <th>View Invoice</th>
                                </thead>
                                <tbody>
                                    @php
                                    $i = 0;
                                    @endphp
                                    @foreach($invoices as $one_invoice)
                                        @php
                                        $i++;
                                        @endphp
                                    <tr>
                                        <td>{{ $i }}.</td>
                                        <td>
                                            @if($one_invoice->invoice_status_id && $one_invoice->msInvoiceStatusFun)
                                            @if($one_invoice->invoice_status_id == 1)
                                            <span class="text-info">{{ucwords($one_invoice->msInvoiceStatusFun->invoice_status)}}</span>
                                            @endif
                                            @if($one_invoice->invoice_status_id == 2)
                                            <span class="text-warning">{{ucwords($one_invoice->msInvoiceStatusFun->invoice_status)}}</span>
                                            @endif
                                            @if($one_invoice->invoice_status_id == 3)
                                            <span class="text-success">{{ucwords($one_invoice->msInvoiceStatusFun->invoice_status)}}</span>
                                            @endif
                                            @else
                                                Not Availble
                                            @endif   
                                        </td>
                                        <td>
                                            @if($one_invoice->user_id && $one_invoice->msTenantFun && $one_invoice->msTenantFun->name)
                                            {{ ucwords($one_invoice->msTenantFun->name)}}
                                            @else
                                                Not Availble
                                            @endif
                                        </td>
                                        <td>
                                            @if($one_invoice->user_id && $one_invoice->msTenantFun && $one_invoice->msTenantFun->email)
                                            {{ $one_invoice->msTenantFun->email}}
                                            @else
                                                Not Availble
                                            @endif
                                        </td>
                                        <td>
                                            @if($one_invoice->user_id && $one_invoice->msTenantFun && $one_invoice->msTenantFun->mobile)
                                            {{ $one_invoice->msTenantFun->mobile}}
                                            @else
                                                Not Availble
                                            @endif
                                        </td>
                                        <td>
                                            @if($one_invoice->payable_amount)
                                            Rs. {{ $one_invoice->payable_amount}}
                                            @else
                                            N/A
                                            @endif
                                        </td>
                                        <td>
                                            @if($one_invoice->created_at)
                                            {{$one_invoice->created_at->format('d-m-Y')}}
                                            @else
                                                Not Availble
                                            @endif
                                        </td>
                                        <td>
                                            @if($one_invoice->for_month)
                                                @php
                                                $f_date=date_create($one_invoice->for_month);
                                                @endphp
                                                {{ date_format($f_date,"F-Y") }}
                                            @else
                                                Not Availble
                                            @endif
                                        </td>
                                        <td>
                                            @if($one_invoice->due_date)
                                                @php
                                                $f_date=date_create($one_invoice->due_date);
                                                @endphp
                                                {{ date_format($f_date,"d-m-Y") }}
                                            @else
                                                Not Availble
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                            $tmp_id_0 = Crypt::encrypt($one_invoice->ts_invoice_id);                         
                                            $tmp_id_1 = $one_invoice->for_month;
                                            $tmp_id_2 = $one_invoice->due_date;
                                            @endphp    
                                            <a href="{{route('owner.invoices.get',['tmp_id_0'=>$tmp_id_0,'tmp_id_1'=>$tmp_id_1,'tmp_id_2'=>$tmp_id_2])}}" target="_blank">View PDF</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                        <div class="alert alert-danger text-center">
                            <span><b> Info - </b> No invoice found !</span>
                        </div>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
<div id="divLoading"> 

</div>
<div class="modal" tabindex="-1" role="dialog" id="upload-rental-agrmnt" data-backdrop="false" aria-labelledby="myModalLabel" style="background-color: rgba(0, 0, 0, 0.5);">
        <div class="modal-dialog">
            <div class="modal-content">
                <div style="" class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Upload Rental Agreement</h4>
                </div>
                <div class="modal-body">
                    <form id="oat-rental-agrmnt-up" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Select PDF Document</label>
                        <input name="oat_rental_agrmnt" class="file" type="file" data-show-upload="false">
                    </div>
                    <div class="text-right">
                    <button type="submit" class="btn btn-info btn-fill">Upload</button>
                    </div>
                    </form>
                </div>
          </div>
        </div>
      </div><!-- /.modal -->
</div>
@include('includes.adminfooter')
</div>
<script>
var token = '{{Session::token()}}';
var url_renatl_upload = '{{route('rental.agreement.upload')}}';
</script>
@endsection

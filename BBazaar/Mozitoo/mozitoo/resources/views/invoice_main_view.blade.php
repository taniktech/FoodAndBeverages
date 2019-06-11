@extends('layouts.admin')
@section('admin')
@section('active5')
    class="active"
@endsection
@include('includes.adminheader')
<div class="main-panel">
  @section('DashboardSiteMap')
      Admin Dashboard / All Invoices
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
                                    <p>Draft Invoices</p>
                                    @if($dr_invoices)
                                    {{count($dr_invoices)}}
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <hr />
                            <div class="stats">
                                @if($dr_invoices && count($dr_invoices) > 0)
                                <a href="{{route('admin.invoices.get.draft')}}"><i class="pe-7s-angle-right-circle"></i> View </a>
                                @else
                                <a href="{{route('admin.invoices.views')}}"><i class="pe-7s-angle-right-circle"></i> Refresh </a>
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
                                <p>Pending Invoices</p>
                                @if($pend_invoices)
                                {{count($pend_invoices)}}
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <hr />
                        <div class="stats">
                            @if($pend_invoices && count($pend_invoices) > 0)
                            <a href="{{route('admin.invoices.get.pending')}}"><i class="pe-7s-angle-right-circle"></i> View </a>
                            @else
                            <a href="{{route('admin.invoices.views')}}"><i class="pe-7s-angle-right-circle"></i> Refresh </a>
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
                                <p>Paid Invoices</p>
                                
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <hr />
                        <div class="stats">
                            
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
                            <p>Tab 4</p>
                            
                        </div>
                    </div>
                </div>
                <div class="footer">
                    <hr />
                    <div class="stats">
                        
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
                <div class="content">
                <!-- Single button -->
                <div class="text-right">
                <button type="submit" class="btn btn-warning btn-fill" id="send-reminder" style="">Send Reminders</button>
                <div class="btn-group">
                    <button type="button" class="btn btn-fill btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Create Invoice <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                    <li><a href="{{route('admin.invoices.create.bulk.view')}}">Bulk Invoice</a></li>
                    <li><a href="{{route('admin.invoices.create.custom.view')}}">Custom Invoice</a></li>
                    </ul>
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
                    <h4 class="title">All Invoices List</h4>
                    <p class="category">All Invoices List</p>
                </div>        
                <div class="content table-responsive table-full-width">
                    @if(count($all_invoices) > 0)
                    <table class="table table-hover table-striped">
                        <thead>
                            <th>Sl.</th>
                            <th>Status</th>
                            <th>Property</th>
                            <th>Inventory ID</th>                            
                            <th>Tenant Name</th>
                            <th>Tenant Email</th>
                            <th>Tenant Mobile</th>
                            <th>Total Amount</th>
                            <th>Invoice Date</th>
                            <th>For Month</th>
                            <th>Due Date</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @php
                            $i = 0;
                            @endphp
                            @foreach($all_invoices as $one_item)
                                @php
                                $i++;
                                @endphp
                            <tr>
                                <td>{{ $i }}.</td>
                                <td>
                                    @if($one_item->invoice_status_id && $one_item->msInvoiceStatusFun)
                                    @if($one_item->invoice_status_id == 1)
                                    <p class="text-info">{{ucwords($one_item->msInvoiceStatusFun->invoice_status)}}</p>
                                    @endif
                                    @if($one_item->invoice_status_id == 2)
                                    <p class="text-warning">{{ucwords($one_item->msInvoiceStatusFun->invoice_status)}}</p>
                                    @endif
                                    @if($one_item->invoice_status_id == 3)
                                    <p class="text-success">{{ucwords($one_item->msInvoiceStatusFun->invoice_status)}}</p>
                                    @endif
                                    @else
                                        Not Availble
                                    @endif

                                </td>
                                <td>
                                    @if($one_item->prop_id && $one_item->tsPropFun && $one_item->tsInventoryFun->prop_id == $one_item->prop_id)
                                    {{ ucwords($one_item->tsPropFun->prop_title)}}
                                    @else
                                        Not Availble
                                    @endif
                                </td>
                                <td>
                                    @if($one_item->ts_prop_invnt_id && $one_item->tsInventoryFun && $one_item->tsInventoryFun->fomatted_invnt_id && $one_item->tsInventoryFun->prop_id == $one_item->prop_id)
                                    {{ ucwords($one_item->tsInventoryFun->fomatted_invnt_id)}}
                                    @else
                                        Not Availble
                                    @endif
                                </td>
                                <td>
                                    @if($one_item->user_id && $one_item->msTenantFun && $one_item->msTenantFun->name)
                                    {{ ucwords($one_item->msTenantFun->name)}}
                                    @else
                                        Not Availble
                                    @endif
                                </td>
                                <td>
                                    @if($one_item->user_id && $one_item->msTenantFun && $one_item->msTenantFun->email)
                                    {{ $one_item->msTenantFun->email}}
                                    @else
                                        Not Availble
                                    @endif
                                </td>
                                <td>
                                    @if($one_item->user_id && $one_item->msTenantFun && $one_item->msTenantFun->mobile)
                                    {{ $one_item->msTenantFun->mobile}}
                                    @else
                                        Not Availble
                                    @endif
                                </td>
                                <td>
                                    @if($one_item->payable_amount)
                                    Rs. {{ $one_item->payable_amount}}
                                    @else
                                    N/A
                                    @endif
                                </td>
                                <td>
                                    @if($one_item->created_at)
                                    {{$one_item->created_at->format('d-m-Y')}}
                                    @else
                                        Not Availble
                                    @endif
                                </td>
                                <td>
                                    @if($one_item->for_month)
                                        @php
                                        $f_date=date_create($one_item->for_month);
                                        @endphp
                                        {{ date_format($f_date,"F-Y") }}
                                    @else
                                        Not Availble
                                    @endif
                                </td>
                                <td>
                                    @if($one_item->due_date)
                                        @php
                                        $f_date=date_create($one_item->due_date);
                                        @endphp
                                        {{ date_format($f_date,"d-m-Y") }}
                                    @else
                                        Not Availble
                                    @endif
                                </td>
                                <td>
                                    @php
                                    $tmp_id_0 = Crypt::encrypt($one_item->ts_invoice_id);                         
                                    $tmp_id_1 = $one_item->for_month;
                                    $tmp_id_2 = $one_item->due_date;
                                    @endphp    
                                    <a href="{{route('admin.invoices.one.get.details',['tmp_id_0'=>$tmp_id_0,'tmp_id_1'=>$tmp_id_1,'tmp_id_2'=>$tmp_id_2])}}"><button type="button" class="btn btn-info btn-fill">See more</button></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                <div class="alert alert-danger text-center">
                    <span><b> Info - </b> There is no invoice</span>
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
@include('includes.adminfooter')
</div>
<script>
var token = '{{Session::token()}}';
var url_send_reminder = '{{route('admin.send.reminder')}}';
</script>
@endsection

@extends('layouts.owner')
@section('owner')
@section('active3')
    class="active"
@endsection
@include('includes.ownerheader')
<div class="main-panel">
  @section('DashboardSiteMap')
      Owner Dashboard / All Invoices
  @endsection
@include('includes.ownernav')
<div class="content">
    <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">All Invoices</h4>
                            <p class="category">Details of all Invoices</p>
                        </div>        
                        <div class="content table-responsive table-full-width">
                            @if(isset($invoices) && count($invoices) > 0)
                            <table class="table table-hover table-striped">
                                <thead>
                                    <th>Sl.</th>
                                    <th>Status</th>  
                                    <th>Appartment Name</th>                         
                                    <th>Tenant Name</th>
                                    <th>Tenant Email</th>
                                    <th>Tenant Mobile</th>
                                    <th>Total Amount</th>
                                    <th>Invoice Date</th>
                                    <th>For Month</th>
                                    <th>Due Date</th>
                                    <th>Payment Mode</th>
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
                                            @if($one_invoice->prop_id && $one_invoice->tsPropFun && $one_invoice->tsPropFun->prop_title)
                                            {{ ucwords($one_invoice->tsPropFun->prop_title)}}
                                            @else
                                                N/A
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
                                            @if($one_invoice->payment_type_id && $one_invoice->msPaymentType)
                                            {{ $one_invoice->msPaymentType->payment_type }}
                                            @else
                                            N/A
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
</div>
@include('includes.adminfooter')
</div>
<script>
var token = '{{Session::token()}}';
</script>
@endsection

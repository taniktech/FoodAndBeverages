@extends('layouts.admin')
@section('admin')
@section('active5')
    class="active"
@endsection
@include('includes.adminheader')
<div class="main-panel">
  @section('DashboardSiteMap')
      Admin Dashboard / Invoice Details
  @endsection
@include('includes.adminnav')
<div class="content">
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                @if(isset($data['invoice_id']))
                @php
                $tmp_id_0 = Crypt::encrypt($data['invoice_data']->ts_invoice_id);                         
                $tmp_id_1 = $data['invoice_data']->for_month;
                $tmp_id_2 = $data['invoice_data']->due_date;
                @endphp   
                <div class="header">
                    <h4 class="title">Invoice Summary : <a href="{{route('admin.invoices.get',['tmp_id_0'=>$tmp_id_0,'tmp_id_1'=>$tmp_id_1,'tmp_id_2'=>$tmp_id_2])}}" target="_blank">{{ $data['invoice_id']}}(Click here to see PDF)</a></h4>
                    <p class="category">Invoice Summary</p>
                </div>
                @endif
                <div class="content">
                     <!--Basic details --> 
                    <div class="row">
                        <div class="col-md-4">
                            <p class="category">Basic Details</p>
                            @if(isset($data['invoice_data']))
                            <div class="table-responsive table-full-width">
                                <table class="table table-striped">
                                <tbody>
                                    <tr>
                                    <td class="text-left">Total Amount</td>
                                    <td class="text-left">:</td>
                                    <td class="text-left">
                                        @if($data['invoice_data']->total_amount)
                                            Rs. {{$data['invoice_data']->total_amount}}
                                        @else
                                            Not Availble
                                        @endif
                                    </td> 
                                    </tr>  
                                    <tr>
                                    <td class="text-left">Due Date</td>
                                    <td class="text-left">:</td>
                                    <td class="text-left">
                                        @if($data['invoice_data']->due_date)
                                        @php
                                        $f_date=date_create($data['invoice_data']->due_date);
                                        @endphp
                                        {{ date_format($f_date,"d-m-Y") }}
                                        @else
                                            Not Availble
                                        @endif
                                    
                                    </td> 
                                    </tr>
                                    <tr>
                                    <td class="text-left">For Month</td>
                                    <td class="text-left">:</td>
                                    <td class="text-left">
                                        @if($data['invoice_data']->for_month)
                                            @php
                                            $f_date=date_create($data['invoice_data']->for_month);
                                            @endphp
                                            {{ date_format($f_date,"F-Y") }}
                                        @else
                                            Not Availble
                                        @endif
                                    </td> 
                                    </tr>   
                                </tbody>
                                </table>
                            </div>
                            @else
                            <p class="category">Details Not Availble</p>
                            @endif
                        </div>
                        <div class="col-md-4" style="border-inline-start-style: solid;">
                                <p class="category">Tenant Details</p>
                                @if(isset($data['tenant_details']))
                                <div class="table-responsive table-full-width">
                                    <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                        <td class="text-left">Name</td>
                                        <td class="text-left">:</td>
                                        <td class="text-left">
                                            @if($data['tenant_details']->name)
                                                {{ucwords($data['tenant_details']->name)}}
                                            @else
                                                Not Availble
                                            @endif
                                        </td> 
                                        </tr>  
                                        <tr>
                                        <td class="text-left">Mobile</td>
                                        <td class="text-left">:</td>
                                        <td class="text-left">
                                            @if($data['tenant_details']->mobile)
                                                {{$data['tenant_details']->mobile}}
                                            @else
                                                Not Availble
                                            @endif
                                        </td> 
                                        </tr>  
                                        <tr>
                                        <td class="text-left">Email</td>
                                        <td class="text-left">:</td>
                                        <td class="text-left">
                                            @if($data['tenant_details']->email)
                                                {{$data['tenant_details']->email}}
                                            @else
                                                Not Availble
                                            @endif
                                        </td> 
                                        </tr> 
                                    </tbody>
                                    </table>
                                </div>
                                @else
                                <p class="category">Details Not Availble</p>
                                @endif
                        </div>
                        <div class="col-md-4" style="border-inline-start-style: solid;">
                                <p class="category">Owner Details</p>
                                @if(isset($data['owner_details']))
                                <div class="table-responsive table-full-width">
                                    <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                        <td class="text-left">Name</td>
                                        <td class="text-left">:</td>
                                        <td class="text-left">
                                            @if($data['owner_details']->name)
                                                {{ucwords($data['owner_details']->name)}}
                                            @else
                                                Not Availble
                                            @endif
                                        </td> 
                                        </tr>  
                                        <tr>
                                        <td class="text-left">Mobile</td>
                                        <td class="text-left">:</td>
                                        <td class="text-left">
                                            @if($data['owner_details']->mobile)
                                                {{$data['owner_details']->mobile}}
                                            @else
                                                Not Availble
                                            @endif
                                        </td> 
                                        </tr>  
                                        <tr>
                                        <td class="text-left">Email</td>
                                        <td class="text-left">:</td>
                                        <td class="text-left">
                                            @if($data['owner_details']->email)
                                                {{$data['owner_details']->email}}
                                            @else
                                                Not Availble
                                            @endif
                                        </td> 
                                        </tr> 
                                    </tbody>
                                    </table>
                                </div>
                                @else
                                <p class="category">Details Not Availble</p>
                                @endif
                            </div>
                    </div>  
                <hr>  
                @if(isset($data['invoice_data']) && $data['invoice_data']['invoice_status_id'] == 3)
                <div class="">
                        <h4 class="title"><span class="text-success">Paid <i class="pe-7s-check"></i></span></h4>
                        <p class="category">Payment Details</p>
                </div>     
                    <div class="table-responsive table-full-width">
                        <table class="table table-striped">
                        <tbody>
                            <tr>
                            <td class="text-left">Transaction ID</td>
                            <td class="text-left">:</td>
                            <td class="text-left">
                                @if($data['invoice_data']['payment_transaction_id'])
                                {{$data['invoice_data']['payment_transaction_id']}}
                                @else
                                    Not Availble
                                @endif
                            ,</td>
                            <td class="text-left">Payment Date</td>
                            <td class="text-left">:</td>
                            <td class="text-left">
                                @if($data['invoice_data']['updated_at'])
                                    {{$data['invoice_data']['updated_at']->format('d-M-Y h:i A')}}
                                @else
                                    Not Availble
                                @endif
                            ,</td> 
                            <td class="text-left">Amount</td>
                            <td class="text-left">:</td>
                            <td class="text-left">
                                @if($data['invoice_data']->total_amount)
                                    Rs. {{$data['invoice_data']->total_amount}}
                                @else
                                    Not Availble
                                @endif
                            ,</td>
                            <td class="text-left">Payment Mode</td>
                            <td class="text-left">:</td>
                            <td class="text-left">
                                @if($data['invoice_data']->payment_type_id == 1)
                                    Online
                                @else
                                    Not Availble
                                @endif
                            </td>  
                            </tr> 
                        </tbody>
                        </table> 
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>
</div>
</div>
@include('includes.adminfooter')
</div>
<script>
var token = '{{Session::token()}}';
</script>
@endsection
